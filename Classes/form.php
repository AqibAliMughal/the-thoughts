<?php 
class form
{
  public static function register()
  {
    ?>
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
        <h2 class="text-center my-3">REGISTRATION FORM </h2>
        <span id="invalid_entries"></span>
          <form class="register-form" action="register.view.php" method="POST" onsubmit="return validation()" enctype="multipart/form-data">
            <?php
            if ( isset($_REQUEST['invalidCredentials']) )
            { 
            }
            ?>
            <div class="row mb-2 ">
              <!-- FIRST NAME && LAST Name -->
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="first_name">First Name</label>
                  <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" 
                  value="<?= isset($_SESSION['f_name']) ? $_SESSION['f_name'] :''; unset($_SESSION['f_name'])?>"/>
                  <span id="first_name_msg"><?= isset($_SESSION['first_name'])? $_SESSION['first_name'] : ''; unset($_SESSION['first_name'])?></span>
                </div>
              </div>
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="last_name">Last name</label>
                  <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" 
                  value="<?= isset($_SESSION['l_name']) ? $_SESSION['l_name'] :''; unset($_SESSION['l_name'])?>"/>
                  <span id="last_name_msg"><?= isset($_SESSION['last_name'])? $_SESSION['last_name'] : ''; unset($_SESSION['last_name'])?></span>
                </div>
              </div>
            </div>
            <!-- Email and Confirm Email -->
            <div class="row mb-2 ">
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Your Email Here" 
                  value="<?= isset($_SESSION['email'])? $_SESSION['email'] : ''; unset($_SESSION['email'])?>"/>
                  <span id="email_msg"><?= isset($_SESSION['isEmail'])? $_SESSION['isEmail'] : ''; unset($_SESSION['isEmail']); ?></span>

                </div>
              </div>
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="confirm_email">Confirm Email</label>
                  <input type="email" id="confirm_email" name="confirm_email" class="form-control" placeholder="Confirm Email" 
                  value="<?= isset($_SESSION['confirmEmail'])? $_SESSION['confirmEmail'] : ''; unset($_SESSION['confirmEmail'])?>"/>
                  <span id="confirm_email_msg"><?= isset($_SESSION['confirm_email'])? $_SESSION['confirm_email'] : ''; unset($_SESSION['confirm_email'])?></span>
                </div>
              </div>
            </div>
            <!-- Password and Confirm Password -->
            <div class="row mb-2 ">
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Your Password Here"/>
                  <span id="password_msg"><?= isset($_SESSION['password'])? $_SESSION['password'] : ''; unset($_SESSION['password'])?></span>

                </div>
              </div>
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="confirm_password">Confirm Password</label>
                  <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" />
                  <span id="confirm_password_msg"><?= isset($_SESSION['confirm_password'])? $_SESSION['confirm_password'] : ''; unset($_SESSION['confirm_password'])?></span>
                </div>
              </div>
            </div>
            <!--  Gender / DOB -->
            <div class="row mb-2">
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="">Gender</label>
                  <select name="gender" id="gender" class="form-select" aria-label="Default select example">
                    <option selected value="">--Select Gender--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
                <span id="gender_msg"></span>
              </div>
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="dob">Date of Birth</label>
                  <input type="date" name= "date_of_birth" id="dob" class="form-control"/>
                </div>
                <span id="date_of_birth_msg"></span>
              </div>
            </div>
            <!--  Image / DOB -->
            <div class="row mb-2">
              <div class="col">
                <div class="form-outline">
                  <label class="form-label" for="form3Example1">Profile Picture</label>
                  <br/><input type="file" name="user_image" id="user_image">
                </div>
                <span id="user_image_msg"><?= isset($_SESSION['user_image'])? $_SESSION['user_image'] : ''; unset($_SESSION['user_image']); ?></span>
              </div>
            </div>
            <div class="form-outline mb-2">
              <label class="form-label" for="address">Address</label>
              <textarea name="address" id="address"  class="form-control" placeholder="Your Address Here.."></textarea>
              <span id="address_msg"></span>
            </div>
            <center>
              <input type="submit" name="signup" class="btn mb-2 btn-block sign-up-btn" value="Sign up">
            </center>
          </form>
        </div>
      <div class="col-3"></div>
    </div>
  <?php 

  }
  public static function login()
  {
    ?>
    <center>
    <form action="" method="POST" class="mb-5">
      <table class="mt-4">
        <td colspan="2">
          <tr>
            <span class="login-msg">  
              <?=  isset($_REQUEST['login-msg'])? $_REQUEST['login-msg'] : ''; ?>
              <br/>
            <?=isset($_SESSION['login-msg']) ? $_SESSION['login-msg'] : ""?>
            </span>
          </tr>
        </td>
        <tr class="my-5">
          <th>Email: </th>
          <td>
            <input class="form-control" type="email" name="email" id="" placeholder="Email Here...">
          </td>
        </tr>
        <tr>
          <th>Password: </th>
          <td>
            <input class="form-control" type="password" name="password" id="" placeholder="Password Here...">
          </td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2">
            <a href="javascript:void(0)" class="form-links" data-bs-toggle="modal" data-bs-target="#forget-form">Forget Password?</a> 
          </td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2">
            <input type="submit" class="btn mb-3 btn-block login-up-btn" name="login" value="Login">
          </td>
        </tr>   
      </table>
    </form>
    <?php 
    if(isset($_REQUEST['register']))
    { ?>
      <a href="pdf.php">Download PDF Credentials</a>
  <?php 
    }
    ?>
  </center>
    <?php 
  }
  public static function contact()
  {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel=  "stylesheet" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php require_once 'partials/navbar.php' ?>
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4 my-4 mt-5 form">
        <h2 class="text-center my-1"><span class="">CONTACT FORM</span> </h2>
        <span><hr style="width: 125px; margin-left: 140px;"/></span>

        <form class="" action="contact.php" method="POST" enctype="multipart/form-data">
          <div class="row mb-4 my-2">
            <?php 
            if( !isset($_SESSION['user']))
            {
            ?>
            <div class="form-outline mb-2">
              <label class="form-label" for="first-name">Full Name</label>
              <span style="color:red">*</span>
              <input type="text" id="first-name" name="name" class="form-control" placeholder="Full Name" value="<?= isset($_SESSION['name'])? $_SESSION['name'] : ''; unset($_SESSION['name'])?>"/>
              <span style="color:red"><?= isset($_REQUEST['contactName']) ? $_REQUEST['contactName'] : ''  ?></span>
            </div>
            
            <div class="form-outline mb-2">
              <label class="form-label" for="first-name">Email</label>
              <span style="color:red">*</span>
              <input type="email" id="first-name" name="email" class="form-control" placeholder="Email Address" value="<?= isset($_SESSION['email'])? $_SESSION['email'] : ''; unset($_SESSION['email'])?>"/>
              <span style="color:red"><?= isset($_REQUEST['contactEmail']) ? $_REQUEST['contactEmail'] : ''  ?></span>
            </div>
            <?php } ?>
            
            <div class="form-outline mb-2">
              <label class="form-label" for="email">Feeback</label>
              <span style="color:red">*</span>
            </textarea>
            <textarea name="feedback" id="" cols="30" rows="5" class="form-control" placeholder="Query? or Feedback?"><?php if( isset($_SESSION['feedback']) ) echo $_SESSION['feedback']; unset($_SESSION['feedback'])?></textarea>
            <span style="color:red"><?= isset($_REQUEST['contactFeedback']) ? $_REQUEST['contactFeedback'] : ''  ?></span>
            </div>
            <!-- SEND BUTTON -->
            <center>
              <button type="submit" name="send" class="btn btn-block mb-1 sign-up-btn">Send</button>
              <p style="color:green; font-size: 18px; font-weight:700" > <?= isset( $_SESSION['msg'] )? $_SESSION['msg']: ''; unset($_SESSION['msg'])?></p>
            </center>
            <div class="col-4"></div>
          </div>
        </form>
      </div>
    <?php
  }
}
?>