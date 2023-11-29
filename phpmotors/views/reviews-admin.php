<?php

if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header ('Location: /phpmotors/');
}

// set page title and call header
    $pageTitle = "Manage User Reviews | PHP Motors Admin";
    include_once 'header.php'; ?>

<h1 id='form-title'>Manage User Reviews</h1>
<section class='form-container'>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

    <form id='filters' action="/phpmotors/reviews/index.php" method="post">
        <fieldset><legend>Filter Reviews By Author</legend>
        <div class="form-field input-right">
            <label for="clientId">Comment Authors</label>
            <?php echo $authorsList; ?>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Filter By Author">
            <input type="hidden" name="action" value="filterAuthor">
            <input type="hidden" name="clientId" value="<?php if(isset($authorsList['clientId'])){echo $authorsList['clientId'];} ?>">
        </div>
        </fieldset>

        <fieldset><legend>Filter Reviews By Vehicle</legend>
        <div class="form-field input-right">
            <label for="invId">Vehicle</label>
            <?php echo $vehiclesList; ?>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Filter By Vehicle">
            <input type="hidden" name="action" value="filterVehicle">
            <input type="hidden" name="invId"value="<?php if(isset($vehiclesList['invId'])){echo $vehiclesList['invId'];} ?>">
        </div>
        </fieldset>
    </form>

    <?php
    if(isset($_SESSION['failMessage'])) {
        $message2 = "<span class='message'>";
        $message2 .= $_SESSION['failMessage'];
        $message2 .="</span>";
        echo $message2;
    }
    ?>
    </form>

    <?php if(isset($Reviews)) {
        echo $Reviews;
    }
    ?>

</section>

<?php unset($_SESSION['message']); ?>
<?php unset($_SESSION['failMessage']); ?>
<?php include_once 'footer.php'; ?>