<?php
session_start();
#file này dùng để chứa các include
// phải vậy vì gốc là index.php
//__DIR__ là folder của index này

require __DIR__ . "/config/config.php";
require __DIR__ . "/core/functions.php";

require __DIR__ . "/core/request.php";
require __DIR__ . "/core/router.php";
require __DIR__ . "/core/database.php";
require __DIR__ . "/core/model.php";
require __DIR__ . "/core/controller.php";


?>