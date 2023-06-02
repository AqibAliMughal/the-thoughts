<div class="row">
  <div class="col-2 col-md-2 col-sm-12 mx-4">
    <?php
    require_once '../assets/initial/sidebar.php';
    ?>
  </div>
  <div class="col-6">
    <h2 class="text-center my-3">Update User </h2>
    <span id="invalid_entries"></span>
    <form class="register-form" action="user-update.php" method="POST" enctype="multipart/form-data">
      <div class="row mb-2 ">
        <!-- FIRST NAME && LAST Name -->
        <div class="row mb-2">
          <div class="col">
            <div class="form-outline">
              <center>
                <img src="../assets/user_image/<?= $user_image?>" alt="User Profile Picture" style="width: 80px;">
              </center>
              <input type="file" name="user_image" id="user_image"> 
            </div>
            <span id="user_image_msg"><?= isset($_SESSION['user_image'])? $_SESSION['user_image'] : ''?></span>
          </div>
        </div>
        <div class="col">
          <div class="form-outline">
            <input type="hidden" name="uid" value="<?= $user ?>">
            <label class="form-label" for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="<?= $first_name?>" />
            <span id="first_name_msg"><?= isset($_SESSION['first_name'])? $_SESSION['first_name'] : ''?></span>
          </div>
        </div>
        <div class="col">
          <div class="form-outline">
            <label class="form-label" for="last_name">Last name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name"  value="<?= $last_name?>" />
            <span id="last_name_msg"><?= isset($_SESSION['last_name'])? $_SESSION['last_name'] : ''?></span>
          </div>
        </div>
      </div>

      <!-- Password and Confirm Password -->
      <div class="row mb-2 ">
        <div class="col">
          <div class="form-outline">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Your Password Here"  value="<?= $password?>" />
            <span id="password_msg"><?= isset($_SESSION['password'])? $_SESSION['password'] : ''?></span>

          </div>
        </div>
      </div>

      <!--  Gender / DOB -->
      <div class="row mb-2">
        <div class="col">
          <div class="form-outline">
            <label class="form-label" for="">Gender</label>
            <select name="gender" id="gender" class="form-select" aria-label="Default select example">
              <option selected> <?= $gender?></option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <span id="gender_msg"></span>
        </div>
        <div class="col">
          <div class="form-outline">
            <label class="form-label" for="dob">Date of Birth</label>
            <input type="date" name= "date_of_birth" id="dob" class="form-control"  value="<?= $date_of_birth?>" />
          </div>
          <span id="date_of_birth_msg"></span>
        </div>
      </div>


      <div class="form-outline mb-2">
        <label class="form-label" for="address">Address</label>
        <textarea name="address" id="address"  class="form-control" placeholder="Your Address Here.."><?= $address?></textarea>
        <span id="address_msg"></span>
      </div>
      <center>
        <input type="submit" name="update" class="sign-up-btn" value="Update">
      </center>
    </form>
  </div>
    <div class="col-4"></div>