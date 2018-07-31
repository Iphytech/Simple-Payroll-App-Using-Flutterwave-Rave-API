<?php
include('../include/config.php');//connection

//checking if user is logged-in or not
if (!$general->is_loggedin()) {

    //redirecting back to index page
    header("location: ../index.php");
}

//make a single transfer
if (isset($_POST['stransfer'])) {
    //get values
    $bankcode = $_POST['bank'];
    $accountno = $_POST['acctno'];
    $amount = $_POST['amount'];
    $narration = $_POST['comment'];

    /*
    ** check if money in the wallet is greater than
    ** the amount that wants to be transfered
    */
    $walletamount = $transaction->getWalletAmount($_SESSION['userid']);

    if ($walletamount >= $amount) {
        //pass to single transfer function
        $trx = $api->singleTransfer($bankcode, $accountno, $amount, $narration);

        //check transaction status
        if ($trx['status'] == 'success' && $trx['data']['status'] == 'FAILED') {
            echo "<script>alert('Transfer Failed! \\nMSG: ".$trx['data']['complete_message'].".');</script>";
        } else {
            echo "<script>alert('Transfer Successful! \\nMSG: ".$trx['data']['complete_message'].".');</script>";
        }
    } else {
        //insufficient amount
        echo "<script>alert('Insufficient Wallet Balance. Please fund your wallet.');</script>";
        //echo "Insufficient Wallet Balance. Please fund your wallet.";
    }
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
                    <h1 class="page-header">Single Transfer</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">                
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-table fa-fw"></i> Single Transfer
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <p>Send money from your wallet to any bank account.</p>
                            <form action="single-transfer.php" method="POST">
                                <div class="form-group col-md-8">
                                    <label>Bank Name:</label><br>
                                    <select class="form-control" name="bank">
                                        <option value="">--select bank --</option>
                                        <?php 
                                            $banks = $api->getBanks();
                                            foreach ($banks as $bank) {
                                                echo '<option value="'.$bank['code'].'">'.$bank['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Account Number:</label><br>
                                    <input type="text" name="acctno" class="form-control" placeholder="0020176171">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Amount to send:</label><br>
                                    <input type="text" name="amount" class="form-control" placeholder="3000">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Narration:</label><br>
                                    <input type="text" name="comment" class="form-control" placeholder="Eg: Transfer for the goods delivered">
                                </div>
                                <div class="form-group col-md-8">
                                    <input type="submit" name="stransfer" value="Transfer" class="btn btn-success pull-right">
                                </div>
                            </form>
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
