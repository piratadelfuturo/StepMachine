<?php
use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Use APC for autoloading to improve performance
// Change 'sf2' by the prefix you want in order to prevent key conflict with another application

$loader = new ApcClassLoader('sevenboom', $loader);
$loader->register(true);


require_once __DIR__.'/../app/AppKernel.php';
require_once __DIR__.'/../app/DebugAppCache.php';

$kernel = new AppKernel('test', true);
//$kernel->loadClassCache();
$kernel = new AppCaDebugAppCacheche($kernel);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
