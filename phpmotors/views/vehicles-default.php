<?php 

if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header ('Location: /phpmotors/');
    exit;
}
if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

$pageTitle = "Admin - vehicle management landing page || PHP Motors, inc.";
    include_once 'header.php'; 
?>

<h1 id='form-title'>Vehicle Manager</h1>
<section class='form-container'>
    <form>
        <fieldset><legend>Options</legend>
        <div>
            <div class="button"><a href='/phpmotors/vehicles/index.php?action=newClass' title='New Vehicle Classification'>Vehicle Classifications</a></div>
        </div>
        <div>
            <div class="button"><a href='/phpmotors/vehicles/index.php?action=manage' title='Add Vehicle Inventory'>Add New Vehicle</a></div>
        </div>
        </fieldset>
    </form>

    <h2>Vehicles By Classification</h2>
    <form>
        <fieldset><legend>Choose a classification to see those vehicles</legend>
    <?php
        if (isset($message)) { 
        echo $message; 
        } 
        if (isset($classificationList)) { 
        echo $classificationList; 
        }
    ?>
    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="inventoryDisplay"></table> <!-- uses JavaScript to provide content -->
        </fieldset>
    </form>

</section>
<script src="../scripts/inventory.js"></script>
<?php unset($_SESSION['message']); ?>
<?php include_once 'footer.php'; ?>

<!-- class="form-field" -->