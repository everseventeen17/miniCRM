<?php
$title = 'Pages Page';
?>
<?php ob_start(); ?>

    <h1> Pages page </h1>
    <a class="btn btn-success" href="/pages/create" >Create page</a>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Page Name</th>
                <th scope="col">Role</th>
                <th scope="col">Page Description</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($pages as $page) : ?>
                <tr js-page-id="<?=$page['id']?>" id="pageRow">
                    <th scope="row"><?php echo $page['id'] ?></th>
                    <td><?php echo $page['page_name'] ?></td>
                    <td><?php echo $page['role'] ?></td>
                    <td><?php echo $page['page_url']?></td>
                    <td>
                        <a href='/pages/edit/<?php echo $page["id"]; ?>' class="btn btn-primary" >Edit</a>
                        <button class="js-deletePage btn btn-danger" data-page-id="<?=$page['id']?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>


<?php $content = ob_get_clean();
include './app/views/layout.php';