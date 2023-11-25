<?php 
// manage vehicle inventory uploads

function storeImages($imgPath, $invId, $imgName, $imgPrimary) { // Add image information to the database table
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO images (invId, imgPath, imgName, imgPrimary) VALUES (:invId, :imgPath, :imgName, :imgPrimary)';
    $stmt = $db->prepare($sql);

    // Store the full size image information
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();
        
    // Make and store the thumbnail image information
    $imgPath = makeThumbnailName($imgPath); // Change name in path
    $imgName = makeThumbnailName($imgName); // Change name in file name
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->bindValue(':imgPrimary', $imgPrimary, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getImages() { // Get Image Information from images table
    $db = phpmotorsConnect();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invMake, invModel FROM images JOIN inventory ON images.invId = inventory.invId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $imageArray;
}

function deleteImage($imgId) { // Delete image information from the images table
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $imgId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
}

function checkExistingImage($imgName){ // Check for an existing image
    $db = phpmotorsConnect();
    $sql = "SELECT imgName FROM images WHERE imgName = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
}

function getThumbs($invId) {
    $db = phpmotorsConnect();
    $sql = "SELECT imgPath FROM images WHERE invId = :invId AND imgName LIKE '%-tn%'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetchAll();
    $stmt->closeCursor();
    return $imageMatch;
}
?>