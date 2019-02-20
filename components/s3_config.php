<?php
namespace app\components;

$bucket="lanoyo-property";
if (!class_exists('S3'))require_once('S3.php');
			
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIRWFUJGOJ46XGJYA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
//instantiate the class

?>