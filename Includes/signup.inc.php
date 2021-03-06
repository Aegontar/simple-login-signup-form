<?php 


if(isset($_POST['signup-submit'])) {

require 'dbh.inc.php';

//after you check your database connection
$sql = mysqli_query($conn,"SELECT * FROM user WHERE username = '".$username."'");


$username = $_POST['uid'];
$email = $_POST['mail'];
$password = $_POST['pwd'];
$passwordRepeat = $_POST['pwd-repeat'];

if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {

    header("Location: ../signup.php?error=emptyfields&uid=".$username."&email=".$email);
    exit();
  }


  else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))  {
  
    header("Location: ../signup.php?error=invaliduid");
    exit();
 }

else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
 }

 else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))  {
  
    header("Location: ../signup.php?error=invaliduid&mail=".$username);
    exit();
 }

 else if ($password !== $passwordRepeat ) {

    header("Location: ../signup.php?error=passwordcheck&uid".$username."&email=".$email);
    exit();

 } else if (mysqli_num_rows($sql)>0){
   header("Location: ../signup.php?error=usernametaken");
    exit();
}

 else {

 $sql = "SELECT uidusers FROM users WHERE uidusers=?";
 $stmt = mysqli_stmt_init($conn);
 if(!mysqli_stmt_prepare($stmt, $sql )) {
  header('Location: ../signup.php?error=sqlerror');
  exit();
 }
 else {

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
$resultCheck = mysqli_stmt_num_rows($stmt);
if ($resultCheck > 0) {
    header("Location: ../signup.php?error=usertaken&email=".$email);
    exit();
      }
      else {
     
         $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
         $stmt = mysqli_stmt_init($conn);
         if(!mysqli_stmt_prepare($stmt, $sql )) {
            header('Location: ../signup.php?error=sqlerror');
            exit();
           }
        else {
         
         $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

         mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
         mysqli_stmt_execute($stmt);
         header('Location: ../signup.php?signup=success');
            exit();
         
        }
      }
     }
    }
   
    mysqli_stmt_close($stmt);
    mysqli_close();
   }
   
  

  