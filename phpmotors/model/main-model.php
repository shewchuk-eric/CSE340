<?php // this is the main phpmotors model

function getClassifications(){
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC'; // The SQL query
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->execute(); // Run the query
    $classifications = $stmt->fetchAll(); // Store results as an array
    $stmt->closeCursor(); // Close the connection
    return $classifications;
}

?>