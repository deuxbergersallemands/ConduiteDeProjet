<?php

include_once("RestClient.class.php");


$client = new RestClient("http://raphael.jorel.emi.u-bordeaux.fr/REST/server");
$request = $client->getAteliers();
?>

<meta charset="UTF-8" />

<pre>
<?php
var_dump($request);
?>
</pre>
