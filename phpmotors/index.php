<?php // This is the main views controller

session_start(); // create or access a session - required at the top of ALL controllers

require_once 'library/connections.php';
require_once 'library/functions.php';


$classifications = getClassList(); // get classifications from functions.php
$navList = buildList($classifications); // Build the navigation list using results from getClassifications()


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 if(isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 }

 switch ($action){
    case 'something':
        echo "Maybe this will get used someday."; 
        break;   
    default:
        include 'views/home.php';
   }

 ?>