<html>
<head>
<style type="text/css">
  /*this must be set so that the loading div
    can be height:100% */
  body{height:100%}

  /*this is what we want the div to look like
    when it is not showing*/
  div.loading-invisible{
    /*make invisible*/
    display:none;
  }

  /*this is what we want the div to look like
    when it IS showing*/
  div.loading-visible{
    /*make visible*/
    display:block;

    /*position it at the very top-left corner*/
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    text-align:center;

    /*in supporting browsers, make it
      a little transparent*/
    background:#fff;
    _background:none; /*this line removes the background in IE*/
    opacity:.75;
    border-top:1px solid #ddd;
    border-bottom:1px solid #ddd;

    /*set the padding, so that the content
      of the div is centered vertically*/
    padding-top:25%;
  }
</style>
</head>
<body>
<div id="loading" class="loading-invisible">
  <img src="loader.gif">
  <p align="center" class="style1"> Please Wait...it may take some time for processing results!</p>
</div>
<script type="text/javascript">
  document.getElementById("loading").className = "loading-visible";
  var hideDiv = function(){document.getElementById("loading").className = "loading-invisible";};
  var oldLoad = window.onload;
  var newLoad = oldLoad ? function(){hideDiv.call(this);oldLoad.call(this);} : hideDiv;
  window.onload = newLoad;
</script>
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
$url="http://www.ideone.com";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,true);
$exec=curl_exec($ch);
$i=strpos($exec,"Set-Cookie: ");
$i+=12;
$cookie=substr($exec,$i,(strpos($exec,";",$i)-$i)+1);
$exec=substr($exec,$i);
$i=strpos($exec,"Set-Cookie: ");
$i+=12;
$cookie=$cookie . " " . substr($exec,$i,(strpos($exec,";",$i)-$i));
curl_close($ch);
$lang=$_POST['lang'];
$url="http://ideone.com/ideone/Index/submit";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,false);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.63 Safari/535.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,true);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$_POST);
$contentl="";$contentt="";
sprintf($contentl,"Content-Length: %s",$_SERVER['CONTENT_LENGTH']);
sprintf($contentt,"Content-Type: %s",$_SERVER['CONTENT_TYPE']);
curl_setopt($ch,CURLOPT_HTTPHEADER,array("Host: ideone.com","Connection: keep-alive",$contentl,"Origin: http://ideone.com",$contentt,"Accept: text/html,application/xhtml+xml,application/xml","Referer: http://ideone.com/"));
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,60);
curl_setopt($ch,CURLOPT_COOKIE,$cookie);
$exec=curl_exec($ch);
$i=strpos($exec,"Location: ");
$i+=10;
$locn=substr($exec,$i,(strpos($exec,"\n",$i)-$i));
curl_close($ch);
$charc=$locn{1};
$locn{1}=$locn{3};
$locn{3}=$charc;
$charc=$locn{2};
$locn{2}=$locn{4};
$locn{4}=$charc;
?>
<p align="center">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6377952601366126";
/* leaderboard under */
google_ad_slot = "7014040906";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</p>
<?php
echo '<html><head><link rel="stylesheet" href="style.css"></head><body><h2 align="center">Click on the following link to see your results <br></br><form action="result.php" method="post"><input type="hidden" name="plc" value="' . $locn . '"><input type="submit" name="Submit" class="myButton" id="submit_button" value="Result"></form></h2></body></html>';
?>
<p align="center">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6377952601366126";
/* voicestatus */
google_ad_slot = "3563874850";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</p>