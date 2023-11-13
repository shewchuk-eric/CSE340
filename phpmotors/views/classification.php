<?php

// set page title and call header
    $pageTitle = "View our $classificationName vehicles inventory | PHP Motors, Inc."; // use information from controller to create title
    include_once 'header.php'; ?>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

<?php if(isset($vehicleDisplay)) {echo $vehicleDisplay;} ?>

<!-- </section> -->

<?php unset($_SESSION['message']); ?>

<?php include_once 'footer.php'; ?>