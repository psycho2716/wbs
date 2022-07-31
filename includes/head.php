<!-- Bootstrap Meta Tag -->
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title>RWD Water Billing System</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />

<!-- Boxicons CDN Link -->
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

<!-- Fontawesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Favicon -->
<link rel="shortcut icon" href="../images/logo.png" type="image/png">

<!-- External CSS -->
<link rel="stylesheet" href="css/style.css" />

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>

<!-- DataTable CDN -->
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<link href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script>
    $(document).ready(function() {
        $("#datatable").dataTable();
    });
</script>

<?php
    $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>