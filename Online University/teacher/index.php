<?php
  session_start();
  require_once('../connection.php');
  $name = $intial = $contact = $email = $dept = "";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Teacher Dashboard</title>
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
          $sql = "SELECT * FROM teacher_info WHERE initial = '".$_SESSION["userName"]."' LIMIT 1";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
          
          if(is_array($row) ==1) {
            $name = $row['name'];
            $intial = $row['initial'];
            $contact = $row['contact'];
            $email = $row['email'];
            $dept = $row['dept'];
          }
          ?>
          <h2>Welcome <?php echo $name."</h2><br><hr>";

          shortInfo();

        }        
      ?>
    </div>

    <footer>
      <p>Author: Oashiur Rahman<br>
      <a href="mailto:oashiur.rahman@northsouth.edu">Mail to Author</a></p>
    </footer>

    <?php
      function shortInfo () {
        global $name; global $intial; global $contact; global $email; global $dept;
        ?>
        <div class="table_div">
          <table>
            <tr>
              <td class="left"><p>Name:</p></td>
              <td class="right"> <?php echo $name; ?></td>
            </tr>
            <tr>
              <td class="left"><p>Initial:</p></td>
              <td class="right"> <?php echo $intial; ?></td>
            </tr>          
            <tr>
              <td class="left"><p>Contact no:</p></td>
              <td class="right"> <?php echo $contact; ?></td>
            </tr>
            <tr>
              <td class="left"><p>Email:</p></td>
              <td class="right"> <?php echo $email; ?></td>
            </tr>
            <tr>
              <td class="left"><p>Department:</p></td>
              <td class="right"> <?php echo $dept; ?></td>
            </tr>
          </table>
        </div>  <?php
      }  ?>

  </body>
</html>
