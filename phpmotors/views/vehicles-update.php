<?php

if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header ('Location: /phpmotors/');
}

// get list of vehicle classifications for dropdown list
$classList = getClassList(); 
$typeList = '<select id="classes" name="classes">';
$typeList .= "<option>Choose a classification</option>";
foreach ($classList as $class) {
    $typeList .="<option value='$class[classificationId]'";
    if (isset($classificationId)) { // tests to see if a value is already set and makes it 'selected' if so - form value stickiness
        if ($class['classificationId'] == $classificationId) {
            $typeList .= ' selected ';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if($class['classificationId'] == $invInfo['classificationId']) {
            $typeList .= ' selected ';
        }
    }
    $typeList .= ">$class[classificationName]</option>";
}
$typeList .="</select>";

// set page title and call header
if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ // use information on vehicle to populate the page title - no default needed because this view only displays if a vehicle has been selected
    $pageTitle = "Modify $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) { 
    $pageTitle = "Modify $invMake $invModel";}
    include_once 'header.php'; ?>

<h1 id='form-title'>
    <?php 
        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])) { // create headline using vehicle information
	        echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif(isset($invMake) && isset($invModel)) { 
	        echo "Modify$invMake $invModel";
    }?>
</h1>
<section class='form-container'>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

    <form id='addNew' action="/phpmotors/vehicles/index.php" method="post">
        <fieldset><legend>Update Vehicle Information</legend>
        <div class="form-field input-right">
            <label for="invMake">Vehicle Make</label>
            <input name="invMake" id="invMake" type="text" <?php if(isset($invMake)){echo "value='$invMake'";}elseif(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invModel">Vehicle Model</label>
            <input name="invModel" id="invModel" type="text" <?php if(isset($invModel)){echo "value='$invModel'";}elseif(isset($invInfo['invModel'])){echo "value='$invInfo[invModel]'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invDescription">Description</label>
            <textarea name="invDescription" id="invDescription" required placeholder="Please enter a detailed vehicle description"><?php if(isset($invDescription)){echo $invDescription;}elseif(isset($invInfo['invDescription'])){echo "$invInfo[invDescription]";} ?></textarea>
        </div>
        <div class="form-field input-right">
            <label for="invImage">Vehicle Image</label>
            <input name="invImage" id="invImage" type="file" <?php if(isset($invImage)){echo $invImage;}elseif(isset($invInfo['invImage'])){echo "value='$invInfo[invImage]'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invThumbnail">Thumbnail Image</label>
            <input name="invThumbnail" id="invThumbnail" type="file" <?php if(isset($invThumbnail)){echo $invThumbnail;}elseif(isset($invInfo['invThumbnail'])){echo "value='$invInfo[invThumbnail]'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invPrice">Vehicle Price</label>
            <input name="invPrice" id="invPrice" type="number" <?php if(isset($invPrice)){echo "value='$invPrice'";}elseif(isset($invInfo['invPrice'])){echo "value='$invInfo[invPrice]'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invStock">Inventory Count</label>
            <input name="invStock" id="invStock" type="number" <?php if(isset($invStock)){echo "value='$invStock'";}elseif(isset($invInfo['invStock'])){echo "value='$invInfo[invStock]'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invColor">Vehicle Color</label>
            <input name="invColor" id="invColor" type="text" <?php if(isset($invColor)){echo "value='$invColor'";}elseif(isset($invInfo['invColor'])){echo "value='$invInfo[invColor]'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="classes">Existing Classes</label>
            <?php echo $typeList; ?>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Update Vehicle">
            <input type="hidden" name="action" value="updateVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];}elseif(isset($invId)){echo $invId;} ?>">
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>