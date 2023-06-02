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