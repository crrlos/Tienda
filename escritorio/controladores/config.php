<?php
if(session_status() == PHP_SESSION_NONE)
    session_start ();

require_once __DIR__.'/../../modelo/vendor/autoload.php';

require_once __DIR__.'/../../modelo/generated-conf/config.php';

define("UID", "a6771cac6e5c72d4189268b857700829");
define("WSK", "c8316a3f2540b892b9b7d399421d8f51");
define("SANDBOX", true);
