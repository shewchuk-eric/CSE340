<?php
// controller for managing customer reviews

session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';
require_once '../model/vehicles-model.php';

$classifications = getClassList();
$navList = buildList($classifications);

$authorList = getAuthors(); 
$authorsList = buildAuthorsList($authorList);
$vehicles = getVehicles();
$vehiclesList = buildVehiclesSelect($vehicles);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}


switch ($action) {
    case 'addNewReview':
	$invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT); // Store the incoming vehicle id and primary picture indicator
	$imgPrimary = filter_input(INPUT_POST, 'imgPrimary', FILTER_VALIDATE_INT);
    $imgName = $_FILES['file1']['name']; // Store the name of the uploaded image

    $imageCheck = checkExistingImage($imgName);
      
    if($imageCheck){
        $message = 'An image by that name already exists.';
    } elseif (empty($invId) || empty($imgName)) {
        $message = 'You must select an existing vehicle and image file for the vehicle.';
    } else {
        $imgPath = uploadFile('file1'); // Upload the image, store the returned path to the file
        $result = storeImages($imgPath, $invId, $imgName, $imgPrimary); // Insert the image information to the database, get the result
        if ($result) {
            $message = "$imgName was uploaded.";
        } else {
            $message = 'Sorry, the upload failed.';
        }
    }
    $_SESSION['message'] = $message;
    header('location: .');
    break;

    case 'adminEdit':
        // $authorList = getAuthors(); 
        // $authorsList = buildAuthorsList($authorList);
        // $vehicles = getVehicles();
        // $vehiclesList = buildVehiclesSelect($vehicles);
        include '../views/reviews-admin.php';
        break;

    case 'filterAuthor':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_VALIDATE_INT);
        
        if(empty($clientId)) { // check for any empty lines in form
            $_SESSION['message'] = 'Please select an author.';
            // $authorList = getAuthors(); 
            // $authorsList = buildAuthorsList($authorList);
            // $vehicles = getVehicles();
            // $vehiclesList = buildVehiclesSelect($vehicles);
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
            // $authorList = getAuthors(); 
            // $authorsList = buildAuthorsList($authorList);
            // $vehicles = getVehicles();
            // $vehiclesList = buildVehiclesSelect($vehicles);
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
   
        break;

    case 'deleteReview':
        
        break;
        
        
    default:
    
        include '../views/image-admin.php';
        exit;
        break;

    
   }

?>