 <div class="dashboard-wrapper" id="page-content-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
            <!-- pageheader -->
            <!-- ============================================================== -->
            
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->


        <!-- Filter Criteria Form start -->
         <!-- Filter Criteria Form start -->
         <div class="row">
                <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
            <div class="card editViewLeadClass">

                <div class="custom-card"><h5 class="card-header"> Create New User 
                </h5>
            </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <?php $this->load->helper("form"); ?>
                            <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUserSubmit" method="post" role="form">
                                <div class="form-row">
                                    <div class="form-group col-xl-6 mb-4">
                                        <label for="fname">Full Name *</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" placeholder=""  maxlength="128">
                                    </div>
                                    <div class="form-group col-xl-6 mb-4">
                                       <label for="email">Email address *</label>
                                         <input type="email" class="form-control required email" id="email" value="<?php echo set_value('email'); ?>" name="email" maxlength="128">
                                    </div>
                                    <div class="form-group col-xl-6 mb-4">
                                       <label for="password">Password *</label>
                                        <input type="password" class="form-control required" id="password" name="password" maxlength="20">
                                    </div>
                                    <div class="form-group col-xl-6 mb-4">
                                       <label for="cpassword">Confirm Password *</label>
                                        <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="20">
                                    </div>
                                    <div class="form-group col-xl-6 mb-4">
                                       <label for="mobile">Mobile Number *</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo set_value('mobile'); ?>" name="mobile" maxlength="10">
                                    </div>

                                    <div class="form-group col-xl-6 mb-4">
                                    <label for="Extension">Extension *</label>
                                      <input type="text" class="form-control" id="extension" placeholder="Extension" name="extension" value="<?php if(isset($extension)) echo $extension; ?>" >
                                    </div>


                                    <div class="form-group col-xl-6 mb-4">
                                       <label for="role">Role *</label>
                                        <select class="form-control required" id="role" name="role">
                                            <option value="0">Select Role</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->roleId ?>" <?php if($rl->roleId == set_value('role')) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="row col-sm-12" id="show_product">  
                                        
                                    </div>
                                    <div class="col-lg-3 offset-lg-4 col-md-6 offset-md-3">
                                        <input type="submit" class="btn btn-rounded btn-block bg-info" value="Submit" />
                                    </div>
                                </div>
                            </form> 
                        </div>
                        </div>                       
                    </div>
            </div>
            <!-- Filter Criteria Form end -->
</div>
<script>

$(document).ready(function(){
    baseURL = '<?php echo base_url() ?>'+'/User/';
    var addUserForm = $("#addUser");    
    var validator = addUserForm.validate({        
        rules:{
            fname :{ required : true },
            email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },            
            password : { required : true },
            cpassword : {required : true, equalTo: "#password"},
            mobile : { required : true, digits : true },
            extension : { required : true},
            role : { required : true, selected : true}
        },
        messages:{
            fname :{ required : "This field is required" },
            email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
            password : { required : "This field is required" },
            cpassword : {required : "This field is required", equalTo: "Please enter same password" },
            mobile : { required : "This field is required", digits : "Please enter numbers only" },
            role : { required : "This field is required", selected : "Please select atleast one option" }           
        }
    });
});
</script>
<script>  
 $(document).ready(function(){  
      $('#role').change(function(){  
           var roleId = $(this).val();      
           $.ajax({  
                url:"../User/loadData",  
                method:"POST",  
                data:{roleId:roleId},  
                success:function(data){                       
            $('#show_product').html(data);  
                }  
           });  
      });               
 });  
 </script>