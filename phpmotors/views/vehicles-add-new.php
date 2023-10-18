<?php include_once 'header.php'; ?>

<h1 id='form-title'>Login To Your Account</h1>
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
            <input name="invMake" id="invMake" type="text" required>
        </div>
        <div class="form-field input-right">
            <label for="invModel">Vehicle Model</label>
            <input name="invModel" id="invModel" type="text" required>
        </div>
        <div class="form-field input-right">
            <label for="invDescription">Description</label>
            <textarea name="invDescription" id="invDescription" required>Please enter a detailed vehicle description</textarea>
        </div>
        <div class="form-field input-right">
            <label for="invImage">Vehicle Image</label>
            <input name="invImage" id="invImage" type="file">
        </div>
        <div class="form-field input-right">
            <label for="invThumbnail">Thumbnail Image</label>
            <input name="invThumbnail" id="invThumbnail" type="file">
        </div>
        <div class="form-field input-right">
            <label for="invPrice">Vehicle Price</label>
            <input name="invPrice" id="invPrice" type="number" required>
        </div>
        <div class="form-field input-right">
            <label for="invStock">Inventory Count</label>
            <input name="invStock" id="invStock" type="number" required>
        </div>
        <div class="form-field input-right">
            <label for="invColor">Vehicle Color</label>
            <input name="invColor" id="invColor" type="text" required>
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