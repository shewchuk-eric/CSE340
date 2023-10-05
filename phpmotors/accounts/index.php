<?php  //This is the Accounts controller

require_once '../library/connections.php';
require_once '../model/main-model.php';


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
    case 'register':
        include '../views/register.php'; 
        break; 
    default:
        echo 'switch not working';
   }

 ?>