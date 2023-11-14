<?php
session_start();

$name = $_SESSION['name'];
$usertype = $_SESSION['usertype']; // Adjust this line based on your session variable

// Check if the user is an admin
$isAdmin = ($usertype === 'admin');
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
}

include "../config.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Query for table1
$sql1 = "SELECT COUNT(*) AS total_rows FROM dboracleprod";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();
$dboracleprod = $row1['total_rows'];

// Query for table2
$sql2 = "SELECT COUNT(*) AS total_rows FROM dboracle_nonprod";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
$dboracle_nonprod = $row2['total_rows'];

// Query for table3
$sql3 = "SELECT COUNT(*) AS total_rows FROM dbnonoracle";
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();
$dbnonoracle = $row3['total_rows'];

// Calculate total
$totaldatabase = $dboracleprod + $dboracle_nonprod + $dbnonoracle;

// Display the result
// echo "Total database rows: " . $totaldatabase;


?>

<!DOCTYPE html>
<html lang="en">
<?php $halaman = "Dashboard" ?>
<?php include "components/header.php"; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "components/navigasi.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <?php include "components/topbar.php"; ?>
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total DB Oracle-Prod</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $dboracleprod; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total DB Oracle-Non Prod</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $dboracle_nonprod; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total DB Non-Oracle</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $dbnonoracle; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total DB</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totaldatabase; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <h1 class="h3 mb-2 text-gray-800">Log Activities</h1>
                    <div class="row">
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tabel-data" method="post" action="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Time</th>
                                                <th>Database</th>
                                                <th>Update Log</th>
                                                <th>Activity By</th>
                                                <!-- Add other user-related columns as needed -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $sql = "SELECT * FROM log_activities";
                                            $query = $conn->query($sql);
                                            if ($query->num_rows > 0) {
                                                while ($row = mysqli_fetch_array($query)) {
                                                    $i++;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['dateTime']; ?></td>
                                                        <td><?php echo $row['database_name']; ?></td>
                                                        <td><?php echo $row['update_log']; ?></td>
                                                        <td><?php echo $row['users']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>

                                                <tr>
                                                    <td colspan='4'>No recent updates found</td>
                                                </tr>

                                            <?php
                                            }

                                            // Close connection
                                            mysqli_close($conn);
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                        </div>

                    </div>

                    <!-- Content Row -->


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php include "components/footer.php" ?>
            <!-- Footer -->
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>