<?php

error_reporting(E_ALL ^ E_NOTICE);
	ini_set('track_errors', '1');
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');

// 	shortcut the DIRECTORY_SEPARATOR value
	if(!defined('DS'))
	{
		define('DS', DIRECTORY_SEPARATOR);
	}

// 	define the paths to the required binaries
	define('PHPVIDEOTOOLKIT_FFMPEG_BINARY', '/usr/bin/ffmpeg');
	define('PHPVIDEOTOOLKIT_FLVTOOLS_BINARY', '/usr/bin/flvtool2');
	define('PHPVIDEOTOOLKIT_MENCODER_BINARY', '/usr/bin/mencoder'); // only required for video joining
	define('PHPVIDEOTOOLKIT_FFMPEG_WATERMARK_VHOOK', '/usr/lib/vhook/watermark.dylib'); // only required for video wartermarking
	define('PHPVIDEOTOOLKIT_EXAMPLE_ABSOLUTE_PATH', dirname(__FILE__).DS);


	
	
	