<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title : ".Blogger | Tech & Freelancing Updates" ?> </title>
  <link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="stylesheet" type="text/css" href="admin.css">
  <!-- CSS/JS -> CDN LINKS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <link rel=  "stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script defer src="../bootstrap/js/bootstrap.bundle.min.js"> </script>
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
    .nav-text
    {
      color: white;
      font-size: 18px;
      font-weight: 700;
    }
  </style>
</head>
<body>
  <!-- 
    =====================================
    |          NAVIGATION BAR           |
    =====================================
  -->
  <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-brand nav-text" href="../">.Blogger</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link nav-text" aria-current="page" href="../index.php" style="color: white;">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-text" aria-current="page" 
            href="<?= ($_SESSION['user']['role_id'] === '1') ? "index.php" : "index.php?q=" ?>">Dashboard</a>
          </li>
          <?php 
          if(isset($_SESSION['user']))
          {
            global $crud;
            $role = $_SESSION['user']['role_id'];
            $userRole = $crud -> select('user', ['role_id'], ['role_id' => $role]);
            if ( !($userRole[0]['role_id'] === '1') )
              {?>
                <li class="nav-item dropdown mt-2">
                  <a class="nav-text dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                  </a>

                <ul class="dropdown-menu">
                <?php 
                  foreach ($categories as $key => $value):  ?>
                  <li><a class="dropdown-item" href="../index.php?id=<?= $value['category_id']?>"><?= $value['category_title']?></a></li>
                <?php
                endforeach;
                ?>
                </ul>

                </li>
              <li class="nav-item">
                <a class="nav-link nav-text" aria-current="page" href="<?= isset($contactURL)? $contactURL : '../contact.php'?>">Contact Us</a>
              </li>
            <?php }
          }
          ?>
        </ul>
        <form class="d-flex">
         <div class="dropdown">
          <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <?php 
            $userID = ($_SESSION['user']['user_id']);
            $userImage = $crud->select('user', ['user_image'], ['user_id' => $userID]);
            $image = $userImage[0]['user_image'];
            ?>
            <img src="../assets/user_image/<?= $image?>" alt="Profile Picture" width="32" height="32" class="rounded-circle me-2">
            <strong class="nav-text">Welcome, <?=$_SESSION['user']['NAME'] ?></strong>
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
          </ul>
        </div>
      </form>
    </div>
  </div>
</nav>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="sidebar/sidebars.js"></script>