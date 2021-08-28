<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Teacher Dashboard - Marks</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php require_once 'menu.php';?>  
    <div class="content">
      <?php
        if(!isset($_SESSION["userName"])) {
          header("Location:../login.php");
        }
        else {
          ?>
          <h2>This is Marks Page</h2>
          <?php
        }        
      ?>
    </div>

    <footer>
      <p>Author: Oashiur Rahman<br>
      <a href="mailto:oashiur.rahman@northsouth.edu">Mail to Author</a></p>
    </footer>

  </body>
</html>
