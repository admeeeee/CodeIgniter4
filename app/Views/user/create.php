<?php 
if($error){
    d($error);
}
?>

<form action="/user/save" method="post">
<label for="">Username</label>
<input type="text" name="username" value="<?= old('username') ?>">
<br>
<label for="">Fullname</label>
<input type="text" name="fullname" value="<?= old('fullname') ?>">
<br>
<label for="">Email</label>
<input type="text" name="email" value="<?= old('email') ?>">
<br>
<label for="">Password</label>
<input type="password" name="password"value="<?= old('password') ?>">
<br>
<label for="">Role</label>
<select name="role">
    <option value="1">Admin</option>
    <option value="2">User</option>
</select>
<br>
<button type="submit">Create</button>
</form>