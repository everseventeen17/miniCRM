<?php

$title = 'User list';?>
<?php ob_start(); ?>

<h1> User list </h1>
<a class="btn" href="index.php?page=users&action=create" >Create user</a>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Login</th>
        <th scope="col">Admin</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user) : ?>
        <tr js-User-id="<?=$user['id']?>" id="userRow">
            <th scope="row"><?php echo $user['id'] ?></th>
            <td><?php echo $user['login'] ?></td>
            <td><?php echo $user['is_admin'] ? 'Yes' : 'No' ?></td>
            <td><?php echo $user['created_at'] ?></td>
            <td>
                <a href='index.php?page=users&action=edit&id=<?php echo $user["id"]; ?>'>Edit</a>
                <a href='index.php?page=users&action=delete&id=<?php echo $user["id"]; ?>' class="js-deleteUser" data-user-id="<?=$user['id']?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<?php $content = ob_get_clean();
include './app/views/layout.php';