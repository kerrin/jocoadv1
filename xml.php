<?php
$root = "../../";
$title = "Project XML";
include "../../php/header.php";
?>

			<p>Use this page to review and download the XML files published by Lassie Shepherd. By downloading XML to your desktop, you can run your project locally.</p>			

			
			<h2>XML Files</h2>
			<ul class="contents">
<?php
$path = "xml";
include $root."php/filelist.php";
?>
			</ul>

<?php include $root."php/footer.php"; ?>