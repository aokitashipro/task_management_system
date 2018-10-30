	
<?php
header('Content-Type: text/xml;charset=UTF-8');
print(file_get_contents('http://chiebukuro.yahooapis.jp/Chiebukuro/V1/questionSearch?appid=wings-project&query='.$_GET['query']));
?>
