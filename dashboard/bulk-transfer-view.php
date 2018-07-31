<?php
include('../include/config.php');//connection

//checking if user is logged-in or not
if (!$general->is_loggedin()) {

    //redirecting back to index page
    header("location: ../index.php");
}

//get groupid from url
$groupid = $_GET['group'];

//create a group
if (isset($_POST['add'])) {
    //get groupid from url
    $groupid = $_GET['group'];
    $bank = $_POST['bank'];
    $acctno = $_POST['acctno'];
    $acctname = $_POST['acctname'];
    $salary = $_POST['salary'];

    //pass to function
    $transaction->addMember($groupid, $bank, $acctno, $acctname, $salary);
}

//paying the group members
if (isset($_POST['pay'])) {
    $groupid = $_POST['groupid'];

    //get wallet amount
    $walletamount = $transaction->getWalletAmount($_SESSION['userid']);

    //get total amount to be disbursed
    $totalPayout = $transaction->getTotalPayout($groupid);

    //check if user has money enough for payout
    if ($totalPayout > $walletamount) {
        //insufficient amount
        echo "<script>alert('Insufficient Balance! \\nFund your wallet.');</script>";
    } else {
        //pass to function
        $membersDetails = $transaction->getMembers($groupid)->fetchall();

        //pass ro function for bulk transfer
        $trx = $api->bulkTransfer($membersDetails);

        if ($trx['status'] == 'success') {
            header('location: transfer-sucess.php');
        }
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
                <div class="col-lg-6">
                    <h1 class="page-header">Bulk Transfer</h1>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4 col-md-6">
                    <br>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-4x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $transaction->getTotalPayout($groupid); ?></div>
                                    <div>Total Group Payout</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <form action="bulk-transfer-view.php?group=<?php echo $groupid; ?>" method="POST">
                                <input type="hidden" name="groupid" value="<?php echo $groupid; ?>">
                                <input type="submit" name="pay" value="Click to Pay" class="btn btn-sm btn-warning pull-right">
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Member</h4>
                  </div>
                  <div class="modal-body">
                    <p>Add member to the group.</p>
                    <form action="bulk-transfer-view.php?group=<?php echo $groupid; ?>" method="POST">
                        <div class="form-group">
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
                        <div class="form-group">
                            <label>Account Number:</label><br>
                            <input type="text" name="acctno" class="form-control" placeholder="0020176171">
                        </div>
                        <div class="form-group">
                            <label>Account Name:</label><br>
                            <input type="text" name="acctname" class="form-control" placeholder="John Doe">
                        </div>
                        <div class="form-group">
                            <label>Salary Amount:</label><br>
                            <input type="text" name="salary" class="form-control" placeholder="Eg: 30000">
                        </div>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="add" class="btn btn-primary" value="Add Member">
                    </form>
                  </div>
                </div>

              </div>
            </div>
            <!-- end modal -->

            <div class="row">
                <div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Group Members
                            <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#myModal">Add Member</button>
                            <br><br>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <p>NB: For the sake of this API test, we will not be deleting or editing any record. If you stumble on this from my github account, kindly add those features. It is highly recommended. We are skipping those features because this is not a production app.</p>
                            <br>
                            <?php
                            $membersCount = $transaction->getMembers($groupid)->rowCount();
                            if ($membersCount > 0) {
                                $members = $transaction->getMembers($groupid)->fetchall();
                                $sn = 0;

                                echo "<table class='table table-bordered'>";
                                echo "<tr>
                                        <th>S/N</th>
                                        <th>Staff Name</th>
                                        <th>Staff Bank</th>
                                        <th>Staff Account No.</th>
                                        <th>Staff Salary</th>
                                    </tr>";
                                foreach ($members as $member) {
                                    echo "<tr>
                                        <td>".++$sn."</td>
                                        <td>".$member['staffname']."</td>
                                        <td>".$api->getBankName($member['staffbank'])."</td>
                                        <td>".$member['staffacctno']."</td>
                                        <td>".$member['amount']."</td>
                                    </tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p style='color: red'>No member in the group.</p>";
                            }
                            ?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-6-->                
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
