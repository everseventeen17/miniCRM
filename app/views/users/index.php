<?php

$title = 'User list';?>
<?php ob_start(); ?>

<h1> User list </h1>
<a class="btn btn-success" href="index.php?page=users&action=create" >Create user</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Email</th>
        <th scope="col">Email verification</th>
        <th scope="col">Is admin</th>
        <th scope="col">Role</th>
        <th scope="col">Is active</th>
        <th scope="col">Last login</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user) : ?>
        <tr js-User-id="<?=$user['id']?>" id="userRow">
            <th scope="row"><?php echo $user['id'] ?></th>
            <td><?php echo $user['username'] ?></td>
            <td><?php echo $user['email']?></td>
            <td><?php echo $user['email_verification'] ? 'Yes' : 'No'?></td>
            <td><?php echo $user['is_admin'] ? 'Yes' : 'No'?></td>
            <td><?php echo $user['role'] ?></td>
            <td><?php echo $user['is_active'] ? 'Yes' : 'No' ?></td>
            <td><?php echo $user['last_login'] ?></td>
            <td>
                <a href='index.php?page=users&action=edit&id=<?php echo $user["id"]; ?>' class="btn btn-primary" >Edit</a>
                <a href='index.php?page=users&action=delete&id=<?php echo $user["id"]; ?>' class="js-deleteUser btn btn-danger" data-user-id="<?=$user['id']?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<?php $content = ob_get_clean();
include './app/views/layout.php';