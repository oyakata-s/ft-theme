<?php

setcookie('fbid', '', time()-3600, '/');
setcookie('fbname', '', time()-3600, '/');

header("Content-type: text/html; charset=utf-8");
?>
<html>
<head>
<style type="text/css">
body {
	position: relative;
	background-color: #3b5998;
	font-size: 16px;
}
.message {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	width: 640px;
	max-width: 100%;
	height: 150px;
	margin: auto;
	padding: 1.5rem;
	max-height: 100%;
	box-sizing: border-box;
	border-radius: 15px;
	background-color: #fffafa;
	color: #3b5998;
	text-align: center;
}
input[type=button] {
	font-size: 16px;
	padding: 0.5rem 1.0rem;
	border: 1px solid #bbb;
	overflow: visible;
	text-decoration: none;
	white-space: nowrap;
	color: #555;
	background-color: #eee;
	border-radius: 3px;
	box-shadow: 0 1px 0 rgba(0, 0, 0, .3), 0 2px 2px -1px rgba(0, 0, 0, .5), 0 1px 0 rgba(255, 255, 255, .3) inset;
}
</style>
<script type="text/javascript">
function winclose() { window.open('about:blank','_self').close(); }
</script>
</head>
<body>
<div class="message">
<?php echo 'You logged out from Facebook, <br>but you can use this theme continuously.'; ?>
<p><input type="button" value="close" onclick="winclose();" /></p>
</div>
</body>
</html>
