<?php 

if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header ('Location: /phpmotors/');
}

$pageTitle = "Admin - create a new vehicle classification || PHP Motors, inc.";
    include_once 'header.php'; ?>

<h1 id='form-title'>Manage Vehicle Classifications</h1>
<section class='form-container'>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

    <form id='addNewClass' action="/phpmotors/vehicles/index.php" method="post">
        <fieldset><legend>Vehicle Classifications</legend>
        <div class="form-field input-right">
            <label for="classificationName">Name Of New Class</label>
            <span>Requires 1 to 30 characters</span>
            <input name="classificationName" id="classificationName" type="text" required pattern="(?=^.{1,30}$).*$">
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Add New Class">
            <input type="hidden" name="action" value="addNewClass">
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?> 