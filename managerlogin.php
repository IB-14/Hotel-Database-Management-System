<?php
$insert = false;

if(isset($_POST['manager_id'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $pass = "";
    
    $con = mysqli_connect($server, $username, $pass);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    
    session_start();
    $manager_id = $_POST['manager_id'];
    $password = $_POST['password'];
    $_SESSION['mid'] = $manager_id;


    $sql = "SELECT * FROM `hotelfinal`.`manager` where manager_id = '$manager_id' and password = '$password'";
    
    $result = mysqli_query($con,$sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    

    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    //printf($row[0]);
    
    if($row[0] == $manager_id && $row[3] == $password)
    {
        printf ("Login Successful. Welcome %s",$row[0]);
        header('Location: bookRooms.php');
    }
    else
     {   $insert=true;}
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Manager Login</title>
    <link rel="stylesheet" type="text/css" href="stylesignup.css">
    <link rel="stylesheet" href="animate.css">
<body>
    <div class="main">
        <div class="logo">
            <div class="slideInDown animated">
                <img src="TRAVELLER.png">
            </div>
        </div>
        <div>
        <ul>
            <li class="active"><a href="index.html">Home</a></li>
            <li class="active"><a href="contact.html">Contact</a></li>
                  </div>
              </a>
        </ul>			
    </div>
    <div class="loginbox">
    <img src="trave.png" class="trave">
        <h1>MANAGER LOGIN</h1>
        <div id="form">
        <form action="managerlogin.php" method="post" class="slideInUp animated">
            <p>Username</p>
            <input type="text" id="manager_id" name="manager_id" placeholder="Mr Manager">
            <p>Password</p>
            <input type="password" id="password" name="password" placeholder="**********">
            <input type="submit" name="" value="Login">
            <a href="login.php">Looking for Admin login?</a>
            <?php
                if($insert == true){
                echo "<p>Failed to login. Please enter correct password</p>";
                }
            ?>
        </form>   
        </div>
    </div>
</body>
</head>
</html>

