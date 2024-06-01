<?php
// Include config file
require_once "config3.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - THRIVE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body { 
            font: 14px sans-serif; 
            background: linear-gradient(to bottom, #80cbc4, #4a148c); /* Gradient background matching the app */
            height: 100vh; /* Full height */
            display: flex; 
            justify-content: center; 
            align-items: center; 
            margin: 0; /* Remove default margin */
            color: #ffffff; /* White text color for better visibility */
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent black background */
            padding: 40px; 
            border-radius: 20px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); /* Soft shadow effect */
            text-align: center; /* Center align text */
        }
        .form-group { 
            margin-bottom: 20px; 
        }
        .form-control {
            border-radius: 25px;
            height: 45px;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            color: #000000; /* Black text color for input fields */
        }
        .btn-primary {
            background-color: #ffab00; /* Amber button */
            border-color: #ffab00;
            border-radius: 25px;
            padding: 10px 25px;
            font-size: 16px;
            color: #000000; /* Black text color for button */
        }
        .btn-primary:hover {
            background-color: #ff6f00; /* Darker amber on hover */
            border-color: #ff6f00;
            color: #ffffff; /* White text color on hover */
        }
        .help-block {
            color: #d32f2f; /* Red color for error messages */
        }
        h2 {
            color: #ffffff; /* White color for headings */
            margin-bottom: 20px;
        }
        p {
            color: #ffffff; /* White color for paragraphs */
        }
        a {
            color: #ffab00; /* Amber color for links */
        }
        a:hover {
            color: #ff6f00; /* Darker amber on hover */
        }
    </style>
</head>
<body>
    <div class="overlay">
        <h2>THRIVE - Sign Up</h2>
        <p>Please fill in this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Sign Up">
            </div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>
