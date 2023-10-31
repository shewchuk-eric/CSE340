<?php // this is the accounts manager model - handles site registrations

// CHECK FOR EXISTING EMAIL/USERNAME DURING REGISTRATION PROCESS
function checkUniqueEmail($clientEmail) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute(); // Run the query
    $isMatch = $stmt->fetch(PDO::FETCH_NUM); // Ask how many rows were affected by query
    $stmt->closeCursor();
    if(empty($isMatch)) {
        return 0; // No match 
    } else {
    return 1; // Match found
    }
}

// ADD NEW CLIENT TO DATABASE
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)'; // The SQL query with placeholders for insert values
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR); // Tells database what type of information is being sent
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->execute(); // Run the query
    $rowsChanged = $stmt->rowCount(); // Ask how many rows were affected by query
    $stmt->closeCursor();
    return $rowsChanged;
}




?>