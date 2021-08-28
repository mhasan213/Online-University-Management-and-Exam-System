
<?php
  session_start();
  require_once('../connection.php');
  $name = $nsuId = $cid = $sid = "";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Dashboard - Exams</title>
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
		<h3 style="text-align:center">Exam Schedules</h3>
      <?php
	   $sql = "SELECT * FROM courses";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
          
          if(is_array($row) ==1) {
            $cid = $row['code'];
            $sid = $row['studentId'];
          }
          ?>
		  
		  <div class = table>
<table>
  <tr>
    <th>#</th>
    <th>Course Code</th>
	<th>Exam Type</th>
	<th>Go to Exam</th>
  </tr>
  <tr>
  <?php
					$sql = "SELECT code FROM courses WHERE studentId='".$nsuId."'";
					$result = mysqli_query($conn,$sql);
					$count=1;
					while ($row=mysqli_fetch_array($result))
						{
							$sql2 = "SELECT courseCode,type FROM exam WHERE courseCode='".$row['code']."'";
							$result2 = mysqli_query($conn,$sql2);
							
							while ($row2=mysqli_fetch_array($result2)){
							echo"<tr>";
							echo"<td>".$count."</td>";
							echo"<td>".$row2['courseCode']."</td>";							
							echo"<td>".$row2['type']."</td>";
							echo"<td><a href='attend_exam.php?examCode=".$row2['courseCode']."'>Exam Link</a></td>";
							echo"</tr>";
							$count+=1;
							}
								
						}
						?>
  

  </tr>
</div>
    </div>

       <?php require_once 'footer.php';?>  


  </body>
</html>
