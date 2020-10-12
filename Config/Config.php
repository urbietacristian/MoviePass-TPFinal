<?php namespace Config;

require_once __DIR__ . '/vendor/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '813085052788956',
    'app_secret' => 'efd7113ea0a3119968ce477683bbb9ac',
    'default_graph_version' => 'v2.10',
    ]);


$handler = $FBObject -> getRedirectLoginHelper();
define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/UTN/TP6/ExerciseThree/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMG_PATH", VIEWS_PATH . "img/");
define("USER_PATH", VIEWS_PATH . "user/");
define("ADMIN_PATH", VIEWS_PATH . "admin/");
?>




