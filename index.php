<?php
ini_set('display_errors','off');
if($input = $_POST['linktext']){
	$input = trim($input);
	$matches = array();
	preg_match_all('/akamai.com[[:space:]][[:space:]].*[[:space:]][[:space:]]/i', $input, $matches);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Asset &amp; Routing Link Builder</title>
<style type="text/css">
form {
	width: 460px;
}
</style>
</head>
<body>
<h1>Asset &amp; Routing Link Builder</h1>
<form action="" method="POST">
<label for="linktext">Paste email from Asset Search &amp; Routing here:</label>
<textarea name="linktext" cols="60" rows="20"><?php if(!empty($_POST['linktext'])) echo $_POST['linktext']; ?></textarea>
<!--<label for="path"><a href="http://screencast.com/t/pfBDIOj0yigY" target="_blank" style="color: #F00;">Path:</a></label>
<input type="text" name="path" <?php if(!empty($_POST['path'])) echo "value=\"".$_POST['path']."\"" ?> />-->
<label for="type">Link Type:</label>
<select name="type">
    <option <?php if($_POST['type'] == "download") echo "selected=\"selected\"" ?> value="download">Download</option>
    <option <?php if($_POST['type'] == "flash") echo "selected=\"selected\"" ?> value="flash">Streaming (Flash)</option>
</select>
<input name="" type="submit" />
</form>
<h2>Results:</h2>
<?php 
$links = "<pre>\n";
$biz = '';
//$path = $_POST['path'];
if(stripos($input,'wbr.streamos') !== false) { $biz = 'wbr'; /* $path = 'nashville/'.$path; */ }
if(stripos($input,'word.streamos') !== false) { $biz = 'word'; /* $path = 'wordmusic/'.$path; */}
if(isset($matches[0])){
foreach ($matches[0] as $v) {
	$result = explode('  ',$v);
	$links .= "http://".$biz.".edgeboss.net/".$_POST['type']."/".$biz./*"/".*/(!empty($_POST['path']) ? $path."/" : $path).strtolower($result[1])."\n\r";
}
$links .= "<pre>\n";
echo $links;
}
?>
</body>
</html>