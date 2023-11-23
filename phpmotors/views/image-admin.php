<?php 

if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header ('Location: /phpmotors/');
}

$pageTitle = "Admin - manage vehicle image uploads || PHP Motors, inc.";
    include_once 'header.php'; ?>

<h1 id='form-title'>Manage Vehicle Images</h1>
<section class='form-container'>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

<p>

    <form id='addNewClass' action="/phpmotors/uploads/index.php" method="post" enctype="multipart/form-data">
        <fieldset><legend>Add New Vehicle Image</legend>
        <div class="form-field input-right">
            <label for="invItem">Vehicle</label>
                <?php echo $prodSelect; ?>
        </div>
        </fieldset>
        <fieldset><legend>Is this the main image for the vehicle?</legend>
            <label for="priYes" class="pImage">Yes</label>
            <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
            <label for="priNo" class="pImage">No</label>
            <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	    </fieldset>
        <label>Upload Image:</label>
        <input type="file" name="file1">
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
    </form>
    <hr>
    <h2>Existing Images</h2>
        <span class="message">If deleting an image, delete the thumbnail too and vice versa.</span><br>
        <?php
        if (isset($imageDisplay)) {
            $alert = "<span class='message'>";
            $alert .= $imageDisplay;
            $alert .="</span>";
        echo $alert;
        } 
        unset($_SESSION['message']);
        unset($imageDisplay);
        ?>
</section>

<?php include_once 'footer.php'; ?> 