









<?php 

//Load the settings

require_once("settings.php");




$message = "";

//Has the user uploaded something?

if(isset($_FILES['file']))

{

	$target_path = Settings::$uploadFolder;

	$target_path = $target_path . time() . '_' . basename( $_FILES['file']['name']); 

	

	//Check the password to verify legal upload

	if($_POST['password'] != Settings::$password)

	{

		$message = "Invalid Password!";

	}

	else

	{

		//Try to move the uploaded file into the designated folder

		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {

		    $message = "The file ".  basename( $_FILES['file']['name']). 

		    " has been uploaded";

		} else{

		    $message = "There was an error uploading the file, please try again!";

		}

	}

	

	//Clear the array

	unset($_FILES['file']);

}



if(strlen($message) > 0)

{

	$message = '<p class="error">' . $message . '</p>';

}



/** LIST UPLOADED FILES **/

$uploaded_files = "";



//Open directory for reading

$dh = opendir(Settings::$uploadFolder);



//LOOP through the files

while (($file = readdir($dh)) !== false) 

{

	if($file != '.' && $file != '..')

	{

		$filename = Settings::$uploadFolder . $file;

		$parts = explode("_", $file);

		$size = formatBytes(filesize($filename));

		$added = date("m/d/Y", $parts[0]);

		$origName = $parts[1];

		$filetype = getFileType(substr($file, strlen($file) - 3));

        $uploaded_files .= "<li class=\"$filetype\"><a href=\"$filename\">$origName</a> $size - $added</li>\n";

	}

}

closedir($dh);



if(strlen($uploaded_files) == 0)

{

	$uploaded_files = "<li><em>No files found</em></li>";

}



function getFileType($extension)

{

	$images = array('jpg', 'gif', 'png', 'bmp','JPG');

	$docs 	= array('txt', 'rtf', 'doc', 'docx', 'pdf', 'XML');

	$apps 	= array('zip', 'rar', 'exe');

	

	if(in_array($extension, $images)) return "Images";

	if(in_array($extension, $docs)) return "Documents";

	if(in_array($extension, $apps)) return "Applications";

	return "";

}



function formatBytes($bytes, $precision = 2) { 

    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

   

    $bytes = max($bytes, 0); 

    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 

    $pow = min($pow, count($units) - 1); 

   

    $bytes /= pow(1024, $pow); 

   

    return round($bytes, $precision) . ' ' . $units[$pow]; 

} 

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

	<meta charset="utf-8">

	<meta name="viewport"    content="width=device-width, initial-scale=1.0">

	<meta name="description" content="">

	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">

	

	<!-- Bootstrap itself -->

	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">



	<!-- Custom styles -->

	<link rel="stylesheet" href="assets/css/magister.css">



	<!-- Fonts -->

	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>

<script src="http://code.jquery.com/jquery-latest.js"></script>

<title>Online file storage</title>

</head>

<body>



<div id="container">



<h1>VE Documents and Rotas</h1>



<form method="post" action="index.php" enctype="multipart/form-data">

	<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />

	<fieldset>

		<legend>Add a new document to the folder</legend>

			<?php echo $message; ?>

			<p><label for="name">Select file</label><br />


			<input type="file" name="file" /></p>

			<p><label for="password">Manager's password for upload</label><br />

			<input type="password" name="password" /></p>

			<p><input type="submit" name="submit" value="Start upload" /></p>	

		</fieldset>

	</form>



	<fieldset>

		<legend>Previousely uploaded files</legend>

			<ul id="menu">

				<li><a href="">All files</a></li>

				<li><a href="">Documents</a></li>

				<li><a href="">Images</a></li>

				<li><a href="">Applications</a></li>

			</ul>

			

			<ul id="files">

				<?php echo $uploaded_files; ?>

			</ul>

	</fieldset>



</div>



<script src="js/filestorage.js" />

</body>

</html>