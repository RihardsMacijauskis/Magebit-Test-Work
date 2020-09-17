<?php
// Include config file
require_once "dbconfig.php";
 
// Define variables and initialize with empty values
$name = $email = $password = "";
$name_err = $email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM lietotaji WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already used.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password!";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must contain at least 6 characters!";
    } else{
        $password = trim($_POST["password"]);
    }
    
       // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a name!";     
    } else{
        $name = trim($_POST["name"]);
    }
    

    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO lietotaji (name, email, password) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo "Registration successful!";
                // Redirect to login page
                header("location: index.html");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
