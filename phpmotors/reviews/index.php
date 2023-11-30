<?php
// controller for managing customer reviews

session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';
require_once '../model/vehicles-model.php';

$classifications = getClassList();
$navList = buildList($classifications);

// $authorList = getAuthors(); 
// $authorsList = buildAuthorsList($authorList);
// $vehicles = getVehicles();
// $vehiclesList = buildVehiclesSelect($vehicles);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}


switch ($action) {
    case 'addNewReview':
	$invId = filter_input(INPUT_POST, 'vehicle', FILTER_VALIDATE_INT); // Store the incoming vehicle id
	$clientId = filter_input(INPUT_POST, 'user', FILTER_VALIDATE_INT);
    $reviewText = trim(filter_input(INPUT_POST, 'newReview', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      
    if(empty($reviewText)) {
        $message = "<p>No review was submitted</p>";
        include '../views/details.php'; // empty field is found - show error message
        exit;
    }
    $reviewDate = date("Y/m/d");
    $addReview = storeReview($reviewText, $reviewDate, $invId, $clientId);

    if ($addReview === 1) {
        $message = "<p>Your review has been submitted. Thanks!</p>";
        $_SESSION['message'] = $message;
        header ("location: /phpmotors/vehicles/index.php?action=vehicleDetails&invId=$invId");
        exit;
    } else {
        $message = "<p>Your review cannot be submitted at this time. Please try again later.</p>";
        $_SESSION['message'] = $message;
        include '../views/details.php';
        exit;
      }


    case 'filterAuthor':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_VALIDATE_INT);
        
        if(empty($clientId)) { // check for any empty lines in form
            $_SESSION['message'] = 'Please select an author.';

            include '../views/reviews-admin.php'; // empty field is found - show error message
            exit;
        }
        $reviews = getClientReviews($clientId);
        if(!count($reviews)){
            $_SESSION['failMessage'] = "Sorry, we were unable to retrieve reviews.";
        } else {
            $Reviews = buildReviewsDisplay($reviews);
        }
        include '../views/reviews-admin.php';
        break;


    case 'filterVehicle':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
        
        if(empty($invId)) { // check for any empty lines in form
            $_SESSION['message'] = 'Please select a vehicle.';
            include '../views/reviews-admin.php'; // empty field is found - show error message
            exit;
        }
        $reviews = getVehicleReviews($invId);
        if(!count($reviews)){
            $_SESSION['failMessage'] = "Sorry, we were unable to retrieve reviews.";
        } else {
            $Reviews = buildReviewsDisplay($reviews);
        }
        include '../views/reviews-admin.php';
        break;
        

    case 'editReview':
        $reviewText = trim(filter_input(INPUT_POST, 'review', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $reviewId = filter_input(INPUT_POST, 'updateReview', FILTER_SANITIZE_NUMBER_INT);

        if(empty($reviewText)) { // check for any empty lines in form
            $_SESSION['message1'] = "Your review text is missing.";
            header ('location: /phpmotors/accounts/index.php?action=update');
            exit;
        }
        $updateResult = updateReview($reviewId, $reviewText);
        if ($updateResult === 1) {
            $_SESSION['message2'] = "Your review has been updated.";
            header ('location: /phpmotors/accounts/index.php?action=update');
            exit;
        } else {
            $_SESSION['message2'] = "Your review cannot be updated at this time. Please try again later.";
            header ('location: /phpmotors/accounts/index.php?action=update');
            exit;
          }
        break;

    case 'deleteReview':
        $reviewId = filter_input(INPUT_GET, 'removeReview', FILTER_SANITIZE_NUMBER_INT);
        $deleteResult = deleteReview($reviewId);
        if ($deleteResult === 1) {
            $_SESSION['message2'] = "Your review has been deleted.";
            header ('location: /phpmotors/accounts/index.php?action=update');
            exit;
        } else {
            $_SESSION['message2'] = "Your review cannot be deleted at this time. Please try again later.";
            header ('location: /phpmotors/accounts/index.php?action=update');
            exit;
          }
        break;
        
        
    default:
    
        include '../views/image-admin.php';
        exit;
        break;

    
   }

?>