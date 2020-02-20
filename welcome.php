<?php
   include('session.php');

   if($_SERVER["REQUEST_METHOD"] == "POST") {

      $myusername = $_SESSION['username'];
      $mypassword = $_SESSION['password'];
      $myanimal = $_POST['animal'];
      $sql = "UPDATE users SET animal = '$myanimal' WHERE username = '$myusername'";
      echo 'sql: ' . $sql . '<br><br>';

      if (mysqli_query($conn, $sql)) {
         echo "Record updated successfully";
      } else {
         echo "Error updating record: " . mysqli_error($conn);
      }
   }
?>
<html>

   <head>
      <title>Welcome </title>
   </head>

   <body>
      <h1>Welcome <?php echo $login_session; ?> !</h1>
      <form action = "" method = "post">
      <label>What is your fave animal? (We store it in your user record as a 2nd factor):</label><input type = "text" name = "animal"/><br/><br/>
      <input type = "submit" value = " Submit "/><br />
      </form>
      <h2><a href = "index.php">Sign Out</a></h2>
   </body>

</html>
