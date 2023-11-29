<?php

// set page title and call header
    $pageTitle = "$details[invMake] $details[invModel] | PHP Motors, Inc."; // use information from controller to create title
    include_once 'header.php'; ?>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

<section id='details'>

<?php if(isset($detailsDisplay)) {echo $detailsDisplay;} ?>

</section>

<?php unset($_SESSION['message']); ?>
<?php include_once 'footer.php'; ?>