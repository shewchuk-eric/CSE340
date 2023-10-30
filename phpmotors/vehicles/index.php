<?php // This is the vehicles management controller

require_once '../library/connections.php'; // bring in DB connections ability
require_once '../model/vehicles-model.php'; // contains functions to manage vehicle inventory 
require_once '../library/functions.php'; // contains data validation functions

$classifications = getClassList(); // get classifications from main-model.php
$navList = buildList($classifications); // Build the navigation list using results from getClassifications()

// check for an action value
$action = filter_input(INPUT_POST, 'action'); 
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL){
    $action = 'default';
  }
 }

 // decide which view to show
 switch ($action){
    case 'default': // first time to vehicle management section - shows options
        include '../views/vehicles-default.php';
        break;

    case 'manage': // user selected 'manage vehicle inventory' so form is displayed
        include '../views/vehicles-add-new.php';
        break;

    case 'newClass': // user selected 'vehicle classifications' so the list is shown and a field to add a new classification
        include '../views/vehicles-add-class.php';
        break;

    case 'newVehicle': // user has submitted form to add vehicle(s) to inventory 
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS)); // get form values and make sure they're clean
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, 'classes', FILTER_SANITIZE_NUMBER_INT));

        $invImage = cleanFileName($invImage);
        $invThumbnail = cleanFileName($invThumbnail);

        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) { // check for any empty lines in form
            $message = "<p>Please provide information for all empty form fields.</p>";
            include '../views/vehicles-add-new.php'; // empty field is found - show error message
            exit;
        }
        $regOutcome = addNewVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId); // all fields populated - send to insert function in 'accounts-model.php'
        if ($regOutcome === 1) {
            $message = "<p>$invMake $invModel has been added to the vehicle inventory.</p>";
            include '../views/vehicles-add-new.php';
            exit;
        } else {
            $message = "<p>$invMake $invModel cannot be added at this time. Please try again.</p>";
            include '../views/vehicles-add-new.php';
            exit;
          }
        break;

    case 'addNewClass': // user has filled out the field to add a new classification
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS)); // get form value and make sure it's clean

        $classificationValid = checkLength($classificationName);

        if(empty($classificationValid)) { // make sure input not empty
            $message = '<p>Please provide a valid classification name.</p>';
            include '../views/vehicles-add-class.php'; // empty field is found - show error message and go back to form
            exit;
        }
        $regOutcome = newClassification($classificationName); // all fields populated - send to insert function in 'accounts-model.php'
        if ($regOutcome === 1) {
            $message = "<p>The $classificationName classification has been added.</p>";
            header ("location: ../views/vehicles-default.php");
            exit;
        } else {
            $message = "<p>Sorry, but the registration failed. Please try again.</p>";
            include '../views/vehicles-add-class.php';
            exit;
          }
        break;

    default: // Houston, we have a problem
        echo 'Switch not working';
        break;
   }

 ?>