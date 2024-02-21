<?php
require('top.inc.php');
isAdmin();

$hostname = get_current_user();
?>
<html>
<head>
  <title>BACKUP & RESTORE</title>
  <link rel="stylesheet" href="asset/css/bootstrap.css">
  <link rel="stylesheet" href="asset/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="asset/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="asset/css/all.min.css" integrity="sha512-W8q3bKSi5sR2YWRsSXrUi5nnRqotU3ziTNFXgq6wszjH4bWq23io7tzFzv/7l80UeYR5HbJ/jyjlo8Sjag+K5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <div class="container">&nbsp
        <center><H1><strong>BACKUP & RESTORE</strong></H1></center>
<?php
// MySQL database details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'masterlist';

// Establish a connection to MySQL
$conn = mysqli_connect($host, $username, $password, $database);
      



// Check the connection
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Export the MySQL database
      if (isset($_POST['export'])) {
          $connection = mysqli_connect('localhost', 'root', '', 'masterlist');
          $tables = array();
          $result = mysqli_query($connection, "SHOW TABLES");
          while ($row = mysqli_fetch_row($result)) {
              $tables[] = $row[0];
          }
          $return = '';
          foreach ($tables as $table) {
              $result = mysqli_query($connection, "SELECT * FROM " . $table);
              $num_fields = mysqli_num_fields($result);

              $return .= 'DROP TABLE ' . $table . ';';
              $row2 = mysqli_fetch_row(mysqli_query($connection, "SHOW CREATE TABLE " . $table));
              $return .= "\n\n" . $row2[1] . ";\n\n";

              for ($i = 0; $i < $num_fields; $i++) {
                  while ($row = mysqli_fetch_row($result)) {
                      $return .= "INSERT INTO " . $table . " VALUES(";
                      for ($j = 0; $j < $num_fields; $j++) {
                          $row[$j] = addslashes($row[$j]);
                          if (isset($row[$j])) {
                              $return .= '"' . $row[$j] . '"';
                          } else {
                              $return .= '""';
                          }
                          if ($j < $num_fields - 1) {
                              $return .= ',';
                          }
                      }
                      $return .= ");\n";
                  }
              }
              $return .= "\n\n\n";
          }

          $currDate = date("Y-m-d");

          // Save file
          $handle = fopen("Backup_".$currDate.".sql", "w+");
          fwrite($handle, $return);
          fclose($handle);
          
          // Display the notification using JavaScript
          echo '<script>
                  const link = document.createElement("a");
                  link.href = "Backup_'.$currDate.'.sql";
                  link.download = "Backup'.$currDate.'_'.$hostname.'.sql";
                  document.body.appendChild(link);
                  link.click();
                  document.body.removeChild(link);
                  alert("Backup file successfully downloaded.");
                </script>';
      }

// Import/Restore the MySQL database
if (isset($_POST['import'])) {
    if (!empty($_FILES['import_file']['tmp_name'])) {
        $connection = mysqli_connect('localhost', 'root', '', 'masterlist');
        $filename = $_FILES['import_file']['tmp_name'];
        $contents = file_get_contents($filename);
        $sql = explode(';', $contents);
        foreach ($sql as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $result = mysqli_query($connection, $query);
                if ($result) {
                }
            }
        }
        echo '<script>alert("Successfully imported");</script>';
    }
}

?>
<!-- HTML form for export and import -->
<h3>Export Database</h3>
<form method="post">
    <button class="btn btn-info btn-lg" type="submit" name="export">
      <i class="fa-solid fa-file-export"></i>&nbspBackup Data
    </button>
</form>

<br>

<h3>Import/Restore Database</h3>
<form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div id="import_area" ondragover="event.preventDefault()" ondrop="handleDrop(event)" style="margin-bottom: 20px">
        <input type="file" id="file_input" name="import_file" required accept=".sql" style="display: none;">
        <div id="drop_area" onclick="openFileSelector()" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
            <i id="file_icon" class="fa-solid fa-cloud-upload" style="font-size: 48px;"></i>
            <p id="file_text">Click here to select backup file or Drag / drop your backup file here (.sql file only)</p>
        </div>
    </div>
    <button class="btn btn-success btn-lg" type="submit" name="import" id="import_button" style="display: none;">
        <i class="fa-solid fa-file-import"></i>&nbspRestore Database
    </button>
</form>

<script>
    function validateForm() {
        var fileInput = document.getElementById("file_input");
        var file = fileInput.files[0];
        
        if (file && !file.name.toLowerCase().endsWith(".sql")) {
            alert("Invalid file format. Please select a .sql file.");
            return false; // Prevent form submission
        }
        
        return confirm("Are you sure you want to restore the database?"); // Confirmation message
    }
</script>



<br>
<script>
    function handleDrop(event) {
        event.preventDefault();
        document.getElementById('file_input').files = event.dataTransfer.files;
        document.getElementById('import_button').style.display = 'block';
        updateFileIconAndText();
    }

    function openFileSelector() {
        document.getElementById('file_input').click();
    }

    function updateFileIconAndText() {
        var fileIcon = document.getElementById('file_icon');
        var fileText = document.getElementById('file_text');
        var fileName = document.getElementById('file_input').files[0].name;
        var fileExtension = fileName.split('.').pop().toLowerCase();

        if (fileExtension === 'sql') {
            fileIcon.classList.remove('fa-cloud-upload');
            fileIcon.classList.add('fa-file');
            fileText.textContent = fileName;
        } else {
            fileIcon.classList.remove('fa-file');
            fileIcon.classList.add('fa-cloud-upload');
            fileText.textContent = 'Click here to select backup file or Drag / drop your backup file here (.sql file only)';
        }
    }

    // Listen for file selection
    document.getElementById('file_input').addEventListener('change', function(event) {
        document.getElementById('import_button').style.display = 'block';
        updateFileIconAndText();
    });
</script>

</div>
</body>
</html>
<?php
require('footer.inc.php');
?>