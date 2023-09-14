<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ directory. Use a full server path with trailing slash.
|
*/
$config[ 'log_directory' ] = '';

/*
|--------------------------------------------------------------------------
| Log File Extension
|--------------------------------------------------------------------------
|
| The default filename extension for log files.
|
| Note: Leaving it blank will default to 'log'.
|
*/
$config[ 'log_file_extension' ] = '';

/*
|--------------------------------------------------------------------------
| Log File Separator
|--------------------------------------------------------------------------
|
| The default separator between each lines.
|
| Note: Leaving it blank will default to '\n'.
|
*/
$config[ 'log_file_separator' ] = '';

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
| Note: Leaving it blank will default to 'Y-m-d H:i:s'.
|
*/
$config[ 'log_date_format' ] = '';

/*
|--------------------------------------------------------------------------
| Log line style
|--------------------------------------------------------------------------
|
| You can choose caracters you want to separate level and message on each line
|
| Note: Leaving it blank will default to ' => '.
|
*/
$config[ 'log_style' ] = '';

/*
|--------------------------------------------------------------------------
| Log access by web
|--------------------------------------------------------------------------
|
| You can enable the web viewer of your log
|
| Note: the url to see your log is http://example.com/log_viewer.
|
*/
$config[ 'log_web_viewer' ] = true;