<?php
  require_once '../functions.php';
  requireFIles(['../Classes/Redirect', '../Classes/Database', '../Classes/CRUD', '../Classes/Role', '../Classes/HTML']);
  $crud = new CRUD;
  Database::getConnection();
  Role::admin();

if( isset($_REQUEST['createPage']) )
{
  extract($_REQUEST);
  extract($_FILES);
  $crud = new CRUD;

  $admin_id = ($_SESSION['user']['user_id']);
  $ImageDestination = '../assets/Blog_Background';
  $random = rand(1000, 5000);
  $blogImage = "Admin_ID[$admin_id]"."_".$random.$blog_background_image['name'];
  $temp      = $blog_background_image['tmp_name'];

  $blogDetails = 
  [
    "user_id"               => $admin_id,
    "blog_title"            => $blog_title, 
    "post_per_page"         => $post_per_page, 
    "blog_background_image" => $blogImage, 
    "blog_status"           => $blog_status
  ];

  $isInserted = $crud -> insert('blog', $blogDetails);
  $moved = move_uploaded_file($temp, "$ImageDestination/$blogImage");
  Redirect::to('index', ['msg'=>'Your Page is Created']);
}

  if( isset($_SESSION['user']) )
{
  $title = 'Create Blog';
  $name = $_SESSION['user']['NAME'];
  require_once '../assets/initial/navbar.php';
  require_once 'html/blog-create.php';
  HTML::footer();
  // require_once '../partials/footer.php';
}
else
{
  Redirect::to('../login', ['msg' => 'Login first to continue.']);
} ?>