
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>.Blogger | Tech & Freelancing Updates</title>
  <link rel=  "stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
  <?php require_once 'partials/navbar.php' ?>
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4 my-4 form">
      <h2 class="text-center my-3"><span class="">CONTACT FORM</span> </h2>
      <span><hr style="width: 125px; margin-left: 80px;"/></span>

      <form class="" action="contact.php" method="POST" enctype="multipart/form-data">
        <div class="row mb-4 my-5">
          <?php 
          if( !isset($_SESSION['user']))
          {
          ?>
          <div class="form-outline mb-4">
            <label class="form-label" for="first-name">Full Name</label>
            <input type="text" id="first-name" name="name" class="form-control" placeholder="Full Name" />
          </div>

          <div class="form-outline mb-4">
            <label class="form-label" for="first-name">Email</label>
            <input type="email" id="first-name" name="email" class="form-control" placeholder="Email Address" />
          </div>
        <?php } ?>

          <div class="form-outline mb-4">
            <label class="form-label" for="email">Feeback</label>
            </textarea>
            <textarea name="feedback" id="" cols="30" rows="10" class="form-control" placeholder="Query? or Feedback?"></textarea>
          </div>
          <!-- SEND BUTTON -->
          <center>
            <button type="submit" name="send" class="btn mb-5 btn-block mb-4 sign-up-btn">Send</button>
          </center>
          <div class="col-4"></div>
        </div>
      </form>
    </div>
