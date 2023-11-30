<?php 

if(!$_SESSION['loggedin']) {
    header ('Location: /phpmotors/');
}

$pageTitle = "You are logged in to Admin | PHP Motors, inc.";
    include_once 'header.php'; ?>

<h1 id='form-title'><?php echo $_SESSION['clientData']['clientFirstname'].' '; echo $_SESSION['clientData']['clientLastname'];?></h1>
<section class='form-container'>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

<ul>
    <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'];?></li>
    <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'];?></li>
    <li>Email: <?php echo $_SESSION['clientData']['clientEmail'];?></li>
</ul>

<section class="message">
    <h3>Account Management</h3>
        <p>Use the following link to update account information:<br><a href="/phpmotors/accounts/index.php?action=update">Update Account Information</a>
    </p>
</section>

<?php if($_SESSION['clientData']['clientLevel'] > 1) {
    echo "<section class='message'><h3>Inventory Management</h3><p>Use the following link to manage inventory:<br><a href='/phpmotors/vehicles/index.php?action=first'>Vehicle Management</a></p><h3>Vehicle Images Management</h3><p>Use the following link to manage vehicle images:<br><a href='/phpmotors/uploads/index.php?'>Vehicle Images Management</a></p></section>";
}?>

</section>

<?php include_once 'footer.php'; ?>