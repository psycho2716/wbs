<?php
session_start();
include('includes/config.php');
include('includes/user_actions.php');

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, user_type, name, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $user_type, $name, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["name"] = $name;
                            $_SESSION["username"] = $username;
                            $_SESSION["user_type"] = $user_type;                            
                            
                            // Redirect user to user check page
                            header("location: includes/checkpoint.php?user_type=" . $user_type);
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
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
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
            <img src="images/logo.png" alt=""> Romblon Water District
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Sign In</a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    
    <header>
        <div class="alert-message" id="liveAlertPlaceholder"></div>
        <div class="form-container">
            <h2 class="text-light">Sign In</h2>
            <form action="#" method="post" id="form">
                <div class="mb-3 input-container">
                    <div class="input">
                        <i class='bx bxs-user-check'></i>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <?php if (!empty($username_err)) {
                    ?>
                        <span class="help-block alert alert-danger"><?php echo $username_err; ?></span>
                    <?php
                    } ?>
                </div>
                <div class="mb-3 input-container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <div class="input">
                        <i class='bx bx-key'></i>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <?php if (!empty($password_err)) {
                    ?>
                        <span class="help-block alert alert-danger"><?php echo $password_err; ?></span>
                    <?php
                    } ?>
                </div>

                <button type="submit" class="btn btn-primary">Log In</button>
            </form>
        </div>
    </header>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" ></script>

    <!-- <script src="js/app.js"></script> -->
  </body>
</html>
