<?php
require '../functions.php';
requireFiles(['../Classes/CRUD', '../Classes/Database','../Classes/Redirect', '../Classes/HTML', '../Classes/Role']);
$crud = new CRUD;
Database::getConnection();
Role::admin();
$userID =  $_SESSION['user']['user_id'];

$isUserSettingExist = $crud->select('setting' , ['user_id'], ['user_id' => $userID]);
if(isset($_SESSION['user']))
{
   if( isset($_REQUEST['add']) )
   {
      if ( !empty($isUserSettingExist[0]['user_id']) )
      {
         array_pop($_REQUEST);
         $values     = implode(";", $_REQUEST);
         $property   = array_flip($_REQUEST);
         $properties = implode(";", $property);
         Database::query("UPDATE setting SET setting_key = '".$properties."', setting_value = '".$values."', updated_at = '".update()."' WHERE user_id IN ($userID)");

         $msg = "Setting Updated.";

         if($_SESSION['user']['role_id'] == 2)
         {
            Redirect::to('../post', ['pid' => $_SESSION['pid'] ]);
         }
      }
      else
      {
         $settings = $_REQUEST;
         $properties = '';
         $values = '';
         foreach ($settings as $property => $value) 
         {
            if($property !== 'add')
            {
               $properties .= $property .";";
               $values .= $value .";";
            }
         }
         $properties = substr($properties, 0, -1);
         $values = substr($values, 0, -1);
         Database::query("INSERT INTO setting(user_id, setting_key, setting_value) VALUES('".$userID."', '".$properties."', '".$values."')");
         $msg = "Setting Inserted.";
        if($_SESSION['user']['role_id'] == 2)
         {
            Redirect::to('../post', ['pid' => $_SESSION['pid'] ]);
         }
      }
   }
   /* 
   =============================
   |     PREVIOUS SETTINGS      |
   =============================
   */
         $previousSetting = $crud->select('setting', ['setting_key', 'setting_value'], ['user_id' => $userID]);
         if( $previousSetting !== '')
         {
            
         foreach ($previousSetting as $key => $value) 
         {
            $property = explode(";", $value['setting_key']);
            $value    = explode(";", $value['setting_value']);
         }
         $preferences = '';
         $length = sizeof($property);
         }
}
/* 
   =========================
   |		HTML - VIEW   		|
   =========================
*/
$title = "Setting";
require_once '../assets/initial/navbar.php';
require 'html/setting.php';
HTML::footer();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>