<?php session_start();
require_once('../connection.php');
 $name = $nsuId = $c_name = $cid = $initial = "" ;

 $sql = "SELECT * FROM student_info WHERE nsuId = '".$_SESSION["userName"]."' LIMIT 1";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
		  if (isset($_POST['code'])){
          $cid = $_POST['code'];
		  
          if(is_array($row) ==1) {
            $nsuId = $row['nsuId'];
             
			 }
			 
		$sql = "SELECT teacher FROM course_list WHERE code = '".$cid."'";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
		  
          if(is_array($row) ==1) {
            $initial = $row['teacher'];
             
			 }
			 
			 //echo $nsuId . $cid . $c_name . $initial;
			 $sql = "INSERT INTO courses (studentId, code, title, teacherInitial) VALUES ('$nsuId', '$cid', '$c_name', '$initial')";
			 mysqli_query($conn, $sql);
		  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Student Dashboard - Courses</title>
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
<h3 style="text-align:center">Courses</h3>

<div class = table>				
<table>
  <tr>
    <th>#</th>
    <th>Course Code</th>
    <th>Course Information</th>
	<th>Faculty</th>
  </tr>
  <tr>
   <?php
					$sql = "SELECT DISTINCT  code,title,teacherInitial FROM courses WHERE studentId='".$nsuId."' ORDER BY code Asc";
					$result = mysqli_query($conn,$sql);
					$count=1;
					while ($row=mysqli_fetch_array($result))
						{
							echo"<tr>";
							echo"<td>".$count."</td>";
							echo"<td>".$row['code']."</td>";
							echo"<td>".$row['title']."</td>";
							echo"<td>".$row['teacherInitial']."</td>";
							
							echo"</tr>";
							$count+=1;
							
							
						}
						?>
  

  </tr>
</div>
    <?php require_once 'footer.php';?>  

  </body>
</html>
