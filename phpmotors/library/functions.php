<?php 

/************************
* VIEW CONTENT BUILDERS *
************************/

// BUILD NAVIGATION LIST FOR HEADER NAV
function buildList($classifications) {
$navList = '<ul class="nav">';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .="<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .='</ul>';
return $navList;
}

// BUILD CLASSIFICATIONS DROP-DOWN LIST
function getClassList() { // function to create list of vehicle classifications
    $db = phpmotorsConnect(); // Create a connection object
    $sql = 'SELECT * FROM carClassification ORDER BY classificationName ASC'; // The SQL query to get classification ID and name
    $stmt = $db->prepare($sql); // Prepare the statement
    $stmt->execute(); // Run the query
    $classifications = $stmt->fetchAll(); // Store results as an array
    $stmt->closeCursor(); // Close the connection
    return $classifications;
}

/*************************
* FORM VALIDATION CHECKS *
*************************/

// USE BUILT-IN FUNCTION TO TEST FOR VALID EMAIL STRUCTURE
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// USE EXPRESSION TO CHECK FOR VALID PASSWORD STRUCTURE
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

// STRIP AND/OR REPLACE PROBLEMATIC CHARACTERS IN A FILENAME
function cleanFileName($file_name){ 
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); 
    $file_name_str = pathinfo($file_name, PATHINFO_FILENAME);   
    $file_name_str = str_replace(' ', '-', $file_name_str); // Replaces all spaces with hyphens 
    $file_name_str = preg_replace('/[^A-Za-z0-9\-\_]/', '', $file_name_str); // Removes special chars 
    $file_name_str = preg_replace('/-+/', '-', $file_name_str); // Replaces multiple hyphens with single one.
    $clean_file_name = $file_name_str.'.'.$file_ext; // Puts filename back together for return 
    return $clean_file_name; 
}

// CHECK LENGTH OF NEW CLASSIFICATION NAME
function checkLength($testWord){
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?:.{1,30})$/';
    return preg_match($pattern, $testWord);
}

/****************************
* SIGN-IN/SESSION FUNCTIONS *
****************************/

//

?>