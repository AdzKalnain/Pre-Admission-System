<?php
    session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if ($_SESSION["user_type"] == "admin") {
            header("location: admin/controller.php");
            exit;
        } else{
            header("location: user/UserProfile.php");
            exit;
        }
    }
    require_once "include/config.php";

    $username_error = $password_errors = $login_error = "";
    $username = $password = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(trim($_POST["username"]))) {
            $username_error = "Please enter your username";
        } else{
            $username = trim($_POST["username"]);
        }
        if (empty(trim($_POST["password"]))) {
            $password_error = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty($username_error) && empty($password_error)){
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
            $result = mysqli_query($mysqli, $query);
            
            if (mysqli_num_rows($result) == 1) {
                $logged_in_user = mysqli_fetch_assoc($result);

                if ($logged_in_user['user_type'] == 'admin') {
    
                    $_SESSION["loggedin"] = true;
                    $_SESSION['user_type'] = $logged_in_user['user_type'];
                    $_SESSION['login_user'] = $username;
                    $_SESSION['userID'] = $rows['id'];
                    $_SESSION['userCollege'] = $rows['college'];
                    $_SESSION['success']  = "You are now logged in";
                    header('location: admin/controller.php');		  
                }		
                        
                elseif ($logged_in_user['user_type'] == 'interviewer'){

                    $_SESSION["loggedin"] = true;
                    $_SESSION['user_type'] = $logged_in_user['user_type'];
                    $_SESSION['login_user'] = $username;
                    $_SESSION['userID'] = $rows['id'];
                    $_SESSION['userCollege'] = $rows['college'];
                    $_SESSION['success']  = "You are now logged in";
                    header('location: admin/controller.php');
                }

                elseif ($logged_in_user['user_type'] == 'admission officer'){

                    $_SESSION["loggedin"] = true;
                    $_SESSION['user_type'] = $logged_in_user['user_type'];
                    $_SESSION['login_user'] = $username;
                    $_SESSION['userID'] = $rows['id'];
                    $_SESSION['userCollege'] = $rows['college'];
                    $_SESSION['success']  = "You are now logged in";
                    header('location: admin/controller.php');
                }

                // elseif ($logged_in_user['user_type'] == 'ics-evaluator'){

                //     $_SESSION['user'] = $logged_in_user;
                //     $_SESSION['login_user'] = $username;
                //     $_SESSION['userID'] = $rows['id'];
                //     $_SESSION['success']  = "You are now logged in";
                //     header('location: evaluator/ics.evaluator.main.php');
                // }

                // elseif ($logged_in_user['user_type'] == 'coe-evaluator'){

                //     $_SESSION['user'] = $logged_in_user;
                //     $_SESSION['login_user'] = $username;
                //     $_SESSION['userID'] = $rows['id'];
                //     $_SESSION['success']  = "You are now logged in";
                //     header('location: evaluator/coe.evaluator.main.php');
                // }
                
                // elseif ($logged_in_user['user_type'] == 'coe-ic'){

                //     $_SESSION['user'] = $logged_in_user;
                //     $_SESSION['login_user'] = $username;
                //     $_SESSION['userID'] = $rows['id'];
                //     $_SESSION['success']  = "You are now logged in";
                //     header('location: ic/coe.ic.main.php');
                // }
                
                // elseif ($logged_in_user['user_type'] == 'ics-ic'){

                //     $_SESSION['user'] = $logged_in_user;
                //     $_SESSION['login_user'] = $username;
                //     $_SESSION['userID'] = $rows['id'];
                //     $_SESSION['success']  = "You are now logged in";
                //     header('location: ic/ics.ic.main.php');
                // }

                // elseif ($logged_in_user['user_type'] == 'coe-ao'){

                //     $_SESSION['user'] = $logged_in_user;
                //     $_SESSION['login_user'] = $username;
                //     $_SESSION['userID'] = $rows['id'];
                //     $_SESSION['success']  = "You are now logged in";
                //     header('location: ao/coe.ao.qual.php');
                // }

                // elseif ($logged_in_user['user_type'] == 'ics-ao'){

                //     $_SESSION['user'] = $logged_in_user;
                //     $_SESSION['login_user'] = $username;
                //     $_SESSION['userID'] = $rows['id'];
                //     $_SESSION['success']  = "You are now logged in";
                //     header('location: ao/ics.qual.php');
                // }
                
                // elseif($logged_in_user['user_type'] == 'user'){
                //     $_SESSION['user'] = $logged_in_user;
                //     $_SESSION['login_user'] = $username;
                //     $_SESSION['userID'] = $rows['id'];
                //     $_SESSION['success']  = "You are now logged in";
                //     header('location: student/UserProfile.php');
                // }
            } else {
                $login_error = "Invalid email or password";
            }
        }
        $mysqli->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="assets/seal/wmsu-logo.png" sizes="32x32" type="image/png">
    <title>Sign-in - WMSU Online Pre-Admission</title>
    
    <!-- Bootstrap and other cdn declaration -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">

    <!-- Style Declaration -->
    <link rel="stylesheet" href="assets/css/login.css">

</head>
<body>

    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-header text-center mb-4 mt-3">
            <img class="d-block mx-auto w-25" src="assets/seal/wmsu-logo.png" alt="">
            <h4 class="mb-4">WMSU Online Pre-Admission System</h4>
            <?php 
                if(!empty($login_error)){
                    echo '<div class="alert alert-danger">' . $login_error . '</div>';
                }        
            ?>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputEmail" class="form-control form-control-lg <?php echo (!empty($username_error)) ? 'is-invalid' : ''; ?>" name="username" value="<?php echo $username; ?>" placeholder="">
            <span class="error-feedback text-danger" <?php if(empty($username_error)) { echo 'hidden';} ?>><?php echo $username_error ."<br>" ?></span>
            <label for="inputEmail">Username or Email</label>
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" class="form-control form-control-lg <?php echo (!empty($password_error)) ? 'is-invalid' : ''; ?>" name="password" value="<?php echo $password; ?>" placeholder="">
            <span class="error-feedback text-danger" <?php if(empty($password_error)) { echo 'hidden';} ?>><?php echo $password_error ."<br>" ?></span>
            <label for="inputPassword">Password</label>
        </div>

        <button class="btn btn-lg btn-danger btn-block" name="btn-sign-in">Sign in</button>
        
        <div class="registration">
            <p class="mt-2">Don't have an account? <a href="registration.php">Sign up now</a></p>
        </div>
        
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © WMSU Online Pre-Admission 2021</span></div>
            </div>
        </footer>
    </form>

    <!-- JS Declaration -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/theme.js"></script>

    <!--This javascript prevent the resubmission of form when refresh or button(f5) is click-->
    <script>
        if (window.history.replaceState) {
          window.history.replaceState (null, null, window.location.href);
        }
    </script>

</body>
</html>