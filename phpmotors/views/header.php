<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Eric Shewchuk">
    <meta name="description" content="CSE340 - Web Backend Development for Eric Shewchuk.  This is the PHP Motors assignment">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title><?php echo($pageTitle);?></title>
    <link rel="stylesheet" href="http://localhost:3000/phpmotors/styles/motors.css">
</head>
<body>
<header>
    <img src="http://localhost:3000/phpmotors/images/logo.png" alt="image of PHP Motors logo">
    <?php if(isset($_SESSION['clientData'])) {
        $welcome = "<span class='account'><a href='/phpmotors/accounts/index.php' title='Logged in user first name'>Welcome  ";
        $welcome .= $_SESSION['clientData']['clientFirstname'];
        $welcome .= "</a> |</span><span class='account'><a href='/phpmotors/accounts/index.php?action=destroy' title='User Log Out'>Log Out</a></span>";
        echo $welcome;
    } else {
        echo "<span class='account'><a href='/phpmotors/accounts/index.php?action=login' title='Returning User Login'>My Account</a></span>";} ?>
    <?php echo $navList; ?>
</header>
    <main>