<?php
    include('./includes/class-autoload.inc.php');

    $posts = new Posts();

    if(isset($_POST['submit'])) {
        $title = $_POST['post-title'];
        $content = $_POST['post-content'];
        $author = $_POST['post-author'];

        $posts->addPost($title, $content, $author);

        header("location: {$_SERVER['HTTP_REFERER']}");
    } else if(isset($_POST['update'])) {
        $id = $_GET['id'];
        $title = $_POST['post-title'];
        $content = $_POST['post-content'];
        $author = $_POST['post-author'];

        $posts->updatePost($title, $content, $author, $id);

        header("location: http://localhost/fee-zee-io/admin.php");
    } else if($_GET['send'] === 'del') {
        $id = $_GET['id'];

        $posts->deletePost($id);
        header("location: http://localhost/fee-zee-io/admin.php");
    }