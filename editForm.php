<?php
    require_once('./shared/header.php');
    include("./includes/class-autoload.inc.php");

    //create new Posts class instance
    $posts = new Posts();

    //call the editPost method. Retrieve the whole post with id from $_GET['id]
    $post = $posts->editPost($_GET['id']);
    
    //Retrieveing attributes from post stored in $post variable above
    $id = $post['id'];
    $title = $post['title'];
    $body = $post['body'];
    $author = $post['author'];
?>

<div class="text-center my-4">
        <h3>Upraviť článok</h3>
    </div>

<div class="container mb-5">
<div class="row">
        <div class="col-md-7 mx-auto">
            <!-- Form Input -->
            <!-- In PHP below, we are fetching the data from particular post and filling the inputs with them -->
            <form action="post.process.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group mb-3">
                    <label>Názov: </label>
                    <!-- Populate the input with the post title-->
                    <input class="form-control" name="post-title" type="text" value="<?php echo $title; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label>Obsah: </label>
                    <!-- Populate the input with the post content-->
                    <textarea class="form-control" name="post-content" type="text" required><?php echo $body; ?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Autor: </label>
                    <!-- Populate the input with the post author-->
                    <input class="form-control" name="post-author" type="text" value="<?php echo $author; ?>" required>
                </div>
                    <a href="index.php" type="button" class="btn btn-secondary">Zavrieť</a>
                    <button type="submit" name="update" class="btn btn-primary">Upraviť článok</button>
            </form>
        </div>
    </div>
</div>
    
    

<?php
    require_once('./shared/footer.php');
?>