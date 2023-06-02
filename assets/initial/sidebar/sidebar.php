  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
  <link rel=  "stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Bootstrap core CSS -->
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="sidebars.css" rel="stylesheet">
</head>
<body >
  <main>
    <div class="flex-shrink-0 p-3 " style="width: 245px; height: 650px">
      <div class="dropdown">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
          <h4><strong> <center><?= $_SESSION['user']['NAME']?></center> </strong></h4>
          <hr/> 
          </div>
        </div>
      </div>
      <ul class="list-unstyled ps-0">
      <ul class="list-unstyled ps-0">
         <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#page-collapse" aria-expanded="false">
            Blog
          </button>
          <div class="collapse" id="page-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="blog/create-blog.php" class="admin-navbar rounded">Create</a></li><br/>
              <hr>
              <li><a href="blog/all-blogs.php" class="admin-navbar rounded">My Page</a></li><br/>
            </ul>
          </div>
        </li>
        <br/>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
            Post
          </button>
          <div class="collapse" id="dashboard-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="post/create-post.php" class="admin-navbar rounded">Create</a></li><br/>
              <li><a href="#" class="admin-navbar rounded">Update</a></li><br/>
              <li><a href="#" class="admin-navbar rounded">Change Status</a></li><br/>
            </ul>
          </div>
        </li>
        <br/>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#manage-collapse" aria-expanded="false">
            Categories
          </button>
          <div class="collapse" id="manage-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="category/add-category.php" class="admin-navbar rounded">Add</a></li><br/>
              <li><a href="#" class="admin-navbar rounded">Edit</a></li><br/>
            </ul>
          </div>
        </li>
        <br/>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false">
            Users
          </button>
          <div class="collapse" id="user-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="#" class="admin-navbar rounded">Approval Request</a></li><br/>
              <li><a href="#" class="admin-navbar rounded">User Status</a></li><br/>
              <li><a href="../register.view.php" class="admin-navbar rounded">Add</a></li><br/>
              <li><a href="user/all-user.php" class="admin-navbar rounded">Users</a></li><br/>
            </ul>
          </div>
        </li>
        <br/>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#comment-collapse" aria-expanded="false">
            Comment
          </button>
          <div class="collapse" id="comment-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="#" class="admin-navbar rounded">Approve</a></li><br/>
              <li><a href="#" class="admin-navbar rounded">Add</a></li><br/>
              <li><a href="#" class="admin-navbar rounded">Edit</a></li><br/>
            </ul>
          </div>
        </li>
        <br/>
        <li class="mb-1">
          <button class="btn btn-toggle align-items-center rounded collapsed " data-bs-toggle="collapse" data-bs-target="#feedback-collapse" aria-expanded="false">
            Feedback
          </button>
          <div class="collapse" id="feedback-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="view-feedback/all-feedback.php" class="admin-navbar rounded">View all feeback</a></li><br/>
            </ul>
          </div>
        </li>
        <br/>
      </ul>
    </div>
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="sidebars.js"></script>
</body>
</html>
