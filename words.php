<?php 
session_start();
$words = array(
    "elefante","sturbcks","almendra","d"
);
$rnd = array_rand($words);
$_SESSION["words"] = json_encode($words[$rnd]);
$resposta= $_SESSION["words"];
echo $resposta;
