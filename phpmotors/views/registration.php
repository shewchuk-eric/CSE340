<?php $pageTitle = "Register for a new account || PHP Motors, inc.";
    include_once 'header.php'; ?>

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
            <input name="clientFirstname" id="clientFirstname" type="text" <?php if (isset($clientFirstname)) { echo "value='$clientFirstname'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="clientLastname">Last Name</label>
            <input name="clientLastname" id="clientLastname" type="text" <?php if (isset($clientLastname)) { echo "value='$clientLastname'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="clientEmail">Email</label>
            <input name="clientEmail" id="clientEmail" type="email" <?php if (isset($clientEmail)) { echo "value='$clientEmail'";} ?> required>
        </div>
        <div class="form-field input-right">
            <label for="clientPassword">Password</label>
            <span id="password">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Create Account">
            <input type="hidden" name="action" value="register"> <!-- add name/value pair for action value -->
        </div>
        </fieldset>
    </form>
</section>
<script src="../scripts/expand.js">
<?php include_once 'footer.php'; ?>