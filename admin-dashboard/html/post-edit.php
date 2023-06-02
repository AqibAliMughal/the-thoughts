<center>
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-12 my-4 mx-4">
      <?php require_once '../assets/initial/sidebar.php'; ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 my-4 mx-4 p-2">
          <form method="POST" action="post-edit.php" enctype="multipart/form-data" class="col-lg-12  row row-cols-lg-auto g-3  right-side-navigation">
            <div class="input-group">
              <div class="input-group-text">Title</div>
              <input type="text" name="post_title" class="form-control" id="inlineFormInputGroupUsername" placeholder="Title of the post" value="<?= $post[0]['post_title']?>">
            </div>

            <div class="input-group">
              <div class="input-group-text">Summary</div>
              <textarea name="post_summary" rows="6" cols="30" class="form-control" rows="10" placeholder="Summary of the post"><?= $post[0]['post_summary']?></textarea>
            </div>
            <div class="input-group">
              <div class="input-group-text">Description</div>
              <textarea name="post_description" maxlength="1000" rows="10" cols="30" class="form-control" rows="10" placeholder="Summary of the post"><?= $post[0]['post_description']?>
              </textarea>
            </div>

            <div class="input-group">
              <div class="input-group-text">Post Image</div>
              <img src="../assets/post/<?= $post[0]['featured_image']?>" alt="Post Image" width="90px">
              <input type="file" name="featured_image" class="form-control" id="">

              <div class="input-group-text mx-2">Comment</div>
              <select name="is_comment_allowed" id="" class="form-control" class="form-select" aria-label="Default select example">
            <?php 
            if ($post[0]['is_comment_allowed'] === '0'):?>
                <option value="0" selected>Not Allowed</option>
                <option value="1">Allow</option>
            <?php
            else:
            ?>
                <option value="1" selected>Allowed</option>
                <option value="0">Not Allow</option>
            <?php 
            endif;
            ?>
              </select>
            </div>

            <div class="input-group">
              <div class="input-group-text">Category</div>
              <select name="category[]" multiple id="" class="form-control" >
                <option value="">
                  <?php
                  $counter = 1;
                  foreach ($showCategoy as $key => $categories): 
                      foreach ($postCategory as $key => $value) { ?>
                      <option <?= $categories['category_title'] === $value['category_title']? "SELECTED" : ''?> 
                  <?php }?>
                      value="<?= $categories['category_id']?>"> <?= $categories['category_title']?> </option>
                <?php endforeach; 
                ?>
                </option>
              </select>
              <!-- ================================== -->
              <?php 
                ?>
              <div class="input-group-text">Select Page</div>
              <select name="page" multiple id="" class="form-control" >
                <option value="">
                  <?php
                  foreach ($showBlogs as $key => $blogs): ?>
                      <option <?= ($blogs['blog_title'] == $postBlog[0]['blog_title']) ? 'SELECTED' : '' ?>
                      value="<?= $blogs['blog_id']?>"><?= $blogs['blog_title']?></option>
                  <?php endforeach; ?>
                </option>
              </select>
            </div>

           <div class="input-group">
            <div class="input-group-text">Attachment</div>
            <input type="file" name="attachment" class="form-control" id="">
           </div>
           <input type="submit" class="text-center mb-3 btn btn-primary" name="update" value="Update">
        </form>   
    </div>          
    <div class="col-lg-2 col-md-2 col-sm-12"></div>
  </div>
</center>