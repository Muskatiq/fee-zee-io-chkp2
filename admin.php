<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
 <?php
  include("./includes/class-autoload.inc.php");
  require_once('./shared/header.php');
?>
<!-- Button trigger modal -->
<div class="text-center">
  <button type="button" class="my-5 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewPost">
    Pridať nový článok
  </button>
</div>

<!-- Modal -->
<div class="modal fade" id="addNewPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Pridať nový článok</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="post.process.php" method="POST">
            <div class="form-group">
                <label>Názov: </label>
                <input class="form-control" name="post-title" type="text" required>
            </div>
            <div class="form-group">
                <label>Obsah: </label>
                <textarea class="form-control" name="post-content" type="text" required></textarea>
            </div>
            <div class="form-group">
                <label>Autor: </label>
                <input class="form-control" name="post-author" type="text" required>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavrieť</button>
                <button type="submit" name="submit" class="btn btn-primary">Pridať článok</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<div class="container mb-5">
  <div class="row">
      <!-- Iterating thorugh all posts from DB-->
      <?php $posts = new Posts(); ?>
      <!-- For each loop to iterate the Posts collection, store particular post to $posts variable -->
      <?php if($posts->getPosts()) : ?>
          <?php foreach($posts->getPosts() as $post) : ?>
              <div class="col-md-6 mt-4">
                  <div class="card">
                      <div class="card-body">
                          <!-- Show the post title -->
                          <h5 class="card-title"><?php echo $post['title']; ?></h5>
                          <p class="card-text">
                              <!-- Show the post content -->
                              <?php echo $post['body']; ?>
                          </p>
                          <!-- Show the post author -->
                          <h6 class="card-subtitle text-muted mb-3">Autor: <?php echo $post['author']; ?></h6>
                          <!-- Button for editing the post. When we click the Edit button -->
                          <!-- we are redirected to edit form with the attribute of post id -->
                          <a href="editForm.php?id=<?= $post['id'] ?>" class="btn btn-warning">Upraviť</a>
                          <!-- Button for deleting the post -->
                          <a href="post.process.php?id=<?= $post['id'] ?>&send=del" class="btn btn-danger">Zmazať</a>
                      </div>
                  </div>
              </div>
          <?php endforeach; ?>
      <?php else : ?>
          <p class="mx-auto mt-5">Žiadne články na zobrazenie</p>
      <?php endif; ?>

  </div>

  <div class="text-center my-5">
    <a href="logout.php" class="btn btn-danger ml-3">Odhlásiť sa</a>
  </div>

</div>

  
  <?php 
    require_once('./shared/footer.php');
  ?>
