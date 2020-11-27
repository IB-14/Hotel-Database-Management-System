<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Records</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="bookRooms.css">
    <link rel="stylesheet" type="text/css" href="util.css">
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="bill.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <style>
        .modal-content {
background-color: #000
}

.padding {
padding: 2rem !important
}

.card {
margin-bottom: 30px;
border: none;
-webkit-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
-moz-box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22);
box-shadow: 0px 1px 2px 1px rgba(154, 154, 204, 0.22)
}

.card-header {
background-color: #fff !important;
border-bottom: 1px solid #e6e6f2 !important;
}


h5 {
font-size: 15px;
line-height: 26px;
color: #3d405c;
margin: 0px 0px 15px 0px;
font-family: 'Circular Std Medium'
}

.text-dark {
color: #3d405c !important
}
    </style>

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
                    //$value = $_SESSION['mid']; 
                    //echo $value; 
                ?></p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bookings</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li class="active">
                            <a href="#">Records</a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="bookRooms.php">Book Rooms</a>
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
                    <h3><span style="margin-left: 4em;">Records</span></h3>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- <div class="searchbox">
                <input class="sboxx" placeholder="Search by Aadhaar No." />
                <i class="fa fa-search sr" aria-hidden="true"></i>
            </div> -->

            <div class="limiter">
                <div class="container-table100">
                    <div class="wrap-table100">
                        <div class="table100">
                            <table>
                                <thead>
                                <tr class="table100-head">
                                        <th class="column1">Adhaar Number</th>
                                        <th class="column2">Room Number</th>
                                        <th class="column3">Name</th>
                                        <th class="column4">State</th>
                                        <th class="column5"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php
                                    $conn= mysqli_connect("localhost","root","","hotelfinal");
                                    if(!$conn){
                                        die("Connection failed: ".mysqli_connect_error());}
                                    $sql= "SELECT b.room_no, c.adhaar_no, CONCAT(c.first_name, ' ', c.LAST_NAME) as name, r.state FROM room r join bookings b on r.room_no = b.room_no join customer_details c on c.adhaar_no = b.adhaar_no";
                                    $result = mysqli_query($conn,$sql);
                                    //echo $result-> mysqli_num_rows(); 
               
                                    $rowcount = mysqli_num_rows($result);                   
                                    if($rowcount > 0){
                                        while($row = $result-> fetch_assoc()){
                                            echo "<tr>";
                                            echo "<td class='column1'>" . $row["adhaar_no"] . "</td><td class='column2'>" . $row["room_no"] . "</td><td class='column3'>". $row["name"]."</td><td class='column4'>". $row["state"]."</td>";
                                            $ro = $row["room_no"];
                                            echo "<td class='column6'>
                                                <button type='submit' class='btn btn-dark' data-toggle='modal' value='".$ro."' data-target='.bd-example-modal-lg'>Bill</button>
                                            </td>";
                                            echo "</tr>";
                                        }
                                        echo "</table>";
                                    } else { echo "0 results"; }
                                    
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
    </div>


<!-- Large modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">


                <header>
                    <h1>Invoice</h1>
                    <address contenteditable spellcheck="false">
                    <?php
                        $query = "SELECT c.first_name, c.adhaar_no, c.address, bi.bill_no, bi.bill, bi.check_in, bi.check_out, b.room_no FROM customer_details c join bookings b on c.adhaar_no = b.adhaar_no join bills bi on c.adhaar_no = bi.adhaar_no where b.room_no = $ro";
                        $result = mysqli_query($conn,$query);
                        $rowall = mysqli_fetch_array($result, MYSQLI_NUM);

                        echo "<p>".$rowall[0]."</p>";
                        echo "<p>".$rowall[1]."</p>";
                        echo "<p>".$rowall[2]."</p>";
                        
                    ?>
                    </address>
                    <span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
                </header>
                <article>
                    <h1>Recipient</h1>
                    <address contenteditable>
                        <img src="TRAVELLER.png" style="width: 250px; height: 60px;">
                    </address>
                    <table class="meta">
                        <tr>
                            <th><span contenteditable>Bill #</span></th>
                            <?php echo "<td><span contenteditable>".$rowall[3]."</span></td>"; ?>
                        </tr>
                        <tr>
                            <th><span contenteditable>Date</span></th>
                            <?php echo "<td><span contenteditable>" . date("d-m-Y") . "</span></td>"; ?>
                        </tr>
                    </table>
                    <table class="inventory">
                        <thead>
                            <tr>
                                <th><span contenteditable>Bill No.</span></th>
                                <th><span contenteditable>Aadhaar No.</span></th>
                                <th><span contenteditable>Check In</span></th>
                                <th><span contenteditable>Room No.</span></th>
                                <th><span contenteditable>Check Out</span></th>
                                <th><span contenteditable>Bill</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php echo
                                "<td><a class='cut'>-</a><span contenteditable>" . $rowall[3] . "</span></td>
                                <td><span contenteditable>" . $rowall[1] . "</span></td>
                                <td><span contenteditable>" . $rowall[5] . "</span></td>
                                <td><span contenteditable>" . $rowall[7] . "</span></td>
                                <td><span>" . $rowall[6] . "</span></td>
                                <td><span data-prefix>₹</span><span>" . $rowall[4] . "</span></td>";
                            ?>
                            </tr>

                        </tbody>
                    </table>
                    <!-- <a class="add">+</a> -->
                    <table class="balance">
                        <tr>
                            <th><span contenteditable>Total</span></th>
                            <?php echo "<td><span data-prefix>₹</span><span>" . $rowall[4] . "</span></td>"; 
                                $conn->close();                            
                            ?>
                        </tr>
                    </table>
                </article>
                <aside>
                    <h1><span contenteditable><br><br><br><br><br><br></span></h1>
                    
                </aside>

          </div>
        </div>
      </div>



    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
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