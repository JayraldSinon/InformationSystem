<?php
require('top.inc.php');
isAdmin();
?>

<html>
<head>
  <title>Monthly Dues Monitoring</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">

    <style>
        /* CSS style for center-aligning text in table cells */
        .center-text {
            text-align: center;
        }
    </style>
</head>

<body style="background-color: #C8C6C6">
    <br>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">&nbsp
        <center><H1>VACANT UNIT</H1></center>
        <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th class="center-text">Block</th>
                    <th class="center-text">Lot</th>
                    <th class="center-text">Occupancy Status</th> 
                </tr>
            </thead> 
        
            <?php

                $block = 1;
                $lot = 1;

                $servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "masterlist";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }

                while ($block <= 12) {
                    $lot = 1;
            
                    while ($lot <= 100) {
                        echo "<tr>";
                        $counter = true;
            
                        $sql_vacant = "SELECT * FROM `address` WHERE block = $block AND lot = $lot";
                        $result1 = $conn->query($sql_vacant);
                        if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                            }
                            $counter = false;
                        }
            
                        if ($counter) {
                            echo "<td class='center-text'>" . $block . "</td>";
                            echo "<td class='center-text'>" . $lot . "</td>";
                            echo "<td class='center-text'>Vacant</td>"; 
                        } else {
                            // You can add code here if needed for other cases
                        }
            
                        echo "</tr>";
            
                        $lot += 1;
                    }
            
                    $block += 1;
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
