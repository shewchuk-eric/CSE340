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
        // $userId = $_SESSION['clientData']['clientId'];
        // $fname = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
        // $lname = $_SESSION['clientData']['clientLastname'];
        // $getReview = "<form id='review' action='/phpmotors/reviews/index.php' method='post'>";
        // $getReview .= "<fieldset><legend>Write A Review</legend>";
        // $getReview .= "<label for='newReview'>Posting as: $fname. $lname</label>";
        // $getReview .= "<div class='form-field input-right'><textarea name='newReview' id='newReview'></textarea></div>";
        // $getReview .= "<div class='form-field submit-field'>";
        // $getReview .= "<input type='submit' value='Submit My Review'>";
        // $getReview .= "<input type='hidden' name='action' value='addNewReview'>";
        // $getReview .= "<input type='hidden' name='user' value='$userId'>";
        // $getReview .= "<input type='hidden' name='vehicle' value='$invId'>";
        // $getReview .= "</div></fieldset></form>";
        echo $getReview;
    } ?>
<?php if(isset($listReviews)) {echo $listReviews;} ?>

</section>

<?php unset($_SESSION['message']); ?>
<?php unset($reviewMessage); ?>
<?php include_once 'footer.php'; ?>