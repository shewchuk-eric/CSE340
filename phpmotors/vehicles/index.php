<?php // This is the vehicles management controller

require_once '../library/connections.php'; // bring in DB connections ability
require_once '../model/main-model.php'; // contains navigation getter function
require_once '../model/vehicles-model.php'; // contains functions to manage vehicle inventory 

// Build the navigation list using results from getClassifications()
$classifications = getClassifications(); // get classifications from main-model.php
$navList = '<ul class="nav">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .="<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .='</ul>';

// get list of vehicle classifications for dropdown list
$classList = getClassList(); 
$typeList = '<select id="classes" name="classes">';
foreach ($classList as $class) {
    $typeList .="<option value='$class[classificationId]'>$class[classificationName]</option>";
}
$typeList .="</select>";

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
        $invMake = filter_input(INPUT_POST, 'invMake'); // get form values and make sure they're clean
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');
        $classificationID = filter_input(INPUT_POST, 'classes');
        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationID)) { // check for any empty lines in form
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/vehicles-add-new.php'; // empty field is found - show error message
            exit;
        }
        $regOutcome = addNewVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationID); // all fields populated - send to insert function in 'accounts-model.php'
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
        $classificationName = filter_input(INPUT_POST, 'classificationName'); // get form value and make sure it's clean
        if(empty($classificationName)) { // make sure input not empty
            $message = '<p>Please provide a new classification name.</p>';
            include '../views/vehicles-add-class.php'; // empty field is found - show error message and go back to form
            exit;
        }
        $regOutcome = newClassification($classificationName); // all fields populated - send to insert function in 'accounts-model.php'
        if ($regOutcome === 1) {
            // $message = "<p>The $classificationName classification has been added.</p>";
            include '../views/vehicles-default.php';
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