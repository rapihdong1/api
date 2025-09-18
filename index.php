<?php
$to = isset($_GET['to']) ? trim($_GET['to']) : '';

if ($to === '') {
    header("Content-Type: text/html; charset=utf-8");
    http_response_code(400);
    echo "Missing 'to'";
    exit;
}

$target = urldecode($to);

if (!preg_match("~^https?://~i", $target)) {
    header("Content-Type: text/html; charset=utf-8");
    http_response_code(400);
    echo "Invalid URL";
    exit;
}

if (!filter_var($target, FILTER_VALIDATE_URL)) {
    header("Content-Type: text/html; charset=utf-8");
    http_response_code(400);
    echo "Invalid URL";
    exit;
}

$host = parse_url($target, PHP_URL_HOST);
if (!$host || strpos($host, '.') === false) {
    header("Content-Type: text/html; charset=utf-8");
    http_response_code(400);
    echo "Invalid URL";
    exit;
}

header("Location: $target", true, 302);
exit;
