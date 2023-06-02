 <center>
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12">
        <?php require_once '../assets/initial/sidebar.php' ?>
      </div>  
      <div class="col-lg-2 col-md-2 col-sm-12"></div>  
      <div class="col-lg-4 col-md-4 col-sm-12 my-5 p-2">
        <form method="POST" action="blog-create.php" enctype="multipart/form-data" class="col-lg-12  row row-cols-lg-auto g-3  right-side-navigation">
          <h2>~CREATE PAGE~</h2>
          <label class="visually-hidden" for="inlineFormInputGroupUsername">Page Name</label>
          <div class="input-group">
            <div class="input-group-text">Page Name</div>
            <input type="text" name="blog_title" class="form-control" id="inlineFormInputGroupUsername" placeholder="Page Name" required>
          </div>
          <label class="visually-hidden" for="inlineFormInputGroupUsername">Post Per Page</label>
          <div class="input-group">
            <div class="input-group-text">Post Per Page</div>
            <input type="number" name="post_per_page" class="form-control" id="inlineFormInputGroupUsername" placeholder="eg: 4, 5" required>
          </div>

          <div class="input-group">
            <div class="input-group-text">Post Background</div>
            <input type="file" name="blog_background_image" class="form-control" id="inlineFormInputGroupUsername">
          </div>

          <div class="input-group">
            <div class="input-group-text">Blog Status</div>
            <select name="blog_status" class="form-select" aria-label="Default select example">
              <option selected value="Active">Active</option>
              <option value="InActive">InActive</option>
            </select>
          </div>

          <input type="submit" class="text-center mb-3 dashboard-form-btn" name="createPage" value="Create Page">
        </table>
      </form>          
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12"></div>
</div>
</center>