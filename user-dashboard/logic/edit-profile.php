<?php 
ob_start();
$html = "Edit Profile";
require_once '../assets/initial/navbar.php';
  if( isset($_SESSION['user']) )
  {
    $user = $_SESSION['user'];
    $userInfo = $crud -> select('user', 
     ['first_name', 
     'last_name',
     'PASSWORD', 
     'gender', 
     'date_of_birth', 
     'user_image', 
     'address'], 
     ['user_id' => $user['user_id'] ]);

    $first_name     = $userInfo[0]['first_name'];
    $last_name      = $userInfo[0]['last_name'];
    $password       = $userInfo[0]['PASSWORD'];
    $gender         = $userInfo[0]['gender'];
    $date_of_birth  = $userInfo[0]['date_of_birth'];
    $user_image     = $userInfo[0]['user_image'];
    $address        = $userInfo[0]['address'];
  }

  if(isset($_REQUEST['update']))
  {  
    extract($_FILES);
    $randomNumber = rand(1000, 4000);
    $tmp  = $_FILES['user_image']['tmp_name'];
    $name = "updated_Image_".$randomNumber.$_FILES['user_image']['name'];
    $destination = '../assets/user_image';
    $user_image = $user_image['name'];
    move_uploaded_file($tmp, $destination."/$name");
    if($user_image == "")
    {
      $crud ->update('user', 
        [
          "first_name"    => $_REQUEST['first_name'], 
          "last_name"     => $_REQUEST['last_name'],
          "password"      => $_REQUEST['password'],
          "gender"        => $_REQUEST['gender'],
          "date_of_birth" => $_REQUEST['date_of_birth'],
          "address"       => $_REQUEST['address'],
          "updated_at"    => update()
        ], 
        [
          'user_id', $user['user_id']
        ]);
    }
    else
    {
      $crud ->update('user', 
        [
          "first_name"      => $_REQUEST['first_name'], 
          "last_name"       => $_REQUEST['last_name'],
          "password"        => $_REQUEST['password'],
          "gender"          => $_REQUEST['gender'],
          "date_of_birth"   => $_REQUEST['date_of_birth'],
          "user_image"      => $name,
          "address"         => $address
        ], 
        [
          'user_id', $user['user_id']
        ]);
    }
    $isUser = $crud->select(
                        'user', 
                        [
                          "user_id", 
                          "role_id", 
                          "CONCAT(first_name,' ' ,last_name) NAME", 
                          "email", 
                          "PASSWORD", 
                          'is_active', 
                          'is_approved'
                        ], 
                        [
                          'user_id' => $_SESSION['user']['user_id']
                        ]);

    $_SESSION['user'] = $isUser[0];
    var_dump($_SESSION['user']);
    Redirect::to("index", ['q'=>'']);
    }
    require_once 'html/edit-profile.php';
    HTML::footer();
  ?>