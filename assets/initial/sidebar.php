    <!-- 
    =====================================
    |             SIDE BAR              |
    =====================================
   -->
        <!-- LEFT SIDE BAR -->
        <center class="left-side-navigation admin-page-status">
          <img class="my-3" src="../assets/user_image/<?= $image?>" alt="Profile Picture" style="width:100px; height: 100px; border-radius: 50%;">
          <table align="center">
            <tr>
              <td>
                <main>
                  <div class="flex-shrink-0 p-3 " style="width: 245px; height: 700px">
                      <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-7 col-md-7 col-sm-12">
                          <h4><strong> <center><?= $_SESSION['user']['NAME']?></center> </strong></h4>
                          <hr/> 
                        </div>
                        <div class="col-lg-2"></div>
                      </div>
                    <?php  
                      if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] === '1')
                      {
                      ?>
                      <ul class="list-unstyled ps-0">
                        <ul class="list-unstyled ps-0">
                         <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#page-collapse" aria-expanded="false">
                            Blog
                          </button>
                          <div class="collapse" id="page-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <li><a href="blog-create.php" class="admin-navbar rounded">Create</a></li><br/>

                              <li>
                                  <strong style="font-size: 16px;">My Page</strong>
                              <li>
                                <br/>
                                  <?php 
                                    $userBlog = $userBlog = $crud->select('blog', ['blog_id', 'blog_title', 'blog_status'], ['user_id' => $userID]);
                                    if($userBlog !== '')
                                    {
                                    foreach ($userBlog as $key => $blog) { ?>
                                    <li>
                                    <a href="blogs.php?bid=<?=$blog['blog_id']?>" class="admin-navbar rounded">
                                      <?= $blog['blog_title']?>
                                    </a>
                                    </li>
                                    <br/>
                                    <?php }
                                    }
                                    else
                                    {
                                      echo "Page not created.";
                                    }
                                  ?>
                              </li>
                            </ul>
                          </div>
                        </li>
                        <hr>  
                        <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            Post
                          </button>
                          <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <li><a href="post-create.php" class="admin-navbar rounded">Create</a></li><br/>
                              <li><a href="posts.php" class="admin-navbar rounded">View </a></li><br/>
                              <!-- <li><a href="post-update.php" class="admin-navbar rounded">Update</a></li><br/> -->
                            </ul>
                          </div>
                        </li>
                        <hr>
                        <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#manage-collapse" aria-expanded="false">
                            Categories
                          </button>
                          <div class="collapse" id="manage-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <li><a href="category-add.php" class="admin-navbar rounded">Add</a></li><br/>
                              <li><a href="category-add.php" class="admin-navbar rounded">Edit</a></li><br/>
                            </ul>
                          </div>
                        </li>
                        <hr>
                        <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false">
                            Users
                          </button>
                          <div class="collapse" id="user-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <!-- <li><a href="#" class="admin-navbar rounded">User Status</a></li><br/> -->
                              <li><a href="../register.view.php" class="admin-navbar rounded">Add</a></li><br/>
                              <li><a href="users-active.php" class="admin-navbar rounded">Active Users</a></li><br/>
                              <li><a href="users-all.php" class="admin-navbar rounded">All Users</a></li><br/>
                            </ul>
                          </div>
                        </li>
                        <hr>
                        <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#comment-collapse" aria-expanded="false">
                            Comment
                          </button>
                          <div class="collapse" id="comment-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <li><a href="comment.php" class="admin-navbar rounded">Approve</a></li><br/>
                              <li><a href="comment.php" class="admin-navbar rounded">Add</a></li><br/>
                              <li><a href="comment.php" class="admin-navbar rounded">Edit</a></li><br/>
                            </ul>
                          </div>
                        </li>
                        <hr>
                        <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#setting-collapse" aria-expanded="false">
                            Settings
                          </button>
                          <div class="collapse" id="setting-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <li><a href="setting.php" class="admin-navbar rounded">Add</a></li><br/>
                              <li><a href="setting.php?s=" class="admin-navbar rounded">Update</a></li><br/>
                            </ul>
                          </div>
                        </li>
                        <hr>
                        <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed " data-bs-toggle="collapse" data-bs-target="#feedback-collapse" aria-expanded="false">
                            Feedback
                          </button>
                          <div class="collapse" id="feedback-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <li><a href="feedback.php" class="admin-navbar rounded">Feedback</a></li><br/>
                            </ul>
                          </div>
                        </li>
                        <br/>
                      </ul>
                      <?php
                    }
                    else
                    {?>
                      <ul class="list-unstyled ps-0">
                         <li class="mb-1">
                          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#page-collapse" aria-expanded="false">
                            Blogs
                          </button>
                          <div class="collapse" id="page-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                              <li>
                                <?php 
                                foreach ($activePages as $key => $page): ?>
                                    <span>
                                      <a href="index.php?q=<?= $page['blog_id']?>" class="admin-navbar rounded">
                                      <?= $page['blog_title']; 
                                      $postPerBlog = $crud->select('post', ['COUNT(post_id) AS totalPost'], ['blog_id' =>$page['blog_id'] ]);
                                      ?>
                                      </a> 
                                      <b>[Posts: <?= $postPerBlog[0]['totalPost']?>]</b>
                                      <!-- <span></span> -->
                                    </span>
                                    <br><br>
                                  <?php
                                endforeach;
                                  ?>
                              </li>
                              <br/>
                              <li>
                                  <strong style="font-size: 16px;">Followed</strong>
                              <li>
                                <br/>
                                  <?php
                                    if( !empty($followedBlogs) )
                                    {
                                      foreach ($followedBlogs as $key => $blog): ?>

                                      <a href="index.php?q=<?= $blog['blog_id']?>" class="admin-navbar rounded">
                                      <?= $blog['blogTitle']; 
                                      endforeach;
                                    }
                                    else
                                    {
                                      echo "No Blog Following";
                                    }
                                  ?>
                              </li>
                            </ul>
                          </div>
                        </li>
                        <hr>
                        <li class="mb-1">
                          <li><a href="index.php?q==" class="admin-navbar rounded">Edit Profile</a></li><br/>
                        </li>
                        </li>
                        <hr>
                        </ul> 
                        <?php
                    }
                    ?>
                  </div>
                  <!-- <script src="bootstrap/js/bootstrap.bundle.min.js"></script> -->
                  <!-- <script src="siderbar/sidebars.js"></script> -->
              </td>
            </tr>
          </table>
        </center>
      <!-- </div> -->