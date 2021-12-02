<?php
  include("./includes/class-autoload.inc.php");
  require_once('./shared/header.php');
?>
<!-- Button trigger modal -->
<div class="text-center my-5">
  <h1>Najnovšie články</h1>
</div>

<div class="container mb-5">
  <div class="row">
      <!-- create new Posts instance -->
      <?php $posts = new Posts(); ?>

      <!-- READ THE POSTS FROM DATABASE -->

      <!-- Start of if condition -->
      <!-- create new Posts instance, then checking if there are some posts in DB -->
      <?php if($posts->getPosts()) : ?>
          <!-- If yes, run for each cycle and iterate through each post -->
          <?php foreach($posts->getPosts() as $post) : ?>
              <div class="col-md-6 mt-4">
                  <div class="card">
                      <div class="card-body">
                          <!-- Put the post title -->
                          <h5 class="card-title"><?php echo $post['title']; ?></h5>
                          <!-- Put the post content -->
                          <p class="card-text">
                              <?php echo $post['body']; ?>
                          </p>
                          <!-- Put the post author -->
                          <h6 class="card-subtitle text-muted mb-3">Autor: <?php echo $post['author']; ?></h6>
                      </div>
                  </div>
              </div>
          <?php endforeach; ?>
      <?php else : ?>
          <p class="mx-auto mt-5">Žiadne články na zobrazenie</p>
      <?php endif; ?>

  </div>
</div>

  
  <?php 
    require_once('./shared/footer.php');
  ?>