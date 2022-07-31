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
            <?php include('includes/error_handlers.php'); ?>
            
            <div class="container-fluid main-content">
                <div class="container button-container">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#addConsumer">
                        <i class='fa-solid fa-plus me-1 fs-5'></i> Add Consumer
                    </button>
                    <button type="button" class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#deleteConsumers">
                        <i class="fa-solid fa-trash me-1"></i> Delete All
                    </button>
                </div>
                <div class="card">
                    <h5 class="card-header">Consumers</h5>
                    <div class="container-fluid table-responsive-lg card-body">
                        <table class="table table-striped text-center" id="datatable">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Account No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Meter No.</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact No.</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $get_data = "SELECT * FROM consumers order by 1 desc";
                                $run_data = mysqli_query($conn, $get_data);
                                $searchResult = mysqli_num_rows($run_data);

                                $i = 0;

                                while ($row = mysqli_fetch_assoc($run_data)) {
                                    $no = ++$i;
                                    $id = $row['id'];
                                    $account_no = $row['account_no'];
                                    $meter_no = $row['meter_no'];
                                    $name = $row['name'];
                                    $address = $row['address'];
                                    $phone = $row['phone'];
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $no; ?></th>
                                        <td><?php echo $account_no; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $meter_no; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td>
                                            <div class="container d-flex">
                                                <div class="m-1">
                                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editConsumer<?php echo $id; ?>">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                </div>
                                                <div class="m-1">
                                                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConsumer<?php echo $id; ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- Add Modal -->
                <div class="modal fade" id="addConsumer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-light">
                                <h5 class="modal-title" id="staticBackdropLabel">Add New Consumer</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="row g-3">
                                    <div class="row-span-1">
                                        <label for="inputAccountNumber" class="form-label">Account No.</label>
                                        <input type="text" name="account_no" class="form-control" id="inputAccountNumber" placeholder="Account Number">
                                    </div>

                                    <div class="row-span-1">
                                        <label for="inputMeterNumber" class="form-label">Meter No.</label>
                                        <input type="text" name="meter_no" class="form-control" id="inputMeterNumber" placeholder="Meter Number">
                                    </div>

                                    <div class="row-span-1">
                                        <label for="inputAccountName" class="form-label">Account Name</label>
                                        <input type="text" name="name" class="form-control" id="inputAccountName" placeholder="Full Name">
                                    </div>

                                    <div class="row-span-1">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Complete Address">
                                    </div>

                                    <div class="row-span-1">
                                        <label for="inputPhone" class="form-label">Contact No.</label>
                                        <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone Number" maxlength="11">
                                    </div>

                                    <div class="row-span-1">
                                        <button type="submit" name="add_consumer" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete All Modal -->
                <div class="modal fade" id="deleteConsumers" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-light">
                                <h5 class="modal-title" id="staticBackdropLabel">Are you sure you want to delete?</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>By clicking yes, all consumer data will be deleted from the database.</p>
                                <h6>Do you still want to continue?</h6>
                            </div>
                            <div class="modal-footer">
                                <a href="includes/user_actions.php?protocol=clean" type="button" class="btn btn-danger">Yes</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteConsumer<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-light">
                                <h5 class="modal-title" id="staticBackdropLabel">Are you sure you want to delete?</h5>
                                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h6>Consumer data will be deleted.</h6>
                            </div>
                            <div class="modal-footer">
                                <a href="includes/user_actions.php?deleteid=<?php echo $id; ?>" type="button" class="btn btn-danger">Delete</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <?php
                $get_data = "SELECT * FROM consumers";
                $run_data = mysqli_query($conn, $get_data);
                $searchResult = mysqli_num_rows($run_data);

                while ($row = mysqli_fetch_assoc($run_data)) {
                    $id = $row['id'];
                    $account_no = $row['account_no'];
                    $meter_no = $row['meter_no'];
                    $name = $row['name'];
                    $address = $row['address'];
                    $phone = $row['phone'];
                ?>
                    <div class="modal fade" id="editConsumer<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark text-light">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Consumer</h5>
                                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="consumers.php?editid=<?php echo $id; ?>" method="post" class="row g-3">
                                        <div class="row-span-1">
                                            <label for="inputAccountNumber" class="form-label">Account No.</label>
                                            <input type="text" name="account_no" class="form-control" id="inputAccountNumber" placeholder="Account Number" value="<?php echo $account_no; ?>">
                                        </div>

                                        <div class="row-span-1">
                                            <label for="inputMeterNumber" class="form-label">Meter No.</label>
                                            <input type="text" name="meter_no" class="form-control" id="inputMeterNumber" placeholder="Meter Number" value="<?php echo $meter_no; ?>">
                                        </div>

                                        <div class="row-span-1">
                                            <label for="inputAccountName" class="form-label">Account Name</label>
                                            <input type="text" name="name" class="form-control" id="inputAccountName" placeholder="Full Name" value="<?php echo $name; ?>">
                                        </div>

                                        <div class="row-span-1">
                                            <label for="inputAddress" class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Complete Address" value="<?php echo $address; ?>">
                                        </div>

                                        <div class="row-span-1">
                                            <label for="inputPhone" class="form-label">Contact No.</label>
                                            <input type="text" name="phone" class="form-control" id="inputPhone" placeholder="Phone Number" value="<?php echo $phone; ?>">
                                        </div>

                                        <div class="row-span-1">
                                            <button type="submit" name="edit_consumer" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
    </div>

    <!-- <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
    </div> -->


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>