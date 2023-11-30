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

<h2>Reviews</h2>

<?php if(isset($reviewMessage)) {echo "<span class='message'>$reviewMessage</span>";} ?>
<?php

    if(!isset($_SESSION['loggedin'])) {
        echo "<p>You must be <a href='../accounts/index.php?action=login'>Logged In</a> to write a review.";
    } else {
        echo $getReview;
    } ?>
<?php if(isset($listReviews)) {echo $listReviews;} ?>

</section>

<?php unset($_SESSION['message']); ?>
<?php unset($reviewMessage); ?>
<?php include_once 'footer.php'; ?>