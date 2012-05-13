<?php 
$root = '../../';
include $root."php/session.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Lassie Shepherd Project Localizer</title>
    <link href="<?php echo($root); ?>styles/lassie.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="<?php echo($root); ?>js/resize.js"></script>
	<script type="text/javascript" src="<?php echo($root); ?>js/swfobject.js"></script>
	<script type="text/javascript">
		var flashvars = {};
		var params = {};
		var attributes = {id:"lassie", name:"lassie"};
		swfobject.embedSWF("<?php echo($root); ?>flash/localizer.swf", "lassie", "800", "600", "9.0.0", false, flashvars, params, attributes);
	</script>
</head>
<body>

<?php include $root."php/nav.php"; ?>

	<div id="shepherd">
		<div id="lassie">
			<a href="http://www.adobe.com/go/getflashplayer">Get Adobe Flash player</a>
		</div>
	</div>
</body>
</html>