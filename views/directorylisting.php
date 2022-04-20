<style type="text/css">
    .directory_listing li{padding: 0 5px;}
</style>

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
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid directory_listing">

                    <?php if(! empty($dlisting['directoryTree'])): ?>
                    <?php 
                    $project_number = $this->uri->segment(2); 
                    $temp = 0;
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="breadcrumb">
                            <?php foreach ($dlisting['directoryTree'] as $url => $name): ?>

                            	<?php
                            		if($project_number == $name){
                            			$temp = 1;
                            		}
                            	?>
                            	<?php if($temp == 1){?>
	                                <li>
	                                    <?php
	                                    $lastItem = end($dlisting['directoryTree']);
	                                    if($name === $lastItem):
	                                         echo urldecode($name);
	                                    else:
	                                    ?>
	                                        <a href="?dir=<?php echo "/".$url; ?>">
	                                            <?php echo urldecode($name); ?>
	                                        </a>
	                                    <?php
	                                    endif;
	                                    ?>
	                                </li>
	                                <li class="seprator">/</li>
                            	<?php }?>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>


                    <div class="row">
                    <div class="col-xs-12">
                        <div class="table-container">
                            <table class="table table-striped table-bordered">
                                <?php if (! empty($dlisting['directories'])): ?>
                                    <thead>
                                        <th>Directory</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dlisting['directories'] as $directory): ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo $directory['url']; ?>" class="item dir">
                                                        <?php echo $directory['name']; ?>
                                                    </a>

                                                    <?php if ($listing->enableDirectoryDeletion): ?>
                                                        <!-- <span class="pull-right">
                                                            <a href="<?php echo $directory['url']; ?>&delete=true" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</a>
                                                        </span> -->
                                                    <?php endif; ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    </div>

                    <?php if (! empty($dlisting['files'])): ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-container">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="<?php echo $listing->sortUrl('name'); ?>">File <span class="<?php echo $listing->sortClass('name'); ?>"></span></a>
                                            </th>
                                            <th class="text-right xs-hidden">
                                                <a href="<?php echo $listing->sortUrl('size'); ?>">Size <span class="<?php echo $listing->sortClass('size'); ?>"></span></a>
                                            </th>
                                            <th class="text-right sm-hidden">
                                                <a href="<?php echo $listing->sortUrl('modified'); ?>">Last Modified <span class="<?php echo $listing->sortClass('modified'); ?>"></span></a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($dlisting['files'] as $file): ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo $file['url']; ?>" target="<?php echo $file['target']; ?>" class="item _blank <?php echo $file['extension']; ?>">
                                                    <?php echo $file['name']; ?>
                                                </a>
                                                <?php if (isset($file['preview']) && $file['preview']): ?>
                                                    <span class="preview"><img src="?preview=<?php echo $file['relativePath']; ?>"><i class="preview_icon"></i></span>
                                                <?php endif; ?>

                                                <!-- <?php if ($listing->enableFileDeletion == true): ?>
                                                    <a href="?deleteFile=<?php echo urlencode($file['relativePath']); ?>" class="pull-right btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</a>
                                                <?php endif; ?> -->
                                            </td>
                                            <td class="text-right xs-hidden"><?php echo $file['size']; ?></td>
                                            <td class="text-right sm-hidden"><?php echo date('M jS Y \a\t g:ia', $file['modified']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="alert alert-info text-center">This directory does not contain any files.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

