<?php

// $request = file_get_contents("http://localhost/server/?presentations/1");

// echo $request;

/*$opts = array(
           'http'=>array(
                   'method'=>'POST',
                   'header'=>'Content-type: application/x-www-form-urlencoded'
                )
);

$opts['http']['content'] = json_encode(
                                       array('titre'=>'PHP5 Avancé',
                                               'edition'=>'6',
                                               'statut'=>'en cours')
                                             );
$context = stream_context_create($opts);
 
//Utilisation du contexte dans l'appel
$request = file_get_contents(
               'http://localhost/server/?presentation/1', 
               false, 
               $context);

echo $request; */

$request = json_decode(file_get_contents("http://localhost/server/?news/"));
?>

<meta charset="UTF-8" />

<?php
print_r($request);
?>
