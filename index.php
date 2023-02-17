<?php
$REQUEST_URI = filter_input(INPUT_SERVER, 'REQUEST_URI');
$INITE = strpos($REQUEST_URI, '?');
if ($INITE) :
    $REQUEST_URI = substr($REQUEST_URI, 0, $INITE);
endif;

$REQUEST_URI_PASTA = substr($REQUEST_URI, 1);
$URL = explode('/', $REQUEST_URI_PASTA);

$URL[1] = ($URL[1] != "" ? $URL[1] : 'index');

// echo '<pre>';
// print_r($_SERVER);
// echo '<pre>';

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $linkAssets = '/Nekomata/public/assets/';
    $linkVendor = '/Nekomata/public/vendor/';
}else{
    $linkAssets = 'Nekomata/public/assets/';
    $linkVendor = 'Nekomata/public/vendor/';   
}


if (file_exists('pages/' . $URL[1] . '.php')) {
    require('pages/' . $URL[1] . '.php');
} elseif (is_dir('pages/' . $URL[1])) {
    if (isset($URL[2]) && file_exists('pages/' . $URL[1] . '/' . $URL[2] . '.php')) {
        if (isset($URL[3]) && file_exists('pages/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '.php')) {
            require('pages/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '.php');
        } else {
            require('pages/' . $URL[1] . '/' . $URL[2] . '.php');
        }
    } elseif (isset($URL[3]) && file_exists('pages/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '.php')) {
        if (isset($URL[3]) && file_exists('pages/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '.php')) {
            require('pages/' . $URL[1] . '/' . $URL[2] . '/' . $URL[3] . '.php');

            // if (!$URL[1] === 'admin') {
            //     session_destroy();
            //     exit;
            // }

        } else {
            require('pages/404.php');
        }
    } else {
        require('pages/admin/login.php');
    }
} else {
    require('pages/404.php');
}
