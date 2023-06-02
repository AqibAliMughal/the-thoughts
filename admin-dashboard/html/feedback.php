<link rel="stylesheet" type="text/css" href="../admin.css"> 
<div class="row">

<div class="col-lg-2 mt-2">
<?php require_once '../assets/initial/sidebar.php'; ?>
</div>
<div class="col-lg-6 mt-2">
 <!-- 
    =====================================
    |         ALL TIME FEEDBACK         |
    =====================================
   -->
    <h2>Feeback</h2>
    <div class="">
      <table class="table table-hover approval-section">
        <thead>
          <tr>
            <th>SNo:</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Feedback</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $userinfo = Database::query("SELECT * FROM user_feedback ORDER BY feedback_id DESC");
          if($userinfo == "")
          { ?>
            <tr>
            <td><h5><strong>No Record Found</strong> </h5></td>
            </tr>
          <?php 
          }
          else
          { 
            $serialNumber = 1;
            foreach ($userinfo as $key => $user) { ?>
              <tr>
                <td><?= $serialNumber++ ?></td>
                <td>
                  <?php 
                  if( $user['user_id'] == NULL) echo "Anonymous";
                  else echo $user['user_id'];
                    ?>
                  </td>
                <td><?= $user['user_name'] ?></td>
                <td><?= $user['user_email'] ?></td>
                <td><?= createdAt($user['created_at']) ?></td>
                <td><?= $user['feedback'] ?></td>
                </tr>
                <?php
              }
        }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>