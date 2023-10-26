<?php $pageTitle = "Sign in to your account || PHP Motors, inc.";
    include_once 'header.php'; ?>

<h1 id='form-title'>Login To Your Account</h1>
<section class='form-container'>

<?php
    if(isset($message)) {
        echo $message;
    }
    ?>

    <form id='login' action="/phpmotors/accounts/index.php" method="post">
        <fieldset><legend>Returning Users</legend>
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
            <input type="submit" value="Login Now">
            <input type="hidden" name="action" value="loginNow">
        </div>
        <p>No Account? <a href='/phpmotors/accounts/index.php?action=registration' title='New User Registration'>Create One</a></p>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>