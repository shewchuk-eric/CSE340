<?php

if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header ('Location: /phpmotors/');
}

// set page title and call header
if(isset($invInfo['invMake'])){ // use information on vehicle to populate the page title - no default needed because this view only displays if a vehicle has been selected
    $pageTitle = "Delete $invInfo[invMake] $invInfo[invModel]";} 
    include_once 'header.php'; ?>

<h1 id='form-title'>
    <?php 
        if(isset($invInfo['invMake'])) { // create headline using vehicle information
	        echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
    ?>
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
        <fieldset><legend>Delete This Vehicle</legend>
        <div class="form-field input-right">
            <label for="invMake">Vehicle Make</label>
            <input name="invMake" id="invMake" type="text" readonly <?php if(isset($invInfo['invMake'])){echo "value='$invInfo[invMake]'";} ?>>
        </div>
        <div class="form-field input-right">
            <label for="invModel">Vehicle Model</label>
            <input name="invModel" id="invModel" type="text" readonly <?php if(isset($invInfo['invModel'])){echo "value='$invInfo[invModel]'";} ?>>
        </div>
        <div class="form-field input-right">
            <label for="invDescription">Description</label>
            <textarea name="invDescription" id="invDescription" readonly><?php if(isset($invInfo['invDescription'])){echo "$invInfo[invDescription]";} ?></textarea>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Delete Vehicle" onclick="alert('Are you Sure? There is no undo!')">
            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){echo $invInfo['invId'];} ?>">
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>