<?php session_start(); 
require_once('../connection.php');
$name = $nsuId = "";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Dashboard - Results</title>
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
          }
          ?>
		<h2><?php echo $name."</h2>";
        }        
      ?>
          <h3 style="text-align:center">Exam Results</h3>
          <div class = table>				
				<table>
				  <tr>
					<th>#</th>				
					<th>Course</th>
					<th>Exam Type</th>
					<th>Marks</th>
				  </tr>
				  <tr>
		<?php
			$sql = "SELECT * FROM result";
			$result = mysqli_query($conn, $sql);
			$count=1;
          while ($row = mysqlI_fetch_assoc($result)) {
            echo "<tr>";
			echo "<td>".$count."</td>";
            echo "<td>".$row['courseCode']."</td>";
            echo "<td>".$row['type']."</td>";
			 echo "<td>".$row['score']."</td>";
			 
            echo "</tr>";
			$count+=1;
		}

						?>

					
    </div>

       <?php require_once 'footer.php';?>  


  </body>
</html>
