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
			 
		$sql = "SELECT title FROM course_list WHERE code = '".$cid."'";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
		  
          if(is_array($row) ==1) {
            $c_name = $row['title'];
             
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
    <title>Student Dashboard - Enroll in Courses</title>
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
		<h2><?php echo $name."</h2><hr>";
        }        
      ?>   
		  <h3>Plese Select Your Courses</h2>
		  <form name="add" method="post" action="">
				<label style = "font-weight: bold;"for="courses">Choose a Course:</label>
				<?php
					$sql = "SELECT * FROM course_list";
					  $result = mysqli_query($conn,$sql);
					
					  echo"<select name='code'>";
					  echo"<option>Courses....</option>";
						while($row=mysqli_fetch_array($result))
						{
							$course_id = $row['code'];
							$course_name = $row['title'];
							echo"<option value = '".$course_id."'>".$course_id." ".$course_name."</option>";
							
						}
					  echo"</select>";
					  
					  ?>
				
				<input type="submit" name="submit" value="Add" class="btn">
				</form>
<br><hr>
<div class = table>				
<table>
  <tr>
    <th>#</th>
    <th>Course Code</th>
    <th>Course Information</th>
  </tr>
  <tr>
  <?php
					$sql = "SELECT DISTINCT  code,title FROM courses WHERE studentId='".$nsuId."' ORDER BY code Asc";
					$result = mysqli_query($conn,$sql);
					$count=1;
					while ($row=mysqli_fetch_array($result))
						{
							echo"<tr>";
							echo"<td>".$count."</td>";
							echo"<td>".$row['code']."</td>";
							echo"<td>".$row['title']."</td>";
							
							echo"</tr>";
							$count+=1;
							
							
						}
						?>
  

  </tr>
</div>
       <?php require_once 'footer.php';?>  


  </body>
</html>
