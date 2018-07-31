<?php
include('../include/config.php');//connection

//checking if user is logged-in or not
if (!$general->is_loggedin()) {

    //redirecting back to index page
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Payroll</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Simple Payroll</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       Welcome <?php echo $_SESSION['name']; ?> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Transfer<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="single-transfer.php">Single Transfer</a>
                                </li>
                                <li>
                                    <a href="bulk-transfer.php">Bulk Transfer</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="verify-account.php"><i class="fa fa-table fa-fw"></i> Verify Account</a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $transaction->getWalletAmount($_SESSION['userid']); ?></div>
                                    <div>Ballance</div>
                                </div>
                            </div>
                        </div>
                        <a data-toggle="modal" data-target="#myModal">
                            <div class="panel-footer">
                                <span class="pull-left">Fund Wallet</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- modal -->
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Fund Wallet</h4>
                  </div>
                  <div class="modal-body">
                    <p>Enter amount you want to fund.</p>
                    <form action="fund-wallet.php" method="POST">
                        <div class="form-group">
                            <label>Amount:</label><br>
                            <input type="text" class="form-control" name="amount" placeholder="Eg: 30000" name="amount">
                        </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="fund" class="btn btn-primary" value="Fund">
                    </form>
                  </div>
                </div>

              </div>
            </div>
            <!-- end modal -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Test Cards
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <p>Use the below <b>Test Cards</b> to test the application and fund your wallet.</p>
                            <p>
                                Test Mastercard PIN authentication<br>
                                5399 8383 8383 8381<br>
                                cvv 470<br>
                                Expiry: 10/22<br>
                                Pin 3310<br>
                                otp 12345<br>
                            </p>
                            <hr>
                            <p>
                                Test Noauth Visa Card<br>
                                4751763236699647<br>
                                Expiry: 09/21<br>
                            </p>
                            <hr>
                            <p>
                                Test Noauth VisaCard<br>
                                4242 4242 4242 4242<br>
                                cvv: 812<br>
                                Expiry: 01/19<br>
                                Pin 3310<br>
                                otp 12345<br>
                            </p>
                            <hr>
                            <p>
                                Test Verve Card<br>
                                5061460410120223210<br>
                                Expiry Month 12<br>
                                Expiry Year 21<br>
                                cvv: 780<br>
                                Pin: 3310<br>
                                otp 12345<br>
                            </p>
                            <hr>
                            <p>
                                Test VisaCard (Local)<br>
                                4187427415564246<br>
                                cvv: 828<br>
                                Expiry: 09/19<br>
                                Pin 3310<br>
                                otp 12345<br>
                            </p>
                            <hr>
                            <p>
                                Test VisaCard (International)<br>
                                4556052704172643<br>
                                cvv: 899<br>
                                Expiry: 01/19<br>
                            </p>
                            <hr>
                            <p>
                                Test American Express Card (International)<br>
                                344173993556638<br>
                                cvv: 828<br>
                                Expiry: 01/22<br>
                            </p>
                            <hr>
                            <p>
                                Test card Declined<br>
                                5143010522339965<br>
                                cvv 276<br>
                                Expiry: 08/19<br>
                                Pin 3310<br>
                            </p>
                            <hr>
                            <p>
                                Test Card Fraudulent<br>
                                5590131743294314<br>
                                cvv 887<br>
                                Expiry: 11/20<br>
                                Pin 3310<br>
                                otp 12345<br>
                            </p>
                            <hr>
                            <p>
                                Test Card Insufficient Funds<br>
                                5258585922666506<br>
                                cvv 883<br>
                                Expiry: 09/19<br>
                                Pin 3310<br>
                                otp 12345<br>
                            </p>
                            <hr>
                            <p>
                                Pre-authorization Test Card<br>
                                5840406187553286<br>
                                cvv 116<br>
                                Expiry: 09/19<br>
                                Pin 1111<br>
                            </p>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-6-->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Test Acounts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <p>Use the below <b>Test Accounts</b> to test the application and fund your wallet.</p>
                            <p>
                                Access Bank<br>
                                Account number: 0690000031<br>
                                otp: 12345
                            </p>
                            <hr>
                            <p>
                                Providus Bank<br>
                                Account number: 5900102340, 5900002567<br>
                                otp: 12345<br>
                            </p>
                            <hr>
                            <p>
                                Sterling Bank<br>
                                Account number: 0061333471<br>
                                otp: 12345
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
