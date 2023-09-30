<?php 

require_once 'connections/connections.php';
require_once 'model/main-model.php';

$classifications = getClassifications(); // get classifications from main-model.php
var_dump($classifications);
exit;

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