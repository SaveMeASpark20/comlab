<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: adminhome.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
       if (isset($_POST["adminlogin"])) {
        $id = $_POST["id"];
        $password = $_POST["password"];
         require_once "database.php";
         $sql = "SELECT * FROM users WHERE id = '$id'";
         $result = mysqli_query($conn, $sql);
         $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
         if ($user) {
             if (password_verify($password, $user["password"])) {
                 session_start();
                 $_SESSION["user"] = "yes";
                 header("Location: adminhome.php");
                 die();
             }else{
                 echo "<div class='alert alert-danger'>Password does not match</div>";
             }
         }else{
             echo "<div class='alert alert-danger'>Email does not match</div>";
         }
     }
        ?>
      <form action="adminlogin.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="Enter Id:" name="id" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="adminlogin" class="btn btn-primary">
        </div>
      </form>
     <div><p>Not registered yet <a href="adminregister.php">Register Here</a></p></div>
    </div>
</body>
</html>