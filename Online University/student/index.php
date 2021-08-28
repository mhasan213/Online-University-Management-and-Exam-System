
<?php
  session_start();
  require_once('../connection.php');
  $name = $nsuId = $email = $dept = "";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="stustyles.css">
    <title>Student Dashboard</title>
  </head>
  <body>
    <?php require_once 'sideMenu.php';?>  
    <div class="content">
     <?php
        if(!isset($_SESSION["userName"])) {
          header("Location:../login.php");
        }
        else {
          $sql = "SELECT * FROM student_info WHERE nsuId = '".$_SESSION["userName"]."' LIMIT 1";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
          
          if(is_array($row) ==1) {
            $name = $row['name'];
            $nsuId = $row['nsuId'];
			$email = $row['email'];
			$dept = $row['dept'];
			
          }
          ?>
		<h2>Welcome, <?php echo $name."</h2>";		
		Intro();
        }        
      ?>           
    </div>
	
	<?php
      function Intro () {
        global $name; global $nsuId; global $email; global $dept;
        ?>
        <div class="table_div">
		<img src="../images/male_profile.png" alt="Profile Photo"/>
		<br><br>
          <table>
            <tr>
              <td class="left"><p>Name:</p></td>
              <td class="right"> <?php echo $name; ?></td>
            </tr>
            <tr>
              <td class="left"><p>ID:</p></td>
              <td class="right"> <?php echo $nsuId; ?></td>
            </tr>          
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

       <?php require_once 'footer.php';?>  


  </body>
</html>
