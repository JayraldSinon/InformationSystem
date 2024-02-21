<!DOCTYPE html>
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
if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = $_GET['type'];
    if ($type == 'delete') {
        $stat = $_GET['stat'];
        $id = $_GET['id'];
        if ($stat == 'active') {
            $status = '1';
        } else {
            $status = '2';
        }

        // Check if the confirmation has already been performedpp
        if (!isset($_GET['confirm'])) {
            // Add a confirmation message using JavaScript
            $confirmMessage = "Are you sure you want to delete this data?";
            $confirmScript = "if (confirm('$confirmMessage')) { 
                window.location.href = '?type=delete&stat=$stat&id=$id&confirm=1'; 
            }";

            // Output the confirmation script
            echo "<script>$confirmScript</script>";
        } else {
            // Perform the update operation
            $update_status_sql = "Delete from records where ID=('$id')";
            mysqli_query($conn, $update_status_sql);
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

</head>
<body style="background-color: #C8C6C6">
    <br>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">&nbsp
        <center><H1>MASTERLIST</H1></center>
        <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Latest Payment</th>
                    <th>Year</th>
					<th>Amount</th>
                    <th>Actions</th>
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

                $sql = "SELECT * FROM records";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        echo "<tr>";
                        echo "<td>" . $row["Firstname"] ." ". $row["Lastname"]. "</td>";
						echo "<td>" . $row["Block"] ."-". $row["Lot"]. "</td>";
                        echo "<td>" . $row["LatestPayment"]. "</td>";
						echo "<td>" . $row["Year"]. "</td>";
                        echo "<td>" . $row["Amount"]. "</td>"; ?>
            
                        <td> 
                        <center>
                        <a href="Update.php?id=<?php echo $row['ID']; ?>" class="btn btn-success" >UPDATE</a> 
                        <?php echo "<a href='?type=delete&stat=deactive&id=".$row['ID']."' class='btn btn-info'>DELETE</a>"; ?>
						<a href="midterm_SanchezDel.php?id=<?php echo $row['ID']; ?>"  class="btn btn-info" >SEND EMAIL</a>						
                        </center>
                        </td>

                <?php
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }

                $conn->close();

                ?>
        </table>

    <hr>

    <div class="row">
        <div style="padding-left: 15px">
            <h3>Add User :</h3>
        </div>
        <div style="padding-left: 15px">
            <button class="btn btn-primary" onclick="myFunction()">Add User</button>
        </div>
    </div>

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

        $sql = "SELECT MAX(ID) AS ID FROM records";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            { 
            ?>

    <div id="AUser">
        <hr>
        <center><H1>ADD USER</H1></center>&nbsp
            <form name="Control" method="post" action="Ins.php?id=<?php echo $row['ID']; ?>">
                <div class="row">
                    <div class="col">
                        <h4>First Name</h4>
                        <input type="text" name="firstName" placeholder="Enter First Name" required="" class="form-control">
                        <br>
                        <h4>Block</h4>
                        <input type="number" name="Block" placeholder="Enter Block" required="" class="form-control">
                    </div>      
                    <div class="col">
                        <h4>Last Name</h4>
                        <input type="text" name="lastName" placeholder="Enter Last Name" required="" class="form-control">
                        <br>
                        <h4>Lot</h4>
                        <input type="number" name="Lot" placeholder="Enter Lot" minlength="10" required="" class="form-control">
                    </div>
                </div>
                 <input type="submit" name="ADD" class="btn btn-primary mt-4" value="ADD">
            </form>
        </div>

        <?php
            }
        } else {
            echo "0 results";
        }

            $conn->close();

        ?>

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