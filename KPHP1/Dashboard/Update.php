<?php
	$id=$_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Monthly Dues Monitoring</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<br>
<body style="background-color: #C8C6C6">
	<div class="container shadow-lg p-3 mb-5 bg-body rounded">&nbsp
            <div class="container mt-6">
            <a href="dashboard.php" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to masterlist page
            </a>
            </div>
        <center><H1>UPDATE</H1></center>

        <table id="example" class="table table-dark table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>Fullname</th>
                    <th>Email</th>
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

                $sql = "SELECT * FROM records WHERE ID = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) 
                {
                    while($row = $result->fetch_assoc()) 
                    {
                        echo "<tr>";
                        echo "<td>" . $row["Firstname"] ." ". $row["Lastname"]. "</td>";
						echo "<td>" . $row["email"] ."</td>";
                        echo "</tr>";
						
						
						
                    }
                } 

                $conn->close();

            ?>
        </table>

        <hr>
        <center><H1>New Information</H1></center>
        <div>
            <form name="Control" method="post" action="UpdateSub.php?id=<?php echo $id; ?>">
                 <div class="row">
                    <div class="col">
                        <h4>First Name</h4>
                        <input type="text" name="firstName" placeholder="Enter First Name" class="form-control">
                        <br>
                        <h4>Email</h4>
                        <input type="email" name="email" placeholder="Enter Email" required="" class="form-control">
                    </div>      
                    <div class="col">
                        <h4>Last Name</h4>
                        <input type="text" name="lastName" placeholder="Enter Last Name" class="form-control">
                        <br>
                       
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <input type="submit" name="EDIT" class="btn  btn-block btn-success mt-4" value="EDIT">
                    </div>
                <div class="col-lg-6 text-center">
                        <?php echo "<a href='delete.php?id=".$id."' class='btn btn-info btn-block mt-4'>MAKE VACANT</a>"; ?>
                </div>
                </div>
				
            </form>
	   </div>
</body>
</html>