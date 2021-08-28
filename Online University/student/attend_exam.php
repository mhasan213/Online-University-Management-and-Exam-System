<?php
 session_start();
require_once('../connection.php');
 $code = $type = $answer =  "" ;
 $counter = 0;
 
 	   /*$sql = "SELECT * FROM exam";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
          
          if(is_array($row)) {
            $code = $row['courseCode'];
            $type = $row['type'];
          }
*/
 $code = $_GET['examCode'];
$sql = "SELECT * FROM exam WHERE courseCode = '$code' ";
$result = mysqli_query($conn, $sql);

if($result) {
    while ($row  = mysqli_fetch_array($result)) {
    $question = $row['question'];

    $op1 = $row['option1'];
    $op2 = $row['option2'];
    $op3 = $row['option3'];
    $op4 = $row['option4'];
	
	$answer = $row['answer'];
	$type = $row['type'];
 ?>
      <?php
        if(!isset($_SESSION["userName"])) {
          header("Location:../login.php");
        }
        else {
          $sql = "SELECT * FROM student_info WHERE nsuId = '".$_SESSION["userName"]."' LIMIT 1";
          $result = mysqli_query($conn, $sql);
          $row  = mysqli_fetch_array($result);
		
          if(is_array($row) ==1) {
            $nsuId = $row['nsuId'];
          }
		}
		
          ?>
 <!DOCTYPE html>
 
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Exam Page</title>
    <link rel="stylesheet" href="stustyles.css">
  </head>
  <body>
 <div class = "mcq">
	<form method ="POST" action="">
	<?php if(isset($_POST['submit'])){
	
	}
	?>
	<h2 align="center";> <?php echo "".$code." ".$type.""?></h2>

    <p>&nbspQ:&nbsp<?php echo $question; ?></p>
	<input type="radio" name="op" value="<?php echo $op1; ?>">&nbsp<?php echo $op1; ?><br>
    <input type="radio" name="op" value="<?php echo $op2; ?>">&nbsp<?php echo $op2; ?><br>
    <input type="radio" name="op" value="<?php echo $op3; ?>">&nbsp<?php echo $op3; ?><br>
    <input type="radio" name="op" value="<?php echo $op4; ?>">&nbsp<?php echo $op4; ?><br>
	<br><hr>
	
	<input type="submit" name ="submit" value="Submit" class="btn">
	<input type='submit' name='reload' value='Reload' onclick='window.location.reload(true);'>

	</form>
<?php	
	if(isset($_POST['op'])){
		if($_POST['op']==$answer)
		$counter = $counter + 1;
	}
	
	if(isset($_POST['submit'])){
		echo("<script>alert('Answers have been submitted')</script>");
		echo("<script>window.location = 'exam.php';</script>");
	}
	
	?>
	</div>
<?php

	

    }
	$sql3 = "SELECT courseCode, type FROM result WHERE studentID =".$nsuId;
    $result3 = mysqli_query($conn, $sql3);
   if(mysqli_fetch_array($result3)==false){
	   $sql2 = "INSERT INTO result (courseCode, studentID, type, score) VALUES ('$code', '$nsuId', '$type', '$counter')";
			mysqli_query($conn, $sql2);
   }
   else {
	 $sql2 = "UPDATE result SET score = ".$counter." WHERE studentID=".$nsuId;
			mysqli_query($conn, $sql2); 
	   
   }
}

  

    

?>
 
</body>
</html>