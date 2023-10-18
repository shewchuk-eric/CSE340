<?php

function getClassList() { // function to create list of vehicle classifications
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'SELECT * FROM carClassification'; // The SQL query to get classification ID and name
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->execute(); // Run the query
    $classifications = $stmt->fetchAll(); // Store results as an array
    $stmt->closeCursor(); // Close the connection
    return $classifications;
}

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
?>