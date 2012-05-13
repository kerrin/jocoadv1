<?php
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	$method = @isset($_POST['method']) ? $_POST['method'] : '';
	$file = @isset($_POST['file']) ? $_POST['file'] : '';
	$data = @isset($_POST['data']) ? $_POST['data'] : '{}';
}
else if ($_SERVER['REQUEST_METHOD'] == "GET")
{
	$method = @isset($_GET['method']) ? $_GET['method'] : '';
	$file = @isset($_GET['file']) ? $_GET['file'] : '';
	$data = @isset($_GET['data']) ? $_GET['data'] : '{}';
}

if ($file != '')
{
	$path = "./";
	$data = stripslashes($data);
	
	switch($method)
	{
		case 'r': read($path . $file); return;
		case 'w': write($path . $file, $data); return;
		case 'd': delete($path . $file); return;
	}
}
else
{
	echo "param error";
}

// READ FILE
function read($file)
{
	if (($fp = fopen($file, 'r')) !== FALSE) {
		echo fread($fp, filesize($file));
		fclose($fp);
	}
	else {
		echo '{}';
	}
}

// WRITE FILE
function write($file, $data)
{
	if (($fp = fopen($file, 'w')) !== FALSE) {
		fwrite($fp, $data);
		fclose($fp);
		echo 'success';
	}
}

// DELETE FILE
function delete($file)
{
	if (file_exists($file)) {
		unlink($file);
		echo 'success';
	}
}
?>