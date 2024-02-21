<?php
session_start();
include("connection.php");
$id = $_GET['id'];
$id2 = $_GET['id2'];
$welcomeMessage = "Welcome, " . $id ." ". $id2;
?>
<!DOCTYPE html>
<html>
<head>

    <title>HISTORY TRANSACTIONS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
<style>
        td {
            text-align: center;
        }
    </style>
</head>

<body style="background-color: #C8C6C6">
<br>
<div class="container-fluid shadow-lg p-3 mb-5 bg-body rounded" style="overflow-x: auto;">
    &nbsp;
    <div style="display: flex; float: right; ">
        <h3 style="margin-right: 20px;"> <?php echo $welcomeMessage; ?></h3>
                <a href="logout.php" class="btn btn-danger">
                    <i class="fa fa-sign-out-alt"></i>
                    <span class="d-none d-sm-inline">Logout</span>
                </a>

         </div>
    <br>
    <br>
        <H1 style="text-align: center" class="h6-responsive text-center">HISTORY TRANSACTION</H1>
    <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" width="100%">
        <thead class="thead-dark" style="text-align: center">
        <tr>
            <th>Date</th>
            <th>Address</th>
            <th>Latest Month Paid</th>
            <th>Year</th>
            <th>Amount</th>
            <th>Official Receipt</th>
        </tr>
        </thead>
        
            <?php

                $servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "masterlist";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }

                $id_acc = "";
                $sql_acc = "SELECT * FROM `records` WHERE Firstname = '$id' && Lastname='$id2'";
                $result = $conn->query($sql_acc);
                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                      $id_acc = $row["ID"];   
                    }
                }

                $sql_Add = "SELECT * FROM `address` WHERE recID = ".$id_acc;
                $resultAdd = $conn->query($sql_Add);
                if ($resultAdd->num_rows > 0) 
                {
                    while($rowAdd = $resultAdd->fetch_assoc()) 
                    {

                $sql = "SELECT * FROM payment WHERE Address = ".$rowAdd['ID']." AND stat = 1 ORDER BY CurrDate DESC ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        echo "<tr>";

                        echo "<td>" . $row["CurrDate"]. "</td>";

                        $sql1 = "SELECT * FROM `records` WHERE ID = '".$rowAdd["recID"]."'";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) 
                        {
                            while($row1 = $result1->fetch_assoc()) 
                            {

                                
						          echo "<td>" . $rowAdd["block"] ."-". $rowAdd["lot"]. "</td>";
                            }
                        }

                        echo "<td>" . $row["Month"]. "</td>";
						echo "<td>" . $row["Year"]. "</td>";
						echo "<td>" . $row["Amount"]. "</td>";
						echo "<td>" . $row["Receipt"]. "</td>";
					
                      
                
                        echo "</tr>";
                    }
                } else {
                    
                }
                    }
                }

                $conn->close();

                ?>
         </table>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>

</body>
</html>








