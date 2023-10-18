<?php include_once 'header.php'; ?>

<h1 id='form-title'>Manage Vehicle Classifications</h1>
<section class='form-container'>

<?php
    if(isset($message)) {
        echo $message;
    }
    ?>

    <form id='addNewClass' action="/phpmotors/vehicles/index.php" method="post">
        <fieldset><legend>Vehicle Classifications</legend>
        <div class="form-field input-right">
            <label for="classes">Existing Classes</label>
            <?php echo $typeList; ?>
        </div>
        <div class="form-field input-right">
            <label for="addClassification">Add New Class</label>
            <input name="classificationName" id="classificationName" type="input" required>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Add New Class">
            <input type="hidden" name="action" value="addNewClass">
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>

<!-- <div class="form-field submit-field">
            <input type="submit" value="Create Account">
            <input type="hidden" name="action" value="register"> add name/value pair for action value -->