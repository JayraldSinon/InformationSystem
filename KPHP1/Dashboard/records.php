<?php
date_default_timezone_set("Asia/Manila");
require('top.inc.php');
isAdmin();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Monthly Dues Monitoring</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">

</head>
<body style="background-color: #C8C6C6">
    <br>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">&nbsp
        <center><H1>LIST OF PENDING PAYMENTS</H1></center>
        <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Pending Payments</th>
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

$sqlAdd = "SELECT * FROM address";
$resultAdd = $conn->query($sqlAdd);
if ($resultAdd ->num_rows > 0) {
    while ($rowAdd = $resultAdd ->fetch_assoc()) {


$sql = "SELECT * FROM records where ID =". $rowAdd["recID"];
$result = $conn->query($sql);
$currentMonth = date('n');
$monthNames = array(
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Lastname"] .", ". $row["Firstname"] ."</td>";
        echo "<td>" . $rowAdd["block"] ."-". $rowAdd["lot"]. "</td>";
        echo "<td>";
        
        $sql_pay = "SELECT * FROM payment WHERE Address =" . $rowAdd["ID"] . " && stat = 0 && Month <= $currentMonth";
        $result1 = $conn->query($sql_pay);
        
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $monthNumber = $row1['Month'];
                $monthName = $monthNames[$monthNumber];
                echo $monthName . " " . $row1['Year'] . " - ";
            }
        } else {
            echo "NO PENDING PAYMENTS";
        }
        
        echo "</td>";
        echo "</tr>";
    }

} else {
    echo "0 results";
}
    }

} else {
    echo "0 results";
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
</html>

<?php
require('footer.inc.php');
?>