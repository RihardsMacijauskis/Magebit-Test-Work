<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <div>
         <h1>Hello, <b><?php echo htmlspecialchars($_SESSION["name"]); ?></b>.<br> Welcome to this website!</h1>
         <form action="logout.php">
             <button class="button">Logout</button>
         </form>
    </div>
</body>
</html>