<?php
$insert = false;
if(isset($_POST['manager_id'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $pass = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $pass);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    session_start();
    $manager_id = $_POST['manager_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    //$admin_id = $_POST['admin_id'];

   if (isset($_SESSION['aid'])) {
       $admin_id = $_SESSION['aid'];}

    //echo $_SESSION['aid'];

    $sql = "INSERT INTO `hotelfinal`.`manager` (`manager_id`, `first_name`, `last_name`, `password`, `admin_id`) VALUES ('$manager_id', '$first_name', '$last_name', '$password', '$admin_id');";
    // echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin</title>

    <!-- Icons font CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" media="all">


    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="bookRooms.css">
    <link rel="stylesheet" href="ADMIN.css">

    <style>
        .card-3 .card-heading {
        background: url("ad2.jpeg") top left/cover no-repeat;
        display: table-cell;
        width: 50%;
        }
    </style>
        


</head>

<body style="font-family: sans-serif;">

    <div class="wrapper">
        

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #303030 !important; color: white;">
                <div class="container-fluid">

                    <h3><span style="margin-left: 5em;">Admin</span></h3>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html" style="color: white;">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="page-wrapper bg-gra-01 p-t-180 font-poppins">
                <div class="wrapper wrapper--w780">
                    <div class="card card-3">
                        <div class="card-heading"></div>
                        <div class="card-body">
                            <h2 class="title">Add Manager</h2>
                            <form method="POST">
                                <div class="input-group">
                                    <input class="input--style-3" type="text" name="first_name" id="first_name" placeholder="First Name" name="fname">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="text" name="last_name" id="last_name" placeholder="Last Name" name="lname">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="text" name="manager_id" id="manager_id" placeholder="Manager ID" name="managerID">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="password" name="password" id="password" placeholder="Create Password" name="pass">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="password" placeholder="Re-enter Password" name="passRe">
                                </div>
                                <div class="p-t-10">
                                    <button class="btn btn--pill btn--green" type="submit" style="float: right;">Submit</button>
                                </div>
                                <?php
                                    if($insert == true){
                                    echo "echo '<script>alert('Manager Record Created Successfully')</script>';";
                                    }
                                ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            </div>
    </div>

    
    <!-- Jquery JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   
    <!-- Main JS-->
    <script>
    (function ($) {
    'use strict';

    
    try {
        var selectSimple = $('.js-select-simple');
    
        selectSimple.each(function () {
            var that = $(this);
            var selectBox = that.find('select');
            var selectDropdown = that.find('.select-dropdown');
            selectBox.select2({
                dropdownParent: selectDropdown
            });
        });
    
    } catch (err) {
        console.log(err);
    }
    

})(jQuery);
    </script>

</body>

</html>


