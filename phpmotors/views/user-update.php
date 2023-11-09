<?php $pageTitle = "Update account information || PHP Motors, inc.";
    include_once 'header.php'; ?>

<h1 id='form-title'>Manage Account</h1>
<section class='form-container'>

<?php
    if(isset($_SESSION['message'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

    <form id="register" method="post" action="/phpmotors/accounts/index.php">
        <fieldset><legend>Update Account Information</legend>
        <div class="form-field input-right">
            <label for="clientFirstname">First Name</label>
            <input name="clientFirstname" id="clientFirstname" type="text" <?php if(isset($_SESSION['clientData'])){echo "value=".$_SESSION['clientData']['clientFirstname'];}?> required>
        </div>
        <div class="form-field input-right">
            <label for="clientLastname">Last Name</label>
            <input name="clientLastname" id="clientLastname" type="text" <?php if(isset($_SESSION['clientData'])){echo "value=".$_SESSION['clientData']['clientLastname'];}?> required>
        </div>
        <div class="form-field input-right">
            <label for="clientEmail">Email</label>
            <input name="clientEmail" id="clientEmail" type="email" <?php if(isset($_SESSION['clientData'])){echo "value=".$_SESSION['clientData']['clientEmail'];}?> required>
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Update Account">
            <input type="hidden" name="action" value="accountUpdate">
            <input type="hidden" name="userId" value="<?php if(isset($_SESSION['clientData'])){echo "value=".$_SESSION['clientData']['clientId'];}?>">
        </div>
        </fieldset>
    </form>

<?php
    if(isset($_SESSION['message1'])) {
        $message = "<span class='message'>";
        $message .= $_SESSION['message'];
        $message .="</span>";
        echo $message;
    }
?>

    <form id="update" method="post" action="/phpmotors/accounts/index.php">
        <fieldset><legend>Update Password</legend>
        <div class="form-field input-right">
            <label for="clientPassword">Password</label>
            <span id="password">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        </div>
        <div class="form-field submit-field">
            <input type="submit" value="Update Password">
            <input type="hidden" name="action" value="passUpdate">
            <input type="hidden" name="userId" value="<?php if(isset($_SESSION['clientData'])){$value = "value="; $value .= $_SESSION['clientData']['clientId']; echo $value;}?>">
        </div>
        </fieldset>
    </form>
</section>
<script src="../scripts/expand.js">
    <?php unset($_SESSION['message']); ?>
    <?php unset($_SESSION['message1']); ?>
<?php include_once 'footer.php'; ?>