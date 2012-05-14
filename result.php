<title>Results</title><?php
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
$locn=$_POST['plc'];
$charc=$locn{1};
$locn{1}=$locn{3};
$locn{3}=$charc;
$charc=$locn{2};
$locn{2}=$locn{4};
$locn{4}=$charc;
$locn=trim($locn);
$url="http://ideone.com" . $locn;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,60);
curl_setopt($ch,CURLOPT_HEADER,false);
$exec=curl_exec($ch);
curl_close($ch);
$i=strpos($exec,"<!-- source code -->");
$code=substr($exec,$i,(strpos($exec,"</table></pre>",$i+20)-$i)+15);
$client=new SoapClient("http://ideone.com/api/1/service.wsdl");
$testArray = $client->getSubmissionStatus("geniush", "geniush159zxc",substr($locn,1));
while(true)
{
	if(strcmp($testArray['error'],'OK')==0&&strcmp($testArray['status'],'0')==0)
	{
		$subdet=$client->getSubmissionDetails("your ideone username","your ideone password",substr($locn,1),true,true,true,true,true);
		break;
	}
	else
	{
		sleep(1);
		$testArray=$client->getSubmissionStatus("your ideone username","your ideone password",substr($locn,1));
	}
}
switch($subdet['result'])
{
	case 11:
		$res="Compilation error";break;
	case 12:
		$res="Runtime error";break;
	case 13:
		$res="Time limit exceeded(max allowed time is 5 seconds)";break;
	case 15:
		$res="Success";break;
	case 17:
		$res="Memory limit exceeded(max allowed memory is 256MB)";break;
	case 19:
		$res="Illegal system call";break;
	case 20:
		$res="Internal error";break;
}
echo '<html><head><title>CodeIt</title></script><link rel="stylesheet" href="style.css"></head>
<body background="back.JPG"><div><img src="my_Logo.JPG" /></div><div class="box"><pre style="font-family:Trebuchet MS;font-size:16px;">Result: ' . $res . '   Time: ' . $subdet['time'] . '   Memory: ' . $subdet['memory'] . '  Return value: ' . $subdet['signal'] . '

</pre><pre class="box" style="font-family:Trebuchet MS;font-size:16px;">Input:
' . $subdet['input'] . '

</pre><br><br><pre class="box" style="font-family:Trebuchet MS;font-size:16px;">Output:
' . $subdet['output'] . '

</pre><br><br><pre style="font-family:Trebuchet MS;font-size:16px;">Source code:
</pre><br>' . $code . '<br><br><br><br>';
?>
    <style type="text/css">
<!--
.style1 {font-family: Tahoma}
.style3 {font-family: Tahoma; font-size: 16px; }
-->
    </style>
    <p align="center"><br>
&nbsp;<span class="style3"><a href="Aboutus.html">About Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="comments.html">Suggestions</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="code.html">Home</a></span></p>
    <p align="center" class="style3">Created By Narendra Rajput </p>
    <p align="center"><span class="style1"><br>
    </span></p>
	</div>
