<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['about'] = 'pages/about';
$route['kategori'] = 'categories/index';

$route['kategori/produk/(:any)'] = 'categories/posts/$1';

$route['posts/index'] = 'posts/index';
$route['posts/create'] = 'posts/create';
$route['posts/update'] = 'posts/update';
$route['posts/(:any)'] = 'posts/view/$1';
$route['produk'] = 'posts/get';

$route['admin'] = 'admin/view';
$route['admin/list']='admin/dashboard';
$route['list']='Shopping_cart';
$route['keranjang']='Shopping_cart/keranjang_belanja';

$route['profil']='users/profil';