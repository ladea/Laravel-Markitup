<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post Textile Preview</title>
<link rel="stylesheet" type="text/css" href="~/templates/preview.css" />
</head>
<body>
<?php
require_once('classTextile.php');
$textile = new Textile();
// For untrusted user input, use TextileRestricted instead:
// echo $textile->TextileRestricted($_POST['data']);
echo nl2br($textile->TextileThis($_POST['data']));
?>
</body>
</html>

