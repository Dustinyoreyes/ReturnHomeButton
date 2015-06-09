<!DOCTYPE html>
<head>
    <title>MySQL file upload example</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body>
    <form action="add_file.php" method="post" enctype="multipart/form-data">
        Select file to upload:
		<br><br>
		1. <input type="file" name="uploaded_file"><br>
		<br>
        2. <input type="submit" value="Upload File">
    </form>
    
	<p>
        <a href="list_files.php">See all files</a>
    </p>
</body>
</html>