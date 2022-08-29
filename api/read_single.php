<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//initializing our api
include_once ('../core/initialize.php');

//instence post

$post = new Post($db);

$post->idUnique = isset($_GET['idUnique']) ? $_GET['idUnique'] : die();
$post->read_single();

$post_arr = array(
    'idUnique' => $post->idUnique,
    'nom' => $post->nom,
    'ddn' => $post->ddn,
    'cin' => $post->cin,
    'mention' => $post->mention,
    'univ' => $post->univ,
    'tel' => $post->tel,
    'idEtudiant' => $post->idEtudiant,
    'compte_fk' => $post->compte_fk,
);

//json
print_r(json_encode($post_arr));