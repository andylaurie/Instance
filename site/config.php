<?php
// SITE SPECIFIC CONFIGURATION - - - - - - - - - - - - - - - - - - - - - - - - -

// SET TIMEZONE...
    $timezone = date_default_timezone_set("Europe/London");

// SET SQL USR PASSWORD AND DB...
    define('SQL_USR', 'InstanceUser');
    define('SQL_PW', 'Instant');
    define('SQL_DB', 'dbinstance');

// SET SITE TMP DIR e.g. C:/temp/
    define('TMP_DIR', '/mnt/www/sites/Instance/io/');

// SET SERVER ADDRESS e.g. http://server.domain.extension/
    define('SVR_ADD', 'http://web.aenet.local/');
