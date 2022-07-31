<?php
session_start();
include('includes/config.php');
include('includes/user_actions.php');

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <?php include('includes/head.php'); ?>
</head>

<body class="dashboard-body">

    <?php include('includes/dashboard_nav.php'); ?>

    <div class="content">
        <?php include('includes/dashboard_sidebar.php'); ?>


        <div class="main-content">
            <div class="container mt-3">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    <div class="col">
                        <a href="consumers.php" class="card-link">
                            <div class="card bg-c-green dashboard-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Consumers</h6>
                                    <h2 class="text-right">
                                        <i class="fa-solid fa-users f-left"></i>
                                        <span>
                                            <?php
                                            $sql = "SELECT * FROM consumers";
                                            $result = mysqli_query($conn, $sql);
                                            $consumers = mysqli_num_rows($result);

                                            echo $consumers;
                                            ?>
                                        </span>
                                    </h2>

                                    <p class="m-b-0">
                                        Total Consumers
                                        
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col">
                        <a href="billings.php" class="card-link">
                            <div class="card bg-c-pink dashboard-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Bills and History</h6>
                                    <h2 class="text-right"><i class="fa-solid fa-money-bill-transfer f-left"></i><span>274</span></h2>

                                    <p class="m-b-0">
                                        Total Bills
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>