<?php // This is the main views controller

require_once 'library/connections.php';
require_once 'library/functions.php';


$classifications = getClassList(); // get classifications from functions.php
$navList = buildList($classifications);


$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'something':
        echo "That fart smells."; 
        break;   
    default:
        include 'views/home.php';
   }

 ?>