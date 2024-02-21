<?php
require('top.inc.php');
isAdmin();
$servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "masterlist";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
   
    if($type == 'stat'){

        $stat = $_GET['stat'];
        $id = $_GET['id'];

    if ($stat == 'deactive') {
            $updatestat = "update address set stat= 0 where ID='$id'";
            mysqli_query($conn, $updatestat);
    } else {
            $updatestat1 = "update address set stat= 1 where ID='$id'";
            mysqli_query($conn, $updatestat1);
    }
}

} 

?>

<html>
<head>
  <title>Monthly Dues Monitoring</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">

    <style>
        /* CSS style for center-aligning text in table cells */
        td {
          text-align: center
        }
    </style>
</head>

<body style="background-color: #C8C6C6">
    <br>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">&nbsp
        <center><H1>ARCHIVE HOMEOWNERS</H1></center>
        <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
					
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Latest Payment</th>
					<th>Balances</th>
                    <th>Status</th>
               
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
				$currentMonth = date('n');
                $monthNames = array(
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
);

                $sqlAdd = "SELECT * FROM address WHERE stat = 0";
                $resultAdd = $conn->query($sqlAdd);

                if ($resultAdd->num_rows > 0) {
                    while($rowAdd = $resultAdd->fetch_assoc()) {

                $sql = "SELECT * FROM records WHERE stat = 1 AND ID = " . $rowAdd["recID"];
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $bal = 0;
                        echo "<tr>";
                        echo "<td>" . $row["Firstname"] ." ". $row["Lastname"]. "</td>";
                        echo "<td>" . $rowAdd["block"] ."-". $rowAdd["lot"]. "</td>";              
                
                        $sql1 = "SELECT * FROM `payment` WHERE Address = '".$rowAdd["ID"]."' AND stat = 1 ORDER BY ID DESC LIMIT 1";
                        $result1 = $conn->query($sql1);
                
                        if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                                $monthNumber = $row1['Month'];
                                $monthName = $monthNames[$monthNumber];
                
                                echo "<td>" . $monthName ." ".$row1["Year"]."</td>"; 
                            }
                        } else {
                            echo "<td></td>"; 
                        }

                        $sql_pay = "SELECT * FROM payment WHERE Address =" . $rowAdd["ID"] . " && stat = 0 && Month <= $currentMonth";
                        $result1 = $con->query($sql_pay);
        
                        if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                                $monthNumber = $row1['Month'];
                                $monthName = $monthNames[$monthNumber];
                                $bal+=1;
                            }
                        } else {
                            
                        }
                        
                        $Tbal =  $bal*100;
                        echo "<td>" . $Tbal ."</td>";
						
                        // Add the following lines for the "Status" column as a button
                        echo "<td>";
                        echo "<center>";
                        if($rowAdd['stat'] == 1){
                            echo "<a class='btn btn-info' href='?type=stat&stat=deactive&id=".$rowAdd['ID']."'>Active</a>&nbsp;";
                        }else{
                            echo "<a class='btn btn-danger' href='?type=stat&stat=active&id=".$rowAdd['ID']."'>Deactive</a>&nbsp;";
                        }
                        echo "</center>";
                        echo "</td>";
                        // Display the buttons in the "Actions" column
                                       
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
            $('#example').DataTable();
        });

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
</html>

<?php
require('footer.inc.php');
?>
