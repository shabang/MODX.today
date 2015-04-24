<?php
define('MODX_API_MODE', true);

/* include custom core config and define core path */
@include(dirname(dirname(__FILE__)) . '/config.core.php');
if (!defined('MODX_CORE_PATH')) define('MODX_CORE_PATH', dirname(__FILE__) . '/core/');

/* include the modX class */
if (!@include_once (MODX_CORE_PATH . "model/modx/modx.class.php")) {
    $errorMessage = 'Site temporarily unavailable';
    @include(MODX_CORE_PATH . 'error/unavailable.include.php');
    header('HTTP/1.1 503 Service Unavailable');
    echo "<html><title>Error 503: Site temporarily unavailable</title><body><h1>Error 503</h1><p>{$errorMessage}</p></body></html>";
    exit();
}

/* Create an instance of the modX class */
$modx= new modX();
$modx->initialize('mgr');


$SiteVersion = $modx->getObject('modSystemSetting', 'site_version');
$SiteVersion->set('value', time()+1);
$SiteVersion->save();

$CacheBusting = $modx->getObject('modSystemSetting', 'cachebust');
$CacheBusting->set('value', '0');
$CacheBusting->save();


$cacheRefreshOptions =  array( 'system_settings' => array(), 'default' => array() );
$modx->cacheManager->refresh($cacheRefreshOptions);

print('Settings updated.'.PHP_EOL);