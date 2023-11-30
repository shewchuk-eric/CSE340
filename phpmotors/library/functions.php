<?php 

/*********************************************
* NAVIGATION AND DROP-LIST BUILDER FUNCTIONS *
*********************************************/

// BUILD NAVIGATION LIST FOR HEADER NAV
function buildList($classifications) {
    $navList = '<ul class="nav">';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .="<li><a href='/phpmotors/vehicles/?action=listCars&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
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

// BUILD CLASSIFICATIONS LIST FOR VEHICLE MANAGEMENT VIEW
function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
}


/******************************************
* LOGIN/REGISTRATION VALIDATION FUNCTIONS *
******************************************/

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


/**********************************
* MANAGE VEHICLE IMAGES FUNCTIONS *
**********************************/

// ADD '-TN' TO THUMBNAIL IMAGES WHEN UPLOADING VIA 'UPLOADS/INDEX.PHP'
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}

// BUILD DISPLAY FOR IMAGE MANAGEMENT
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
     $id .= '<li>';
     $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] on PHP Motors.com'>";
     $id .= "<p><a href='/phpmotors/uploads/index.php?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
     $id .= '</li>';
   }
    $id .= '</ul>';
    return $id;
}

// BUILDS A DROP-DOWN LIST TO SELECT VEHICLES FOR IMAGE MANAGEMENT
function buildVehiclesSelect($vehicles) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
     $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}

// UPLOADS IMAGE, GETS THE STORAGE PATH AND THEN INSERTS PATH TO DB
function uploadFile($name) {
    global $image_dir, $image_dir_path; // Gets the paths, full and local directory
    if (isset($_FILES[$name])) { // Gets the actual file name
        $filename = $_FILES[$name]['name'];
    if (empty($filename)) {
        return;
    }
    $source = $_FILES[$name]['tmp_name']; // Get the file from the temp folder on the server 
    $target = $image_dir_path . '/' . $filename; // Sets the new path - images folder in this directory
    move_uploaded_file($source, $target); // Moves the file to the target folder
    processImage($image_dir_path, $filename); // Send file for further processing
    $filepath = $image_dir . '/' . $filename; // Sets the path for the image for Database storage
    return $filepath; // Returns the path where the file is stored
    }
}

// TAKES UPLOAD IMAGE AND RESIZES ORIGINAL AND CREATES A THUMBNAIL
function processImage($dir, $filename) {
    $dir = $dir . '/'; // Set up the variables
    $image_path = $dir . $filename; // Set up the image path
    $image_path_tn = $dir.makeThumbnailName($filename); // Set up the thumbnail image path  
    resizeImage($image_path, $image_path_tn, 200, 200); // Create a thumbnail image that's a maximum of 200 pixels square 
    resizeImage($image_path, $image_path, 500, 500); // Resize original to a maximum of 500 pixels square
}

// CHECKS SIZE OF UPLOADED IMAGE AND RESIZES AS NEEDED
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
    $image_info = getimagesize($old_image_path); // Get image type
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
        break;

        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
        break;

        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
        break;

        default:
            return;
    }
   
    $old_image = $image_from_file($old_image_path); // Get the old image and its height and width
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    $width_ratio = $old_width / $max_width; // Calculate height and width ratios
    $height_ratio = $old_height / $max_height;
   
    if ($width_ratio > 1 || $height_ratio > 1) { // If image is larger than specified ratio, create the new image
        $ratio = max($width_ratio, $height_ratio); // Calculate height and width for the new image
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);
        
        $new_image = imagecreatetruecolor($new_width, $new_height); // Create the new image
   
     
        if ($image_type == IMAGETYPE_GIF) { // Set transparency according to image type
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }
        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }
        
        $new_x = 0; // Copy old image to new image - this resizes the image
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        $image_to_file($new_image, $new_image_path); // Write the new image to a new file
        imagedestroy($new_image); // Free any memory associated with the new image
        } else {
            $image_to_file($old_image, $new_image_path); // Write the old image to a new file
        }
    imagedestroy($old_image); // Free any memory associated with the old image
}


/********************************
* MANAGE USER REVIEWS FUNCTIONS *
********************************/

function buildAuthorsList($authorList) {
    $authorsList = '<select id="authors" name="authors">';
    $authorsList .= "<option>Choose an author</option>";
    foreach ($authorList as $author) {
        $authorsList .="<option value='$author[clientId]'";
        $authorsList .= ">$author[clientLastname], $author[clientFirstname]</option>";
    }
    $authorsList .="</select>";
    return $authorsList;
}

function buildReviewsDisplay($reviews) {
    $list = '<div id="reviews">';
    foreach ($reviews as $review) {
        $fname = substr($review['clientFirstname'], 0, 1);
        $postDate = substr($review['reviewDate'], 0, 9);
        $list .= "<article class='reviewText'><span>User: $fname $review[clientLastname], On: $postDate Said:</span>";
        $list .= "<p>$review[reviewText]</p></article>";
    }
    $list .= '</div>';
    return $list;
}

function buildReviewsEdit($reviews) {
    $list = '<form class="review">';
    foreach ($reviews as $review) {
        $list .= "<div class='form-field input-right'><label for='review'>$review[reviewDate]</label>";
        $list .= "<textarea name='review' id='review' required>$review[reviewText]</textarea></div>";
    }
    $list .= '</form>';
    return $list;
}
?>