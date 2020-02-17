<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Betfair Betting Automation</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--alerts CSS -->
    <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/megna-dark.css" name="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div name="main-wrapper">
	<?php
	include_once('header.php');
	include_once('leftside.php');
	?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Tab</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item">Bet</li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body p-b-0">
                                <h4 class="card-title">Bet</h4>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#quad1" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Quad1</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#quad2" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Quad2</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#quad3" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Quad3</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#quad4" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Quad4</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
									<br>
									<?php foreach($settings as $setting) { ?>
									<div class="tab-pane  <?php echo $setting['quad']==1?'active':''; ?>" id="quad<?php echo $setting['quad']; ?>" role="tabpanel">
										<form id="frmtab<?php echo $setting['quad']; ?>" method="post">
											<input type="hidden" name="curleg" value="<?php echo $setting['curleg']; ?>">
											<input type="hidden" name="stage" value="<?php echo $setting['stage']; ?>">
											<div class="row">
												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<div class="row">
																<div class="col-md-6">
																	<h4 class="card-title">Racing</h4>
																	<div class="demo-checkbox" style="border: solid 1px #e9f3ee;">
																		<input type="checkbox" id="horse" name="horse" <?php echo $setting['horse']?'checked':''; ?> />
																		<label for="horse">Horses</label>
																		<input type="checkbox" id="dog" name="dog" <?php echo $setting['dog']?'checked':''; ?> />
																		<label for="dog">Dogs</label>
																	</div>
																</div>
																<div class="col-md-6">
																	<h4 class="card-title">Countries</h4>
																	<div class="demo-checkbox" style="border: solid 1px #e9f3ee;">
																		<input type="checkbox" id="uk" name="uk" <?php echo $setting['uk']?'checked':''; ?> />
																		<label for="uk">UK</label>
																		<input type="checkbox" id="Ire" name="Ire" <?php echo $setting['ire']?'checked':''; ?> />
																		<label for="Ire">Ire</label>
																		<input type="checkbox" id="Sth Africa" name="Sth Africa" <?php echo $setting['sthafrica']?'checked':''; ?> />
																		<label for="Sth Africa">Sth Africa</label>
																		<input type="checkbox" id="Aust" name="Aust" <?php echo $setting['aust']?'checked':''; ?> />
																		<label for="Aust">Aust</label>
																		<input type="checkbox" id="NZ" name="NZ" <?php echo $setting['nz']?'checked':''; ?> />
																		<label for="NZ">NZ</label>
																		<input type="checkbox" id="Others" name="Others" <?php echo $setting['others']?'checked':''; ?> />
																		<label for="Others">Others</label>
																	</div>
																</div>
															</div>
															<h4 class="card-title">First Leg</h4>
															<div class="form-group row">
															  <label for="example-text-input" class="col-md-5 col-form-label">Win/Place</label>
															  <div class="col-md-7">
																<select class="custom-select" name="wp1">
																	<option <?php echo $setting['wp1']=='WIN'?'selected=""':''; ?> value="WIN">WIN</option>
																	<option <?php echo $setting['wp1']=='PLACE'?'selected=""':''; ?> value="PLACE">PLACE</option>
																</select>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Race</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php if($setting['curleg']==1 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketName;} else {echo $setting['marketname1'];} ?>" name="marketname1" readonly>
																<input type="hidden" name="marketid1" value="<?php if($setting['curleg']==1 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketId;} else {echo $setting['marketid1'];} ?>">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Selection</label>
															  <div class="col-md-7">
															  <?php if($setting['curleg']==1 && $setting['stage']==0) { ?>
															  	<select class="custom-select" name="selectionid1">
																<?php
																foreach($markets[$setting['quad']]->runners as $selection) { ?>
																	<option <?php echo $setting['selectionid1']==$selection->selectionId?'selected=""':''; ?> value="<?php echo $selection->selectionId;?>"><?php echo $selection->runnerName;?></option>
																<?php } ?>
																</select>
																<input type="hidden" value="<?php echo $setting['selectionname1'];?>" name="selectionname1" readonly>
															  <?php } else { ?>
																<input class="form-control" type="search" value="<?php echo $setting['selectionname1'];?>" name="selectionname1" readonly>
																<input type="hidden" value="<?php echo $setting['selectionid1'];?>" name="selectionid1" readonly>
															  <?php } ?>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Stake</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['default1']; ?>" name="default1">
															  </div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<h4 class="card-title">Second Leg</h4>
															<div class="form-group row">
															  <label for="example-text-input" class="col-md-5 col-form-label">Win/Place</label>
															  <div class="col-md-7">
																<select class="custom-select" name="wp2">
																	<option <?php echo $setting['wp2']=='PLACE'?'selected=""':''; ?> value="WIN">WIN</option>
																	<option <?php echo $setting['wp2']=='PLACE'?'selected=""':''; ?> value="PLACE">PLACE</option>
																</select>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">1st Leg</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="" name="legresult1" readonly>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Race</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php if($setting['curleg']==2 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketName;} else {echo $setting['marketname2'];} ?>" name="marketname2" readonly>
																<input type="hidden" name="marketid2" value="<?php if($setting['curleg']==2 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketId;} else {echo $setting['marketid2'];} ?>">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Selection</label>
															  <div class="col-md-7">
															  <?php if($setting['curleg']==2 && $setting['stage']==0) { ?>
															  	<select class="custom-select" name="selectionid2">
																<?php
																foreach($markets[$setting['quad']]->runners as $selection) { ?>
																	<option <?php echo $setting['selectionid2']==$selection->selectionId?'selected=""':''; ?> value="<?php echo $selection->selectionId;?>"><?php echo $selection->runnerName;?></option>
																<?php } ?>
																</select>
																<input type="hidden" value="<?php echo $setting['selectionname2'];?>" name="selectionname2" readonly>
															  <?php } else { ?>
																<input class="form-control" type="search" value="<?php echo $setting['selectionname2'];?>" name="selectionname2" readonly>
																<input type="hidden" value="<?php echo $setting['selectionid2'];?>" name="selectionid2" readonly>
															  <?php } ?>
															  </div>
															</div>
															<hr>
															<h4 class="card-title">Stake</h4>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">%</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['percent2']; ?>" name="percent2">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Default</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['default2']; ?>" name="default2">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Add</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['addition2']; ?>" name="addition2">
															  </div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<h4 class="card-title">Third Leg</h4>
															<div class="form-group row">
															  <label for="example-text-input" class="col-md-5 col-form-label">Win/Place</label>
															  <div class="col-md-7">
																<select class="custom-select" name="wp3">
																	<option <?php echo $setting['wp3']=='PLACE'?'selected=""':''; ?> value="WIN">WIN</option>
																	<option <?php echo $setting['wp3']=='PLACE'?'selected=""':''; ?> value="PLACE">PLACE</option>
																</select>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">2nd Leg</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="" name="legresult2" readonly>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Race</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php if($setting['curleg']==3 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketName;} else {echo $setting['marketname3'];} ?>" name="marketname3" readonly>
																<input type="hidden" name="marketid3" value="<?php if($setting['curleg']==3 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketId;} else {echo $setting['marketid3'];} ?>">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Selection</label>
															  <div class="col-md-7">
															  <?php if($setting['curleg']==3 && $setting['stage']==0) { ?>
															  	<select class="custom-select" name="selectionid3">
																<?php
																foreach($markets[$setting['quad']]->runners as $selection) { ?>
																	<option <?php echo $setting['selectionid3']==$selection->selectionId?'selected=""':''; ?> value="<?php echo $selection->selectionId;?>"><?php echo $selection->runnerName;?></option>
																<?php } ?>
																</select>
																<input type="hidden" value="<?php echo $setting['selectionname3'];?>" name="selectionname3" readonly>
															  <?php } else { ?>
																<input class="form-control" type="search" value="<?php echo $setting['selectionname3'];?>" name="selectionname3" readonly>
																<input type="hidden" value="<?php echo $setting['selectionid3'];?>" name="selectionid3" readonly>
															  <?php } ?>
															  </div>
															</div>
															<hr>
															<h4 class="card-title">Stake</h4>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">%</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['percent3']; ?>" name="percent3">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Default</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['default3']; ?>" name="default3">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Add</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['addition3']; ?>" name="addition3">
															  </div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<h4 class="card-title">Forth Leg</h4>
															<div class="form-group row">
															  <label for="example-text-input" class="col-md-5 col-form-label">Win/Place</label>
															  <div class="col-md-7">
																<select class="custom-select" name="wp4">
																	<option <?php echo $setting['wp4']=='PLACE'?'selected=""':''; ?> value="WIN">WIN</option>
																	<option <?php echo $setting['wp4']=='PLACE'?'selected=""':''; ?> value="PLACE">PLACE</option>
																</select>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">3rd Leg</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="" name="legresult1" readonly>
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Race</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php if($setting['curleg']==4 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketName;} else {echo $setting['marketname4'];} ?>" name="marketname4" readonly>
																<input type="hidden" name="marketid4" value="<?php if($setting['curleg']==4 && $setting['stage']==0) {echo $markets[$setting['quad']]->marketId;} else {echo $setting['marketid4'];} ?>">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Selection</label>
															  <div class="col-md-7">
															  <?php if($setting['curleg']==4 && $setting['stage']==0) { ?>
															  	<select class="custom-select" name="selectionid4">
																<?php
																foreach($markets[$setting['quad']]->runners as $selection) { ?>
																	<option <?php echo $setting['selectionid4']==$selection->selectionId?'selected=""':''; ?> value="<?php echo $selection->selectionId;?>"><?php echo $selection->runnerName;?></option>
																<?php } ?>
																</select>
																<input type="hidden" value="<?php echo $setting['selectionname4'];?>" name="selectionname4" readonly>
															  <?php } else { ?>
																<input class="form-control" type="search" value="<?php echo $setting['selectionname4'];?>" name="selectionname4" readonly>
																<input type="hidden" value="<?php echo $setting['selectionid4'];?>" name="selectionid4" readonly>
															  <?php } ?>
															  </div>
															</div>
															<hr>
															<h4 class="card-title">Stake</h4>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">%</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['percent4']; ?>" name="percent4">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Default</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['default4']; ?>" name="default4">
															  </div>
															</div>
															<div class="form-group row">
															  <label for="example-search-input" class="col-md-5 col-form-label">Add</label>
															  <div class="col-md-7">
																<input class="form-control" type="search" value="<?php echo $setting['addition4']; ?>" name="addition4">
															  </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</form>
										<div class="row">
											<div class="col-md-12">
												<div class="card">
													<div class="card-body">
														<div class="row">
															<div class="col-md-2">
																<!--button type="button" class="tst1 btn waves-effect waves-light btn-block btn-info" onclick="javascript:savesettings(1);">Save Settings</button-->
															</div>
															<div class="col-md-2"></div>
															<div class="col-md-5">
																<div class="form-group row">
																  <label for="example-search-input" class="col-md-5 col-form-label">Final Result</label>
																  <div class="col-md-7">
																	<input class="form-control" type="search" value="" name="result1" readonly="">
																  </div>
																</div>
															</div>
															<div class="col-md-1"></div>
															<div class="col-md-2">
																<button type="button" onclick="javascript:runbot(this,1);" class="btn btn-success <?php echo $setting['status']?'active':''; ?>" data-toggle="button" aria-pressed="<?php echo $setting['status']?'true':'false'; ?>">
																	<i class="fa fa-link text" aria-hidden="true"></i>
																	<span class="text">Run Quad1</span>
																	<i class="ti-check text-active" aria-hidden="true"></i>
																	<span class="text-active">Quad1 is Running</span>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php }	?>
                                    <div class="tab-pane" id="quad2" role="tabpanel">
									</div>
                                    <div class="tab-pane" id="quad3" role="tabpanel">
									</div>
                                    <div class="tab-pane" id="quad4" role="tabpanel">
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?php include_once('footer.php'); ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
	<script>
		function objectifyForm(formArray,tab) {//serialize data function
			var returnArray = {};
			for (var i = 0; i < formArray.length; i++){
				returnArray[formArray[i]['name']] = formArray[i]['value'];
			}
			returnArray['quad'] = tab;
			return returnArray;
		}
		function savesettings(tab){
			$.post('/settings/newsession',objectifyForm($('#frmtab1').serializeArray(),tab),function(){
				swal("Saved!", "Settings have been saved successfully.", "success");
			});
		}
		function runbot(btn,tab){
			var enabled = ($(btn).attr('aria-pressed')=='true')?'0':'1';
			if(enabled=='1') {
				$.post('/settings/newsession',objectifyForm($('#frmtab1').serializeArray(),tab),function(){
					$.post('/settings/runsession',{sess:tab,enabled:enabled}, function(){
						$.get('/auto',{token:'OUUNYHp1lgWUxEp5nCUl'}, function(){
							swal("Saved!", "Settings have been saved successfully.", "success");
						});
					});
				});
			} else {
				$.post('/settings/runsession',{sess:tab,enabled:enabled});
			}
		}
		$('[name="selectionid1"]').change(function(){
			var selected = $('[name="selectionid1"] option:selected').text();
			if(selected)$('[name="selectionname1"]').val(selected );
		});
		$('[name="selectionid2"]').change(function(){
			var selected = $('[name="selectionid2"] option:selected').text();
			if(selected)$('[name="selectionname2"]').val(selected );
		});
		$('[name="selectionid3"]').change(function(){
			var selected = $('[name="selectionid3"] option:selected').text();
			if(selected)$('[name="selectionname3"]').val(selected );
		});
		$('[name="selectionid4"]').change(function(){
			var selected = $('[name="selectionid4"] option:selected').text();
			if(selected)$('[name="selectionname4"]').val(selected );
		});
		$('[name="selectionid1"]').change();
		$('[name="selectionid2"]').change();
		$('[name="selectionid3"]').change();
		$('[name="selectionid4"]').change();
	</script>
</body>
</html>