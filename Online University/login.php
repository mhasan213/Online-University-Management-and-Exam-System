<?php 
  session_start();
  require_once('connection.php');
  $message="";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php require('menu.php');?>

    <div class="user_login">

      <?php
        if (isset($_POST['submit'])) {
          $userName = $_POST["user_name"];
          $password = $_POST["password"];
          $hashedPassword = hash('sha512',$password);
          
          $sql = "SELECT * FROM users WHERE userName = '$userName' AND password = '$hashedPassword' LIMIT 1";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
          
          if(is_array($row) ==1) {
            $_SESSION["userName"] = $row['userName'];
            $role = $row['role'];
          }
          else {
            $message = "Invalid Username or Password!";
          }
          
          if(isset($role)) {
            if ($role == "dean")
              header("Location:dean/");
            elseif ($role == "teacher")
              header("Location:teacher/");
            elseif ($role == "student")
              header("Location:student/");
            
          }
        }
      ?>

      <form name="frmUser" method="post" action="" align="center">
        <div class="message"><?php if($message!="") { echo $message; } ?></div>
        <h3 align="center">Enter Login Details</h3>
        Username:<br>
        <input type="text" name="user_name">
        <br>
        Password:<br>
        <input type="password" name="password">
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <input type="reset">
      </form>
      
    
    
    
    
    
    
    
    
    
    <!--
      <div class="student_login">
        <a href="#" class="button">Student Login</a>
      </div>
      <div class="teacher_login">
        <a href="#" class="button">Teacher Login</a>
      </div>
      <div class="admin_login">
        <a href="#" class="button">Administration Login</a>
      </div>
      -->
    </div>

    <?php require('footer.php');?>

  </body>
</html>
