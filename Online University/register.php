<?php
  session_start();
  require_once('connection.php');

  $Error = "";
  $name = $intial = $nsuId = $password = $conPassword = $dob = $gender = $contact = $email = "";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php require 'menu.php';
    
    if (count($_POST)==0) { ?>
      <div class="bgImage">
        <form class="home_contents" name="preRegister" method="POST" action=""> 
          <div class="home_texts">
            <input type="submit" name="teacher" class="button" value="Register as a Teacher">
          </div>
          <div class="home_button">
            <input type="submit" name="student" class="button" value="Register as a Student">
          </div>
        </form> 
      </div> 
      <?php
    }

    if (isset($_POST['teacher'])) {
      registrationForm("Teacher");

    }

    if (isset($_POST['teacherValidation'])) {
      validation("Teacher");
      if ($Error != "") {
        registrationForm("Teacher");
      }
      else{

        $hashedPassword = hash('sha512',$password);
        
        $sql1 = "INSERT INTO teacher_info (name, initial, dob, gender, contact, email)
                                  VALUES ('$name', '$intial', '$dob', '$gender', '$contact', '$email')";
        
        $sql2 = "INSERT INTO users (userName, password, role)
                            VALUES ('$intial', '$hashedPassword', 'teacher')";
        
        if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
          $_SESSION["userName"] = $intial;
        } else {
          echo "Error: ".$sql1."<br>".mysqli_error($conn)."<br>";
          echo "Error: ".$sql2."<br>".mysqli_error($conn)."<br>";
        }        
        mysqli_close($conn);
        
        if(isset($_SESSION["userName"])) {
          header("Location:teacher/");
        }
      }
      
    }


    if(isset($_POST['student'])) { 
      registrationForm("Student");
    }

    if (isset($_POST['studentValidation'])) {
      validation("Student");
      if ($Error != "") {
        registrationForm("Student");
      }
      else{

      }
      
    }


    ?>


    <?php
      function inputChecker($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      function registrationForm($Role) {
        global $Error;
        global $name;
        global $intial;
        global $nsuId;
        global $contact;
        global $email;    ?>   
        <div class="bgImage">
          <form class="teaRegForm" action="" method="POST">
            <div class="table_div">
              <h3><?php echo $Role; ?> Registration</h3><br>
              <div class="error">
                <?php echo $Error; ?>
              </div>
              <table>
                <tr>
                  <td class="left"><label for="name">Name :</label></td>
                  <td class="right"><input type="text" name="name" maxlength="50" autofocus value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                  <?php
                    if ($Role == "Teacher") {     ?>
                      <td class="left"><label for="initial">Initial :</label></td>
                      <td class="right"><input type="text" name="initial" maxlength="10" value="<?php echo $intial; ?>"></td>  <?php
                    }
                    else {   ?>
                      <td class="left"><label for="nsuId">NSU ID :</label></td>
                      <td class="right"><input type="text" name="nsuId" maxlength="10" value="<?php echo $nsuId; ?>"></td>    <?php
                    }
                  ?>
                </tr>
                <tr>
                  <td class="left"><label for="password">Password :</label></td>
                  <td class="right"><input type="password" name="password"></td>
                </tr>
                <tr>
                  <td class="left"><label for="confirm_pass">Confirm Password :</label></td>
                  <td class="right"><input type="password" name="confirm_pass"></td>
                </tr>
                <tr>
                  <td class="left"><label for="dob">Date of Birth :</label></td>
                  <td class="right">
                    <select name="year">
                    <option value="" disabled selected>Year</option>
                      <?php for ($year = date("Y"); $year >= 1960; $year--) { ?>
                      <option value="<?php echo $year ?>"><?php echo $year ; ?></option>
                      <?php } ?>
                    </select>
                    <select name="month">
                    <option value="" disabled selected>Month</option>
                      <?php for ($month = 1; $month <= 12; $month++) { ?>
                      <option value="<?php echo $month ?>"><?php echo $month ; ?></option>
                      <?php } ?>
                    </select>
                    <select name="day">
                      <option value="" disabled selected>Day</option>
                      <?php for ($day = 1; $day <= 31; $day++) { ?>
                      <option value="<?php echo $day ?>"><?php echo $day ; ?></option>
                      <?php } ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="left"><label for="gender">Gender :</label></td>
                  <td class="right">
                    <input type="radio" name="gender" value="Male">
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="Female">
                    <label for="male">Female</label>
                    <input type="radio" name="gender" value="Other">
                    <label for="male">Other</label>
                  </td>
                </tr>
                <tr>
                  <td class="left"><label for="contact">Contact no :</label></td>
                  <td class="right"><input type="tel" name="contact" maxlength="11" value="<?php echo $contact; ?>"></td>
                </tr>
                <tr>
                  <td class="left"><label for="email">Email :</label></td>
                  <td class="right"><input type="email" name="email" maxlength="100" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                  <td class="left"></td>
                  <td class="right">
                    <?php
                      if ($Role == "Teacher") {     ?>
                        <input class="regButton" name="teacherValidation" type="submit" value="Submit">  <?php
                      }
                      else {   ?>
                        <input class="regButton" name="studentValidation" type="submit" value="Submit">    <?php
                      }
                    ?>
                    <input class="regButton" type="reset">
                  </td>
                </tr>
              </table>
            </div>
          </form>
        </div>
        <?php                 
      }

      function validation($Role) {

        global $Error;
        global $name; global $intial; global $nsuId; global $password;
        global $dob; global $gender; global $contact; global $email;



        if (empty($_POST["name"])) {
          $nameErr = "Name is required";
          $Error = $Error.$nameErr."<br>";
        }
        else {
          $name = inputChecker($_POST["name"]);
          if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $Error = $Error.$nameErr."<br>";
          }
        }
  
        if ($Role == "Teacher") {
          if (empty($_POST["initial"])) {
            $initialErr = "Initial is required";
            $Error = $Error.$initialErr."<br>";
          }
          else {
            $intial = inputChecker($_POST["initial"]);
            if (!preg_match("/^\w{3,}$/", $intial)) {
              $initialErr = "Only letters and numbers allowed";
              $Error = $Error.$initialErr."<br>";
            }
          }
        }
        else {
          if (empty($_POST["nsuId"])) {
            $nsuIdErr = "NSU ID is required";
            $Error = $Error.$nsuIdErr."<br>";
          }
          else {
            $nsuId = inputChecker($_POST["nsuId"]);
            if (!preg_match("/^[0-9]*$/", $nsuId)) {
              $nsuIdErr = "Invalid NSU ID";
              $Error = $Error.$nsuIdErr."<br>";
            }
          }
        }
  
        if (empty($_POST["password"]) || empty($_POST["confirm_pass"])) {
          $passwordErr = "Password is required";
          $Error = $Error.$passwordErr."<br>";
        }
        else {
          $password = inputChecker($_POST["password"]);
          $conPassword = inputChecker($_POST["confirm_pass"]);
          if (strcmp($password, $conPassword)) {
            $passwordErr = "Password did not match";
            $Error = $Error.$passwordErr."<br>";            
          }
        }
  
        if(empty($_POST['year']) || empty($_POST['month']) || empty($_POST['day'])) {
          $dobErr = "Date of Birth is required";
          $Error = $Error.$dobErr."<br>";
        } else {
          $dob = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
          $today = date("Y-m-d");
          $dob=new DateTime($dob);
          $today=new DateTime($today);
          $interval = $dob->diff($today);
          $age= $interval->y;
  
          if ($age <= 16){ 
            $dobErr = "Underage";
            $Error = $Error.$dobErr."<br>";
          }
          else{
            $dob = date_format($dob, "Y-m-d");
          }
        }
  
        if (empty($_POST["gender"])) {
          $genderErr = "Gender is required";
          $Error = $Error.$genderErr."<br>";
        }
        else {
          $gender = inputChecker($_POST["gender"]);
        }
  
        if (empty($_POST["contact"])) {
          $contactErr = "Contact number is required";
          $Error = $Error.$contactErr."<br>";
        }
        else {
          $contact = inputChecker($_POST["contact"]);
          if (!preg_match("/^[0-9]*$/", $contact)) {
            $contactErr = "Invalid contact number";
            $Error = $Error.$contactErr."<br>";
          }
        }
  
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";
          $Error = $Error.$emailErr."<br>";
        }
        else {
          $email = inputChecker($_POST["email"]);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $Error = $Error.$emailErr."<br>";
          }
        }
      }

    ?>

    <?php require_once('footer.php');?>



  </body>
</html>
