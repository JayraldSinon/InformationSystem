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
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
 </head>
 <body>
 
 
 
 <div id="AUser">
        <hr>
        <center><H1>PAYMENT</H1></center>&nbsp
            <form name="Control" method="post" action="Ins.php">
                <div class="row">
                    <div class="col">
                        <h4>Address</h4>
                        <input type="text" name="Address" placeholder="Enter Address" required="" class="form-control">
                        <br>
                        <h4>Month</h4>
                        <input type="text" name="Month" placeholder="Enter Month" required="" class="form-control">
						<br>
						 <h4>Receipt</h4>
                        <input type="number" name="Receipt" placeholder="Enter OR Number" minlength="10" required="" class="form-control">
                    </div>      
                    <div class="col">
                        <h4>Year</h4>
                        <input type="number" name="Year" placeholder="Enter Year" required="" class="form-control">
                        <br>
                        <h4>Amount</h4>
                        <input type="number" name="Lot" placeholder="Enter Amount" minlength="10" required="" class="form-control">
						
                    </div>
                </div>
                 <input type="submit" name="ADD" class="btn btn-primary mt-4" value="ADD">
            </form>
        </div>
		
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
	
	
		
	</body>
</html>