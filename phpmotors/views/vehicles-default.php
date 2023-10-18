<?php include_once 'header.php'; ?>

<h1 id='form-title'>Vehicle Manager</h1>
<section class='form-container'>

<?php
    if(isset($message)) {
        echo $message;
    }
    ?>

    <form id='empty' action="#" method="post">
        <fieldset><legend>Options</legend>
        <div class="form-field input-right">
            <button type="button"><a href='/phpmotors/vehicles/index.php?action=newClass' title='New Vehicle Classification'>Vehicle Classifications</a>
        </div>
        <div class="form-field input-right">
            <button type="button"><a href='/phpmotors/vehicles/index.php?action=manage' title='Add Vehicle Inventory'>Manage Vehicle Inventory</a>
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>