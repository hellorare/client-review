<?php

// ==========================================================================
//
//  Functions.php
//    Required by Wordpress
//
// ==========================================================================

include_once('includes/sandpit-utilities.php');
include_once('includes/sandpit-activation.php');
include_once('includes/sandpit-configuration.php');
include_once('includes/sandpit-enqueue.php');


// Include all models

foreach (glob(dirname(__FILE__) . "/includes/**/model*.php") as $filename)
{
	include $filename;
}


// Include all taxonomies

foreach (glob(dirname(__FILE__) . "/includes/**/taxonomy*.php") as $filename)
{
	include $filename;
}


// Include all controllers

foreach (glob(dirname(__FILE__) . "/includes/**/controller*.php") as $filename)
{
	include $filename;
}


// Include all tweaks

foreach (glob(dirname(__FILE__) . "/includes/tweak*.php") as $filename)
{
	include $filename;
}
