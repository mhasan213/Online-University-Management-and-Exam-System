<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #002B5B;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 10px 20px;
  font-size: 18px;
  display: block;
  text-decoration: none;
  color: #fff;
}

.sidenav a:hover {
  color: #29A1DB;
}

img{
    width: 142px;
    margin: 3px;
    border: 5px solid #fff;
  }
footer {
    margin-left: 200px;
    text-align: center;
    padding: 3px;
    background-color: #0F1A50;
    color: white;
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 60px;
  }
</style>
</head>
<body>
 <div class="sidenav">
 <a href="../student"><img src="../images/male_profile.png" alt="Profile Photo"/></a>
  <a href="information.php">Student Information</a>
  <a href="enrollcourses.php">Enroll in Courses</a>
  <a href="courses.php">Courses</a>
  <a href="exam.php">Exam</a>
  <a href="result.php">Result</a>
  <a href="logout.php">Logout</a>
</div>

</body>
</html>