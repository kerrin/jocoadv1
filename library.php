<?php
$root = "../../";
$title = "Project Library";
include $root."php/header.php";

$result = "";
$method = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$method = @$_POST["method"];
	
	if ($method == "upload") {
		$result = upload();
	}
	else if ($method == "delete") {
		$result = delete();
	}
}

function upload()
{
	$return = "";
	
	if((!empty($_FILES['file'])) && ($_FILES['file']['error'] == 0))
	{
		$upload = $_FILES['file'];
		$path = $_POST["path"];
		$overwrite = ($_POST["overwrite"] == "true");
		$filename = basename($upload['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
		$swftype = "application/x-shockwave-flash";
		$maxsize = 100000000;
		
		if (($ext == "swf") && ($upload["type"] == $swftype) && ($upload["size"] < $maxsize))
		{
			$newname = './'. $path .'/'.$filename;
			
			if (!file_exists($newname) || $overwrite)
			{
				if ((move_uploaded_file($upload['tmp_name'], $newname)))
				{
					chmod($newname, 0644);
					$return = "Upload complete!";
				} 
				else
				{
					$return = "A problem occurred while attepting to upload your file.";
				}
			} 
			else
			{
				$return = "The file '". $upload['name'] ."' already exists.";
			}  
		} 
		else
		{
			$return = "Invalid file: a SWF movie under ". ($maxsize/1000000) ."Mb is required.";
		}
	}
	else
	{
		$return = "No file was specified for upload.";
	}
	
	return $return;
}

function delete()
{
	$filelist = $_POST['filelist'];
	$files = split(",", $filelist);
	
	for ($count = 0; $count < sizeof($files); $count++)
	{
		if (strpos($files[ $count ], ".swf") > 0)
		{
			unlink($files[ $count ]);
		}
	}
	
	return "Libraries have been deleted.";
}
?>
			<p>Use this page to upload media library SWFs into your project.</p>			

			
			<h2>Libraries</h2>
			<ul class="contents">
<?php
$path = "lib";
include $root."php/filelist.php";
?>
			</ul>
			
			<h2>Upload a Library</h2>
			<form enctype="multipart/form-data" action="library.php" method="POST">
				<?php if ($result != "") echo('<p class="error">'. $result .'</p>'); ?>
                <input type="hidden" name="method" value="upload" />
                <input type="hidden" name="path" value="lib" />
                <input type="hidden" name="overwrite" value="true" />
				<p><label>swf file:</label><input type="file" name="file" /></p>
				<p class="submit"><input type="submit" value="Upload" /></p>
			</form>

<?php include $root."php/footer.php"; ?>