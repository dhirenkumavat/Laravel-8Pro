<div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row  mb-2">
                    <div class="col-8">
                            <div class="page-header mb-2">
                                <h2 class="pageheader-title">Contacts </h2>
                            </div>
                        </div>
                        <div class="col-4 text-right">
                            <a class="btn btn-rounded bg-warning btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                </div>
                
                <div class="col-xs-6 text-left">
                    <?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>
                        <?php echo $this->session->flashdata('error'); ?>                    
                    </div>
                    <?php } ?>
                    <?php  
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> x </button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } ?>
                </div>
                <!-- Filter Criteria Form start -->
                <div class="card collapse show" id="collapseExample">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Contact Name</label>
                                <input type="text" name="contact_name"  class="form-control" id="contact_name" placeholder="Contact Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Business Name</label>
                                <input type="text" name="business_name"  class="form-control" id="business_name" placeholder="Business Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4 phoneinput">
                                <label>Phone Number</label>
                                <input type="text" name="contact_phone" maxlength="10" class="form-control" id="contact_phone" placeholder="Phone Number">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Email Address</label>
                                <input type="text" name="contact_email"  class="form-control" id="contact_email" placeholder="Email Address">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Assigned To</label>
                                <!-- <input type="text" name="contact_email"  class="form-control" id="contact_email" placeholder="Email Address"> -->
                                <select class="form-control" id="assigned_to" name="assigned_to">
                                    <option value="">Select Assigned To</option>
                                        <?php
                                        if(!empty($userList))
                                        {

                                            foreach ($userList as $user)
                                            {
                                                //print_r($user);
                                                ?>
                                                <option data-tokens="<?php echo $user->userId; ?>" value="<?php echo $user->userId; ?>"><?php echo $user->name ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Notes</label>
                                <input type="text" name="notes"  class="form-control" id="notes" placeholder="Notes">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Buisness Type</label>
                                <input type="text" name="buisness_type"  class="form-control" id="buisness_type" placeholder="Buisness Type">
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2">
                                 <label class="clearfix">&nbsp;</label><br>
                                 <button name="filter_order_filter" type="button" class="btn btn-rounded bg-info pd-6-30" id="filter-order-filter" value="filter"><i class="fa fa-search fa-fw"></i></button>  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Filter Criteria Form end -->
                <div class="card">
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-xl-12 col-lg-4 col-md-12 col-sm-12">
                                <a href="<?php echo base_url() ?>add_contact" class="btn btn-rounded bg-warning m-t-b float-right m-b-0"> <i class="fa fa-plus"></i> </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive" id="render-list-of-order">                                      
                                    <table class="table table-striped table-bordered first" id="contactTable"  cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" class="checkboxAll" id="select_all" onclick="selectAllChkbox('all');">
                                                </th>
                                                <th>Contact Name</th>
                                                <th>Business Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Notes</th>
                                                <th>Buisness Type</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($contactRecords))
                                            {
                                                foreach($contactRecords as $record)
                                                { 
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" class="checkbox" name="CalChkBox" value="<?php echo $record->contactId; ?>" onclick="selectAllChkbox('single');"></td>
                                                    <td><a title="Edit" href="<?php echo base_url().'editContact/'.$record->contactId; ?>"><?php echo $record->contact_name ?></a> </td>  
                                                    <td> <?php echo $record->client_name ?> </td> 
                                                    <td> <?php echo $record->contact_email ?> </td> 
                                                    <td> <?php echo $record->contact_phone ?> </td> 
                                                    <td> <?php echo $record->comment ?> </td> 
                                                    <td> <?php echo $record->buisness_type ?> </td> 
                                                    <td class="text-center">    
                                                        <a title="Edit" href="<?php echo base_url().'editContact/'.$record->contactId; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
                                                        <a title="Delete" href="#" data-contactid="<?php echo $record->contactId; ?>" onClick="delete_contact(<?php echo $record->contactId; ?>)" class="btn btn-rounded bg-danger deleteLead btn-sm"> <i class="fa fa-trash-alt"></i> </a>
                                                    </td>
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
    </div>
</div>      
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/css/jquery-ui.css">
<script src="<?php echo base_url(); ?>assets/libs/js/jquery-ui.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css">
<script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        // Initialize select2
        $("#assigned_to").select2();         
    });
</script>

<script type="text/javascript">
     $(document).ready(function() {
        $('#contactTable').DataTable( {
           // "bLengthChange": false,
            "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
            //"pageLength": 10,
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
            "sDom": "Rlfrtip",
            });
     });
    // render date datewise
    jQuery(document).on('click','#filter-order-filter', function(){

        var contact_name = $("#contact_name").val();
        var business_name = $("#business_name").val();
        var contact_phone = $("#contact_phone").val();
        var contact_email = $("#contact_email").val();
        var assigned_to = $("#assigned_to").val();
        var notes = $("#notes").val();
        var buisness_type = $("#buisness_type").val();
        
        var data = {contact_name:contact_name, business_name:business_name, contact_phone:contact_phone, contact_email:contact_email, assigned_to:assigned_to,notes:notes,buisness_type:buisness_type};
        generateLeadTable(data);
    });
    // generate Order Table
    function generateLeadTable(element){ 

        jQuery.ajax({
            url: "<?php echo site_url('contact/getFilterList')?>",
            data: {'contact_name' : element.contact_name,'business_name':element.business_name,'contact_phone':element.contact_phone,'contact_email':element.contact_email, 'assigned_to':element.assigned_to, 'notes':element.notes, 'buisness_type':element.buisness_type},
            type: 'post', 
            dataType: 'json',
            beforeSend: function () {
                jQuery('#render-list-of-order').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
            },           
            success: function (html) {
                var dataTable='<table id="order-datatable" class="table table-striped" cellspacing="0" width="100%"></table>';
                jQuery('#render-list-of-order').html(dataTable);        
                var table = $('#order-datatable').DataTable({
                    data: html.data,
                    "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": false,
                    "bInfo": true,
                    "bAutoWidth": true,
                    columns: [
                        { title: "<input type='checkbox' class='checkboxAll' id='select_all' onclick=selectAllChkbox('all');>"},
                        { title: "Contact Name"},
                        { title: "Business Name"},
                        { title: "Email"},
                        { title: "Phone"},  
                        { title: "Comment"},   
                        { title: "Comment"},                   
                        { title: "Buisness Type"}
                    ],              
                });
            }        
        });
    }

    function selectAllChkbox(clickType) {
        var select_all = document.getElementById("select_all"); //select all checkbox
        var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

        //select all checkboxes
        select_all.addEventListener("change", function(e){
            for (i = 0; i < checkboxes.length; i++) { 
                checkboxes[i].checked = select_all.checked;
            }
        });


        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
                //uncheck "select all", if one of the listed checkbox item is unchecked
                if(this.checked == false){
                    select_all.checked = false;
                }
                //check "select all" if all checkbox items are checked
                if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
                    select_all.checked = true;
                }
            });
        }
    }

    function delete_contact(contactId){
            swal({
              title: "Are you sure to delete contact?",
              text: "Your will not be able to recover this contact!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes",
              closeOnConfirm: false
            },
            function(){
                $.ajax({
                type : "POST",
                dataType : "json",
                url : "<?php echo base_url(); ?>deleteContact",
                data : { contactId : contactId } 
                }).done(function(data){
                    if(data.status = true) { 
                        swal({title: "Deleted!", text: "Contact has been deleted.!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }
                    else if(data.status = false) { 
                        swal("failed!", "Contact deletion failed.", "error");
                    }                    
                });
              
            });        
    }

</script>

<style type="text/css">
    .select2-container{
        position: relative;
    }
    .select2-selection__arrow{
        width: 100%;
        height: 100%;
        text-align: right;
        top: 0;
        right: 0;
    }
    .select2-container span{
        outline: none;
    }
    .select2-selection__arrow b{
        right: 18px !important;
        margin-left: auto;
    }
    .dataTables_length {
        display: block;
    }
</style>