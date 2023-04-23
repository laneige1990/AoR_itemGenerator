<?php

// Globals
if ($_SERVER['HTTP_HOST'] != "itemtool.local"){
    define('SERVER', 'localhost');
    define('DATABASE', 'laneonli_fastlane');
    define('USER', 'laneonli_fastlane');
    define('PASSWORD', 'cx7y%a29FI%U3#5L');
}else{
    define('SERVER', 'localhost');
    define('DATABASE', 'item-tool_dev');
    define('USER', 'root');
    define('PASSWORD', '');
}

// load database
require_once('models/database.php');