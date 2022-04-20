<div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row  mb-2">
                    <div class="col-8">
                            <div class="page-header mb-2">
                                <h2 class="pageheader-title">Business List  </h2>
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
                <!-- Filter Criteria Form start -->
        <div class="card collapse show" id="collapseExample">
            <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                <div class="card-body">
                        <div class="form-row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Business Name</label>
                                <input type="text" name="client_name"  class="form-control" id="client_name" placeholder="Business Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Business Type</label>
                                <input type="text" name="buisness_type"  class="form-control" id="buisness_type" placeholder="Business Type">
                            </div>
                        </div>
                       <div class="col-xl-2 col-lg-2 col-md-2">
                             <label class="clearfix">&nbsp;</label><br>
                             <button name="filter_order_filter" type="button" class="btn btn-rounded bg-info pd-6-30" id="filter-order-filter" value="filter"><i class="fa fa-search fa-fw"></i></button>  
                        </div>
                </div>
        </div>
                <!-- Filter Criteria Form end -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive" id="render-list-of-order">                                      
                                <table class="table table-striped table-bordered first resizable" id="buisnessDataTable" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Business Name</th>
                                            <th>Business Type</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($buisnessListRecords))
                                        {
                                            foreach($buisnessListRecords as $record)
                                            {

                                                // $marketType = str_replace("_"," ",$record->marketType);
                                                // $buildingType = str_replace("_"," ",$record->buildingType);
                                        ?>
                                            <tr>
                                                <td><?php echo $record->client_name ?></td> 
                                                <td><?php echo $record->buisness_type ?></td> 
                                                <td><?php echo $record->phone_no ?></td>
                                                <td><?php echo $record->address ?></td>
                                                <td class="text-center">
                                                    <a title="Edit" href="<?php echo base_url().'editBuisness/'.$record->id; ?>" class="btn btn-rounded bg-warning btn-sm"> <i class="fa fa-pencil-alt"></i> </a>
                                                    <a title="Delete" href="#" data-contactid="<?php echo $record->id; ?>" onClick="delete_buisness(<?php echo $record->id; ?>)" class="btn btn-rounded bg-danger deleteList btn-sm"> <i class="fa fa-trash-alt"></i> </a>
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
<?php 
if(!empty($stateresult)){ 
    $stateFalg = 1;
 }else{
    $stateFalg = 0;
 } ?>

<input type="hidden" class="tablestateresult" name="tablestateresult" id="tablestateresult"  value="<?php echo $stateFalg;?>">    

<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
 --><script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/css/jquery-ui.css">

<script src="<?php echo base_url(); ?>assets/libs/js/jquery-ui.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
            $('#buisnessDataTable').dataTable( {
            "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
              "dom": '<"top"i>rt<"bottom"flp><"clear">',
                "sDom": "Rlfrtip",
                "stateSave": true,
                'autoWidth': false,
            } );
    });

    jQuery(document).on('click','#filter-order-filter', function(){

        var client_name = $("#client_name").val();
        var buisness_type = $("#buisness_type").val();
        
        var data = {client_name:client_name, buisness_type:buisness_type};
        generateLeadTable(data);
    });

    // generate Order Table
    function generateLeadTable(element){ 

        jQuery.ajax({
            url: "<?php echo site_url('buisnesslist/getFilterList')?>",
            data: {'client_name' : element.client_name,'buisness_type':element.buisness_type},
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
                        { title: "Business Name"},
                        { title: "Business Type"},
                        { title: "Phone Number"},  
                        { title: "Address"},   
                        { title: "Action"}
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

    function delete_buisness(buisnessId){
            swal({
              title: "Are you sure to delete bid?",
              text: "Your will not be able to recover this bid!",
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
                url : "<?php echo base_url(); ?>deleteBuisnessResults",
                data : { buisnessId : parseInt(buisnessId) } 
                }).done(function(data){
                    
                    if(data.status == true) {
                        swal({title: "Deleted!", text: "Business has been deleted.!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }
                    else if(data.status == false) { 
                        swal("failed!", "Business deletion failed.Business is associated with project or contact", "error");
                    }                    
                });
              
            });        
    }

</script>
<style type="text/css">
.dataTables_length {
        display: block;
    }
</style>