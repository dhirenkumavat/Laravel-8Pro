<?php //echo '<pre>'; print_r($_SESSION);die; ?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="icon" href="<?php //echo base_url(); ?>/assets/images/favicon.png" type="image/icon" sizes="16x16">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/css/sweetalert.css"> 
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <script src="<?php echo base_url(); ?>assets/libs/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <title><?php if(isset($pageTitle)){echo $pageTitle;}else{echo "Amplify";} ?></title>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper toggled" id="wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top simpifyNavBar">
             
                <a href="#menu-toggle" id="menu-toggle" class="menu-toggle-web">
					<i class="fas fa-bars"></i>   
				</a>
                <button class="navbar-toggler custom-icon hideMobileMenuiconright" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-user"></i></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <div class="page-breadcrumb">
                         <?php if (current_url() !== base_url() && current_url() !== base_url() . "home") { ?>
                        <nav aria-label="breadcrumb">
                            <?php
                            $segments = $this->uri->segment_array();
                            // echo '<pre>'; print_r($segments);die;
                            $last_segment = '';
                            $data = '';
                            ?>
                            <ol class="breadcrumb">
                                <?php if(isset($PageEdit)){?>
                                    <li class="breadcrumb-item active" aria-current="page"> <a href="javascript:void(0)"><?php echo ucfirst($PageEdit)?></a> </li>
                                <?php } ?>
                                <?php  
                                        // if($this->uri->segment(1)=='addNewLead'){
                                        //     $data = 'leadListing';
                                        // }if($this->uri->segment(1)=='scheduleTask'){
                                        //     $data = 'leadListing';
                                        // }if($this->uri->segment(1)=='addNew'){
                                        //     $data = 'userListing';
                                        // }if($this->uri->segment(1)=='addNewList'){
                                        //     $data = 'listListing';
                                        // }if($this->uri->segment(1)=='addRefSource'){
                                        //     $data = 'referralListing';
                                        // }if($this->uri->segment(1)=='addNewStage'){
                                        //     $data = 'settings';
                                        // }if($this->uri->segment(1)=='editOldStage'){
                                        //     $data = 'settings';
                                        // }if($this->uri->segment(1)=='addNewRef'){
                                        //     $data = 'settings'; 
                                        // }if($this->uri->segment(1)=='addNewTag'){
                                        //     $data = 'settings'; 
                                        // }if($this->uri->segment(1)=='addNewSelling'){
                                        //     $data = 'settings'; 
                                        // }
                                ?> 
                               
                                <?php 

                                // foreach ($segments as $segment) {
                                //     $last_segment .= '/' . $segment;

                                //     $segments_txt = '';

                                //     if(in_array($segment,array("leadListing","viewleadListing","scheduleTask"))){    
                                //         $segments_txt .= 'Leads';
                                //     }
                                //     elseif($segment=="editOldLead"){
                                //         $segments_txt .= 'Leads';
                                //     }
                                //     elseif($segments[1]=="editOldLead" && preg_match("/^[0-9]+$/", $segment)){ //print_r($leadInfo);die;
                                //         $segments_txt = $PageEdit;
                                //     }
                                //     elseif($segment=="addNewLead"){
                                //         $segments_txt .= 'Leads';
                                //     }
                                //     elseif(in_array($segment,array("userListing","addNew","editOld"))){
                                //         $segments_txt .= 'Users';
                                //     }
                                //     elseif($segments[1]=="editOld" && preg_match("/^[0-9]+$/", $segment)){ //print_r($leadInfo);die;
                                //         $segments_txt = $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("listListing","addNewList","editOldList"))){
                                //         $segments_txt .= 'Lists';
                                //     }
                                //     elseif($segments[1]=="editOldList" && preg_match("/^[0-9]+$/", $segment)){ 
                                //         $segments_txt = $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("referralListing","addRefSource","editSource"))){
                                //         $segments_txt .= 'Referral Sources';
                                //     }
                                //     elseif($segments[1]=="editSource" && preg_match("/^[0-9]+$/", $segment)){ 
                                //         $segments_txt = $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("commListing"))){
                                //         $segments_txt .= 'Communications';
                                //     }
                                //     elseif(in_array($segment,array("repListing"))){
                                //         $segments_txt .= 'Representative';
                                //     }
                                //     elseif(in_array($segment,array("reportView"))){
                                //         $segments_txt .= 'Reports';
                                //     }
                                //     elseif(in_array($segment,array("addNewStage","editOldStage"))){
                                //         $segments_txt .= 'Settings';
                                //     }
                                //     elseif($segments[1]=="editOldStage" && preg_match("/^[0-9]+$/", $segment)){    
                                //         $segments_txt .= $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("addNewRef","editOldReferral"))){
                                //         $segments_txt .= 'Settings';
                                //     }
                                //     elseif($segments[1]=="editOldReferral" && preg_match("/^[0-9]+$/", $segment)){    
                                //         $segments_txt .= $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("addNewTag","editOldTag"))){
                                //         $segments_txt .= 'Settings';
                                //     }
                                //     elseif($segments[1]=="editOldTag" && preg_match("/^[0-9]+$/", $segment)){    
                                //         $segments_txt .= $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("addNewSelling","editOldSelling"))){
                                //         $segments_txt .= 'Settings';
                                //     }
                                //     elseif($segments[1]=="editOldSelling" && preg_match("/^[0-9]+$/", $segment)){    
                                //         $segments_txt .= $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("emailtemplatesListing","addEmailTemplate","editEmailTemplate"))){
                                //         $segments_txt .= 'Email Templates';
                                //     } 
                                //     elseif($segments[1]=="editEmailTemplate" && preg_match("/^[0-9]+$/", $segment)){    
                                //         $segments_txt .= $PageEdit;
                                //     }
                                //     elseif(in_array($segment,array("mapListing"))){
                                //         $segments_txt .= 'Map';
                                //     }  
                                //     elseif(in_array($segment,array("taskListing","editTaskList"))){
                                //         $segments_txt .= 'View Task List';
                                //     } 
                                //     elseif($segments[1]=="editTaskList" && preg_match("/^[0-9]+$/", $segment)){    
                                //         $segments_txt .= $PageEdit;
                                //     }
                                //     elseif($segments[1]=="activeProject"){    
                                //         $segments_txt .= $PageEdit;
                                //     }elseif($segments[1]=="projectListing"){    
                                //         $segments_txt .= $PageEdit;
                                //     }                 
                                //     else{
                                //        $segments_txt = $segment;
                                //     }
                                //     
                                ?>                                 
                                 <?php
                                   
                                //     echo  '<li class="breadcrumb-item active" aria-current="page"> <a href="'.base_url() . substr($last_segment,1) . '">' .    ucfirst(str_replace('-', ' ', str_replace('_', ' ', $segments_txt))) . '</a> </li>';
                                ?>                                    
                                <?php //} ?>                                
                            </ol>
                        </nav>
                        <?php } ?> 
                    </div>

                    <ul class="navbar-nav ml-auto navbar-right-top">
                         <?php 
                         if(!empty($this->session->userdata('tmp_admin_session'))){  
                            ?>
                             <div class="blue-btn"><a href="/backtoAdmin"  class="btn btn-rounded bg-info">Back To Admin</a></div>
                       <?php  } 
                       ?>
                         
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="/login/backtoAdmin" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="userAvtarIcon"><i class="fas fa-user"></i></span> <span class="userloginName"> <?php echo $this->session->userdata['name'];?></span> </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php echo $this->session->userdata['name'];?></h5>
                                </div>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>profile"><i class="fas fa-user mr-2"></i>Profile</a>
                               <!--  <a class="dropdown-item" href="<?php //echo base_url(); ?>passwordchange"><i class="fas fa-cog mr-2"></i>Change Password</a> -->
                                <a class="dropdown-item iphone-hide" href="<?php echo base_url(); ?>logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark" id="sidebar-wrapper">
            <a class="navbar-brand border-r" href="<?php echo base_url(); ?>dashboard"><img style="max-height: 54px;" src="<?php echo base_url(); ?>assets/images/am_logo.png" alt=""></a>
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                   
                    <div class="collapse navbar-collapse menus-cus" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                           
                            <li class="nav-item">
                                <a class="nav-link <?php if($this->uri->segment(1)=="dashboard") echo 'active'; ?>" href="<?php echo base_url(); ?>dashboard" aria-expanded="false"><i class="fas fa-window-maximize"></i>Dashboard <!-- <span class="badge badge-success">6</span> --></a>
                            </li>  
                            <?php
                                $leadPages = array("leadListing", "addNewLead","viewleadListing", "scheduleTask", "editOldLead", "projectListing");
                            ?>                         
                            <li class="nav-item">
                                <a id="mainNav" class="nav-link <?php if (in_array($this->uri->segment(1), $leadPages)) echo 'active'; ?>" href="javascript:void(0);" aria-expanded="false"><i class="fas fa-list"></i>Projects</a>
                                <!--<ul style="list-style: none; display: none;" id="subnav">-->
                                 <ul style="list-style: none;" id="subnav">
                                    <li><a class="nav-link <?php if (in_array($this->uri->segment(1), $leadPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>projectListing" aria-expanded="false">All</a></li>
                                    <li><a href="<?php echo base_url(); ?>prospects" class="nav-link <?php if ($this->uri->segment(1) == 'prospects') echo 'active'; ?>">Prospects</a></li>
                                	<li><a href="<?php echo base_url(); ?>activeProject" class="nav-link <?php if ($this->uri->segment(1) == 'activeProject') echo 'active'; ?> " >Bid Board</a></li>
                                    <li><a href="<?php echo base_url(); ?>pendingBids" class="nav-link <?php if ($this->uri->segment(1) == 'pendingBids') echo 'active'; ?>">Pending Bids</a></li>
                                    <li><a href="<?php echo base_url(); ?>pendingBudget" class="nav-link <?php if ($this->uri->segment(1) == 'pendingBudget') echo 'active'; ?>">Pending Budget</a></li>
                                    <li><a href="<?php echo base_url(); ?>percent" class="nav-link <?php if ($this->uri->segment(1) == 'percent') echo 'active'; ?>">90 Percent</a></li>
                                	<li><a href="<?php echo base_url(); ?>completedProject" class="nav-link <?php if ($this->uri->segment(1) == 'completedProject') echo 'active'; ?>">Won</a></li> 
                                    <li><a href="<?php echo base_url(); ?>lost" class="nav-link <?php if ($this->uri->segment(1) == 'lost') echo 'active'; ?>">Lost</a></li>
                                </ul>

                            </li>
                            <?php $bidResults = array("bidResults");?>
							<li class="nav-item">
                                    <a class="nav-link <?php if (in_array($this->uri->segment(1), $bidResults)) echo 'active'; ?>" href="<?php echo base_url(); ?>bidResultsListing" aria-expanded="false"><i class="fa fa-bullhorn"></i> Bid Results </a>
                                </li>
							 <?php 
                             if($role == ROLE_ADMIN || $role == ROLE_TERRITORY_MANAGER || $role == ROLE_SALES_AGENT || $role == ROLE_MANAGER || $role == ROLE_DEPARTMENT_MANAGER || $role == ROLE_QUALIFIER || $role == ROLE_SALES_ADMIN)
                             {

                                 if(($role == ROLE_ADMIN)) {
                                    $userPages = array("userListing", "addNew", "editOld");
                                ?>

                                <li class="nav-item">
                                    <a class="nav-link <?php if (in_array($this->uri->segment(1), $userPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>userListing" aria-expanded="false"><i class="fa fa-user"></i> Users </a>
                                </li>
                            <?php } ?>


                            <?php $contacts = array("contacts");?>
                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $contacts)) echo 'active'; ?>" href="<?php echo base_url(); ?>contacts" aria-expanded="false"><i class="fa fa-phone"></i> Contacts </a>
                            </li>

                            <?php $buisnessList = array("buisnessList");?>
                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $buisnessList)) echo 'active'; ?>" href="<?php echo base_url(); ?>buisnessList" aria-expanded="false"><i class="fa fa-briefcase"></i> Business List </a>
                            </li>

                            <?php
                                $systemtemplatesPages = array("systemtemplatesListing", "addSystemTemplate", "editSystemTemplate");
                            ?>
                               
                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $systemtemplatesPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>systemtemplatesListing"><i class="fa fa-file-alt"></i> System Templates</a>
                            </li>

                            <?php
                                $emailtemplatesPages = array("emailtemplatesListing", "addEmailTemplate", "editEmailTemplate");
                            ?>
                               
                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $emailtemplatesPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>emailtemplatesListing"><i class="fa fa-envelope"></i> Email Templates</a>
                            </li>
                           

                            <?php
                                $taskListingPages = array("taskListing", "editTaskList");
                            ?>

                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $taskListingPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>taskListing"><i class="fa fa-list"></i> View Task List</a>
                            </li>

                            
                            <?php
                                $mapPages = array("mapListing");
                            ?>

                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $mapPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>mapListing"><i class="fa fa-map-marker"></i> Projects Map</a>
                            </li> 

                            <?php
                                $materialMapPages = array("materialsMapListing");
                            ?>

                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $materialMapPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>materialsMapListing"><i class="fa fa-map-signs"></i>Material Map</a>
                            </li>              

                            <?php if(($role == ROLE_ADMIN)) {?>
                             <?php
                                $settingPages = array("settings", "addNewStage", "editOldStage", "addNewRef", "editOldReferral", "addNewTag", "editOldTag", "addNewSelling", "editOldSelling");
                            ?>
                            
                            <li class="nav-item">
                                <a class="nav-link <?php if (in_array($this->uri->segment(1), $settingPages)) echo 'active'; ?>" href="<?php echo base_url(); ?>settings"><i class="fas fa-cogs"></i> Settings</a>
                            </li>            
                            <?php } ?>

                            <?php }  ?> 
                            

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    
</body>


<script>
        function backtoAdmin(){
             swal({
              title: "you want to Back to admin?",
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
                url : "<?php echo base_url(); ?>backtoAdmin",
                }).done(function(data){
                    if(data.status = true) { 
                        swal("Login!", "You logged as admin.", "success");
                        location.reload();
                    }
                    else if(data.status = false) { 
                        swal("failed!", "login failed.", "error");
                    }                    
                });
              
            });     
    }

    $(document).ready(function(){
        $("#mainNav").click(function(){
            $("#subnav").slideToggle();
        });
    })
</script>