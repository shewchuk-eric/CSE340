<?php  //This is the Accounts controller

require_once '../library/connections.php'; // bring in DB connections ability
require_once '../model/main-model.php'; // contains navigation getter function
require_once '../model/accounts-model.php'; // contains functions to manage user accounts 


$classifications = getClassifications(); // get classifications from main-model.php
// var_dump($classifications); // test for good connection
// exit;

// Build the navigation list using results from getClassifications()
$navList = '<ul class="nav">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .="<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .='</ul>';
// echo $navList; // test for accuracy of navigation builder code
// exit;


$action = filter_input(INPUT_POST, 'action'); 
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


 switch ($action){
    case 'login':
        include '../views/login.php';
        break;
    case 'registration':
        include '../views/registration.php'; 
        break; 
    case 'register':
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname'); // get form values and make sure they're clean
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');

        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) { // check for any empty lines in form
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/registration.php'; // empty field is found - show error message
            exit;
        }
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword); // all fields populated - send to insert function in 'accounts-model.php'
        if ($regOutcome === 1) {
            $message = "<p>Thanks for registereing, $clientFirstname. Please use your email and password to login.</p>";
            include '../views/registration.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../views/registration.php';
            exit;
          }
        break;
    default:
        echo 'switch not working';
   }

 ?>