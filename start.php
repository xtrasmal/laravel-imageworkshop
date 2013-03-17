<?php
use PHPImageWorkshop\ImageWorkshop;

//require_once(__DIR__.DS.'PHPImageWorkshop'.DS.'ImageWorkshop.php');

Autoloader::map(array(
	'PHPImageWorkshop\ImageWorkshop' => __DIR__.DS.'PHPImageWorkshop'.DS.'ImageWorkshop.php',
));