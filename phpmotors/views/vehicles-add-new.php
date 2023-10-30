<?php
// get list of vehicle classifications for dropdown list
$classList = getClassList(); 
$typeList = '<select id="classes" name="classes">';
foreach ($classList as $class) {
    $typeList .="<option value='$class[classificationId]'";
    if (isset($classificationId)) { // tests to see if a value is already set and makes it 'selected' if so - form value stickiness
        if ($class['classificationId'] == $classificationId) {
            $typeList .= ' selected ';
        }
    }
    $typeList .= ">$class[classificationName]</option>";
}
$typeList .="</select>";

// set page title and call header
$pageTitle = "Admin - manage vehicle inventory || PHP Motors, inc.";
    include_once 'header.php'; ?>

<h1 id='form-title'>Manage Vehicle Inventory</h1>
<section class='form-container'>

<?php
    if(isset($message)) {
        echo $message;
    }
    ?>

    <form id='addNew' action="/phpmotors/vehicles/index.php" method="post">
        <fieldset><legend>Inventory Management</legend>
        <div class="form-field input-right">
            <label for="invMake">Vehicle Make</label>
            <input name="invMake" id="invMake" type="text" <?php if (isset($invMake)) { echo "value='$invMake'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invModel">Vehicle Model</label>
            <input name="invModel" id="invModel" type="text" <?php if (isset($invModel)) { echo "value='$invModel'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invDescription">Description</label>
            <textarea name="invDescription" id="invDescription" required placeholder="Please enter a detailed vehicle description"><?php if (isset($invDescription)) {echo $invDescription;} ?></textarea>
        </div>
        <div class="form-field input-right">
            <label for="invImage">Vehicle Image</label>
            <input name="invImage" id="invImage" type="file" <?php if (isset($invImage)) {echo $invImage;} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invThumbnail">Thumbnail Image</label>
            <input name="invThumbnail" id="invThumbnail" type="file" <?php if (isset($invThumbnail)) {echo $invThumbnail;} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invPrice">Vehicle Price</label>
            <input name="invPrice" id="invPrice" type="number" <?php if (isset($invPrice)) { echo "value='$invPrice'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invStock">Inventory Count</label>
            <input name="invStock" id="invStock" type="number" <?php if (isset($invStock)) { echo "value='$invStock'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="invColor">Vehicle Color</label>
            <input name="invColor" id="invColor" type="text" <?php if (isset($invColor)) { echo "value='$invColor'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="classes">Existing Classes</label>
            <?php echo $typeList; ?>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Add Vehicle(s) To Inventory">
            <input type="hidden" name="action" value="newVehicle">
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>