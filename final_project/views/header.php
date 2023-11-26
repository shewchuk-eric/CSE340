<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Eric Shewchuk">
    <meta name="description" content="CSE340 - Web Backend Development for Eric Shewchuk.  This is the final project">
    <link rel="icon" href="http://localhost:3000/final_project/images/favicon.ico" type="image/x-icon">
    <title><?php echo($pageTitle);?></title>
    <link rel="stylesheet" href="http://localhost:3000/final_project/styles/base.css">
    <!-- <link rel="stylesheet" href="http://localhost:3000/final_project/styles/final.min.css"> -->
</head>
<body>
<header>
    <img src="http://localhost:3000/final_project/images/logo.png" alt="... logo">
    <!-- <?php //if(isset($_SESSION['clientData'])) {
    //     $welcome = "<span class='account'><a href='/phpmotors/accounts/index.php' title='Logged in user first name'>Welcome  ";
    //     $welcome .= $_SESSION['clientData']['clientFirstname'];
    //     $welcome .= "</a> |</span><span class='account'><a href='/phpmotors/accounts/index.php?action=destroy' title='User Log Out'>Log Out</a></span>";
    //     echo $welcome;
    // } else {
    //     echo "<span class='account'><a href='/phpmotors/accounts/index.php?action=login' title='Returning User Login'>My Account</a></span>";} ?>
    
    
    <?php echo $navList; ?> -->
    <?php include_once "http://localhost:3000/final_project/views/navigation.php" ?>

    
</header>
    <main>