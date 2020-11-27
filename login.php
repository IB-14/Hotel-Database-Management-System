<?php
$insert = false;

if(isset($_POST['administrator_id'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $pass = "";
    //echo "HI";
    // Create a database connection
    $con = mysqli_connect($server, $username, $pass);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    
    //mysqli_select_db($con,"hotelfinal");
    session_start();
    $administrator_id = $_POST['administrator_id'];
    $first_name = $_POST['first_name'];
    $_SESSION['aid'] = $administrator_id;

    //mysql_connect("localhost","root","");
    //echo $administrator_id;

    $sql = "SELECT * FROM `hotelfinal`.`administrator` where administrator_id = '$administrator_id' and first_name = '$first_name'";
    
    $result = mysqli_query($con,$sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    
    //$result =  mysqli_query($con,"SELECT * FROM administrator where administrator_id = '$administrator_id' and first_name = '$first_name'")
     //               or die("Failed to query database".mysqli_error());

    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    //printf($row[0]);
    
    if($row[2] == $administrator_id && $row[0] == $first_name)
    {
        printf ("Login Successful. Welcome %s",$row[2]);
        header('Location: adminmain.php');
    }
    else
     {   $insert = true;}
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
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
        <h1>ADMIN LOGIN</h1>
        <form action="login.php" method="post" class="slideInUp animated">
            <p>Administrator ID</p>
            <input type="text" id="administrator_id" name="administrator_id" placeholder="Admin ID">
            <p>Password</p>
            <input type="password" id="first_name" name="first_name" placeholder="**********">
            <input type="submit" name="" value="Login">
            <a href="managerlogin.php">Looking for Manager login?</a>
            <?php
                if($insert == true){
                echo "<p>Failed to login. Please enter correct password</p>";
                }
            ?>
        </form>   
    </div>
</body>
</head>
</html>


