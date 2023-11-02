<?php 

if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header ('Location: /phpmotors/');
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
            <div class="button"><a href='/phpmotors/vehicles/index.php?action=manage' title='Add Vehicle Inventory'>Manage Vehicle Inventory</a></div>
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>

<!-- class="form-field" -->