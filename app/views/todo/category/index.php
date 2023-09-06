<?php
if($_SERVER['REQUEST_URI'] == '/index.php') {
header('Location: /');
exit();
}

$title = 'Todo Category';?>
<?php ob_start(); ?>

    <h1> Todo category</h1>
    <a class="btn btn-success" href="/todo/category/create" >Create category</a>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Usability
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($categories as $category) : ?>
                <tr js-role-id="<?=$category['id']?>" id="roleRow">
                    <th scope="row"><?php echo $category['id'] ?></th>
                    <td><?php echo $category['title'] ?></td>
                    <td><?php echo $category['description']?></td>
                    <td><?php echo $category['usability'] == 1 ? 'Yes' : 'No'; ?></td>
                    <td>
                        <a href='category/edit/<?php echo $category["id"]; ?>' class="btn btn-primary" >Edit</a>
                        <button class="js-deleteTodoCategory btn btn-danger" data-todo-id="<?=$category['id']?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>


<?php $content = ob_get_clean();
include './app/views/layout.php';