<!-- Dashbord

<a href="<?php echo base_url(); ?>login/logout">Logout</a> -->
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/libs/css/slick.css'>    

<script>
    setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 20000); // <-- time in milliseconds
</script>
<?php 
// echo "<pre>";
// print_r($graphEstimatorPriceQuantity);
// die;
?>
 <div class="dashboard-wrapper" id="page-content-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Projects by Status  </h2>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->

           
           <div class="card"> 
                <div class="card-body pt-0 pb-1">      
                    <div class="row mt-3">
                        <div class="col-sm-12 dash-slidermain" style="max-height: 136px !important; padding:0; overflow-y: hidden !important; overflow-x: hidden !important;">
                            <div class="gallery gallery-responsive portfolio_slider">
                                <?php foreach($stages as $key=>$record) { ?>
                                <div class="inner">
                                    <div class="card border-t dashboaard-boxes">
                                        <div class="card-body text-center project_stage" style="cursor: pointer; padding: 0.5rem;" data-stage="<?php echo $record->stageId; ?>" data-name="<?php echo $record->stageName; ?>">
                                            <div class="d-inline-block">
                                                <h2 class="mb-2">   <?php if($totalstageCount) { 
                                                foreach($totalstageCount as $key=>$stageCount){         
                                                    if($key==$record->stageId) { ?>
                                                        <?php echo $stageCount;?>
                                                         <?php 
                                                    } 
                                                 } 
                                             }  ?>  </h2>
                                                <h5 class="text-muted mb-1"> <?php echo $record->stageName; ?>  </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                              </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal" id="stagesListing">
                    <div class="modal-dialog" id="editsmsloader1">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title"></h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">                                                
                                        <div class="tableView"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Graphs -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 p-0">
                    <div class="page-header">
                        <h2 class="pageheader-title"> &nbsp; </h2>
                    </div>
                </div>
            </div>

<div class="card">
            <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                <div class="card-body">
                   
                        <div class="form-row">
                           <form  name="dashboardDATEFilter" id="dashboardDATEFilter" action="dashboard" method="post" role="form"> 
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                                <label>Start date</label>
                                <input type="text" name="startdate" required value="<?php echo isset($startdate)?$startdate:date('m/01/Y');?>" class="form-control" id="startdate" placeholder="Start date">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-3">
                                <label>End date</label>
                                <input type="text" name="enddate" required value="<?php echo isset($enddate)?$enddate:date('m/'.$lastDay.'/Y');?>" class="form-control" id="enddate" placeholder="End date">
                            </div>                                                      
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label class="clearfix">&nbsp;</label> <br>
                                <button name="filter_order_filter" type="submit" class="btn btn-rounded bg-info" id="filter-order-filter" value="filter"><i class="fa fa-search fa-fw"></i></button>                                
                            </div>
                            </form>
                        </div>
                    
                </div>
        </div>
            <div class="card">
                <div class="card-body">
                    <div style="font-size: 20px;text-align: left;color: #000;font-weight: 400;"> Total Won Sales to Date: $<?php echo number_format($totalwon['firstsum'],2);?></div> 
                    <div class="row m-t-10">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Estimator Won by Individual 
                                        <a class="btn accordina-btn btn-rounded" data-toggle="collapse" href="#EstimatorWonbyIndividual" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse show" id="EstimatorWonbyIndividual">
                                    <div id="estimator_won_by_individual"></div>
                                    <a href="javascript:void(0);" onclick="estimatorWonByIndividual();">View details</a>
                                </div>
                            </div>
                        </div>  
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Sales Won by Individual 
                                        <a class="btn accordina-btn btn-rounded" data-toggle="collapse" href="#SalesWonbyIndividual" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse show" id="SalesWonbyIndividual">
                                    <div id="sales_won_by_individual"></div>
                                    <a href="javascript:void(0);" onclick="saleswonbyIndividualDetails();">View details</a>
                                </div>
                            </div>  
                        </div>      
                    </div>

                    <div class="row m-t-10">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        COMPANY BY PROJECT QUANTITY AND PRICE (MILLIONS $) 
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#CompanyByProjectQuantity" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="CompanyByProjectQuantity">
                                    <div id="bids_north_contracting_by_qty"></div>
                                </div>
                            </div>
                        </div>   
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Bids by Project Quantity and Price (Millions $) 
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#BidsbyProjectQuantity" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="BidsbyProjectQuantity">
                                    <div id="bids_by_qty"></div>
                                </div>
                            </div>
                        </div>                     
                    </div>
                    

                    <div class="row m-t-10">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Bids by Estimator Quantity and Price (Millions $)
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#BidsbyEstimator" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="BidsbyEstimator">
                                    <div id="bids_by_estimator_qty"></div>
                                </div>
                            </div>
                        </div>                       
                    </div>

                    <div class="row m-t-10">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Pending Bids by Estimator Quantity and Price (Millions $)
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#PendingBidsbyEstimator" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="PendingBidsbyEstimator">
                                    <div id="pendinbids_by_estimator_qty"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-10">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Pending Budgets by Estimator Quantity and Price (Millions $) 
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#PendingBudgetsbyEstimator" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="PendingBudgetsbyEstimator">
                                    <div id="pendingbuget_by_estimator_qty"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div class="row m-t-10">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <!-- <div style="font-size: 20px;text-align: center !important;color: #000;font-weight: 400;"> 90% Sales Total: $<?php echo number_format($total90won['firstsum'],2);?></div> -->
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        90% List by Estimator Quantity and Price (Millions $) 
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#ListbyEstimatorQuantity" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="ListbyEstimatorQuantity">
                                    <div id="90percentbuget_by_estimator_qty" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div class="row m-t-10">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Projects by Scope 
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#ProjectsbyScope" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="ProjectsbyScope">
                                    <div id="projects_by_scope"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div class="row m-t-10">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Projects Won by Scope 
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#ProjectsWonbyScope" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="ProjectsWonbyScope">
                                    <div id="projectswon_by_scope"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div class="row m-t-10">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card">
                                    <h5 class="card-header"> 
                                        Projects Lost by Scope 
                                        <a class="btn accordina-btn btn-rounded collapsed" data-toggle="collapse" href="#ProjectsLostbyScope" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa fa-plus plus-icon"></i>
                                            <i class="fa fa-minus minus-icon"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div class="card-body collapse" id="ProjectsLostbyScope">
                                    <div id="projectslost_by_scope"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>

                   <!--  <div class="row m-t-10">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card"><h5 class="card-header"> Sales Won by Individual </h5></div>
                                <div class="card-body">
                                    <div id="sales_won_by_individual"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>   -->                 
                    
                    
                </div>
            </div>

            <!-- End Graphs  -->

                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Tasks / Follow-Ups Overview </h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                    <div class="card">
                        <div class="custom-card"><h5 class="card-header"> Pending Tasks <a href="/taskListing" class="viewtasLink">View Tasks</a> </h5></div>
                        <div class="card-body">
                        <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- four widgets   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total views   -->
                            <!-- ============================================================== -->

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2> <?php echo $pendingTaskToday['pending_task']?> </h2>
                                            <h5 class="text-muted"> Today </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total views   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total followers   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2> <?php echo $pendingTaskWeek['weekCount']?> </h2>
                                            <h5 class="text-muted"> This Week </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total followers   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- partnerships   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2> <?php  echo $pendingTaskMonth['monthCount']?> </h2>
                                            <h5 class="text-muted"> This Month </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end partnerships   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total earned   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2> <?php echo $pendingTaskYear['yearCount']?> </h2>
                                            <h5 class="text-muted"> This Year </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total earned   -->
                            <!-- ============================================================== -->
                        </div>
                        </div>

                        <div class="custom-card"><h5 class="card-header"> Completed Tasks </h5></div>
                                                <div class="card-body">
                        <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- four widgets   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total views   -->
                            <!-- ============================================================== -->

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2> <?php echo $completedTaskToday['complete_task']?> </h2>
                                            <h5 class="text-muted"> Today </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total views   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total followers   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $completedTaskWeek['weekCount']?> </h2>
                                            <h5 class="text-muted"> This Week </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total followers   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- partnerships   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $completedTaskMonth['monthCount']?> </h2>
                                            <h5 class="text-muted"> This Month </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end partnerships   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total earned   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $completedTaskYear['yearCount']?> </h2>
                                            <h5 class="text-muted"> This Year </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total earned   -->
                            <!-- ============================================================== -->
                        </div>
                        </div>
                    </div>

                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Misc. System Statistics </h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                    <div class="card">
                        <div class="custom-card"><h5 class="card-header"> Overview </h5></div>
                        <div class="card-body">
                        <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- four widgets   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total views   -->
                            <!-- ============================================================== -->

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $userCount['user_count'];?> </h2>
                                            <h5 class="text-muted"> Users </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total views   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total followers   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $projectCount['project_count'];?></h2>
                                            <h5 class="text-muted"> Projects </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total followers   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- partnerships   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2> <?php echo $monthCount['project_count'];?> </h2>
                                            <h5 class="text-muted"> This Month </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end partnerships   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total earned   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2> 5<?php ///echo $year['yearCount'];?> </h2>
                                            <h5 class="text-muted"> This Year </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total earned   -->
                            <!-- ============================================================== -->
                        </div>
                        </div>
                    </div>

                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> Tag Statistics </h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->

                            <div class="card">
                                    <div class="card-body">
                                <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- product sales  -->
                            <!-- ============================================================== -->

                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="custom-card"><h5 class="mb-0"> Quantity by Tag</h5></div>
                                    </div>
                                    <div class="card-body p-0 quantityByTagCardBody">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered first" id="exampleOne">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tag</th>
                                                                    <th>Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                 <?php
                                                              if(!empty($tagsData))
                                                              {
                                                                  foreach($tagsData as $record)
                                                                  {
                                                              ?>
                                                                <tr>
                                                                    <td><?php echo $record['tagName']; ?> </td>
                                                                    <td><?php echo $record['quantity']; ?>  </td>
                                                                </tr>
                                                                <?php
                                                                  }
                                                              }
                                                              ?>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- product category  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="custom-card"><h5 class="card-header"> Chart by Tag </h5></div>
                                    <div class="card-body">
                                     <div id="c3chart_pie_five"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product category  -->
                            <!-- ============================================================== -->
                        </div>
                    </div>
                    </div>
                      

                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title"> System Uploads </h2>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->

                    <div class="card">
                        <div class="custom-card"><h5 class="card-header"> New Files </h5></div>
                        <div class="card-body">
                        <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- four widgets   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total views   -->
                            <!-- ============================================================== -->

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $newfileToday;?> </h2>
                                            <h5 class="text-muted"> Today </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total views   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total followers   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $fileweekCount;?> </h2>
                                            <h5 class="text-muted"> This Week </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total followers   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- partnerships   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $filemonthCount;?> </h2>
                                            <h5 class="text-muted"> This Month </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end partnerships   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total earned   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $fileyearCount;?> </h2>
                                            <h5 class="text-muted"> This Year </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total earned   -->
                            <!-- ============================================================== -->
                        </div>
                        </div>
                        <!-- basic table  -->
                        <!-- ============================================================== -->
                       

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <div class="custom-card"><h5 class="card-header"> Total File Size: <?php if(!empty($fileSize)){echo $fileSize;}?></h5></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered first" id="exampleTwo">
                                            <thead>
                                                <tr>
                                                    <th>File Id</th>
                                                    <th>Date/Time</th>
                                                    <!-- <th>Username</th> -->
                                                    <th>Document Name</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                          <tbody>
                                              <?php
                                              if(!empty($filesData))
                                              {
                                                  foreach($filesData as $record)
                                                  {
                                              ?>
                                              <tr>
                                                  <td><?php echo $record['fileId']; ?> </td>
                                                  <td><?php echo date("m/d/Y", strtotime($record['createdDtm'])) ?> </td>
                                                  
                                                  <td><?php echo $record['name']; ?></td>
                                                  <td><a href="<?php echo base_url() ?>dashboard/download/<?php echo $record['fileId'];?>" class="dwn">Click here</a></td>
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
                        <!-- ============================================================== -->
                        <!-- end basic table  -->
                    </div>
                        <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- product sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="custom-card"><h5 class="mb-0"> File Types</h5></div>
                                    </div>
                                    <div class="card-body p-0 fileTypeCardBody">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered first" id="exampleThree">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Type</th>
                                                                        <th>Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                  if(!empty($fileType))
                                                                  {
                                                                      foreach($fileType as $record)
                                                                      {
                                                                  ?>
                                                                    <tr>
                                                                        <td><?php echo $record->type; ?> </td>
                                                                        <td><?php echo $record->count; ?> </td>
                                                                    </tr>
                                                                    
                                                                        <?php
                                                                      }
                                                                  }
                                                                  ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- product category  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="custom-card"><h5 class="card-header"> Chart of File Types </h5></div>
                                    <div class="card-body">
                                         <div id="c3chart_pie_four"></div>
                                    </div>
                                   
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product category  -->
                            <!-- ============================================================== -->
                        </div>
                    </div>


                    <div class="card">
                        <div class="custom-card"><h5 class="card-header"> Phone Call Statistics </h5></div>
                        <div class="card-body">
                        <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- four widgets   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total views   -->
                            <!-- ============================================================== -->

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $phoneDataToday['phoneTodayCount'];?> </h2>
                                            <h5 class="text-muted"> Today </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total views   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total followers   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $phoneDataWeekly['phoneWeeklyCount'];?> </h2>
                                            <h5 class="text-muted"> This Week </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total followers   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- partnerships   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $phoneMonthlyCount['phoneMonthlyCount'];?> </h2>
                                            <h5 class="text-muted"> This Month </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end partnerships   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total earned   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $phoneyearlyCount['phoneYearlyCount'];?> </h2>
                                            <h5 class="text-muted"> This Year </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total earned   -->
                            <!-- ============================================================== -->
                        </div>
                        </div>
                        <div id="c3chart_area"></div>

                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- product sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="custom-card"><h5 class="mb-0"> Call by Sales Rep - Today</h5></div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered first" id="exampleFour">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                     <?php
                                                                  if(!empty($phoneData))
                                                                  {
                                                                      foreach($phoneData as $record)
                                                                      {
                                                                  ?>
                                                                    <tr>
                                                                        <td><?php echo $record['name']; ?> </td>
                                                                        <td><?php echo $record['phoneCount']; ?> </td>
                                                                    </tr>
                                                                     <?php
                                                                      }
                                                                  }
                                                                  ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                                    <div id="c3chart_pie"></div>
                                    <br>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -->

                            <!-- ============================================================== -->
                            <!-- product sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="custom-card"><h5 class="mb-0"> Call by Sales Rep - Month</h5></div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered first" id="exampleFive">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                     <?php
                                                                  if(!empty($phoneDataMonthly))
                                                                  {
                                                                      foreach($phoneDataMonthly as $record)
                                                                      {
                                                                  ?>
                                                                    <tr>
                                                                        <td><?php echo $record['name']; ?> </td>
                                                                        <td><?php echo $record['phonemonthly']; ?>  </td>
                                                                    </tr>
                                                                    
                                                                        <?php
                                                                      }
                                                                  }
                                                                  ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                                    <div id="c3chart_pie_third"></div>
                                    <br>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -->

                        </div>
                    </div>



                    <div class="card">
                        <div class="custom-card"><h5 class="card-header"> Email Statistics </h5></div>
                        <div class="card-body">
                        <div class="row m-t-10">
                            <!-- ============================================================== -->
                            <!-- four widgets   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total views   -->
                            <!-- ============================================================== -->

                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $emailDataToday['emailTodayCount'];?> </h2>
                                            <h5 class="text-muted"> Today </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total views   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total followers   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $emailDataWeekly['emailWeeklyCount'];?> </h2>
                                            <h5 class="text-muted"> This Week </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total followers   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- partnerships   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $emailMonthlyCount['emailMonthlyCount'];?> </h2>
                                            <h5 class="text-muted"> This Month </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end partnerships   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total earned   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card border-t dashboaard-boxes">
                                    <div class="card-body text-center">
                                        <div class="d-inline-block">
                                            <h2><?php echo $emailyearlyCount['emailYearlyCount'];?> </h2>
                                            <h5 class="text-muted"> This Year </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total earned   -->
                            <!-- ============================================================== -->
                        </div>
                        </div>
                        <div id="c3chart_pie_second"></div>

                        <div class="row m-t-0">
                            <!-- ============================================================== -->
                            <!-- product sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        
                                        <div class="custom-card"><h5 class="mb-0"> Email by Sales Rep - Today</h5></div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered first" id="exampleSix">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                     <?php
                                                                  if(!empty($emailData))
                                                                  {
                                                                      foreach($emailData as $record)
                                                                      {
                                                                  ?>
                                                                    <tr>
                                                                        <td><?php echo $record['name']; ?> </td>
                                                                        <td><?php echo $record['emailCount']; ?> </td>
                                                                    </tr>
                                                                        <?php
                                                                      }
                                                                  }
                                                                  ?>  
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -->

                            <!-- ============================================================== -->
                            <!-- product sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="custom-card"><h5 class="mb-0"> Email by Sales Rep - Month</h5></div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <!-- ============================================================== -->
                                            <!-- basic table  -->
                                            <!-- ============================================================== -->
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered first" id="exampleSeven">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Name</th>
                                                                        <th>Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                     <?php
                                                                  if(!empty($emailDataMonthly))
                                                                  {
                                                                      foreach($emailDataMonthly as $record)
                                                                      {
                                                                  ?>
                                                                    <tr>
                                                                        <td><?php echo $record['name']; ?> </td>
                                                                        <td><?php echo $record['emailCountmonthly']; ?> </td>
                                                                    </tr>
                                                                     <?php
                                                                      }
                                                                  }
                                                                  ?>  
                                                                </tbody>
                                                            </table>
                                                        </div>
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- end basic table  -->
                                            <!-- ============================================================== -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -->

                        </div>
                    </div>
</div>
<div class="modal fade" id="estimatorProjectModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Estimator Won Project Details</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         
       </div>
       <div class="modal-body">
        <!-- Place to print the fetched phone -->
         <div id="estimator_project_result"></div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>

<div class="modal fade" id="salesProjectModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true" style="margin-top: -20px;">
   <div class="modal-dialog modal-lg">
     <div class="modal-content">
       <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"> Sales Won Project Details</h4>
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         
       </div>
       <div class="modal-body">
        <!-- Place to print the fetched phone -->
         <div id="sales_project_result"></div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>
<!--dashboard slider box js-->
    <script src='<?php echo base_url(); ?>assets/libs/js/slick.min.js'></script>

<script>
    $(document).ready(function(){
        $('.project_stage').on('click', function (e) {
            var stageID = $(this).attr("data-stage");
            var stageName = $(this).attr("data-name");
           
            if(stageID>0){
                    jQuery.ajax({
                        url: "<?php echo base_url(); ?>project/getProjByStage",
                        data: { stageID : stageID} ,
                        type: 'post', 
                        dataType: 'json',
                        'async': false,
                        beforeSend: function () {
                            jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                        },            
                        success: function (data) {
                            jQuery('#editsmsloader').hide();
                            if(data.status == true) { 
                                var projectList = data.result;
                                $('#stagesListing .tableView').empty();
                                var htmlT = "<table class='table table-striped table-bordered first'  cellspacing='0'>";
                                        htmlT += "<thead>";
                                            htmlT += "<tr><th>Project Name</th></tr>";
                                        htmlT += "</thead>";
                                        htmlT += "<tbody>";
                                            $.each(projectList, function( key, value ) {
                                                htmlT += "<tr>";
                                                    htmlT += "<td>";
                                                        htmlT += "<a href='<?php echo base_url(); ?>editProject/"+value.projectId+"'>"+value.projectName+"</a>";
                                                    htmlT += "</td>";
                                                htmlT += "</tr>";
                                            });
                                        htmlT += "</tbody>";
                                    htmlT += "</table>";
                                    $('#stagesListing .tableView').html(htmlT);
                            }else if(data.status == false) { 
                                $('#stagesListing .tableView').empty();
                            }
                        }        
                    });
                $('#stagesListing .modal-title').html("<strong>"+stageName+"</strong>");
                $('#stagesListing').modal('show');
            }
        });
        $('#months').on('change', function (e) {
            $("#dashboardFilter").submit();
        });
    });

    function saveLostNotes(){
        var lost_text = $("#lost_note").val();
        $("#lostnote").val(lost_text); 
        $('#lostNoteModal').modal('hide');
    }
</script>

    <script>    
        $('.gallery-responsive').slick({
          dots: false,
          infinite: false,
           arrows: true,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: false,
                dots: false
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
                 centerMode: true,
                centerPadding: 0,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                 centerMode: true,
                 centerPadding: 0,
                slidesToScroll: 1
              }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
          ]
        });
    </script>
<style type="text/css">
    /*#estimator_won_by_individual,#estimator_won_by_individual,#bids_north_contracting_by_qty,#bids_by_qty,#sales_won_by_individual{overflow-x: scroll;overflow-y: hidden;width:580; }*/
    /*#bids_by_estimator_qty{overflow-x: scroll;overflow-y: hidden;width:1160;}*/
    /*#pendinbids_by_estimator_qty,#pendingbuget_by_estimator_qty,#90percentbuget_by_estimator_qty,#projects_by_scope,#projectswon_by_scope,#projectslost_by_scope{overflow-x: scroll;width:1160;}*/
</style>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawfileChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Name', 'Count'],
      <?php
      // if($tagsData->num_rows > 0){
      //     while($row = $result->fetch_assoc()){
      //       echo "['".$row['name']."', ".$row['rating']."],";
      //     }
      // }
      //print_r($tagsData);die;
       foreach($tagsData as $record){
                 echo  "['".$record['tagName']."', ".$record['quantity']."],";                                                  
        }
      ?>
    ]);
    
    var options = {
        'legend':'bottom',
         'width': '100%',
         height: 300
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('c3chart_pie_five'));
    
    chart.draw(data, options);

    //Bids by Quantity
    
    var data1 = google.visualization.arrayToDataTable([
                ['Date','Quantity', { role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php  if(!empty($graphCompanyPriceQuantity)){
                    foreach($graphCompanyPriceQuantity as $key => $values) { ?>
                ['North', <?php echo $values['north'];?>,<?php echo $values['north'];?>,<?php echo $values['northsum'];?>, <?php echo $values['northsum'];?>],
                ['Contracting', <?php echo $values['contract'];?>,<?php echo $values['contract'];?>,<?php echo $values['contractsum'];?>, <?php echo $values['contractsum'];?>], 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>                
          ]);
    
    var options1 = {
        chart: {
          title: 'BIDS BY QUANTITY AND PRICE (Millions $)',
          subtitle: ''
        },
        hAxis: {
          title: 'AMPCO North and AMPCO Contracting'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width: 560,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart1 = new google.visualization.ColumnChart(document.getElementById('bids_north_contracting_by_qty'));
    chart1.draw(data1,options1); 

   //Bids by Quantity
    var data1 = google.visualization.arrayToDataTable([
                ['Date','Quantity', { role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php  if(!empty($graphProjectPriceQuantity)){
                    foreach($graphProjectPriceQuantity as $key => $values) { ?>
                ['', <?php echo $values['first'];?>,<?php echo $values['first'];?>,<?php echo $values['firstsum'];?>, <?php echo $values['firstsum'];?>], 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>                
          ]);
    
    var options1 = {
        chart: {
          title: 'BIDS BY QUANTITY AND PRICE (Millions $)',
          subtitle: ''
        },
        hAxis: {
          title: '<?php echo $startdate;?> - <?php echo $enddate;?>'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:560,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart1 = new google.visualization.ColumnChart(document.getElementById('bids_by_qty'));
    chart1.draw(data1,options1);

    //estimator_won_by_individual
  
  var data13 = google.visualization.arrayToDataTable([
                ['Name', 'Quantity',{ role: 'annotation'}, 'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php if(!empty($graphEstimatorWonbyScopePriceQuantity)){
                    foreach($graphEstimatorWonbyScopePriceQuantity as $key => $values) { ?>
                ['<?php echo $values['name'];?>', <?php echo $values['first'];?>,<?php echo $values['first'];?>,<?php echo $values['firstsum'];?>, <?php echo $values['firstsum'];?>], 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>               
          ]);
    
    var options13 = {
        chart: {
          title: 'Estimator Won by Scope',
          subtitle: ''
        },
        hAxis: {
          title: 'Estimator Name'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE(Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:560,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart13 = new google.visualization.ColumnChart(document.getElementById('estimator_won_by_individual'));
    chart13.draw(data13, options13);

    //bids_by_estimator_qty
    var data3 = google.visualization.arrayToDataTable([
                ['Name', 'Quantity', { role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php  if(!empty($graphEstimatorPriceQuantity)){
                    foreach($graphEstimatorPriceQuantity as $key => $values) { 
        $userName = explode(" ",$values['name']); $name = isset($userName[1])?$userName[0].'\n'.$userName[1]:$userName[0]; ?>

                ['<?php echo $name;?>', <?php echo $values['first'];?>,<?php echo $values['first'];?>,<?php echo $values['firstsum'];?>, <?php echo $values['firstsum'];?>],
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>               
          ]);
      
    var options3 = {        
       chart: {
          title: 'BIDS BY ESTIMATOR QUANTITY AND PRICE (Millions $)',
          subtitle: ''
        },
        hAxis: {
          title: 'Estimator Name',           
          slantedTextAngle:45,
          slantedText:false,
        },
        vAxis: {
            title: 'TOTAL ESTIMATOR QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        isStacked: true,
        height: 500,width:1160,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],       
      };
    var chart3 = new google.visualization.ColumnChart(document.getElementById('bids_by_estimator_qty'));
    chart3.draw(data3,options3);

//pendinbids_by_estimator_qty
    var data5 = google.visualization.arrayToDataTable([
                ['Name', 'Quantity', { role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php if(!empty($graphPendingPriceQuantity)){
                    foreach($graphPendingPriceQuantity as $key => $values) { $userName = explode(" ",$values['name']); $name = isset($userName[1])?$userName[0].'\n'.$userName[1]:$userName[0];?>
                ['<?php echo $name;?>', <?php echo $values['first'];?>,<?php echo $values['first'];?>,<?php echo $values['firstsum'];?>, <?php echo $values['firstsum'];?>], 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>                 
          ]);
    
    var options5 = {
        chart: {
          title: 'PENDING BIDS BY ESTIMATOR QUANTITY AND PRICE (Millions $)',
          subtitle: ''
        },
        hAxis: {
          title: 'Estimator Name'
        },
        vAxis: {
            title: 'TOTAL ESTIMATOR QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        
        height: 400,width:1160,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart5 = new google.visualization.ColumnChart(document.getElementById('pendinbids_by_estimator_qty'));
    chart5.draw(data5,options5);

//pendingbuget_by_estimator_qty
  var data7 = google.visualization.arrayToDataTable([
                ['Name', 'Quantity', { role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php if(!empty($graphPendingBudgetPriceQuantity)){
                    foreach($graphPendingBudgetPriceQuantity as $key => $values) { $userName = explode(" ",$values['name']); $name = isset($userName[1])?$userName[0].'\n'.$userName[1]:$userName[0];?>
                ['<?php echo $name;?>', <?php echo $values['first'];?>,<?php echo $values['first'];?>,<?php echo $values['firstsum'];?>, <?php echo $values['firstsum'];?>], 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>               
          ]);
  var options7 = {
        chart: {
          title: 'PENDING BUDGETS BY ESTIMATOR QUANTITY AND PRICE (Millions $)',
          subtitle: ''
        },
        hAxis: {
          title: 'Estimator Name'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:1160,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart7 = new google.visualization.ColumnChart(document.getElementById('pendingbuget_by_estimator_qty'));
    chart7.draw(data7,options7);

//90percentbuget_by_estimator_qty
    var data8 = google.visualization.arrayToDataTable([
                ['Name', 'Quantity', { role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php if(!empty($graph90EstimatorPriceQuantity)){
                    foreach($graph90EstimatorPriceQuantity as $key => $values) { $userName = explode(" ",$values['name']); $name = isset($userName[1])?$userName[0].'\n'.$userName[1]:$userName[0];?>
                ['<?php echo $name;?>', <?php echo $values['first'];?>,<?php echo $values['first'];?>,<?php echo $values['firstsum'];?>, <?php echo $values['firstsum'];?>], 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>                
          ]);
    
    var options8 = {
        chart: {
          title: 'BIDS BY 90% ESTIMATOR QUANTITY AND PRICE (Millions $)',
          subtitle: ''
        },
        hAxis: {
          title: 'Estimator Name'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:1160,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart8 = new google.visualization.ColumnChart(document.getElementById('90percentbuget_by_estimator_qty'));
    chart8.draw(data8,options8);

//sales_won_by_individual
    var data12 = google.visualization.arrayToDataTable([
                ['Name', 'Quantity', { role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php if(!empty($graphSalesWonbyScopePriceQuantity)){

                    foreach($graphSalesWonbyScopePriceQuantity as $key => $values) { 
                        $userName = explode(" ",$values['name']); 
                        $name = isset($userName[1])?$userName[0].'\n'.$userName[1]:$userName[0];?>

                ['<?php echo $name?>', <?php echo $values['first'];?>,<?php echo $values['first'];?>,<?php echo $values['firstsum'];?>, <?php echo $values['firstsum'];?>], 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>               
          ]);
    
    var options12 = {
        chart: {
          title: 'Sales Won by Scope',
          subtitle: ''
        },
        hAxis: {
          title: 'Sales Associate'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:560,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart12 = new google.visualization.ColumnChart(document.getElementById('sales_won_by_individual'));

    chart12.draw(data12, options12); 
    
  //projects_by_scope
    var data9 = google.visualization.arrayToDataTable([
                ['Scope', 'Quantity',{ role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php if(!empty($graphProjectsbyScopePriceQuantity)){
                    foreach($graphProjectsbyScopePriceQuantity as $key => $values) { ?>
                    ['All',<?php echo $values['all1'];?>,<?php echo $values['all1'];?>,<?php echo $values['all1Price'];?>,<?php echo $values['all1Price'];?>],
                    ['Abatement',<?php echo $values['abatement'];?>,<?php echo $values['abatement'];?>,<?php echo $values['abatementPrice'];?>,<?php echo $values['abatementPrice'];?>],
                    ['Site Demolition',<?php echo $values['site_demolition'];?>,<?php echo $values['site_demolition'];?>,<?php echo $values['site_demolitionPrice'];?>,<?php echo $values['site_demolitionPrice'];?>],
                    ['Interior Demolition',<?php echo $values['interior_demolition'];?>,<?php echo $values['interior_demolition'];?>,<?php echo $values['interior_demolitionPrice'];?>,<?php echo $values['interior_demolitionPrice'];?>],
                    ['Earthwork',<?php echo $values['earthwork'];?>,<?php echo $values['earthwork'];?>,<?php echo $values['earthworkPrice'];?>,<?php echo $values['earthworkPrice'];?>],
                    ['Other',<?php echo $values['other'];?>,<?php echo $values['other'];?>,<?php echo $values['otherPrice'];?>,<?php echo $values['otherPrice'];?>] 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>                
          ]);
    
    var options9 = {
        chart: {
          title: 'Projects by Scope',
          subtitle: ''
        },
        hAxis: {
          title: ''
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:1160,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart9 = new google.visualization.ColumnChart(document.getElementById('projects_by_scope'));
    chart9.draw(data9,options9);

// projectswon_by_scope
    var data10 = google.visualization.arrayToDataTable([
                ['Scope', 'Quantity',{ role: 'annotation'},'Total Amount (Millions $)',{ role: 'annotation'}],
                <?php if(!empty($graphProjectsWonbyScopePriceQuantity)){
                    foreach($graphProjectsWonbyScopePriceQuantity as $key => $values) { ?>
                    ['All',<?php echo $values['all1'];?>,<?php echo $values['all1'];?>,<?php echo $values['all1Price'];?>,<?php echo $values['all1Price'];?>],
                    ['Abatement',<?php echo $values['abatement'];?>,<?php echo $values['abatement'];?>,<?php echo $values['abatementPrice'];?>,<?php echo $values['abatementPrice'];?>],
                    ['Site Demolition',<?php echo $values['site_demolition'];?>,<?php echo $values['site_demolition'];?>,<?php echo $values['site_demolitionPrice'];?>,<?php echo $values['site_demolitionPrice'];?>],
                    ['Interior Demolition',<?php echo $values['interior_demolition'];?>,<?php echo $values['interior_demolition'];?>,<?php echo $values['interior_demolitionPrice'];?>,<?php echo $values['interior_demolitionPrice'];?>],
                    ['Earthwork',<?php echo $values['earthwork'];?>,<?php echo $values['earthwork'];?>,<?php echo $values['earthworkPrice'];?>,<?php echo $values['earthworkPrice'];?>],
                    ['Other',<?php echo $values['other'];?>,<?php echo $values['other'];?>,<?php echo $values['otherPrice'];?>,<?php echo $values['otherPrice'];?>] 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>            
          ]);
    
    var options10 = {
        chart: {
          title: 'Projects Won by Scope',
          subtitle: ''
        },
        hAxis: {
          title: 'Scope'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE (Millions $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:1160,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart10 = new google.visualization.ColumnChart(document.getElementById('projectswon_by_scope'));
    chart10.draw(data10,options10);

//projectslost_by_scope
    var data11 = google.visualization.arrayToDataTable([
                ['Scope', 'Quantity',{ role: 'annotation'},'Total Amount(Thousand $)',{ role: 'annotation'}],
                <?php if(!empty($graphProjectsLostbyScopePriceQuantity)){
                    foreach($graphProjectsLostbyScopePriceQuantity as $key => $values) { ?>
                    ['All',<?php echo $values['all1'];?>,<?php echo $values['all1'];?>,<?php echo $values['all1Price'];?>,<?php echo $values['all1Price'];?>],
                    ['Abatement',<?php echo $values['abatement'];?>,<?php echo $values['abatement'];?>,<?php echo $values['abatementPrice'];?>,<?php echo $values['abatementPrice'];?>],
                    ['Site Demolition',<?php echo $values['site_demolition'];?>,<?php echo $values['site_demolition'];?>,<?php echo $values['site_demolitionPrice'];?>,<?php echo $values['site_demolitionPrice'];?>],
                    ['Interior Demolition',<?php echo $values['interior_demolition'];?>,<?php echo $values['interior_demolition'];?>,<?php echo $values['interior_demolitionPrice'];?>,<?php echo $values['interior_demolitionPrice'];?>],
                    ['Earthwork',<?php echo $values['earthwork'];?>,<?php echo $values['earthwork'];?>,<?php echo $values['earthworkPrice'];?>,<?php echo $values['earthworkPrice'];?>],
                    ['Other',<?php echo $values['other'];?>,<?php echo $values['other'];?>,<?php echo $values['otherPrice'];?>,<?php echo $values['otherPrice'];?>] 
                <?php } } else { ?>
                    ['', 0, 0, 0, 0], 
                <?php } ?>
          ]);
    
    var options11 = {
        chart: {
          title: 'Projects Lost by Scope',
          subtitle: ''
        },
        hAxis: {
          title: 'Scope'
        },
        vAxis: {
            title: 'TOTAL QUANTITY AND PRICE(Thousand $)',
            minValue: 0          
        },
        bars: 'horizontal',
        height: 400,width:1160,colors: ['#f3d2b1', '#b8d2eb', '#cccccc', '#f3b49f', '#f6c7b6'],
       
      };
    var chart11 = new google.visualization.ColumnChart(document.getElementById('projectslost_by_scope'));
    chart11.draw(data11, options11);    
}

function drawfileChart() {

    var data = google.visualization.arrayToDataTable([
      ['Type', 'Count'],
      <?php if(!empty($fileType)){
      // if($tagsData->num_rows > 0){
      //     while($row = $result->fetch_assoc()){
      //       echo "['".$row['name']."', ".$row['rating']."],";
      //     }
      // }
      //print_r($tagsData);die;
       foreach($fileType as $record){
                 echo  "['".$record->type."', ".$record->count."],";                                                  
       } } else { ?>
                    ['', 0], 
                <?php } ?>
    ]);
    
    var options = {
        'legend':'bottom',
         'width': '100%',
         height: 300,
        
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('c3chart_pie_four'));
    
    chart.draw(data, options);
}
</script>

<script>
$(document).ready(function() {
    $('#exampleTwo').DataTable( {
        "scrollY": 200,
         columnDefs: [ {
            targets: [ 0 ],
            orderData: [ 0, 1 ]
        }, {
            targets: [ 1 ],
            orderData: [ 1, 0 ]
        }, {
            targets: [ 4 ],
            orderData: [ 4, 0 ]
        } ]
      
    } );
     $('#exampleThree').DataTable( {
        "scrollY": 217       
    } );
      $('#exampleFour').DataTable( {
        "scrollY": 170       
    } );
       $('#exampleFive').DataTable( {
        "scrollY": 170         
    } );
       $('#exampleSix').DataTable( {
        "scrollY": 170         
    } );
       $('#exampleSeven').DataTable( {
        "scrollY": 170        
    } );
} );
</script>
<script type="text/javascript">
    function  saleswonbyIndividualDetails (){
            var startdate    = $("#startdate").val();
            var enddate      = $("#enddate").val();
            jQuery.ajax({
                    url: "<?php echo base_url(); ?>dashboard/getSalesWonByIndividualDetails",
                    data: {'startdate' : startdate, 'enddate' : enddate} ,
                    type: 'post', 
                    dataType: 'json',
                    'async': false,
                    beforeSend: function () {
                    //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                    },            
                    success: function (data) {
                        //jQuery('#editsmsloader').hide();
                        if(data.status == true) { 
                            $("#sales_project_result").html(data.html);
                            $("#salesProjectModal").modal('show');
                        }else if(data.status == false) { 
                           
                        }
                    }        
                });

        }

        function showSalesTable(id){
            $(".SalesProjectDetails").hide();
            $("#SalesProjectDetails_"+id).toggle();
        }

        
        function  estimatorWonByIndividual (){
            var startdate    = $("#startdate").val();
            var enddate      = $("#enddate").val();
            jQuery.ajax({
                    url: "<?php echo base_url(); ?>dashboard/getEstimatorWonByIndividualDetails",
                    data: {'startdate' : startdate, 'enddate' : enddate} ,
                    type: 'post', 
                    dataType: 'json',
                    'async': false,
                    beforeSend: function () {
                    //jQuery('#editsmsloader').html('<div class="text-center mrgA padA"><i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i></div>');
                    },            
                    success: function (data) {
                        //jQuery('#editsmsloader').hide();
                        if(data.status == true) { 
                            $("#estimator_project_result").html(data.html);
                            $("#estimatorProjectModal").modal('show');
                        }else if(data.status == false) { 
                           
                        }
                    }        
                });

        }

        function showEstimatorTable(id){
            $(".EstimatorProjectDetails").hide();
            $("#EstimatorProjectDetails_"+id).toggle();
        }
</script>
 <style>
 #c3chart_pie_five{
     margin:0 auto;
 }
 #c3chart_pie_four{
     margin:0 auto;
 }
 .slick-next{
    right:0; 
 }
 .slick-prev{
    left:0; 
 }
 @media only screen and (min-width:1024px){
 .slick-slide{
    /*
    width: 18.3% !important;
    max-width: 25% !important;
    */
 }
}
 </style>
 
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script type="text/javascript">
     $( "#startdate" ).datepicker({dateFormat: 'mm/dd/yy'});
     $( "#enddate" ).datepicker({dateFormat: 'mm/dd/yy'});
 </script>