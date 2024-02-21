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
    if ($type == 'delete') {
        $stat = $_GET['stat'];
        $id = $_GET['id'];
        
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



if (isset($_GET['block'])) {
    $selectedBlock = $_GET['block'];

    for ($lot = 1; $lot <= 100; $lot++) {
        $sql_lot = "SELECT * FROM `address` WHERE block = $selectedBlock AND lot = $lot";
        $result = $conn->query($sql_lot);

        if ($result->num_rows == 0) {
            echo "<option value='$lot'>$lot</option>";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
    <style>
        .action-button {
            margin-right: 10px;
        }
        .table-centered td {
            text-align: center;
        }
    </style>

</head>
<body style="background-color: #C8C6C6">
    <br>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">&nbsp
        <center><H1>MASTERLIST</H1></center>
        <table id="example" class="table table-centered table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>Fullname</th>
                    <th>Address</th>
                    <th>Latest Payment</th>
					<th>Amount</th>
                    <th>Status</th>
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
                
                $currentMonth = date('n');
                $monthNames = array(
                    1 => "January", 2 => "February", 3 => "March", 4 => "April",
                    5 => "May", 6 => "June", 7 => "July", 8 => "August",
                    9 => "September", 10 => "October", 11 => "November", 12 => "December"
                );


                $sql_add = "SELECT * FROM address WHERE stat = 1";
                $resultAdd = $conn->query($sql_add);

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
                            echo "<td> - </td>"; 
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

						if($rowAdd['stat'] == 1){
                            echo "<a class='btn btn-info' href='?type=stat&stat=deactive&id=".$rowAdd['ID']."'>Active</a>&nbsp;";
                        }else{
                            echo "<a class='btn btn-danger' href='?type=stat&stat=active&id=".$rowAdd['ID']."'>Deactive</a>&nbsp;";
                        }

                        echo "</td>";
                        // Display the buttons in the "Actions" column
                        echo "<td>"; 
                        echo "<center>";
                        echo "<a href='Update.php?id=" . $row['ID'] . "' class='btn btn-success action-button'>UPDATE</a>";
                        echo "<a href='Email/send.php?id=" . $row['ID'] . "' class='btn btn-danger action-button'>SEND EMAIL</a>";
						echo "<a href='Payment.php?id=" . $rowAdd["ID"] . "' class='btn btn-info action-button'>PAYMENT</a>";
					
                        echo "</center>";
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

    <hr>

    <div class="row">
        <div style="padding-left: 15px">
            <h3>ADD NEW HOMEOWNERS :</h3>
        </div>
        <div style="padding-left: 15px">
            <button class="btn btn-primary" onclick="myFunction()">NEW HOMEOWNERS</button>
        </div>
    </div>
    <hr>
     <div class="row">
        <div style="padding-left: 15px">
            <h3>BUY ANOTHER UNIT :</h3>
        </div>
        <div style="padding-left: 15px">
            <button class="btn btn-primary" onclick="myFunction1()">EXISING HOMEOWNERS</button>
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
        <center><H1>REGISTER A NEW HOMEOWNERS</H1></center>&nbsp
            <form name="Control" method="post" action="add.php?id=<?php echo $row['ID']; ?>">
                <div class="row">
                    <div class="col">
                        <h4>First Name</h4>
                        <input type="text" name="firstName" placeholder="Enter First Name" required="" class="form-control">
                        <br>
                        <h4>Block</h4>
                    <select name="Block" id="blockDropdown" class="form-control">
                        <option>Select Block</option>
                        <?php
                            $counter = 0;
                            $block = 1;

                            While($block <= 13){

                            $sql_block = "SELECT Count(ID) as ID FROM `address` WHERE block =$block";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) 
                            {
                            while($row = $result->fetch_assoc()) 
                            {
                                $counter = $row['ID'];
                            }
                            }

                            if($counter == 100){

                            }else{
                                echo "<option name='drop' value='".$block."''>".$block."</option>";
                            }

                            $block += 1;
                            }
                        ?>
                    </select>
                    <br>
                        <h4>Email</h4>
                        <input type="email" name="email" placeholder="Enter Email" required="" class="form-control">
                    </div>      
                    <div class="col">
                        <h4>Last Name</h4>
                        <input type="text" name="lastName" placeholder="Enter Last Name" required="" class="form-control">
                        <br>
                        <h4>Lot</h4>
                    <select name="Lot" id="lotDropdown" class="form-control">
                        <option>Select Lot</option>
                    </select>
                    </div>
                    </div>
                 <input type="submit" name="ADD" class="btn btn-primary mt-4" value="ADD" onclick="return confirmUserCreation();">
            </form>
        </div>

        <div id="AUser1">
        <hr>
        <center><H1>BUYING NEW UNIT</H1></center>&nbsp
            <form name="Control" method="post" action="add1.php">
                <div class="row">
                    <div class="col">
                        <h4>Name</h4>
                        <select name = "Name" class="form-control">
                        <option>Homeowner Records</option>
                            <?php 

                                $sqlInfo = "SELECT * FROM `records`";
                                $resultInfo = $conn->query($sqlInfo);

                                if ($resultInfo->num_rows > 0) 
                                {
                                while($rowInfo = $resultInfo->fetch_assoc()) 
                                {
                                    echo "<option value='".$rowInfo['ID']."'>".$rowInfo['Firstname']." ".$rowInfo['Lastname']."</option>";
                                }
                                }

                            ?>
                        </select>
                        <br>
                        <h4>Block</h4>
                    <select name="Block1" id="blockDropdown1" class="form-control">
                        <option>Select Block</option>
                        <?php
                            $counter = 0;
                            $block = 1;

                            While($block <= 13){

                            $sql_block = "SELECT Count(ID) as ID FROM `address` WHERE block =$block";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) 
                            {
                            while($row = $result->fetch_assoc()) 
                            {
                                $counter = $row['ID'];
                            }
                            }

                            if($counter == 100){

                            }else{
                                echo "<option name='drop' value='".$block."''>".$block."</option>";
                            }

                            $block += 1;
                            }
                        ?>
                    </select>
                    </div>      
                    <div class="col">
                        <h4>Lot</h4>
                    <select name="Lot1" id="lotDropdown1" class="form-control">
                        <option>Select Lot</option>
                    </select>
                    </div>
                    </div>
                 <input type="submit" name="ADD" class="btn btn-primary mt-4" value="ADD" onclick="return confirmUserCreation();">
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
    const blockDropdown = document.getElementById('blockDropdown');
    const lotDropdown = document.getElementById('lotDropdown');
    
    blockDropdown.addEventListener('change', function () {
        const selectedBlock = blockDropdown.value;

        if (selectedBlock !== 'Block') {
            // Clear existing options
            lotDropdown.innerHTML = '<option>Loading...</option>';

            // Make an asynchronous request to get Lot values
            fetch(`?block=${selectedBlock}`)
                .then(response => response.text())
                .then(data => {
                    lotDropdown.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching Lot values:', error);
                });
        } else {
            lotDropdown.innerHTML = '<option>Lot</option>';
        }
    });
</script>

<script>
    const blockDropdown1 = document.getElementById('blockDropdown1');
    const lotDropdown1 = document.getElementById('lotDropdown1');
    
    blockDropdown1.addEventListener('change', function () {
        const selectedBlock1 = blockDropdown1.value;

        if (selectedBlock1 !== 'Block') {
            // Clear existing options
            lotDropdown1.innerHTML = '<option>Loading...</option>';

            // Make an asynchronous request to get Lot values
            fetch(`?block=${selectedBlock1}`)
                .then(response => response.text())
                .then(data => {
                    lotDropdown1.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching Lot values:', error);
                });
        } else {
            lotDropdown1.innerHTML = '<option>Lot</option>';
        }
    });
</script>

    <script>
    const blockDropdown = document.getElementById('blockDropdown');
    const lotDropdownContainer = document.getElementById('lotDropdownContainer');

    blockDropdown.addEventListener('change', function () {
        if (blockDropdown.value !== 'Block') {
            lotDropdownContainer.style.display = 'block';
            // You can also set the selected block value to the Lot dropdown
            // by accessing the "value" attribute of the selected option.
        } else {
            lotDropdownContainer.style.display = 'none';
        }
    });
    </script>

    <script>
        $(document).ready(function() 
        {
            $('#example').DataTable();
        } );

        document.getElementById("AUser").style.display="none";
        document.getElementById("AUser1").style.display="none";
        function myFunction() {
        var x = document.getElementById("AUser");
        if (x.style.display === "none") 
        {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        }

        function myFunction1() {
        var y = document.getElementById("AUser1");
        if (y.style.display === "none") 
        {
            y.style.display = "block";
        } else {
            y.style.display = "none";
        }
        }
    </script>
    <script>
    const blockDropdown = document.getElementById('blockDropdown');
    const lotDropdown = document.getElementById('lotDropdown');

    blockDropdown.addEventListener('change', function () {
        const selectedBlock = blockDropdown.value;
        const selectedLot = lotDropdown.value;

        if (selectedBlock !== 'Select Block' && selectedLot !== 'Select Lot') {
            // Make an asynchronous request to check if the combination is occupied
            fetch(`check_occupancy.php?block=${selectedBlock}&lot=${selectedLot}`)
                .then(response => response.json())
                .then(data => {
                    if (data.occupied) {
                        alert('This block and lot combination is already occupied. Please choose another.');
                        // Reset the lot dropdown to the default value
                        lotDropdown.value = 'Select Lot';
                    }
                })
                .catch(error => {
                    console.error('Error checking occupancy:', error);
                });
        }
    });
</script>
<script>
function confirmUserCreation() {
    // Display a confirmation dialog
    if (confirm('If the information is correct, click "OK" to create a new user.')) {
        // User confirmed, allow the form submission
        return true;
    } else {
        // User canceled, prevent the form submission
        return false;
    }
}
</script>


    
</body>
</html>
<?php
require('footer.inc.php');
?>