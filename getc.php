<html>
<head>
    <link rel="stylesheet" href="style.css">
	<title>CodeIt</title>
</head>
<body background="back.JPG">
<div><img src="my_Logo.JPG" /></div>
<div class="box">
<?php
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}
$con = mysql_connect('localhost','','');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db('p170r760_smsregister');
$ins=mysql_query("select * from comments");
while($row=mysql_fetch_array($ins)) 
    echo $row['usern'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $row['comment'] . "<br>";
?>
</div>
</body>
</html>


