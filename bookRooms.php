<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Book Rooms</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="bookRooms.css">
    <link rel="stylesheet" type="text/css" href="util.css">
	<link rel="stylesheet" type="text/css" href="main.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Greetings Manager!</h3>
            </div>

            <ul class="list-unstyled components">
                <p style="text-align: center;">
                <?php 
                    session_start(); 
                    if (isset($_SESSION['mid'])) {
                        echo $_SESSION['mid'];}
                ?>
                </p>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bookings</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="Records.php">Records</a>
                        </li>
                        <li>
                            <a href="#">Advanced Search</a>
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

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button> -->
                    <h3><span style="margin-left: 4em;">Book Rooms</span></h3>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="limiter">
                <div class="container-table100" style="align-items: center;">
                    <div class="wrap-table100">
                        <div class="table100">
                            <table>
                                <thead>
                                    <tr class="table100-head">
                                        <th class="column1">Room Number</th>
                                        <th class="column2">Location</th>
                                        <th class="column3">Room Type</th>
                                        <th class="column4">Rating</th>
                                        <th class="column5">Rent</th>
                                        <th class="column6"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <form method='post' action='booking.php'>
                                <?php
                                    $conn= mysqli_connect("localhost","root","","hotelfinal");
                                    if(!$conn){
                                        die("Connection failed: ".mysqli_connect_error());}
                                    $sql= "SELECT room_no, position, room_type, remark, rent FROM room where state='vacant'";
                                    $result = mysqli_query($conn,$sql);
                                    //echo $result-> mysqli_num_rows(); 
               
                                    $rowcount = mysqli_num_rows($result);   

                                    if($rowcount > 0){

                                        while($row = $result-> fetch_assoc()){

                                            echo "<tr>";
                                            echo "<td class='column1'>" . $row["room_no"] . "</td><td class='column2'>" . $row["position"] . "</td><td class='column3'>". $row["room_type"]."</td>";
                                            
                                            if($row["remark"]=="3"){
                                                echo "<td class='column4'>". 
                                                "<div class='rating'>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star'></span>
                                                    <span class='fa fa-star'></span>
                                                </div></td>";
                                            }
                                            if($row["remark"]=="2"){
                                                echo "<td class='column4'>". 
                                                "<div class='rating'>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star'></span>
                                                    <span class='fa fa-star'></span>
                                                    <span class='fa fa-star'></span>
                                                </div></td>";
                                            }
                                            if($row["remark"]=="1"){
                                                echo "<td class='column4'>". 
                                                "<div class='rating'>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star'></span>
                                                    <span class='fa fa-star'></span>
                                                    <span class='fa fa-star'></span>
                                                    <span class='fa fa-star'></span>
                                                </div></td>";
                                            }
                                            if($row["remark"]=="4"){
                                                echo "<td class='column4'>". 
                                                "<div class='rating'>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star'></span>
                                                </div></td>";
                                            }
                                            if($row["remark"]=="5"){
                                                echo "<td class='column4'>". 
                                                "<div class='rating'>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                    <span class='fa fa-star checked'></span>
                                                </div></td>";
                                            }
                     
                                            $amtroom = $row["room_no"];

                                            echo "<td class='column5'>". $row["rent"]. "
                                            </td><td class='column6'>
                                            <button type='submit' value='".$amtroom."' name='bro' class='btn btn-dark'>Book</button>
                                            
                                            </td>";

                                            echo "</tr>";
                                        }
                                    echo "</table>";
                                    } else { echo "0 results"; }

                                    
                                    $conn->close();
                                ?></form>
                                
                                        
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
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