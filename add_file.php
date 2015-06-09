<!DOCTYPE html>
<head>
    <title>Return Home</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body>
<p>
      <button onclick="location.href = 'http://localhost/returnhomebutton/index.php';" id="myButton">Return home</button>
</p>

<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "http://localhost/returnhomebutton/index.php";
    };
</script>

<?php

//CREATE A CONNECTION using Procedural Style
$conn = mysqli_connect('localhost', 'root', '','forecast');

//CHECK CONNECTION 
if (!$conn) {
	die('Connection failed: ('.mysqli_connect_errno().')'. mysqli_connect_errno());
} 
echo 'Success in connecting to ' . mysqli_get_host_info($conn). "\n" ;
echo "<br>";

/********************
//SQL TO CREATE A TABLE
$sql = "CREATE TABLE customer (
	id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	mime VARCHAR(50) Not Null Default 'text/plain',
	size INT(200) UNSIGNED Not Null,
	data BLOB Not Null,
	created DateTime Not Null
	)";
if ($conn->query($sql) === TRUE) {
	echo "Table customer created successfully";
} else {echo "Error creating table: ". $conn->error;
}
 $conn->close();
*********************/

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
echo "File is set for uploading"; }
echo "<br>";
// Gather all required data
        $name = mysqli_real_escape_string($conn, $_FILES['uploaded_file']['name']);
        $mime = mysqli_real_escape_string($conn, $_FILES['uploaded_file']['type']);
        $data = mysqli_real_escape_string($conn, file_get_contents($_FILES ['uploaded_file']['tmp_name']));
        $size = Intval($_FILES['uploaded_file']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO customer (
                name, mime, size, data, created
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )";
 
        // Execute the query
        $result = $conn->query($query);
 
        // Check if it was successful
        if($result) {
            echo 'Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$conn->error}</pre>";
        } 

// Close the mysql connection
    $conn->close();

echo "<br><br>";

 // Connect to the database
$dbLink = new mysqli('127.0.0.1', 'root', '', 'forecast');
if(mysqli_connect_errno()) {
    die("MySQL connection failed: ". mysqli_connect_error());
}
 
// Query for a list of all existing files
$sql = 'SELECT `id`, `name`, `mime`, `size`, `created` FROM `customer`';
$result = $dbLink->query($sql);
 
// Check if it was successful
if($result) {
    // Make sure there are some files in there
    if($result->num_rows == 0) {
        echo '<p>There are no files in the database</p>';
    }
    else {
        // Print the top of a table
        echo '<table width="80%">
                <tr>
                    <td><b>File Name</b></td>
                    <td><b>Mime</b></td>
                    <td><b>Size (bytes)</b></td>
                    <td><b>Created</b></td>
                    <td><b>&nbsp;</b></td>
                </tr>';
 
        // Print each file
        while($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['name']}</td>
                    <td>{$row['mime']}</td>
                    <td>{$row['size']}</td>
                    <td>{$row['created']}</td>
                    <td><a href='get_file.php?id={$row['id']}'>Download</a></td>
                </tr>";
        }
 
        // Close table
        echo '</table>';
    }
 
    // Free the result
    $result->free();
}
else
{
    echo 'Error! SQL query failed:';
    echo "<pre>{$dbLink->error}</pre>";
}
 
// Close the mysql connection
$dbLink->close();

/****************************Everything above this line is functional************************/


?>

<p>
      <button onclick="location.href = 'http://localhost/returnhomebutton/index.php';" id="myButton">Return home</button>
</p>

<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "http://localhost/returnhomebutton/index.php";
    };
</script>
	
	
</body>
</html>




