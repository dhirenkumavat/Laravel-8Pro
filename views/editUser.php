<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
$extension = $userInfo->extension;
?>


 <div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">            
                <!-- Filter Criteria Form start -->
                <div class="card editViewLeadClass">
                    <div class="custom-card"><h5 class="card-header"> Edit User</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <form role="form" action="<?php echo base_url() ?>editUserSubmit" method="post" id="editUser" role="form">
                                        <div class="form-row">
                                            
                                             
                                            <div class="form-group col-xl-6 mb-4">
                                               <label for="fname">Full Name</label>
                                               <input type="text" class="form-control" id="fname" placeholder="Full Name" name="fname" value="<?php echo $name; ?>" maxlength="128">
                                                <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />  
                                            </div>
                                                                                
                                            
                                            <div class="form-group col-xl-6 mb-4">
                                                 <label for="email">Email address</label>
                                               <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>" maxlength="128"> 
                                            </div>

                                             
                                            <div class="form-group col-xl-6 mb-4">
                                                <label for="password">Password</label>
                                               <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="20">
                                            </div>

                                             
                                            <div class="form-group col-xl-6 mb-4">
                                                <label for="cpassword">Confirm Password</label>
                                              <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" maxlength="20">
                                            </div>

                                             
                                            <div class="form-group col-xl-6 mb-4">
                                            <label for="mobile">Mobile Number</label>
                                              <input type="mobile" class="form-control" id="mobile" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                            </div>

                                            <div class="form-group col-xl-6 mb-4">
                                            <label for="Extension">Extension</label>
                                              <input type="text" class="form-control" id="extension" placeholder="Extension" name="extension" value="<?php echo $extension; ?>" >
                                            </div>

                                            
                                            <div class="form-group col-xl-6 mb-4">
                                                <label for="role">Role</label>
                                              <select class="form-control" id="role" name="role">
                                                    <option value="0">Select Role</option>
                                                    <?php
                                                    if(!empty($roles))
                                                    {
                                                        foreach ($roles as $rl)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $rl->roleId; ?>" <?php if($rl->roleId == $roleId) {echo "selected=selected";} ?>><?php echo $rl->role ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div> 
                                            <div class="row col-sm-12" id="show_product">                                              
                                            <?php 
                                            if(isset($departmentUserAssignedInfo) && !empty($departmentUserAssignedInfo)){
                                              $departmentUserAssignedInfo = array_column($departmentUserAssignedInfo, 'salesManagerId');
                                              if($roleId==2) 
                                              {
                                                  $roleId = 3;           
                                                  if(isset($roleId))
                                                   {
                                                        $output = '<div class="col-sm-12">
                                                                                    <h4 class="salesmanagerHeding">Sales Manager</h4>
                                                                                    <ul class="mailsalesul">';                
                                                        $sql = "SELECT * FROM amp_users WHERE roleId in (".$roleId.")";            
                                                        $result =  $this->db->query($sql)->result_array();
                                                        //echo "<pre>";print_r($result);
                                                        //echo "<pre>";print_r($departmentUserAssignedInfo);
                                                        foreach ($result as $key => $row) {  
                                                        $checked =  (in_array($row["userId"], $departmentUserAssignedInfo))?'checked' :'';
                                                         $output .= '<li>
                                                                                        <label class="custom-control custom-checkbox">
                                                                                            <input type="checkbox" class ="salesManager custom-control-input" '.$checked.' name="salesManager[]" value="'.$row["userId"].'"/>
                                                                                            <span class="custom-control-label">'.$row["name"].'</span>
                                                                                        </label>
                                                                                      </li>';                          

                                                            $sqlUserAssigned = " SELECT amp_userassigned.userassigned as userId, amp_users.name as name from amp_userassigned left join amp_users on amp_users.userId  = amp_userassigned.userassigned WHERE userassigned > 0 and executiveId = 0 and amp_userassigned.salesManagerId =  ".$row["userId"];            
                                                            $resultUserAssigned =  $this->db->query($sqlUserAssigned)->result_array();

                                                            if(isset($resultUserAssigned) && !empty($resultUserAssigned))
                                                            {
                                                                $output .= '<li> <span class="salesRepheading">Sales Reps</span>
                                                                                        <ul class="salesperul">';
                                                                foreach ($resultUserAssigned as $key => $userAssigned) {
                                                                    
                                                                    $output .= '<li>
                                                                                            <label class="custom-control custom-checkbox">
                                                                                                <span class="custom-label">'.$userAssigned["name"].'</span>
                                                                                            </label>
                                                                                          </li>';
                                                                }
                                                                $output .="</ul></li>";
                                                            } 
                                                        }
                                                         $output .= '</ul></div>';   
                                                        echo $output;  
                                                   }
                                              }
                                            }
                                                if(isset($AllSalesAgentInfo) && !empty($AllSalesAgentInfo))
                                                {
                                                  $salesUserAssignedInfo = array_column($salesUserAssignedInfo, 'userassigned');
                                                    echo ' <div class="col-sm-12"><ul class="mailsalesul"><li> <span class="salesRepheading">Sales Reps</span>
                                                    <ul class="salesperul">';
                                                    $resultUserAssigned = $salesUserAssignedInfo;
                                                   {    
                                                        foreach ($AllSalesAgentInfo as $key => $row) {
                                                                $checked =  (in_array($row["userId"], $salesUserAssignedInfo))?'checked' :'';
                                                                if($row["userId"] > 0) {
                                                                {                                                                    
                                                                        $output = '
                                                                        <li>
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class ="salesAgent salesManager custom-control-input" '.$checked.' value="'.$row["userId"].'" name="salesAgent[]"/>
                                                                            <span class="custom-control-label">'.$row["name"].'</span>
                                                                        </label>
                                                                      </li>';                                 
                                                                }
                                                            }                                                            
                                                            echo $output;
                                                        } 
                                                   }
                                                   echo '</ul>
                                                  </li></ul>
                                                  </div>';
                                                }
                                            ?>             
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                                                <input type="submit" class="btn btn-rounded bg-info" value="Update"> &nbsp;&nbsp;
                                                <a href="<?php echo base_url(); ?>userListing" class="btn btn-rounded bg-warning"> Cancel </a>
                                            </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card editViewLeadClass">
                    <div class="custom-card"><h5 class="card-header"> System Logs</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                   
                                         <div class="row">
              <div class="table-responsive" id="render-list-of-order">                                      
                  <table class="table table-striped table-bordered first"  cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Last Login</th>
                      <th>Message</th>
                    </tr>
                  </thead>
                   <tbody>
                    <?php
                      if(!empty($loginInfo))
                      {
                        foreach($loginInfo as $record)
                        {
                      ?>
                    <tr>
                      <td><?php echo $record['id'] ?> </td>  
                      <td> <?php echo $record['name'] ?> </td> 
                      <td><?php echo  date("m/d/Y", strtotime($record['lastLogin'])).'--'.$record['createdDtm'] ?></td>
                      <td> <?php echo $record['name'].' has logged in ' ?> </td> 
                     </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="box-footer clearfix">
                <?php echo $this->pagination->create_links(); ?>
              </div>
          </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Filter Criteria Form end -->
    </div>
</div>
<script>  
  $(document).ready(function(){
   baseURL = '<?php echo base_url() ?>'+'/User/';
  var editUserForm = $("#editUser");
  
  var validator = editUserForm.validate({
    
    rules:{
      fname :{ required : true },
      email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post", data : { userId : function(){ return $("#userId").val(); } } } },
      cpassword : {equalTo: "#password"},
      mobile : { required : true, digits : true },
      extension : { required : true},
      role : { required : true, selected : true}
    },
    messages:{
      fname :{ required : "This field is required" },
      email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
      cpassword : {equalTo: "Please enter same password" },
      mobile : { required : "This field is required", digits : "Please enter numbers only" },
      role : { required : "This field is required", selected : "Please select atleast one option" }     
    }
  });
});
 $(document).ready(function(){  
      $('#role').change(function(){  
           var roleId = $(this).val();      
           $.ajax({  
                url:"../User/loadDataEdit/<?php echo $userId; ?>",  
                method:"POST",  
                data:{roleId:roleId,userId:'<?php echo $userId; ?>'},  
                success:function(data){                       
            $('#show_product').html(data);  
                }  
           });  
      });               
 });  
 </script>