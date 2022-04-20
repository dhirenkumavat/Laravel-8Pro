 <div class="dashboard-wrapper" id="page-content-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                    <div class="card">
                    <!-- <div class="custom-card"><h5 class="card-header"> Pending Tasks </h5></div> -->
                        <div class="card-body">
                            <div class="row m-t-20">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body" style="overflow-y: scroll; height: 600px;">
                                            <?php  
                                 if (! function_exists('imap_open')) {
                                        echo "IMAP is not configured.";
                                        exit();
                                    } else {
                                        ?>
                                         <div id="listData" class="list-form-container">
                                 <?php
        
        /* Connecting Gmail server with IMAP */
        /*
        $connection = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', 'testing.gigaparse@gmail.com', 'Test@123') or die('Cannot connect to Gmail: ' . imap_last_error());
        */

        $connection = imap_open('{imap.office365.com:587/imap/ssl/novalidate-cert}INBOX', $emailSmtpUser, $smtp_pass) or die('Cannot connect to Gmail: ' . imap_last_error());

        /* Search Emails having the specified keyword in the email subject */
        $emailData = imap_search($connection, 'All');
        if (! empty($emailData)) {
            ?>
            <table>
            <?php
            foreach ($emailData as $emailIdent) {
                
                $overview = imap_fetch_overview($connection, $emailIdent, 0);
                $message = imap_fetchbody($connection, $emailIdent, '1.1');
                $messageExcerpt = substr($message, 0, 150);
                $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
                $date = date("d F, Y", strtotime($overview[0]->date));
                ?>
                <tr>
                        <td style="width:32%;"><strong class="column"><?php echo $overview[0]->from; ?></strong></td>
                        <td class="content-div"><strong class="column"><?php echo $overview[0]->subject; ?> - <?php echo $partialMessage; ?></strong>
                            <span class="date"><?php echo $date; ?></span></td>
                </tr>
                <?php
            } // End foreach
            ?>
            </table>
            <?php
        } // end if
        
        imap_close($connection);
    }?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
        </div>