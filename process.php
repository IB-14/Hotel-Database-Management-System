<?php
$insert = false;

if(isset($insert)){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";
    echo "HI";
    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    mysqli_select_db($con,"hotelfinal");

    $administrator_id = $_POST['administrator_id'];
    $first_name = $_POST['first_name'];

    //mysql_connect("localhost","root","");
    echo $administrator_id;

    $result =  mysqli_query($con,"SELECT * FROM administrator where administrator_id = '$administrator_id' and first_name = '$first_name'")
                    or die("Failed to query database".mysqli_error());

    $row = mysqli_fetch_array($result);
    echo $row;
    if($row['administrator_id'] == $administrator_id && $row['first_name'] == $first_name)
    {
        printf ("Login Successful. Welcome %s",$row["administrator_id"]);
    }
    else
        echo "failed to login";
    $con->close();
}
?>