<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" >
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Brad Huizenga" />
	<meta name="keywords" content="jedi knight, jedi knight arena, first person shooter, mod, levelmod, jk, jkarena, jk arena, jka" />
	<meta name="description" content="Official home of Jedi Knight Arena" />
	<title>Jedi Knight Arena</title>
<?
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
	$uagent = $_SERVER['HTTP_USER_AGENT'];
}
else $uagent = $HTTP_ENV_VARS['HTTP_USER_AGENT'];
?>

	<link rel="stylesheet" href="jkarenadark.css" type="text/css" title="JK Arena Dark" />
	<link rel="alternate stylesheet" href="jkarena.css" type="text/css" title="JK Arena Green" />
	<link rel="alternate stylesheet" href="jkarenablue.css" type="text/css" title="JK Arena Blue" />
	<link rel="alternate stylesheet" href="jkarenafixed.css" type="text/css" title="JK Arena Green Fixed Menu" />
	<?if (stristr($uagent,'MSIE 5.0')) {?><link rel="stylesheet" href="ie5fix.css" type="text/css">
	<?}?>

	<script type="text/javascript" src="styles.js"></script>
</head>

<?
if (stristr($uagent,'Mozilla/5') || stristr($uagent,'Opera 7')) $extra = TRUE;
else $extra = FALSE;
$x = $_REQUEST['x'];
if (empty($x)) $x = 'front';
if (is_file($x . '.php')) { include($x . '.php'); }
else include('notfound.php');
?>

</body>
</html>