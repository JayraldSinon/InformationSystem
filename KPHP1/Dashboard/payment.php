<!DOCTYPE html>
<?php
require('top.inc.php');
isAdmin();

$info = "Name | Address";
$bal = "Pending";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_add = "SELECT recID, block, lot FROM `address` WHERE ID = '$id'";
    $result = mysqli_query($con, $sql_add);
    $row = mysqli_fetch_assoc($result);
    $recID = $row['recID'];

    $sql_rec = "SELECT Firstname, Lastname FROM `records` WHERE ID = '$recID'";
    $result = mysqli_query($con, $sql_rec);
    $row1 = mysqli_fetch_assoc($result);
    $info = $row1['Firstname']." ".$row1['Lastname']." | ".$row['block']."-".$row['lot'];

}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $bal = 0;
    $penMonths = "";

    $sqlAdd = "SELECT * FROM address WHERE ID = $id";
    $resultAdd = $con->query($sqlAdd);

    if ($resultAdd->num_rows > 0) {
        while ($rowAdd = $resultAdd->fetch_assoc()) {

    $sql = "SELECT * FROM records WHERE ID = ".$rowAdd['recID'];
    $result = $con->query($sql);
    $currentMonth = date('n');
    $monthNames = array(
    1 => "January", 2 => "February", 3 => "March", 4 => "April",
    5 => "May", 6 => "June", 7 => "July", 8 => "August",
    9 => "September", 10 => "October", 11 => "November", 12 => "December"
    );

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
              
        $sql_pay = "SELECT * FROM payment WHERE Address =" . $rowAdd["ID"] . " && stat = 0 && Month <= $currentMonth";
        $result1 = $con->query($sql_pay);
        
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $monthNumber = $row1['Month'];
                $monthName = $monthNames[$monthNumber];
                $bal+=1;
                $penMonths = $penMonths ."". $monthName . " " . $row1['Year'] . " - ";
            }
        } else {
            echo "<td></td>";
        }
        
    }
} else {
    echo "0 results";
}
        }
    } else {
        echo "0 results";
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
        <div class="container">
        <hr>
        <center><H1>PAYMENT</H1></center>&nbsp
            <form name="Control" method="post" action="Ins.php?id=<?php echo $id; ?>">
                <div class="row">
                    <div class="col-md-6">
					
                    <h4>Information</h4>
                        <input type="text" name="Information" id="Information" value="<?php echo $info; ?>" minlength="10" required="" class="form-control">
                  
                        <br>
                        <h4>Month</h4>
                        <select name = "months" class="form-control">
                            <option value="1">January</option>
                            <option value="2">Febuary</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
						<br>
						<h4>Year</h4>
                        <input type="number" name="Year" placeholder="Enter Year" required="" class="form-control">
						</div>      
                     <div class="col-md-6">
                        <h4>Outstanding Balance</h4>
                        <input type="text" name="Outstanding Balance" value="<?php echo $bal*100; ?>
                        " minlength="10" required="" class="form-control">
						<br>
                        <h4>Pending Months</h4>
                        <input type="text" name="Pending Months"  value="<?php echo $penMonths ?>" minlength="10" required="" class="form-control">
						<br>
                        <h4>Receipt</h4>
                        <input type="number" name="Receipt" placeholder="Enter OR Number" minlength="10" required="" class="form-control">
                        <br>
                        <h4>Amount</h4>
                        <input type="number" name="Amount" placeholder="Enter Amount" minlength="10" required="" class="form-control">
                    </div>
                </div>
                 <input type="submit" name="ADD" class="btn btn-primary mt-4" id="doubleCheckButton" value="PAY">
            </form>
        </div>
    </div>
		
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
	
    <script>
        // Add an event listener to the "ID" input field
        const addressInput = document.getElementById('Address');
        const informationInput = document.getElementById('Information');
		
		
        addressInput.addEventListener('input', function() {
            // Get the value of the "ID" input field
            const idValue = this.value;

            // Make an asynchronous request to the server to fetch information based on the entered ID
            fetch('fetch.php?id=' + idValue) // Replace 'fetch_info.php' with your server-side script
                .then(response => response.text())
                .then(data => {
                    // Update the "Information" input field with the fetched data
                    informationInput.value = data;
                })
                .catch(error => {
                    console.error('Error fetching information:', error);
                });
        });
        // Add an event listener to the "Double Check & PAY" button
    const doubleCheckButton = document.getElementById('doubleCheckButton');
    doubleCheckButton.addEventListener('click', function (event) {
        // Get the value of the "Information" input field
        const informationValue = informationInput.value;

        // Check if the information is correct (customize this check as needed)
        if (informationValue === "Name | Address") {
            // The information is incorrect, display an alert
            alert('Please provide correct information.');
            event.preventDefault(); // Prevent the form from submitting
        } else {
            // The information is correct, ask for confirmation
            const confirmation = confirm('Is the information correct? Click OK to submit or Cancel to cancel.');

            if (!confirmation) {
                event.preventDefault(); // Prevent the form from submitting
            }
        }
    });
    </script>

	</body>
</html>

<?php
require('footer.inc.php');
?>