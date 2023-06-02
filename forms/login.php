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
