<?php 
require_once '../functions.php';
requireFIles
([
  '../Classes/Redirect', 
  '../Classes/Database', 
  '../Classes/CRUD', 
  '../Classes/HTML', 
  '../Classes/Role'
]);
$crud = new CRUD;
Database::getConnection();
Role::admin();
$html = "Update User";
require_once '../assets/initial/navbar.php';

  if( isset($_REQUEST['uid']) ):
    $user = $_REQUEST['uid'];
    $_SESSION['uid'] = $_REQUEST['uid'];
    $userInfo = $crud -> select('user', 
     ['first_name', 
     'last_name',
     'PASSWORD', 
     'gender', 
     'date_of_birth', 
     'user_image', 
     'address'], 
     ['user_id' => $_REQUEST['uid']]);

    $first_name     = $userInfo[0]['first_name'];
    $last_name      = $userInfo[0]['last_name'];
    $password       = $userInfo[0]['PASSWORD'];
    $gender         = $userInfo[0]['gender'];
    $date_of_birth  = $userInfo[0]['date_of_birth'];
    $user_image     = $userInfo[0]['user_image'];
    $address        = $userInfo[0]['address'];
  endif;
/** =================
 * UPDATING THE USER
 * ==================
*/
  if(isset($_REQUEST['update'])):
    $requestType = $_REQUEST['update'];
    // dd($_REQUEST);
    extract($_REQUEST);
    extract($_FILES);
    $randomNumber = rand(1000, 4000);
    $tmp = "updated_Image_".$randomNumber.$_FILES['user_image']['tmp_name'];
    $name = "updated_Image_".$randomNumber.$_FILES['user_image']['name'];
    $dest = 'assets/user_image';
    $user_image = $user_image['name'];

    if($user_image == "")
    {
      $crud ->update('user', 
        [
          "first_name"    => $first_name, 
          "last_name"     => $last_name,
          "password"      => $password,
          "gender"        =>  $gender,
          "date_of_birth" => $date_of_birth,
          "address"       => $address,
          "updated_at"    => update()
        ], 
        [
          'user_id', $uid
        ]);
        Redirect::to('index', ['msg' => "Updated successfully"]);
    }
    else
    {
      $crud ->update('user', 
        [
          "first_name"      => $first_name, 
          "last_name"       => $last_name,
          "password"        => $password,
          "gender"          =>  $gender,
          "date_of_birth"   => $date_of_birth,
          "user_image"      => $user_image,
          "address"         => $address
        ], 
        [
          'user_id', $uid
        ]);
    }
  endif;

/*
=====================================================
  SEND MAIL TO USER AS PER REQUEST APPROVED CHANGED |
=====================================================
*/
if( isset($_REQUEST['request']) ):
  $userIs = $crud->select('user',["CONCAT(first_name, ' ', last_name)AS NAME, email"], ['user_id' => $_REQUEST['us']]);
  $userName = $userIs[0]['NAME'];
  $userEmail = $userIs[0]['email'];
  $requestType = $_REQUEST['request'];

    if( $requestType === 'approve' )
    {
      $result = $crud -> update('user', ['is_approved' => 'Approved'], ['user_id', $_REQUEST['us']]);
      Email('sahmedrajput17@gmail.com', $userEmail, $userName, "Request Approved", 
      "<b>Congrats!!</b><br/>Dear user, your request has been accepted. Now wait for the another email for your confirmed credetnials. <br/>Thanks
      "); 
      Redirect::to('index', ['msg' => "Request Approved"]);
    }
    else if( $requestType === 'reject' )
    {
      $result = $crud -> update('user', ['is_approved' => 'Rejected'], ['user_id', $_REQUEST['us']]);
      Email('sahmedrajput17@gmail.com', $userEmail, $userName, "Request Rejected", 
      "<b>Dear valued user,</b><br/> your request has been rejected. due to some reason, contact us for more information<br/> Team: .Blogging;
      ");
      Redirect::to('index', ['msg' => "Request Rejected"]);
    }
    elseif( $requestType === 'InActive' )
    {
      $result = $crud -> update('user', ['is_active' => 'Active'], ['user_id', $_REQUEST['us']]);
      Email('sahmedrajput17@gmail.com', $userEmail, $userName, "Account Activated", 
      "<b>Greetings</b><br/>Dear valued user, your account is Activated you can login with the following credentials:<br/> <strong>Email:</strong> $userEmail<br/><strong>Password:</strong> $userPassword <br/>
      ");
      Redirect::to('index', ['msg' => "Activated"]);
    }
    else if ($requestType === 'Active')
    {
      $result = $crud -> update('user', ['is_active' => 'InActive'], ['user_id', $_REQUEST['us']]);
      Email('sahmedrajput17@gmail.com', $userEmail, $userName, "Account De-activated", 
      "<b>Dear valued user,</b><br/> your account is Deactivated due to some violance, please read our terms & conditions for more or you can contact us <u>@.blogging</u>.
      ");
      Redirect::to('users-all', ['msg' => "De-activated"]);
    }
  endif;
  if( isset($_REQUEST['uid']) ):
    require_once 'html/user-update.php';
    HTML::footer(   ); 
   endif;
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>