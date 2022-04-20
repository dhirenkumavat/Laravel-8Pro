<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>index</title>
   </head>
   <body>
<?php
$projectId = $leadInfo->projectId;
$project_name = $leadInfo->projectName;
$budget= $leadInfo->budget;
$scope=$leadInfo->scope;
$wages=$leadInfo->wages;
$sales= $leadInfo->sales;
$admin= $leadInfo->admin;
$estimator= $leadInfo->estimator;
$estimator_email = $leadInfo->estimator_email;
$clientName= $leadInfo->clientName;
$dueDate= $leadInfo->dueDate;
$dueTime= $leadInfo->dueTime;
$jobWalkTime= $leadInfo->jobWalkTime;
$estStartDate= $leadInfo->estStartDate;
$rfiDeadline= $leadInfo->rfiDeadline;
$bidForm= $leadInfo->bidForm;
$bid_price= $leadInfo->bid_price;
$reports= $leadInfo->reports;
$mainContact= $leadInfo->mainContact;
$first_name = $leadInfo->firstName;
$last_name = $leadInfo->lastName;
$address = $leadInfo->address;
$reftypeId = $leadInfo->reftypeId;
$dl = $leadInfo->DL;
$dob = $leadInfo->dob;
$email = $leadInfo->email;
$mobile1 = $leadInfo->phoneNo1;
$mobile2 = $leadInfo->phoneNo2;
$salesRepId = $leadInfo->salesRepId;
$stage = $leadInfo->stageId;
$countryId = $leadInfo->countryId;
$fs_id = $leadInfo->filesystem_id;
$createdDtm = $leadInfo->createdDtm;

if($createdDtm == "0000-00-00" || $createdDtm == ""){
    $createdDtm = date("Y-m-d");
}

$brokerFee = $leadInfo->brokerFee;
$iid = $leadInfo->IID;
$tag = $leadInfo->tagId;
$jobtypeid = $leadInfo->jobtypeid;

$referralSourceId = $leadInfo->referralSourceId;
$notes = $leadInfo->notes;
$ownership = $leadInfo->ownership;
$policyExpiration = $leadInfo->policyExpiration;
$businessOwner = $leadInfo->businessOwner;
$is_priority = $leadInfo->is_priority;
$contract = $leadInfo->contract;

$getLatLong = $this->map_model->getLatLong($address);

    if(!empty($getLatLong)){
        $getLatLongArr = explode("@", $getLatLong);
    }

$map_img = time().".png";
$google_image = file_get_contents("https://maps.googleapis.com/maps/api/staticmap?center=".$getLatLongArr[0].",".$getLatLongArr[1]."&zoom=maxZoom&size=1100x250&maptype=satellite&markers=color:red%7Clabel:C%7C".$getLatLongArr[0].",".$getLatLongArr[1]."&key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc");


//echo "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.",".$long."&zoom=7&size=250x250&maptype=terrain&markers=color:red%7Clabel:C%7C".$lat.",".$long."&key=AIzaSyAjkU86Kej9K_AAiq3ciIKNQ2CjRIGHg-Y";die;
$fp  = fopen("./assets/images/map/".$map_img, 'w+'); 
fputs($fp, $google_image); 
fclose($fp);

?>  
 
 
      <table style="font-size:10pt; font-family: Arial, Helvetica, sans-serif; width: 100% max-width:100%;  background-color: #ffffff; margin: auto;" cellpadding="0" cellspacing="0">
         <tr>
            <td align="center">
                <img style="width:180px;" src="<?php echo getcwd().'/assets/images/am_logo.png'; ?>">
            </td>
         </tr>

         <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td colspan="2">
                        <h3>LOCAL FILE SERVER</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:20%;">
                         <b>Local File Server</b>
                     </td>
                     <td style="width: 50%;">
                         <?php if(!empty($fs_id)){ echo $fs_id; }?>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>

         <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px; line-height: 25px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td colspan="4">
                        <h3>PROJECT DATA</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                         <b>This project is a priority:</b>
                     </td>
                     <td style="width:25%;">
                         <input value="1" type="checkbox" name="is_priority" <?php echo ($is_priority == '1') ?  "checked" : "" ;  ?>>
                     </td>
                     <td style="width:25%;">
                         <b>Project Name:</b>
                     </td>
                     <td style="width:25%;">
                         <?php echo $project_name; ?>   
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                         <b>Contract Value:</b>
                     </td>
                     <td style="width:25%;">
                        <?php echo $contract; ?>
                     </td>
                     <td colspan="2">
                        <table style="width:100%;">
                           <td style="width:50%;">
                               <b>Budget:</b>
                           </td>
                           <td><input type="checkbox" name="budget"  value="1" <?php echo ($budget== '1') ?  "checked" : "" ;  ?>></td>
                           <td>&nbsp;Yes</td>
                           <td><input type="checkbox" name="budget"  value="0" <?php echo ($budget== '0') ?  "checked" : "" ;  ?>></td>
                           <td>&nbsp;No</td>
                           <td style="width: 25%;"></td>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <?php
                        $scope=explode(",",$scope);

                        ?>
                     <td style="width:25%;">
                         <b>Scope :</b>
                     </td>
                     <td style="width:75%;" colspan="3">
                         <table cellpadding="0" cellpadding="0">
                            <tr>
                              <td><input type="checkbox" name="scope[]" id="scope" value="abatement" <?php if (in_array("abatement",$scope)) { echo 'checked="checked"';}?> ></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abatement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              <td><input type="checkbox" name="scope[]" id="scope" value="demolition" <?php if (in_array("demolition",$scope)) { echo 'checked="checked"';}?>></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demolition&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              <td><input type="checkbox" name="scope[]" value="earthwork" id="scope" <?php if (in_array("earthwork",$scope)) { echo 'checked="checked"';}?>></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Earthwork&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                              <td><input type="checkbox" name="scope[]" value="other" id="scope" <?php if (in_array("other",$scope)) { echo 'checked="checked"';}?>></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Other&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            </tr>
                         </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>Wages:</b>
                     </td>
                     <td style="width:25%;">
                         <?php echo $wages; ?>
                     </td>
                     <td style="width:25%;">
                         <b>Sales:</b>
                     </td>
                     <td style="width:25%;">
                         <?php
                            if(!empty($userlist))
                            {
                                foreach ($userlist as $userEmail)
                                {
                                    ?>
                                    <?php if($sales == $userEmail->email){  echo $userEmail->name; }?>
                                    <?php
                                }
                            }
                            ?>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>Admin:</b>
                     </td>
                     <td style="width:25%;">
                          <?php
                               if(!empty($userlist))
                               {
                                   foreach ($userlist as $userInfo)
                                   {
                                       ?>
                                       <?php if($admin == $userInfo->userId){ echo $userInfo->name; } ?>
                                       <?php
                                   }
                               }
                               ?>
                     </td>
                     <td style="width:25%;">
                         <b>Estimator:</b>
                     </td>
                     <td style="width:25%;">
                         <?php
                            if(!empty($userlist))
                            {
                                foreach ($userlist as $userInfo)
                                {
                                    ?>
                                    <?php if($estimator == $userInfo->userId){ echo $userInfo->name; } ?>
                                    <?php
                                }
                            }
                            ?>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>Estimator Email:</b>
                     </td>
                     <td style="width:25%;">
                         <?php
                               if(!empty($userlist))
                               {
                                   foreach ($userlist as $userInfo)
                                   {
                                       ?>
                                       <?php if($estimator_email == $userInfo->userId){ echo $userInfo->name; } ?>
                                       <?php
                                   }
                               }
                               ?>
                     </td>
                     <td style="width:25%;">
                         <b>Address:</b>
                     </td>
                     <td style="width:25%;">
                         <?php echo $address; ?>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>Due Date:</b>
                     </td>
                     <td style="width:25%;">
                        <?php echo $dueDate; ?>
                     </td>
                     <td style="width:25%;">
                         <b>Due Time:</b>
                     </td>
                     <td style="width:25%;">
                        <?php echo $dueTime; ?>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>Job Walk/Time:</b>
                     </td>
                     <td style="width:25%;">
                        <?php echo $jobWalkTime; ?>
                     </td>
                     <td style="width:25%;">
                         <b>Est. Start Date:</b>
                     </td>
                     <td style="width:25%;">
                         <?php echo $estStartDate; ?>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>RFI Deadline:</b>
                     </td>
                     <td style="width:25%;">
                        <?php echo $rfiDeadline; ?> 
                     </td>
                     <td style="width:25%;">
                        <b>Bid Form:</b>  
                     </td>
                     <td style="width:25%;">
                        <table>
                           <tr>
                              <td><input type="radio" name="bid_form"  value="1" <?php echo ($bidForm== '1') ?  "checked" : "" ;  ?>></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</td>
                              <td><input type="radio" name="bid_form"  value="0" <?php echo ($bidForm== '0') ?  "checked" : "" ;  ?>></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>Bid Price:</b>
                     </td>
                     <?php
                       if($bid_price != "" || $bid_price != NULL){
                           setlocale(LC_MONETARY, 'en_US');
                           $bidprice = money_format('%.0n', $bid_price) ;
                       }else{
                           $bidprice = "";
                       }
                       ?>
                     <td style="width:25%;">
                        <?php echo $bidprice; ?>
                     </td>
                     <td style="width:25%;">
                        <b>Reports:</b>  
                     </td>
                     <td style="width:25%;">
                        <table>
                           <tr>
                              <td><input type="radio" name="reports"  value="1"  <?php echo ($reports== '1') ?  "checked" : "" ;  ?>></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes</td>
                              <td><input type="radio" name="reports"  value="0"  <?php echo ($reports== '0') ?  "checked" : "" ;  ?>></td>
                              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No</td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:25%;">
                        <b>Project Manager:</b>
                     </td>
                     <td style="width:25%;">
                        <?php
                             if(!empty($sales_rep))
                             {
                                 foreach ($sales_rep as $rl)
                                 {
                                     ?>
                                     <?php if($rl->userId == $salesRepId) {echo $rl->name ;} ?>
                                     <?php
                                 }
                             }
                             ?>
                     </td>
                     <td style="width:25%;">
                        <b>Project Stage:</b>  
                     </td>
                     <td style="width:25%;">
                        <?php
                             if(!empty($stages))
                             {
                                 foreach ($stages as $rl)
                                 {
                                     ?>
                                     <?php if($rl->stageId == $stage) {echo $rl->stageName ;} ?>
                                     <?php
                                 }
                             }
                             ?>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>

         <!-- <tr>
            <td style="border-bottom: 1px solid #000;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>PRIVATE NOTES & COMMENTS</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;">
                        
                     </td>
                  </tr>
               </table>
            </td>
         </tr> -->

         

         <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>NOTES HISTORY</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;" >
                        <table style="width: 100%; text-align: left;" border="1" cellspacing="0" cellpadding="3">
                           <tr style="background:#f1f1f1">  
                              <th style="height: 25px; width:55px;">lead Id</th>
                              <th>Notes</th>
                              <th style="width:100px;">Created Time</th>
                           </tr>
                            <?php
                           if(!empty($notes_history))
                            {
                              $i = 1;
                              foreach($notes_history as $record)
                              {
                            ?>
                           <tr>  
                              <td><?php echo  $i ?> </td>
                              <td style="word-break: break-all; word-wrap: break-word;"><div style="word-break: break-all; word-wrap: break-word;"><?php echo $record['notes'] ?></div></td>
                              <td style="word-break: break-all; word-wrap: break-word;">
                                <div style="word-break: break-all; word-wrap: break-word;"><?php echo  date("h:i:s", strtotime($record['createdDtm']))?>
                                </div>
                              </td>
                           </tr>
                           <?php
                          $i++;
                            }
                          }
                          ?>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>

<!--          <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td colspan="2">
                        <h3>DATA TAG</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:20%;">
                         <b>Tag</b>
                     </td>
                     <td style="width: 50%;">
                        <?php
                        if(!empty($tags))
                        {
                            foreach ($tags as $rl)
                            {
                                ?>
                                <?php if($rl->id == $tag) {echo $rl->tagName;} ?>
                                <?php
                            }
                        }
                        ?>     
                     </td>
                  </tr>
               </table>
            </td>
         </tr> -->

         <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td colspan="2">
                        <h3>JOB TYPE</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:20%;">
                         <b>Job Type</b>
                     </td>
                     <td style="width: 50%;">
                        <?php
                                if(!empty($jobTypes))
                                {
                                    foreach ($jobTypes as $job_type) 
                                    {
                                        ?>
                                        <?php if($job_type->id == $jobtypeid) {echo $job_type->jobType;} ?>
                                        <?php
                                    }
                                }
                                ?> 
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <?php if($address != "" || $address != NULL){?> 
            <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>MAP</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width:100%;">
                        <div style="min-width:768px; width: 100%;" id="map"></div>
                        <img style="min-width:589px; width: 100%;" src="<?php echo getcwd().'/assets/images/map/'.$map_img; ?>">
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      <?php } ?>
         <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>Business</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;" >
                        <table style="width: 100%; text-align: left;" border="1" cellspacing="0" cellpadding="3">
                           <tr style="background:#f1f1f1">  
                              <th style="height: 25px;">Business</th>
                           </tr>
                           <?php

                               if(!empty($clientInfo))
                              {
                                 foreach ($clientInfo as $clientInfoVal)
                                 {
                                     ?>
                                     <tr> 
                                       <td>
                                     <?php echo $clientInfoVal->client_name ?>
                                       </td>
                                     </tr>
                                     <?php
                                 }
                             }else{ ?>
                                <tr> 
                                       <td>
                                          No Client available
                                       </td>
                                     </tr>
                             <?php }?>
                           
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>

         <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>CONTACTS</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;" >
                        <table style="width: 100%; text-align: left;" border="1" cellspacing="0" cellpadding="3">
                           <tr style="background:#f1f1f1">  
                              <th style="height: 25px;">Business</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                           </tr>
                          <?php if(!empty($contacInfo)){
                            foreach($contacInfo as $contactInfoVal){ ?>
                           <tr> 
                              <?php if($contactInfoVal->client_name != ""){?>
                                    <td style="text-align: center;"><?php echo $contactInfoVal->client_name; ?></td> 
                                <?php } ?>
                              <td style="text-align: center;"><?php echo $contactInfoVal->contact_name; ?></td>
                              <td style="text-align: center;"><?php echo $contactInfoVal->contact_email; ?></td>
                              <td style="text-align: center;"><?php echo $contactInfoVal->contact_phone; ?></td>
                           </tr>
                        <?php  } }else{ ?>
                          <tr>
                            <td colspan="4"> No Contacts available</td>
                          </tr>
                        <?php } ?>

                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>

         <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>COMMUNICATIONS</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;" >
                        <table style="width: 100%; text-align: left;" border="1" cellspacing="0" cellpadding="3">
                           <tr style="background:#f1f1f1">  
                              <th style="height: 25px;">Type</th>
                              <th>To/From</th>
                              <th>Created Date </th>
                           </tr>
                           <?php
                            if(!empty($communication))
                            {
                                foreach ($communication as $rl)
                                { ?>
                                <tr>
                                      <td style="text-align: center;">
                                      <?php if($rl->type==1 || $rl->type == 3){ ?>
                                          <i class="fas fa-phone fa-lg"></i>
                                      <?php }else if($rl->type==2){ ?>
                                          <i class="fas fa-envelope fa-lg"></i>
                                      <?php } else{ ?>
                                          <i class="fas fa-comments fa-lg"></i>
                                      <?php }  ?>
                                      </td>
                                      <td style="text-align: center;">
                                          <?php if($rl->type == 3){ ?>
                                          <a href="javascript:void(0)"><?= $rl->to ?></a>
                                          <?php } else { ?>
                                          <a href="#" onclick="commShowDetails('<?php echo $rl->type;?>','<?php echo $rl->communicationId;?>');"><?php echo $rl->froms;?></a>
                                          <?php } ?>
                                      </td>
                                      <td style="text-align: center;">
                                          <?php echo date("m/d/Y H:i:s", strtotime($rl->createdDtm)) ?>
                                      </td>
                                 </tr>
                                 <?php }
                            }else{?>
                                <tr>
                                    <td colspan="3">
                                        No communication available.
                                    </td>
                                
                            </tr>
                        <?php }
                            ?>

                           
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>

         <!-- <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>FILES</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;" >
                        <table style="width: 100%; text-align: left;" border="1" cellspacing="0">
                           <tr style="background:#f1f1f1">  
                              <th style="height: 25px;">Files</th>
                           </tr>
                           
                                 <tr>
                                     <td>
                                        <?php   
                              if(!empty($files))
                              {
                                 foreach ($files as $rl)
                                 { ?>  
                                      <img style="border:1px solid #ccc; padding:6px;" src="<?php echo '/home/ampcotestdadenll/public_html/assets/uploads/files/'.$rl->name; ?>" width="70px" height="70px">
                                      <?php } 
                              }else{
                                echo "No files available";
                              } ?>
                                    </td>
                               </tr>    
                            
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr> -->

         

         <!-- <tr>
            <td style="border-bottom: 1px solid #000; padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>MY TASKS / FOLLOW-UP</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;" >
                        <table style="width: 100%; text-align: left;" border="1" cellspacing="0" cellpadding="3">
                           <tr style="background:#f1f1f1">  
                              <th style="height: 25px;">Message</th>
                              <th>Task Date</th>
                           </tr>
                          <?php if($taskInfo){
                                 foreach($taskInfo as $taskInfoVal){ ?>
                           <tr> 
                              <td><?php echo $taskInfoVal->name; ?></td> 
                              <td><?php echo  date("m/d/Y", strtotime($taskInfoVal->eventDate)); ?></td> 
                           </tr>
                        <?php }}else{ ?>
                          <tr> 
                              <td colspan="2"> NO Task / Follow-up available</td> 
                           </tr>
                        <?php } ?>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr> -->

         <!-- <tr>
            <td style="padding-bottom: 10px;">
               <table style="width: 100%;" cellspacing="0">
                  <tr>
                     <td>
                        <h3>PROJECT STAGE - HISTORY</h3>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 100%;" >
                        <table style="width: 100%; text-align: left;" border="1" cellspacing="0" cellpadding="1">
                           <?php
                        if(!empty($stage_history))
                        {
                            foreach ($stage_history as $rl)
                            { ?>  
                             
                                <tr>
                                    <td>
                                        <?php echo $rl->stageName?>
                                    </td>
                                    <td>
                                        <?php 
                                        $datetime1 = new DateTime();
                                        $datetime2 = new DateTime($rl->createdDtm);
                                        $interval = $datetime1->diff($datetime2);
                                        //print_r($interval);die;
                                       if($interval->h > 24){
                                        echo $interval->format('%D days %H Hours %I Minutes');
                                       }else{
                                        echo $interval->format('%H Hours %I Minutes');
                                       }?>
                                    </td> 
                                </tr>  

                               <?php }
                        }
                        ?>  
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr> -->

      </table>
   
   </body>
   <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name',
        administrative_area_level_2: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    <!-- AIzaSyB7_NfvBxKc8FpOZgAlRLlW0SApkVbidb4 -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnYIF2RRd5COYQasKvQdAK6Pa7jKl5Oc&libraries=places&callback=initAutocomplete" async defer></script>
   <!---------------- View on Map ---------------->
  <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map-address {
      height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
   
    #floating-panel {
      position: absolute;
      top: 10px;
      left: 25%;
      z-index: 5;
      background-color: #fff;
      padding: 5px;
      border: 1px solid #999;
      text-align: center;
      font-family: 'Roboto','sans-serif';
      line-height: 30px;
      padding-left: 10px;
    }
    
     @page{margin: 0.2in 0.5in 0.2in 0.5in;}

     td {
  word-wrap: break-word;
  overflow-wrap: break-word
}
  </style>
<?php 
    //get lat long
    $getLatLong = $this->map_model->getLatLong($address);
    if(!empty($getLatLong)){
        $getLatLongArr = explode("@", $getLatLong);
    }
?>
 <script type="text/javascript">
    $(document).ready(function() {
        var address = "<?php echo $address; ?>";
        var lat = "<?php echo $getLatLongArr[0]; ?>";
        var long = "<?php echo $getLatLongArr[1]; ?>";
        viewonMap(address,lat,long);
    });

    function viewonMap(address,lat,long){
        //alert(lat+"="+long);

        if(lat!='' && long!=''){
            var locations = [
              [address, lat,long, 4]];

            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 17,
              center: new google.maps.LatLng(lat, long),
              mapTypeId: google.maps.MapTypeId.SATELLITE
            });

            var infowindow = new google.maps.InfoWindow();

            var marker, i;

            for (i = 0; i < locations.length; i++) {  
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
              });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
        }
        //$('#viewMapModal').modal('show'); 
    }
 </script>
</html>