<?php
  session_start();
  require_once('../connection.php');
  $name = $nsuId = $contact = $email = $dob = $gender = $cgpa = $program = $address = $dept = "";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Dashboard - Information</title>
    <link rel="stylesheet" href="stustyles.css">
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
            $contact = $row['contact'];
            $email = $row['email'];
            $dob = $row['dob'];
			$gender = $row['gender'];
			$cgpa = $row['cgpa'];
			$program = $row['program'];
			$address= $row['address'];
			$dept = $row['dept'];
			
          }
          ?>
		  <h2><?php echo $name."</h2>";
          shortInfo();
        }        
      ?>
      
    </div>
	<?php
      function shortInfo () {
        global $name; global $nsuId; global $contact; global $email; global $dob; global$gender; global$cgpa ; global$program ; global$address ; global$dept ;
        ?>
        <div class="table_div1">
		<p align = "center" style= "font-weight: bold";> Academic Information</p>
		<table>
            <tr>
              <td class="left"><p>Name:</p></td>
              <td class="right"> <?php echo $name; ?></td>
            </tr>
            <tr>
              <td class="left"><p>ID:</p></td>
              <td class="right"> <?php echo $nsuId; ?></td>
			</tr>
			<tr>
              <td class="left"><p>Department:</p></td>
              <td class="right"> <?php echo $dept; ?></td>
            </tr>
			<tr>          
              <td class="left"><p>Enrolled In:</p></td>
              <td class="right"> <?php echo $program; ?></td>
            </tr>
            <tr>
              <td class="left"><p>CGPA:</p></td>
              <td class="right"> <?php echo $cgpa; ?></td>
            </tr>
          </table>
        </div> 
		<div class="table_div2">
		<p align = "center" style= "font-weight: bold";>Personal Information</p>
		<table>
            <tr>
              <td class="left"><p>Gender:</p></td>
              <td class="right"> <?php echo $gender; ?></td>
            </tr>
            <tr>
              <td class="left"><p>Date of Birth:</p></td>
              <td class="right"> <?php echo $dob; ?></td>
			</tr>
			<tr>
              <td class="left"><p>Contact:</p></td>
              <td class="right"> <?php echo $contact; ?></td>
            </tr>
			<tr>
              <td class="left"><p>Email:</p></td>
              <td class="right"> <?php echo $email; ?></td>
            </tr>
			<tr>
              <td class="left"><p>Address:</p></td>
              <td class="right"> <?php echo $address; ?></td>
            </tr>
          </table>
        </div>
		<?php
      }  ?>


    <?php require_once 'footer.php';?>  

  </body>
</html>
