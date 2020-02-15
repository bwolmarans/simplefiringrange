<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $myusername = $_POST['username'];
      $mypassword = $_POST['password'];

      $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
      echo 'sql: ' . $sql . '<br><br>';

      $result = mysqli_query($db,$sql);
      printf("Select returned %d rows. <br><br>", mysqli_num_rows($result));
      $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
      foreach( $rows as $row ):
        printf ("Email: %s,CreditCard: %s,Password: %s <br><br>", $row["email"], $row["creditcard"], $row["password"]);
      endforeach;

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count > 0) {
         $sql = "SELECT creditcard FROM users WHERE username = '$myusername' and password = '$mypassword'";
         $cc = mysqli_query($db,$sql);
         $sql = "SELECT password FROM users WHERE username = '$myusername' and password = '$mypassword'";
         $pw = mysqli_query($db,$sql);
         #session_register("myusername");
         #$_SESSION['login_user'] = $myusername;

         // header("location: welcome.php");
         //echo 'Welcome, ' . $result;
         //echo 'Welcome, ' . $myusername . ', your credit card number is ' . $cc . '<br>';
         //echo '...and for good measure, in case you need it, your password is ' . $pw . '<br>';
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>

   <head>
      <title>Login Page</title>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>

               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

         </div>

      </div>

   </body>
</html>
