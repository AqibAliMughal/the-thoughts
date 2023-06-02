   <style>
    span,ul { color: red; font-size: 16px; }
    ul{
      text-align: center;
    }
    li{
      list-style: none;
    }
  </style>

  <script>
    function validation()
    {
      var flag = true;
      var name_pattern      = /^[A-Z]{1}[a-z]{2,30}$/;
      var email_pattern     = /^[a-z]{2,15}[0-9]{1,5}[@][a-z]{5,8}[.][a-z]{2,6}$/;
      var password_pattern  = /[A-Z a-z]{4,20}[0-9]{4,10}/;

      var first_name        = document.getElementById("first_name").value;
      var last_name         = document.getElementById("last_name").value;
      var email             = document.getElementById("email").value;
      var confirm_email     = document.getElementById("confirm_email").value;
      var password          = document.getElementById("password").value;
      var confirm_password  = document.getElementById("confirm_password").value;
      var gender            = document.getElementById("gender").value;
      var date_of_birth     = document.getElementById("dob").value;
      var date_of_birth     = document.getElementById("dob").value;
      var address           = document.getElementById("address").value;
      
      if(first_name == "")
      {
        flag = false;
        document.getElementById('first_name_msg').innerHTML = "Please enter first name";
      }
      else if( name_pattern.test(first_name) == false )
      {
        flag = false;
        document.getElementById('first_name_msg').innerHTML = "First name must be like Ahmed";
      }

      if(last_name == "")
      {
        flag = false;
        document.getElementById('last_name_msg').innerHTML = "Please enter last name";
      }
      else if( name_pattern.test(last_name) == false )
      {
        flag = false;
        document.getElementById('last_name_msg').innerHTML = "last name must be like Shaikh";
      }
      
      if(email == "")
      {
        flag = false;
        document.getElementById('email_msg').innerHTML = "Please enter email";
      }
      else 
      {
        if( email_pattern.test(email) == false )
        {
          flag = false;
          document.getElementById('email_msg').innerHTML = "Email must like: sahmedrajput17@gmail.com";
        }
        else
        {
          flag = true;
          document.getElementById('email_msg').innerHTML = "";
        } 
      }

      if(confirm_email == "")
      {
        flag = false;
        document.getElementById('confirm_email_msg').innerHTML = "Please enter confirm email";
      }
      else 
      {
        if( email_pattern.test(confirm_email) == false )
        {
          flag = false;
          document.getElementById('confirm_email_msg').innerHTML = "Confirm Email must like: sahmedrajput17@gmail.com";
        }
        else
        {
         flag = true;
         document.getElementById('confirm_email_msg').innerHTML = ""; 
       }
     }

     if( email_pattern.test(confirm_email) )
     {
       if(email !== confirm_email)
       {
        flag = false;
        document.getElementById('confirm_email_msg').innerHTML = "Email is not matched";
      }
      else
      {
        flag = true;
        document.getElementById('confirm_email_msg').innerHTML = "";
      }
    }
    
    if(password == "")
    {
      flag = false;
      document.getElementById('password_msg').innerHTML =  'Please enter Password';
    }

    else 
    {
      if( password_pattern.test(password) == false )
      {
        flag = false;

        document.getElementById('password_msg').innerHTML =  'Password must be atleast 8 character containing [a-z][0-9]';
      }
      else
      {
        flag = true;
        document.getElementById('password_msg').innerHTML =  '';
      }
    }

    if(confirm_password == "")
    {
      flag = false;
      document.getElementById('confirm_password_msg').innerHTML =  'Please enter Confirm password';
    }

    else 
    {
      if( password_pattern.test(confirm_password) == false )
      {
        flag = false;

        document.getElementById('confirm_password_msg').innerHTML =  'Confirm password must be atleast 8 character containing [a-z][0-9]';
      }
      else
      {
        flag = true;
        document.getElementById('confirm_password_msg').innerHTML =  '';
      }
    }

    if( password_pattern.test(confirm_password) )
    {
      if( password !== confirm_password )
      {
        flag = false;
        document.getElementById('confirm_password_msg').innerHTML = 'Password is not matched';
      }
      else
      {
        flag = true;
        document.getElementById('confirm_password_msg').innerHTML = ''; 
      }
    }

    if( gender == "")
    {
      flag = false;
      document.getElementById('gender_msg').innerHTML = 'Please select gender';
    }
    else
    {
      flag = true;
      document.getElementById('gender_msg').innerHTML = ''
    }
     
    if( date_of_birth == "")
    {
      flag = false;
      document.getElementById('date_of_birth_msg').innerHTML = ' Please choose date of birth';
    }
    else
    {
      flag = true;
      document.getElementById('date_of_birth_msg').innerHTML = '';
    }
        if( address == "" )
    {
      flag = false;
      document.getElementById('address_msg').innerHTML = 'Please provide address';
    }
    else
    {
      flag = true;
      document.getElementById('address_msg').innerHTML = '';
    }
    
    if( first_name == "" || email == "" || password == "" || gender == "")
    {
      flag = false;
      document.getElementById('invalid_entries').innerHTML = "Please fill all the fields.";
    }
    else
    {
      flag = true;
      document.getElementById('invalid_entries').innerHTML = "";
    }
    return flag;
  }
</script>
<div class="row">
  <div class="col-3"></div>
  <div class="col-6">
    <h2 class="text-center my-3">REGISTRATION FORM </h2>
    <span id="invalid_entries"></span>
    <!-- <form class="register-form" action="#" method="POST"  enctype="multipart/form-data"> -->
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
              <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" />
              <span id="first_name_msg"><?= isset($_SESSION['first_name'])? $_SESSION['first_name'] : ''?></span>
            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="last_name">Last name</label>
              <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" />
              <span id="last_name_msg"><?= isset($_SESSION['last_name'])? $_SESSION['last_name'] : ''?></span>
            </div>
          </div>
        </div>
        <!-- Email and Confirm Email -->
        <div class="row mb-2 ">
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Your Email Here" />
              <span id="email_msg"><?= isset($_SESSION['email'])? $_SESSION['email'] : ''?></span>

            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="confirm_email">Confirm Email</label>
              <input type="email" id="confirm_email" name="confirm_email" class="form-control" placeholder="Confirm Email" />
              <span id="confirm_email_msg"><?= isset($_SESSION['confirm'])? $_SESSION['confirm_email'] : ''?></span>

            </div>
          </div>
        </div>
        <!-- Password and Confirm Password -->
        <div class="row mb-2 ">
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="password">Password</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Your Password Here" />
              <span id="password_msg"><?= isset($_SESSION['password'])? $_SESSION['password'] : ''?></span>

            </div>
          </div>
          <div class="col">
            <div class="form-outline">
              <label class="form-label" for="confirm_password">Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm Password" />
              <span id="confirm_password_msg"><?= isset($_SESSION['confirm_password'])? $_SESSION['confirm_password'] : ''?></span>

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
            <span id="user_image_msg"><?= isset($_SESSION['user_image'])? $_SESSION['user_image'] : ''?></span>
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