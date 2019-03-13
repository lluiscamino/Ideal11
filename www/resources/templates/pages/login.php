<?php
$this->layout('global::main', array('title' => 'Login', 'url' => 'login'));
if ($errorMessage !== '') {
    echo '<div class="alert alert-danger" role="alert">' . $this->e($errorMessage) . '</div>';
}
?>
<form method="post">
    <div class="form-group">
        <label for="emailOrNickname">Email or nickname</label>
        <input type="text" class="form-control" id="emailOrNickname" name="emailOrNickname" autofocus required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <input type="submit" class="btn btn-success" name="login" value="Login">
</form>
