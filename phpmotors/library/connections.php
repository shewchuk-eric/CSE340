<?php 

function phpmotorsConnect(){
 $server = 'localhost';
 $dbname= 'phpmotors';
 $username = 'iClient';
 $password = 'Clunker08'; 
 $dsn = "mysql:host=$server;dbname=$dbname;port=3306"; // laptop computer
 //$dsn = "mysql:host=$server;dbname=$dbname;port=3307"; // studio computer
 $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

 // Create the actual connection object and assign it to a variable
 try {
  $link = new PDO($dsn, $username, $password, $options);
     if (is_object($link)) {
     //echo 'It worked!';
    }
  return $link;
 } catch(PDOException $e) {
    //echo "It didn't work, error: " . $e->getMessage();
  header('Location: views/500.php');
  exit;
 }
} 

//phpmotorsConnect();

?>