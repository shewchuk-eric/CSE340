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

// FIND AND RETURN VEHICLES THAT MATCH THE CLASSIFICATION ID SELECTED IN VEHICLE ADMIN VIEW
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

// RETURN INFORMATION FOR A SPECIFIC VEHICLE - USED BY 'VEHICLES-UPDATE.PHP' AND 'DETAILS.PHP'
function getInvItemInfo($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT *, imgPath FROM inventory i JOIN images p ON i.invId = p.invId WHERE i.invId = :invId AND p.imgPrimary = 1';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

// UPDATE AN EXISTING VEHICLE IN THE DB
function updateVehicle($invId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId) { // add a new vehicle to the inventory in database
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invColor = :invColor, classificationId = :classificationId WHERE invId = :invId'; // The SQL query with placeholders for insert values
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
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

// DELETE A VEHICLE SELECTED IN THE ADMIN MANAGEMENT VIEW
function deleteVehicle($invId) {
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'DELETE FROM inventory WHERE invId = :invId'; // The SQL query with placeholders for insert values
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute(); // Run the query
    $rowsChanged = $stmt->rowCount(); // Ask how many rows were affected by query
    $stmt->closeCursor();
    return $rowsChanged;
}

// GET A LIST OF VEHICLES FROM A CATEGORY AS SELECTED IN THE NAVIGATION LINKS
function getVehiclesByClassification($classificationName) {
    $db = phpmotorsConnect();
    $sql = 'SELECT *, imgPath FROM inventory i JOIN images p ON i.invId = p.invId WHERE imgPath LIKE "%-tn%" AND p.imgPrimary = 1 AND i.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

// BUILD THE LIST OF VEHICLES TO SHOW USER WHEN A NAVIGATION BAR LINK IS SELECTED
function buildVehiclesDisplay($vehicles, $classificationName) {
    $dv = '<div id="cards-container">';
    $dv .= "<h1>$classificationName vehicles</h1>";
    $dv .= '<div id="display-box">';
    foreach ($vehicles as $vehicle) {
        $price = number_format($vehicle['invPrice']);
        $dv .= '<section class="inv-display">';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicleDetails&invId=$vehicle[invId]'>";
        $dv .= "<img src='$vehicle[imgPath]' alt='$vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h3>$vehicle[invMake] $vehicle[invModel]</h3>";
        $dv .= "<span>$$price</span><br>";
        $dv .= "<div class='button'>View Details</div></a>";
        $dv .= '</section>';
    }
    $dv .= '</div>'; // end of 'cards-container'
    $dv .= '</div>'; // end of 'display-box'
    return $dv;
}

// BUILD VIEW CONTENT FOR INDIVIDUAL VEHICLE DETAILS FOR DISPLAY ON 'DETAILS.PHP'
function buildVehicleDetails($details, $thumbnails) {
    $price = number_format($details['invPrice']);
    $dv = "<div id='vehicleDisplay'>";
    $dv .= "<article id='text'>";
    $dv .= "<h1>$details[invMake] $details[invModel]</h1>";
    $dv .= "<h3>$$price</h3>";
    $dv .= "<p>$details[invDescription]</p>";
    $dv .= "</article>";
    $dv .= "<img src='$details[imgPath]' alt='$details[invMake] $details[invModel] on phpmotors.com' class='fullImage'>";
    $dv .= "</div>";
    // build thumbnails div
    $dv .= "<div id='thumbs'>";
    $iter = 1;
    foreach ($thumbnails as $thumb) {
        $dv .= "<img src='$thumb[imgPath]' alt='$details[invMake] $details[invModel] thumbnail $iter on phpmotors.com' class='smallImage'>";
        $iter ++;
    }
    $dv .= "</div>";
    return $dv;
}

// GET INFORMATION ABOUT ALL VEHICLES IN INVENTORY FOR 'UPLOADS/INDEX.PHP'
function getVehicles() {
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}

?>