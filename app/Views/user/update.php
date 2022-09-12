<?php 
if($error){
    d($error);
}
d($user);
?>

<form action="/user/save/" method="post">
<input type="hidden" name="id" value="<?= $user['user_id'] ?>">
<label for="">Username</label>
<input type="text" name="username" value="<?= old2($user['username'],old('username')) ?>">
<br>
<label for="">Fullname</label>
<input type="text" name="fullname" value="<?= old('fullname')?old('fullname'):$user['fullname'] ?>">
<br>
<label for="">Email</label>
<input type="text" name="email" value="<?= old('email')?old('email'):$user['email'] ?>">
<br>
<label for="">Password</label>
<input type="password" name="password">
<br>
<label for="">Role</label>
<select name="role">
    <option value="1" <?php if($user['role']==1){echo 'selected';} ?>>Admin</option>
    <option value="2" <?php if($user['role']==2){echo 'selected';} ?>>User</option>
</select>
<br>
<button type="submit">Create</button>
</form>