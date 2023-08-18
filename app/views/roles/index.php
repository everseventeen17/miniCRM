<?php
if($_SERVER['REQUEST_URI'] == '/index.php') {
header('Location: /');
exit();
}

$title = 'Roles Page';?>
<?php ob_start(); ?>

    <h1> Roles page </h1>
    <a class="btn btn-success" href="index.php?page=roles&action=create" >Create role</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Role Name</th>
            <th scope="col">Role Description</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($roles as $role) : ?>
            <tr js-role-id="<?=$role['id']?>" id="roleRow">
                <th scope="row"><?php echo $role['id'] ?></th>
                <td><?php echo $role['role_name'] ?></td>
                <td><?php echo $role['role_description']?></td>
                <td>
                    <a href='index.php?page=roles&action=edit&id=<?php echo $role["id"]; ?>' class="btn btn-primary" >Edit</a>
                    <a href='index.php?page=roles&action=delete&id=<?php echo $role["id"]; ?>' class="js-deleteRole btn btn-danger" data-role-id="<?=$role['id']?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>

<?php $content = ob_get_clean();
include './app/views/layout.php';