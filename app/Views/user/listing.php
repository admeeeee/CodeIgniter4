<?php //d($users) ?>
<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Username</th>
        <th>Fullname</th>
        <th>role</th>
        <th>Action</th>
    </tr>
    </thead>
    <?php foreach ($users as $u){ ?>
        <tbody>
        <tr>
            <td></td>
            <td><?= $u['username'] ?></td>
            <td><?= $u['fullname'] ?></td>
            <td><?= $u['role_desc'] ?></td>
            <td>
                <a href="/user/update/<?= $u['user_id'] ?>">Update</a>
                <a href="/user/delete/<?= $u['user_id'] ?>">Delete</a>
            </td>
        </tr>
        </tbody>
    <?php } ?>

</table>

