<?php

$params=$_SERVER['argv'] ;
$stream = @fopen('tmp/'.$params[1].".txt", 'a', true);
@fwrite($stream,'THIS FILE IS CREATED BY PHP COMMAND-LINE.');
@fclose($stream);
echo "Hello";
echo "<br><br>I am test console running from 'application/console/test.php' and I created a file named 'tmp/".$params[1].".txt' .";
?>