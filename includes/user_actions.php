<?php
include('config.php');

// Sign Up Starts here
// Define Signup variables
$name = $username = $password = $confirm_password = "";
$name_err = $username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if (isset($_POST['signup'])) {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Check name if empty
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (name, username, password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_username, $param_password);

            // Set parameters
            $param_name = $name;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: /new_wbs/login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($con);
}
// Signup Ends Here

// Add Consumer Starts Here
if (isset($_POST['add_consumer'])) {
    $account_no = $_POST['account_no'];
    $meter_no = $_POST['meter_no'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $sql = "INSERT INTO consumers (account_no, name, address, phone, meter_no)
      VALUES ('$account_no','$name','$address','$phone','$meter_no')";
    $result = mysqli_query($conn, $sql);

    header('location: consumers.php?info=add');
}
// Add Consumer Ends Here

// Edit Consumer Starts Here

if (isset($_POST['edit_consumer'])) {
    $id = $_GET['editid'];

    $account_no = $_POST['account_no'];
    $meter_no = $_POST['meter_no'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql = "UPDATE consumers SET account_no = '$account_no', meter_no = '$meter_no', name = '$name', address = '$address', phone = '$phone' WHERE id=$id ";
    $result = mysqli_query($conn, $sql);

    header('location: consumers.php?info=edit');
}
// Edit Consumer Ends Here

// Delete Consumer Starts Here

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM consumers WHERE id=$id";
    $result = mysqli_query($conn,$sql);

    header('location: ../consumers.php?info=delete');
}
// Delete Consumer Ends Here

// Delete All Consumer Starts Here
if (isset($_GET['protocol'])) {
    $protocol = $_GET['protocol'];

    $sql = "SELECT * FROM consumers";
    $result = mysqli_query($conn, $sql);
    $consumers = mysqli_num_rows($result);

    if ($consumers !== 0) {
        if ($protocol === 'clean') {
            $sql = "TRUNCATE TABLE consumers";
            $result = mysqli_query($conn,$sql);
    
            header('location: ../consumers.php?info=clean');
        }
    } else {
        header('location: ../consumers.php?info=failed');
    }
}
// Delete All Consumer Ends Here
