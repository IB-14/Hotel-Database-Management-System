<?php
$insert = false;
if(isset($_POST['adhaar_no'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";
    session_start(); 
    if (isset($_SESSION['mid'])) {
        $manager_id = $_SESSION['mid'];}
    
        $room_no = $_POST['room_no'];

    // Collect post variables
    $adhaar_no = $_POST['adhaar_no'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $bill_no = $_POST['bill_no'];

    $query = "SELECT rent from `hotelfinal`.`room` where room_no=$room_no;";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    $query2 ="SELECT DATEDIFF('$check_out', '$check_in') AS DateDiff;";
    $result2 = mysqli_query($con,$query2);
    if (!$result2) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    $row2 = mysqli_fetch_array($result2, MYSQLI_NUM);
    if($row2[0]==0){
        $row2[0]=1;
    }
    
    $bill = $row[0]*$row2[0];

    
    $sql = "INSERT INTO `hotelfinal`.`customer_details` (`first_name`, `last_name`, `age`, `adhaar_no`, `address`) VALUES ('$first_name', '$last_name', '$age', '$adhaar_no', '$address');";
    
    $sql .= "INSERT INTO `hotelfinal`.`bookings` (`adhaar_no`, `check_in`, `check_out`, `room_no`, `manager_id`) VALUES ('$adhaar_no', '$check_in', '$check_out', '$room_no', '$manager_id');";
    
    $sql .= "UPDATE `hotelfinal`.`room` SET state='Occupied' where room_no = $room_no;";
    

    $sql .= "INSERT INTO `hotelfinal`.`manages` (`manager_id`, `room_no`) VALUES ('$manager_id', '$room_no');";
    
    $sql .= "INSERT INTO `hotelfinal`.`bills` (`bill_no`, `adhaar_no`, `check_in`, `room_no`, `bill`, `check_out`) VALUES ('$bill_no', '$adhaar_no', '$check_in', '$room_no', '$bill', '$check_out');";

    if ($con->multi_query($sql) === TRUE) {
        $insert=true;
      } else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }
    $con->close();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Book Room</title>

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
    <link rel="stylesheet" href="RoomForm.css">

    <link href= 
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
          rel='stylesheet'> 


    <style>
        .card-3 .card-heading {
        background: url("room2.jpeg") top left/cover no-repeat;
        display: table-cell;
        width: 50%;
        }
    </style>
      
    <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > 
    </script> 
      
    <script src= 
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" > 
    </script> 
    

</head>

<body style="font-family: sans-serif;">

    <div class="wrapper">

        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Greetings Manager!</h3>
            </div>

            <ul class="list-unstyled components">
                <p style="text-align: center;">
                <?php 
                    //session_start(); 
                    if (isset($_SESSION['mid'])) {
                        echo $_SESSION['mid'];}
                    //$value = $_SESSION['mid']; 
                    //echo $value; 
                ?></p>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bookings</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="Records.php">Records</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="active">
                    <a href="#">Book Rooms</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Services</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="./Breakfast.php">Breakfast</a>
                        </li>
                        <li>
                            <a href="./Swimming.php">Swimming</a>
                        </li>
                        <li>
                            <a href="./Laundary.php">Laundary</a>
                        </li>
                        <li>
                            <a href="./Transport.php">Transport</a>
                        </li>
                    </ul>
                </li>
                
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="index.html" class="article">Log Out</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #303030 !important; color: white;">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <h3><span style="margin-left: 5em;">Book Room</span></h3>
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
                        <?php 
                        if($insert==true){
                            echo  "<h2 class='title'>Room ".$room_no." Booked!</h2>"; 
                        }
                        ?>
                            <form method="POST">
                                <div class="input-group">
                                    <input class="input--style-3" type="text" name="room_no" id="room_no"placeholder="Room Number">
                                </div>


                                <div class="input-group">
                                    <input class="input--style-3" type="text" placeholder="Bill Number" name="bill_no">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="text" name="adhaar_no" id="adhaar_no"placeholder="Aadhaar Number">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="text" name="first_name" id="first_name" placeholder="First Name">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="text" name="last_name" id="last_name"placeholder="Last Name">
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="number" name="age" id="age" placeholder="Age(yrs)">
                                </div>

                                <div style="display: inline-flex; max-width: 200px;">
                                    <div class="input-group" style="margin-right: 5px;">
                                        <input class="input--style-3 js-datepicker" type="date" placeholder="Check-In " name="check_in">
                                        <!-- <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i> -->
                                    </div>
                                    <div class="input-group" style="margin-left: 1em;">
                                        <input class="input--style-3 js-datepicker" type="date" placeholder="Check-Out " name="check_out">
                                        <!-- <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i> -->
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="text" placeholder="Address" name="address">
                                </div>
                                <div class="p-t-10">
                                    <button class="btn btn--pill btn--green" type="submit" style="float: right;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            </div>
    </div>

    <script>
        $(document).ready(function() { 
          
            $(function() { 
                $( "#my_date_picker" ).datepicker(); 
            }); 
        })
        
        $(document).ready(function() { 
          
          $(function() { 
              $( "#my_date_picker2" ).datepicker(); 
          }); 
      })
    </script> 

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">

        (function ($) {
            "use strict";
        })(jQuery);

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

    </script>

</body>

</html>

