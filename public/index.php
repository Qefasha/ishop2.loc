<?php

require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/function.php';
new\ishop\App();

debug(\ishop\App::$app->getProperties());