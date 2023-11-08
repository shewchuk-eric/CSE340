<?php

// CREATE NEW VEHICLE CLASSIFICATION AND ADD IT TO THE DB
function newClassification($classificationName) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'INSERT INTO carclassification (classificationId, classificationName) VALUES (DEFAULT, :classificationName)'; // The SQL query with placeholders for insert values
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR); // Tells database what type of information is being sent
    $stmt->execute(); // Run the query
    $rowsChanged = $stmt->rowCount(); // Ask how many rows were affected by query
    $stmt->closeCursor();
    return $rowsChanged;
}

// ADD A NEW VEHICLE TO THE DB
function addNewVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) { // add a new vehicle to the inventory in database
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'INSERT INTO inventory (invId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId) VALUES (DEFAULT, :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)'; // The SQL query with placeholders for insert values
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR); // Tells database what type of information is being sent
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute(); // Run the query
    $rowsChanged = $stmt->rowCount(); // Ask how many rows were affected by query
    $stmt->closeCursor();
    return $rowsChanged;
}

// FIND AND RETURN VEHICLES THAT MATCH THE CLASSIFICATION SELECTED IN VEHICLE ADMIN VIEW
function getInventoryByClassification($classificationId) {
    $db = phpmotorsConnect(); 
    $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}
?>