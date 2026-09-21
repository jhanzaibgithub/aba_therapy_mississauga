<?php
if (!defined('ABSPATH')) {
    define('ABSPATH', true);
    define('ABA_STANDALONE_ROUTER', true);
}
require_once __DIR__ . '/functions.php';

$service = $_GET['service'] ?? get_query_var('service_slug') ?? '';
if (!empty($service)) {
    require __DIR__ . '/single-service.php';
    exit;
}

$page = $_GET['page'] ?? '';
if (empty($page)) {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(parse_url($uri, PHP_URL_PATH) ?? '', '/');
    $parts = explode('/', $path);
    $last = end($parts);
    if (in_array($last, ['about', 'services', 'our-approach', 'resources', 'contact'], true)) {
        $page = $last;
    }
}

switch ($page) {
    case 'about':
        require __DIR__ . '/page-about.php';
        break;
    case 'services':
        require __DIR__ . '/page-services.php';
        break;
    case 'our-approach':
    case 'approach':
        require __DIR__ . '/page-our-approach.php';
        break;
    case 'resources':
        require __DIR__ . '/page-resources.php';
        break;
    case 'contact':
        require __DIR__ . '/page-contact.php';
        break;
    default:
        require __DIR__ . '/front-page.php';
        break;
}
