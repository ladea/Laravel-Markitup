<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post BBCode Preview</title>
<link rel="stylesheet" type="text/css" href="~/templates/preview.css" />
</head>
<body>
<?php include_once 'markitup.bbcode-parser.php'; ?>
<?php echo BBCode2Html($_POST['data']); ?>
</body>
</html>

