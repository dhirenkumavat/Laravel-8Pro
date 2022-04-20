<div class="dashboard-wrapper" id="page-content-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content ">
            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Bids </h2>
                        </div>
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
                <div class="card">
                    <div class="card-body">

                        <div class="form-row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Job Name</label>
                                <input type="text" name="job_name"  class="form-control" id="job_name" placeholder="Job Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Company Name</label>
                                <input type="text" name="company_name"  class="form-control" id="company_name" placeholder="Company Name">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Market Type</label>
                                <select class="form-control" id="market_type" name="market_type">
                                        <option value="">Select Market Type</option>  
                                        <option value="residential">Residential</option>  
                                        <option value="multi_family">Multi Family</option>  
                                        <option value="light_industrial">Light Industrial</option>  
                                        <option value="heavy_industrial">Heavy Industrial</option>  
                                        <option value="commercial">Commercial</option>
                                        <option value="school_K-12">School K-12</option>
                                        <option value="college">College</option>
                                        <option value="hospital">Hospital</option>
                                        <option value="hotel">Hotel</option>
                                        <option value="airport">Airport</option>
                                        <option value="freeway/highway">Freeway/Highway</option>
                                        <option value="other">Other</option> 
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Building Type</label>
                                <select class="form-control" id="building_type" name="building_type">
                                        <option value="">Select Building Type</option>  
                                        <option value="concrete1to3">Concrete  1-3 Story</option>  
                                        <option value="concrete4to10">Concrete  4-10 Story</option>  
                                        <option value="steel_framed1to3">Steel Framed  1-3 Story</option>
                                        <option value="steel_framed4to10">Steel Framed 4-10 Story</option>  
                                        <option value="tilt_up">Tilt-Up</option>  
                                        <option value="wood_stucco">Wood/Stucco</option>  
                                        <option value="brick">Brick</option>
                                        <option value="other">Other</option>  
                                </select>
                            </div>
                            <!-- <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Project Type</label>
                                
                                <input type="text" name="project_type"  class="form-control" id="project_type" placeholder="Project Type">
                            </div> -->
                            <div class="col-xl-4 mb-4">
                                <div class="row"> 
                                    <label style="padding-left: 16px;">Unit Cost</label>
                                </div>
                                <div class="row"> 
                                    <div class="col-xl-4 mb-4">
                                        <select class="form-control" id="unit_cost" name="unit_cost">
                                            <option value=">"> > </option>
                                            <option value="<"> < </option>
                                            <option value=">="> >= </option>
                                            <option value="<="> <= </option>
                                        </select>
                                    </div>
                                    <div class="col-xl-8 mb-4">
                                        <input type="text" name="unit_cost_value" data-type="currency" class="form-control" id="unit_cost_value" placeholder="Unit Cost">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-4">
                                <label>Material Needs</label>
                                <select class="form-control" id="material_needs" name="material_needs[]" multiple>
                                        <!-- <option value="">Select Status</option>   -->
                                        <option value="import_soil">Import Soil</option>  
                                        <option value="export_soil">Export Soil</option>  
                                        <option value="balance_site">Balance Site</option>  
                                        <option value="crush_on_site">Crush on Site</option>
                                        <option value="concrete_haul_Off">Concrete Haul Off</option>      
                                </select>
                                
                            </div>
                            
                        </div>
                        <div class="form-row">
                            <div class="row">                        
                                <div class="form-group col-sm-2 mb-4">
                                    <label>Scope :</label>                                
                                </div> 
                                <div class="form-group col-sm-10 mb-4">
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_all" value="all" class="custom-control-input "><span class="custom-control-label">All</span>
                                    </label>    
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_abatement" value="abatement" class="custom-control-input "><span class="custom-control-label">Abatement</span>
                                    </label>    
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_interior_demolition" value="interior_demolition" class="custom-control-input "><span class="custom-control-label">Interior Demolition</span>
                                    </label>      
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" id="scope_site_demolition" value="site_demolition" class="custom-control-input "><span class="custom-control-label">Site Demolition</span>
                                    </label>      
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" value="earthwork" id="scope_earthwork" class="custom-control-input "><span class="custom-control-label">Earthwork</span>
                                    </label>     
                               
                                    <label class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" name="scope[]" value="other" id="scope_other" class="custom-control-input "><span class="custom-control-label">Other</span>
                                    </label>     
                                </div>                        
                            </div>
                     
                        <div class="form-row">
                            <div class="col-xl-2 col-lg-2 col-md-2">
                                 <label class="clearfix">&nbsp;</label><br>
                                 <button name="filter_order_filter" type="button" class="btn btn-rounded bg-info pd-6-30" id="filter-order-filter" value="filter"><i class="fa fa-search fa-fw"></i></button>  
                            </div>
                        </div>
                   </div>
                    </div>
                </div>
                <!-- Filter Criteria Form end -->
                <div class="card">
                    <div class="card-body">
                        <div class="row LeadsBtnclass">
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                            <h4 class="actionforallhead"> Actions for All: </h4>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                            <a href="<?php echo base_url(); ?>exportExcel" class="btn btn-rounded bg-info btn-block m-t-b"> Export Projects </a>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive" id="render-list-of-order">                                      
                                    <table class="table table-striped table-bordered first resizable" id="bidResultsDataTable" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Job Name</th>
                                                <th>Scope</th>
                                                <th>Company Name</th>
                                                <th>Project Type</th>
                                                <th>Building Type</th>
                                                <th>Building SF</th>
                                                <th>Bid Price</th>
                                                <th>Unit Cost</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(!empty($bidResultsRecords))
                                            {
                                                foreach($bidResultsRecords as $record)
                                                {

                                                    $marketType = str_replace("_"," ",$record->marketType);
                                                    $buildingType = str_replace("_"," ",$record->buildingType);
                                            ?>
                                                <tr>
                                                    <td><a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo $record->projectName ?></a> </td> 
                                                    <td><a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo $record->scope ?></a> </td> 
                                                    <td><a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo $record->companyName ?></a> </td>
                                                    <td><a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo ucfirst($marketType); ?></a> </td> 
                                                    <td><a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo ucfirst($buildingType); ?></a> </td> 
                                                    <td><a title="Edit" href="<?php echo base_url().'editProject/'.$record->projectId; ?>"><?php echo $record->buildingSf; ?></a> </td> 
                                                    <td> <?php setlocale(LC_MONETARY, 'en_US');
                                                                $bidprice = money_format('%.0n', (float)$record->bidPrice);
                                                                echo $bidprice ?> </td> 
                                                    <td> <?php 
                                                    if((float)$record->buildingSf > 0)
                                                            echo number_format((float)$record->bidPrice/(float)$record->buildingSf, 2, '.', '');
                                                    else echo "0";?> </td> 
                                                    <td class="text-center">
                                                        <a title="Delete" href="#" data-contactid="<?php echo $record->id; ?>" onClick="delete_bid(<?php echo $record->id; ?>)" class="btn btn-rounded bg-danger deleteLead btn-sm"> <i class="fa fa-trash-alt"></i> </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
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
<?php 
if(!empty($stateresult)){ 
    $stateFalg = 1;
 }else{
    $stateFalg = 0;
 } ?>

<input type="hidden" class="tablestateresult" name="tablestateresult" id="tablestateresult"  value="<?php echo $stateFalg;?>">    

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/css/jquery-ui.css">

<script src="<?php echo base_url(); ?>assets/libs/js/jquery-ui.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        if($('#tablestateresult').val()=="1"){    
            $('#bidResultsDataTable').dataTable( {
              "dom": '<"top"i>rt<"bottom"flp><"clear">',
              "lengthMenu": [[20, 40, 60, 80, 100, -1], [20, 40, 60, 80, 100, "All"]],
                "sDom": "Rlfrtip",
                "stateSave": true,
                'autoWidth': false,
              "stateSaveCallback": function (settings, data) {
                // Send an Ajax request to the server with the state object
                $.ajax( {
                  "url": '<?php echo base_url()?>/project/saveState',
                  "data": {"name":"BidTable", "state": data} ,//you can use the id of the datatable as key if it's unique,
                  "dataType": "json",
                  "type": "POST",
                  "success": function () {}
                } );
              },
              stateLoadCallback: function(settings) {
                //return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                    var o;
                    // Send an Ajax request to the server to get the data. Note that
                    // this is a synchronous request since the data is expected back from the
                    // function
                    $.ajax( {
                        "url": '<?php echo base_url()?>/project/loadState',
                        "data":{"name":"BidTable"},
                        "async": false,
                        "dataType": "json",
                        "type": "POST",
                        "success": function (json) {
                            o = json;
                        }
                    } );
                    return o;
                }
            } );
        }else{
            $('#bidResultsDataTable').dataTable( {
              "dom": '<"top"i>rt<"bottom"flp><"clear">',
                "sDom": "Rlfrtip",
                "stateSave": true,
                'autoWidth': false,
              "stateSaveCallback": function (settings, data) {
                // Send an Ajax request to the server with the state object
                $.ajax( {
                  "url": '<?php echo base_url()?>/project/saveState',
                  "data": {"name":"BidTable", "state": data} ,//you can use the id of the datatable as key if it's unique,
                  "dataType": "json",
                  "type": "POST",
                  "success": function () {}
                } );
              }
            } );
        } 
    });

    // render date datewise
    jQuery(document).on('click','#filter-order-filter', function(){

        var job_name = $("#job_name").val();
        var company_name = $("#company_name").val();
        var unit_cost = $("#unit_cost").val();
        var market_type = $("#market_type").val();

        var building_type = $("#building_type").val();
       // var scope = $("#scope").val();
        var scope_all = $("#scope_all:checked").val();
        var scope_abatement = $("#scope_abatement:checked").val();
        var scope_interior_demolition = $("#scope_interior_demolition:checked").val();
        var scope_site_demolition = $("#scope_site_demolition:checked").val();
        var scope_earthwork = $("#scope_earthwork:checked").val();
        var scope_other = $("#scope_other:checked").val();
        var project_type = $("#project_type").val();
        var material_needs = $("#material_needs").val();
        var unit_cost_value = $("#unit_cost_value").val();
        var data = {job_name:job_name, company_name:company_name, unit_cost:unit_cost,unit_cost_value:unit_cost_value, market_type:market_type , building_type:building_type ,scope_all:scope_all,scope_abatement:scope_abatement,scope_interior_demolition:scope_interior_demolition,scope_site_demolition:scope_site_demolition,scope_earthwork:scope_earthwork,scope_other:scope_other, project_type:project_type, material_needs:material_needs};
        generateLeadTable(data);
    });
    // generate Order Table
    function generateLeadTable(element){ 
        //alert("here");
        //alert(JSON.stringify(element));return false;
        jQuery.ajax({
            url: "<?php echo site_url('bidresults/getFilterList')?>",
            data: {'job_name' : element.job_name,'company_name':element.company_name,'unit_cost':element.unit_cost,'unit_cost_value':element.unit_cost_value,'market_type':element.market_type
        ,'building_type':element.building_type,'scope_all':element.scope_all,'scope_abatement':element.scope_abatement,'scope_interior_demolition':element.scope_interior_demolition,'scope_site_demolition':element.scope_site_demolition,'scope_earthwork':element.scope_earthwork,'scope_other':element.scope_other,'project_type':element.project_type,'material_needs':element.material_needs},
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
                        // { title: "<input type='checkbox' class='checkboxAll' id='select_all' onclick=selectAllChkbox('all');>"},
                        { title: "Job Name"},
                        { title: "Scope"},
                        { title: "Company Name"},
                        { title: "Project Type"},
                        { title: "Building Type"},
                        { title: "Building SF"},
                        { title: "Bid Price"},
                        { title: "Unit Cost"},             
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

    function delete_bid(bidId){
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
                url : "<?php echo base_url(); ?>deletebidResults",
                data : { bidId : bidId } 
                }).done(function(data){
                    if(data.status = true) { 
                        swal({title: "Deleted!", text: "Bid has been deleted.!", type: "success"},
                           function(){ 
                               location.reload();
                           }
                        );
                    }
                    else if(data.status = false) { 
                        swal("failed!", "Bid deletion failed.", "error");
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