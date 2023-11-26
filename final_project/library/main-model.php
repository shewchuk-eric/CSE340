<?php // this is the accounts manager model - handles site registrations

// CHECK FOR EXISTING EMAIL/USERNAME DURING REGISTRATION PROCESS
function checkUniqueEmail($clientEmail) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute(); // Run the query
    $isMatch = $stmt->fetch(PDO::FETCH_NUM); // Look for a qualifying row and return a number as the result (1 or 0)
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

// GET CLIENT DATA IN RESPONSE TO LOGIN - USES EMAIL/USERNAME TO LOCATE
function getClient($clientEmail) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute(); // Run the query
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC); // Get any row that qualifies and return an associative array as the result
    $stmt->closeCursor();
    return $clientData;
}

function updateClient($clientFirstname, $clientLastname, $clientEmail, $userId) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId'; // The SQL query with placeholders for insert values
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR); // Tells database what type of information is being sent
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $userId, PDO::PARAM_INT);
    $stmt->execute(); // Run the query
    $rowsChanged = $stmt->rowCount(); // Ask how many rows were affected by query
    $stmt->closeCursor();
    return $rowsChanged;
}

function updatePass($clientId, $clientPassword) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId'; // The SQL query with placeholders for insert values
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute(); // Run the query
    $rowsChanged = $stmt->rowCount(); // Ask how many rows were affected by query
    $stmt->closeCursor();
    return $rowsChanged;
}

?>