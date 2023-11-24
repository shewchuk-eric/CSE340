<?php
// image uploads controller
session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';

$classifications = getClassList();
$navList = buildList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

// create variables for use with image uploads
$image_dir = '/phpmotors/images/vehicles'; // directory name where uploaded images are stored
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir; // The path is the full path from the server root

switch ($action) {
    case 'upload':
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

    case 'delete':
    $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Get the image name and id
    $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);
    $target = $image_dir_path . '/' . $filename; // Build the full path to the image to be deleted
        
    if (file_exists($target)) { // Check that the file exists in that location
        $result = unlink($target); // Deletes the file in the folder
    }
    if ($result) { // Remove from database only if physical file deleted
        $remove = deleteImage($imgId);
    }
    if ($remove) { // Set a message based on the delete result
        $message = "$filename was successfully deleted.";
    } else {
        $message = "$filename was NOT deleted.";
    }
    $_SESSION['message'] = $message;
    header('location: .');  
    break;

    default:
    $imageArray = getImages(); // Call function to return image info from database

    if (count($imageArray)) { // Build the image information into HTML for display
        $imageDisplay = buildImageDisplay($imageArray);
    } else {
        $imageDisplay = 'Sorry, no images could be found.';
    }
    $vehicles = getVehicles(); // Get vehicles information from database
    $prodSelect = buildVehiclesSelect($vehicles); // Build a select list of vehicle information for the view   
    include '../views/image-admin.php';
    exit;
    break;
   }


?>