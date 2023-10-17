<?php include_once 'header.php'; ?>

<h1 id='form-title'>Create New Account</h1>
<section class='form-container'>

    <?php
    if(isset($message)) {
        echo $message;
    }
    ?>

    <form id="register" method="post" action="/phpmotors/accounts/index.php">
        <fieldset><legend>All Fields Are Required!</legend>
        <div class="form-field input-right">
            <label for="clientFirstname">First Name</label>
            <input name="clientFirstname" id="clientFirstname" type="text" required>
        </div>
        <div class="form-field input-right">
            <label for="clientLastname">Last Name</label>
            <input name="clientLastname" id="clientLastname" type="text" required>
        </div>
        <div class="form-field input-right">
            <label for="clientEmail">Email</label>
            <input name="clientEmail" id="clientEmail" type="email" required>
        </div>
        <div class="form-field input-right">
            <label for="clientPassword">Password</label>
            <input name="clientPassword" id="clientPassword" type="password" required>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Create Account">
            <input type="hidden" name="action" value="register"> <!-- add name/value pair for action value -->
        </div>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>