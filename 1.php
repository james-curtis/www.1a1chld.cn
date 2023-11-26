<?php
$gets=http_build_query($_GET);
$posts=http_build_query($_POST);
$u="GET:$gets \n POST:$posts";
file_put_contents('post'.time().'.txt',$u);
?>
