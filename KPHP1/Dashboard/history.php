<!DOCTYPE html>
<?php
require('top.inc.php');
isAdmin();

$monthNames = array(
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
);
?>
<html>
 <head>
 
   <title>PAYMENTS HISTORY</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <style>
        td{
            text-align: center
        }
    </style>
 </head>
 
 <body style="background-color: #C8C6C6">
    <br>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">&nbsp
        <center><H1>PAYMENT HISTORY</H1></center>
        <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>Date</th>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Month</th>
					<th>Year</th>
					<th>Amount</th>
					<th>Official Receipt</th>
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

                $sql = "SELECT * FROM payment WHERE stat = 1 ORDER BY CurrDate ASC ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        echo "<tr>";

                        echo "<td>" . $row["CurrDate"]. "</td>";
                        
                        $sqlAdd = "SELECT * FROM `address` WHERE ID = '".$row["Address"]."'";
                        $resultAdd = $conn->query( $sqlAdd );

                        if ($resultAdd->num_rows > 0) 
                        {
                            while($rowAdd = $resultAdd->fetch_assoc()) 
                            {

                        $sql1 = "SELECT * FROM `records` WHERE ID = '".$rowAdd["recID"]."'";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) 
                        {
                            while($row1 = $result1->fetch_assoc()) 
                            {

                                echo "<td>" . $row1["Firstname"] ." ". $row1["Lastname"] ."</td>";
						          echo "<td>" . $rowAdd["block"] ."-". $rowAdd["lot"]. "</td>";
                            }
                        }
                        $monthNumber = $row["Month"];
                        $monthName = $monthNames[$monthNumber];
                        echo "<td>" . $monthName. "</td>";
						echo "<td>" . $row["Year"]. "</td>";
						echo "<td>" . $row["Amount"]. "</td>";
						echo "<td>" . $row["Receipt"]. "</td>";
					
                      
                
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
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
        $(document).ready(function() 
        {
            $('#example').DataTable();
        } );

        document.getElementById("AUser").style.display="none";
        function myFunction() {
        var x = document.getElementById("AUser");
        if (x.style.display === "none") 
        {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        }
    </script>
    
</body>