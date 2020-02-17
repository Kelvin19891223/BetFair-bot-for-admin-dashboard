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
    <!-- chartist CSS -->
    <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="../assets/plugins/morrisjs/morris.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/megna-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="fix-header fix-sidebar card-no-border">
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
    <div id="main-wrapper">
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
                    <h3 class="text-themecolor">Dashboard</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-9 col-xlg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-wrap">
                                    <div>
                                        <h4 class="card-title">Analytics Overview</h4>
                                        <h6 class="card-subtitle">Overview of Monthly analytics</h6>
                                    </div>
                                    <div class="ml-auto align-self-center">
                                        <ul class="list-inline m-b-0">
                                            <li>
                                                <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>Site A</h6> </li>
                                            <li>
                                                <h6 class="text-muted text-info"><i class="fa fa-circle font-10 m-r-10"></i>Site B</h6> </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="campaign ct-charts" style="height:305px!important;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Visit</h4>
                                <div class="d-flex">
                                    <div class="align-self-center">
                                        <h4 class="font-medium m-b-0"><i class="ti-angle-up text-success"></i>  12456</h4></div>
                                    <div class="ml-auto">
                                        <div id="spark8"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bounce rate</h4>
                                <div class="d-flex">
                                    <div class="align-self-center">
                                        <h4 class="font-medium m-b-0"><i class="ti-angle-down text-danger"></i>  456</h4></div>
                                    <div class="ml-auto">
                                        <div id="spark9"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Page Views</h4>
                                <div class="d-flex">
                                    <div class="align-self-center">
                                        <h4 class="font-medium m-b-0"><i class="ti-angle-up text-success"></i> 2456</h4></div>
                                    <div class="ml-auto">
                                        <div id="spark10"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <h4 class="card-title">Visit From Countries</h4>
                                    <div class="ml-auto">
                                        <select class="custom-select">
                                            <option selected="">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-20">
                                    <table class="table nowrap stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Language</th>
                                                <th>Vists</th>
                                                <th>%</th>
                                                <th> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <i class="flag-icon flag-icon-us"></i>
                                                    <span class="country-name">U.S.A</span>
                                                </td>
                                                <td>18,224</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span></div>
                                                    </div>
                                                </td>
                                                <td>50%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="flag-icon flag-icon-gb"></i>
                                                    <span class="country-name">U.K</span>
                                                </td>
                                                <td>12,347</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%; height:6px;"> <span class="sr-only">50% Complete</span></div>
                                                    </div>
                                                </td>
                                                <td>60%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="flag-icon flag-icon-ca"></i>
                                                    <span class="country-name">Canada</span>
                                                </td>
                                                <td>11,868</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span></div>
                                                    </div>
                                                </td>
                                                <td>50%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="flag-icon flag-icon-de"></i>
                                                    <span class="country-name">Germany</span>
                                                </td>
                                                <td>10,346</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span></div>
                                                    </div>
                                                </td>
                                                <td>50%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="flag-icon flag-icon-in"></i>
                                                    <span class="country-name">India</span>
                                                </td>
                                                <td>8,354</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span></div>
                                                    </div>
                                                </td>
                                                <td>80%</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <i class="flag-icon flag-icon-au"></i>
                                                    <span class="country-name">Australia</span>
                                                </td>
                                                <td>7,675</td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger " role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span></div>
                                                    </div>
                                                </td>
                                                <td>50%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-4 col-xlg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Browser Stats</h4>
                                <table class="table browser m-t-30 no-border">
                                    <tbody>
                                        <tr>
                                            <td style="width:40px"><img src="../assets/images/browser/chrome-logo.png" alt=logo /></td>
                                            <td>Google Chrome</td>
                                            <td class="text-right"><span class="label label-light-info">23%</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../assets/images/browser/firefox-logo.png" alt=logo /></td>
                                            <td>Mozila Firefox</td>
                                            <td class="text-right"><span class="label label-light-success">15%</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../assets/images/browser/safari-logo.png" alt=logo /></td>
                                            <td>Apple Safari</td>
                                            <td class="text-right"><span class="label label-light-primary">07%</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../assets/images/browser/internet-logo.png" alt=logo /></td>
                                            <td>Internet Explorer</td>
                                            <td class="text-right"><span class="label label-light-warning">09%</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../assets/images/browser/opera-logo.png" alt=logo /></td>
                                            <td>Opera mini</td>
                                            <td class="text-right"><span class="label label-light-danger">23%</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="../assets/images/browser/internet-logo.png" alt=logo /></td>
                                            <td>Microsoft edge</td>
                                            <td class="text-right"><span class="label label-light-megna">09%</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-xlg-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Visits</h4>
                                <div id="visitfromworld" style="width:100%!important; height:410px"></div>
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
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--morris JavaScript -->
    <script src="../assets/plugins/raphael/raphael-min.js"></script>
    <script src="../assets/plugins/morrisjs/morris.min.js"></script>
    <!-- Vector map JavaScript -->
    <script src="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/dashboard2.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>