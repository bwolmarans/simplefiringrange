<?php
   include('config.php');
   session_start();
      $myusername = $_SESSION['username'];
      $mypassword = $_SESSION['password'];

      $sql = "SELECT * FROM users WHERE username = '$myusername' and password = '$mypassword'";
      echo 'sql: ' . $sql . '<br><br>';

      $result = mysqli_query($conn, $sql);
	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
      printf("Select returned %d rows. <br><br>", mysqli_num_rows($result));
      $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      foreach( $rows as $row ):
        printf ("Username: %s, Animal: %s, Email: %s, CreditCard: %s, Password: %s <br><br>", $row["username"], $row["animal"], $row["email"], $row["creditcard"], $row["password"]);
      endforeach;

   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($db,"select username from users where username = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session = $row['username'];

   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>
