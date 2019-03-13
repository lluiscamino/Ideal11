<?php
$this->layout('global::main', array('title' => 'Register', 'url' => 'register'));
if ($errorMessage !== '') {
    echo '<div class="alert alert-danger" role="alert">' . $this->e($errorMessage) . '</div>';
}
?>
<form method="post" id="register-form" novalidate>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="yourname@email.com" autofocus required>
        <div class="invalid-feedback" id="email-feedback">Please choose a valid email.</div>
    </div>
    <div class="form-group" id="form-remove-margin">
        <label for="password">Choose a password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <meter max="4" id="password-strength-meter"></meter>
    </div>
    <div class="form-group">
        <label for="passwordAgain">Enter your password again</label>
        <input type="password" class="form-control" id="passwordAgain" name="passwordAgain" required>
        <div class="invalid-feedback" id="password-feedback">Password cannot be empty.</div>
    </div>
    <div class="form-group">
        <label for="nickname">Choose a nickname</label>
        <input type="text" class="form-control" id="nickname" name="nickname" placeholder="yourname" maxlength="20" required>
        <div class="invalid-feedback" id="nickname-feedback">Please choose a nickname.</div>
    </div>
    <input type="submit" class="btn btn-success" name="register" value="Register">
</form>