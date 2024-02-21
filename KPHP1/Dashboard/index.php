<?php
require('top.inc.php');
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .officers-section {
            margin-top: 20px;
        }
        .officers-card {
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            color: #000;
        }
        .officers-card-body {
            padding: 20px;
        }
        .logo {
            display: block;
            margin: 0 auto;
            width: 250px;
			margin-bottom: -70px;
        }
        h4.officers-box-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #000;
        }
        .officers-list {
            list-style-type: none;
            padding-left: 0;
        }
        .officers-list-item {
            margin-bottom: 20px;
            padding: 5px;

        }
        .officers-list-item p {
            margin: 0; 
            font-size: 16px;
            line-height: 1.4;
            
        }
        .officers-list-item:last-child {
            margin-bottom: 0;
        }
        .officers-columns {
            column-count: 2;
        }
		.about-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #000;
			
        }
        .about-description {
            font-size: 24px;
            line-height: 1.6;
            margin-bottom: 40px;
			background-color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>

<?php
date_default_timezone_set("Asia/Manila");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "masterlist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
}

$currYear = date('Y');  
$currDay =  date('d'); 
$currMonth = date('F');
$currMonthN = date('n');
$currDate = date("Y-m-d");

$months = array(
        1 => "January", 2 => "February", 3 => "March", 4 => "April",
        5 => "May", 6 => "June", 7 => "July", 8 => "August",
        9 => "September", 10 => "October", 11 => "November", 12 => "December"
    );
foreach ($months as $monthNumber => $monthName) {

    if($currMonthN <= $monthNumber){
        $sql_rec = "SELECT * FROM address";
        $result = $conn->query($sql_rec);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $sql_pend = "SELECT * FROM payment WHERE Address = ".$row['ID']."&& Month = '$monthNumber' && Year = '$currYear'";
                $result1 = $conn->query($sql_pend);
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                    }
                }else{
                    $sql7 = "INSERT INTO `payment` (`ID`, `Address`, `Month`, `Year`, `Amount`, `Receipt`, `CurrDate`, `stat`) VALUES (NULL, ".$row['ID'].", '$monthNumber', '$currYear', NULL, NULL, '$currDate', '0');";
                    mysqli_query($conn, $sql7);
                }

            }

        }
    }

}

?>
<div class="content">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card officers-card"> 
                    <div class="card-body">
                        <img src="images/logo12.png" alt="Logo" class="logo"> 
                        <h2 class="about-title"><strong>About Us<strong></h2>
                        <p class="about-description">Welcome to Karlaville Parkhomes Phase 1! We are proud to introduce the dedicated team of officers who help manage and maintain our vibrant community.</p>
                        
                        <h5><strong>Meet Our Officers:</strong></h5><br>
                        <div class="officers-columns">
                            <ul class="officers-list">
                                <li class="officers-list-item"><p>Cristina G. Bello - President</p></li>
                                <li class="officers-list-item"><p>Nixon F. Macanas - Vice President</p></li>
                                <li class="officers-list-item"><p>Mylene D. Formaran - Secretary</p></li>
                                <li class="officers-list-item"><p>Teodora C. Dumagan - Treasurer</p></li>
                                <li class="officers-list-item"><p>Ernie S. Onofre - Auditor</p></li>
                            </ul>
                            <ul class="officers-list">
                                <li class="officers-list-item"><p>Teodoro S. Vista - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Jerry F. Mindanao - Board Of Directors</p></li>
                                <li class="officers-list-item"><p> Vivian   C. Dala - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Santiago P. Nartates Jr. - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Marvin G. Batino - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Regie E. Egualan - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Susan S. Aguilar - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Benjie S. Garcia - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Amador P. Esquivel - Board Of Directors</p></li>
                                <li class="officers-list-item"><p>Daisy J. Raymundo - Board Of Directors</p></li>
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require('footer.inc.php');
?>