<?php
// Edit Consumer Starts Here
$id = $_GET['editid'];

if (isset($_POST['edit_consumer'])) {
    

    $account_no = $_POST['account_no'];
    $meter_no = $_POST['meter_no'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $sql = "UPDATE consumer SET account_no = '$account_no', meter_no = '$meter_no', name = '$name', address = '$address', phone = '$phone' WHERE id=$id ";
    $result = mysqli_query($conn, $sql);

    header('location: consumers.php?edit=success');
}
// Edit Consumer Ends Here