<?php  //This is the Accounts controller

require_once '../library/connections.php'; // bring in DB connections ability
require_once '../model/accounts-model.php'; // contains functions to manage user accounts 
require_once '../library/functions.php'; // contains data validation functions

$classifications = getClassList(); // get classifications from functions.php
$navList = buildList($classifications); // Build the navigation list using results from getClassifications()

$action = filter_input(INPUT_POST, 'action'); 
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }


 switch ($action){
    case 'login':
        include '../views/login.php';
        break;
    case 'loginNow':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail); // call function to validate for correct email format
        $checkPassword = checkPassword($clientPassword); // call function to validate for correct password format

        if(empty($clientEmail) || empty($checkPassword)) { // check for any empty lines in form
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/login.php'; // empty field is found - show error message
            exit;
        }
        break;
    case 'registration':
        include '../views/registration.php'; 
        break; 
    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)); // get form values and make sure they're clean
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail); // call function to validate for correct email format
        $checkPassword = checkPassword($clientPassword); // call function to validate for correct password format

        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) { // check for any empty lines in form
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../views/registration.php'; // empty field is found - show error message
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword); // all fields populated - send to insert function in 'accounts-model.php'
        if ($regOutcome === 1) {
            $message = "<p>Thanks for registering, $clientFirstname. Please use your email and password to login.</p>";
            include '../views/login.php';
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