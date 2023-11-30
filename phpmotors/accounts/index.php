<?php  //This is the Accounts controller

session_start(); // create or access a session - required at the top of ALL controllers

require_once '../library/connections.php'; // bring in DB connections ability
require_once '../library/functions.php'; // contains data validation functions
require_once '../model/accounts-model.php'; // contains functions to manage user accounts 
require_once '../model/reviews-model.php'; // contains functions to manage user reviews 

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
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL)); // collect data from form
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail); // call function to validate for correct email format
        $checkPassword = checkPassword($clientPassword); // call function to validate for correct password format

        if(empty($clientEmail) || empty($checkPassword)) { // check for any empty lines in form
            $_SESSION['message'] = 'Please provide information for all empty form fields.';
            include '../views/login.php'; // empty field is found - show error message
            exit;
        }

        $clientData = getClient($clientEmail); // user input passes basic check so see if it matches any row in database
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']); // check the user supplied password against the one returned from database

        if(!$hashCheck) {
            $_SESSION['message'] = 'Please check your username and password and try again.'; // $hashCheck returned 'false' so give error message and return to login
            include '../views/login.php';
            exit;
        }

        $_SESSION['message'] = "You are logged in.";
        $_SESSION['loggedin'] = TRUE; // checks pass so log in the user
        array_pop($clientData); // remove $clientPassword from the array - no longer needed
        $_SESSION['clientData']= $clientData; // the clientData array is now stored as a session value
        include '../views/admin.php'; // send user to admin view
        exit;
        break; // still needed?

    case 'registration':
        include '../views/registration.php'; 
        break;

    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)); // get form values and make sure they're clean
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $existingEmail = checkUniqueEmail($clientEmail); // check if email/username already exists in database
        $clientEmail = checkEmail($clientEmail); // call function to validate for correct email format
        $checkPassword = checkPassword($clientPassword); // call function to validate for correct password format

        if($existingEmail) {
            $_SESSION['message'] = 'The email address you entered already exists.  Do you wish to login instead?';
            include '../views/login.php';
            exit;
        }

        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) { // check for any empty lines in form
            $_SESSION['message'] = 'Please provide information for all empty form fields.';
            include '../views/registration.php'; // empty field is found - show error message
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword); // all fields populated - send to insert function in 'accounts-model.php'
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/'); // the last item - '/' tells the controller that the whole website is open to this cookie -> no restricted pages
            $_SESSION['message'] = "Thanks for registering, $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $_SESSION['message'] = "Sorry $clientFirstname, but the registration failed. Please try again.";
            include '../views/registration.php';
            exit;
          }
        break;

    case 'destroy':
        unset($_SESSION['clientData']);
        unset($_SESSION['loggedin']);
        session_destroy();
        header ('Location: /phpmotors/index.php'); 
        break;

    case 'update':
        $clientId = $_SESSION['clientData']['clientId'];
        $reviews = getClientReviews($clientId);
        if(!count($reviews)){
            $noReviews = "You have no saved reviews.";
        } else {
            $reviewList = editReviewsDisplay($reviews);
        }
        include '../views/user-update.php';
        break;

    case 'accountUpdate':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS)); // get form values and make sure they're clean
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $userId = trim(filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT));

        if($clientEmail != $_SESSION['clientData']['clientEmail']){
            $existingEmail = checkUniqueEmail($clientEmail); // check if email/username already exists in database
            if($existingEmail) {
                $_SESSION['message'] = 'The email address you entered already exists.  Please select another?';
                include '../views/user-update.php';
                exit;
            }
        }

        $clientEmail = checkEmail($clientEmail); // call function to validate for correct email format

        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) { // check for any empty lines in form
            $_SESSION['message'] = 'Please provide valid information for all form fields.';
            include '../views/user-update.php'; // empty field is found - show error message
            exit;
        }
       
        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $userId); // all fields populated - send to update function in 'accounts-model.php'
        if ($updateOutcome === 1) {
            $_SESSION['message'] = "Your account data has been updated.";
            $clientData = getClient($clientEmail);
            array_pop($clientData); // remove $clientPassword from the array - no longer needed
            $_SESSION['clientData']= $clientData;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = "Sorry $clientFirstname, but the update failed. Please try again.";
            include '../views/user-update.php';
            exit;
          }
        break;

    case 'passUpdate':
        $userId = trim(filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $checkPassword = checkPassword($clientPassword); // call function to validate for correct password format

        if(empty($checkPassword)) { // check for any empty lines in form
            $_SESSION['message1'] = 'Please provide a valid password.';
            include '../views/user-update.php'; // empty field is found - show error message
            exit;
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        $passChange = updatePass($userId, $hashedPassword); // all fields populated - send to insert function in 'accounts-model.php'
        if ($passChange === 1) {
            $_SESSION['message1'] = "Your password has been updated.";
            $clientData = getClient($_SESSION['clientData']['clientEmail']);
            array_pop($clientData); // remove $clientPassword from the array - no longer needed
            $_SESSION['clientData']= $clientData;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message1'] = "Sorry $clientFirstname, but the update failed. Please try again.";
            include '../views/user-update.php';
            exit;
          }
        break;
    
    default:
        include '../views/admin.php';
   }

 ?>