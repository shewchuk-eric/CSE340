<?php 
// manage user reviews

function storeReview($reviewText, $reviewDate, $invId, $clientId) { // Insert a new review to the database table
    $db = phpmotorsConnect();
    $sql = 'INSERT INTO reviews (reviewText, reviewDate, invId, clientId) VALUES (:reviewText, :reviewDate, :invId, :clientId)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewDate', $reviewDate, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getReviews($invId) { // Get reviews for a specific vehicle from reviews table
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewText, reviewDate, clientFirstname, clientLastname FROM reviews r JOIN clients c ON r.clientId = c.clientId WHERE r.invId = $invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review;
}

function getAuthors() {
    $db = phpmotorsConnect();
    $sql = 'SELECT DISTINCT clientFirstname, clientLastname clientId FROM reviews r JOIN clients c ON r.clientId = c.clientId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $authors;
}

function getClientReviews($clientId) { // Get reviews uploaded by a specific client
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewText, reviewDate FROM reviews WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

function getVehicleReviews($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewText, reviewDate FROM reviews WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

function getSingleReview($reviewId){ // Get a single specific review - admin only
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewText, reviewDate, clientFirstname, clientLastname FROM reviews r JOIN clients c ON r.clientId = c.clientId WHERE r.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $singleReview = $stmt->fetch();
    $stmt->closeCursor();
    return $singleReview;
}

function updateReview($reviewId, $reviewText) { // Update a single specific review - admin only
    $db = phpmotorsConnect();
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_STR); // Tells database what type of information is being sent
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->execute();
    $reviewUpdate = $stmt->rowCount();
    $stmt->closeCursor();
    return $reviewUpdate;
}

function deleteReview($reviewId) { // Delete a single specific review - admin only
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}
?>