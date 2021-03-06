<?php  
session_start();  
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrator</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/ava.ico" />
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">MAIN MENU </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="room.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a class="active-menu" href="room.php"><i class="fa fa-plus-circle"></i>Add Room</a>
                    </li>
                    <li>
                        <a class="" href="service.php"><i class="fa fa-plus-circle"></i>Add Service</a>
                    </li>
            </div>
        </nav>


        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            NEW ROOM <small></small>
                        </h1>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                ADD NEW ROOM
                            </div>
                            <div class="panel-body">
                                <form name="form" method="post">
                                    <div class="form-group">
                                        <label>Room ID</label>
                                        <input type="text" name="newroomid" class="form-control"
                                            placeholder="Enter Room ID">
                                    </div>
                                    <div class="form-group">
                                        <label>Type Of Room *</label>
                                        <select name="newroomtype" class="form-control" required>
                                            <option value="Normal Room">NORMAL ROOM</option>
                                            <option value="VIP Room">VIP ROOM</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Bedding Type</label>
                                        <select name="newroombed" class="form-control" required>
                                            <option value="Single">Single</option>
                                            <option value="Double">Double</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Price/day</label>
                                        <input type="float" name="newroomprice" class="form-control"
                                            placeholder="Enter Room Price">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="newroomstatus" class="form-control" required>
                                            <option value="ready">Ready</option>
                                            <option value="booked">Booked</option>
                                            <option value="using">Using</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <input type="text" name="newroomnote" class="form-control"
                                            placeholder="Enter Room Note">
                                    </div>

                                    <input type="submit" name="add" value="Add New" class="btn btn-primary">
                                </form>
                                <?php
							include('db.php');
							if(isset($_POST['add']))
							{
								$roomid = $_POST['newroomid'];
								$roomtype = $_POST['newroomtype'];
								$roombed = $_POST['newroombed'];
								$roomprice = $_POST['newroomprice'];
                                $roomstatus = $_POST['newroomstatus'];
                                $roomnote = $_POST['newroomnote'];

								$check="SELECT * FROM room WHERE roomid = '$roomid' ";
								$rs = mysqli_query($conn,$check);
								$data = mysqli_num_rows($rs);                                
								if($data > 0) {
									echo "<script type='text/javascript'> alert('Room Already in Exists')</script>";
											
								} else {
                                    
                                        $sql ="INSERT INTO `room`(`roomID`, `type`, `bedding`, `price`, `status`, `note`) VALUES ('$roomid','$roomtype','$roombed','$roomprice','$roomstatus','$roomnote')" ;
                                        if(mysqli_query($conn,$sql))
                                        {
                                            echo '<script>alert("New Room Added") </script>' ;
                                        } else {
                                            echo '<script>alert("Sorry! Check The System") </script>' ;
                                        }                                    
							    }
                            
							}
							?>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-7 col-sm-7">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                ROOMS INFORMATION
                            </div>
                            <div class="panel-body">
                                <div class="panel panel-default">

                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover"
                                                id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Type</th>
                                                        <th>Bedding</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Note</th>
                                                        <th>Update</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php                                    
                                        $sql = "select * from room";
                                        $result = mysqli_query($conn,$sql);                                    
										while($row= mysqli_fetch_array($result))
										{
                                            $roomid = $row['roomID'];
											$roomtype = $row['type'];
											$roombed = $row['bedding'];
                                            $roomprice = $row['price'];
                                            $roomstatus = $row['status'];
                                            $roomnote = $row['note'];
                                            echo "<tr>
											    <th>".$roomid."</th>
											    <th>".$roomtype."</th>
											    <th>".$roombed."</th>
											    <th>".$roomprice."</th>
											    <th>".$roomstatus."</th>
											    <th>".$roomnote."</th>	
                                                <td><a href='roomupdate.php?id=$roomid'><button class='btn btn-primary'> <i class='fa fa-edit' ></i> Update</button></a></td>										
                                                <td><a href='roomdel.php?id=$roomid'><button class='btn btn-danger'> <i class='far fa-trash-alt'></i> Delete</button></a></td>										
											    </tr>";
										}
									?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog"
                                aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Add New Customer</h4>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Customer Name</label>
                                                    <input name="newcn" class="form-control" id="name123"
                                                        placeholder="Enter Customer Name">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>ID Card</label>
                                                    <input name="newidc" class="form-control" id="idc"
                                                        placeholder="Enter ID Card">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select name="newgd" class="form-control">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input name="newad" class="form-control" id="province"
                                                        placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input name="newpn" class="form-control" id="phone"
                                                        placeholder="Enter Phone Number">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nationality</label>
                                                    <input name="newna" class="form-control" id="Vietnamese"
                                                        placeholder="Enter Nationality">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input name="newem" class="form-control" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <input name="newnote" class="form-control" placeholder="Enter Note">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <input type="submit" name="addnew" value="Add" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                                    if(isset($_POST['addnew']))
                                    {
                                            
                                        $newcname = $_POST['newcn'];                            
                                        $newcidcard = $_POST['newidc'];
                                        $newcgender = $_POST['newgd'];
                                        $newcaddress = $_POST['newad'];
                                        $newcphonenumber = $_POST['newpn'];
                                        $newcnationality = $_POST['newna'];
                                        $newcemail = $_POST['newem'];
                                        $newcnote = $_POST['newnote'];

                                        $newsql ="INSERT INTO customer(customerName, idCard, gender, address, phoneNumber, nationality, email, note) VALUES ('$newcname','$newcidcard','$newcgender','$newcaddress','$newcphonenumber','$newcnationality','$newcemail','$newcnote')";
                                        echo $newsql;
                                            
                                        if(mysqli_query($conn,$newsql))
                                        {
                                            echo "<script language='javascript' type='text/javascript'> alert('Add customer success!') </script>";
                                        }
                                        header("Location: customer.php");
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- JS Scripts-->
        <!-- jQuery Js -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- Bootstrap Js -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Metis Menu Js -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- Custom Js -->
        <script src="assets/js/custom-scripts.js"></script>
        <!-- DATA TABLE SCRIPTS -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
        </script>


</body>

</html>