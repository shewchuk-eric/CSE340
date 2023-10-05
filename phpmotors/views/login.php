<?php include_once 'header.php'; ?>

<h1 id='form-title'>Login To Your Account</h1>
<section class='form-container'>
    <form id='login'>
        <fieldset><legend>Returning Users</legend>
        <div class="form-field input-right">
            <label for="clientEmail">Email</label>
            <input name="clientEmail" id="clientEmail" type="email" required>
        </div>
        <div class="form-field input-right">
            <label for="clientPassword">Password</label>
            <input name="clientPassword" id="clientPassword" type="password" required>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Login Now">
        </div>
        <p>No Account? <a href='/phpmotors/accounts/index.php?action=register' title='New User Registration'>Create One</a></p>
        </fieldset>
    </form>
</section>

<?php include_once 'footer.php'; ?>