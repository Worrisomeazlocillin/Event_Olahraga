<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Dashboard
$routes->get('dashboard', 'DashboardController::index');
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);

//export
$routes->get('peserta/export', 'PendaftaranController::export');

//user
$routes->get('/user/user-dashboard', 'UserController::userDashboard'); // Rute untuk user dashboard
$routes->get('/user/dashboard', 'UserController::dashboard'); // Pastikan ini ada
$routes->get('/user/user_dashboard', 'UserController::dashboard'); // Sesuaikan nama controller dan metode
$routes->get('/user/history-event', 'UserHistoryController::index');
$routes->get('/user/history_event', 'UserHistoryController::index');

//OnlyUser login
$routes->get('user/login', 'AuthUserController::login');
$routes->get('authuser/login', 'AuthUserController::login');
$routes->post('authuser/loginuser', 'AuthUserController::loginUser');
$routes->get('user/register', 'AuthUserController::register');
$routes->post('authuser/registeruser', 'AuthUserController::registerUser');
$routes->get('user/profil', 'AuthUserController::profil');
$routes->get('authuser/logout', 'AuthUserController::logout');

//OnlyUser Regiter
$routes->get('authuser/register', 'AuthUserController::register', ['as' => 'authuser_register']);
$routes->post('authuser/registeruser', 'AuthUserController::registeruser');
$routes->get('user_dashboard', 'DashboardController::index', ['as' => 'user_dashboard']);

// app/Config/Routes.php
$routes->get('authuser/profil', 'AuthUserController::profil');

//User Logout
$routes->get('user/logout', 'AuthUserController::logout');

//Event
$routes->get('events', 'EventController::index'); // Menampilkan daftar event
$routes->get('events/create', 'EventController::create'); // Menampilkan form create event
$routes->post('event/store', 'EventController::store'); // Menyimpan data event
$routes->get('events/edit/(:num)', 'EventController::edit/$1'); // Route for editing an event
$routes->post('events/update/(:num)', 'EventController::update/$1'); // Route for updating an event
$routes->post('events/delete/(:num)', 'EventController::delete/$1'); // Route for deleting an event
$routes->get('events/delete/(:num)', 'EventController::delete/$1'); // Delete event
$routes->get('event/detail/(:num)', 'EventController::detail/$1');
$routes->post('events/storeAndProceed', 'EventController::storeAndProceed');
$routes->get('event/peserta/(:num)', 'PendaftaranController::peserta/$1');
$routes->get('/event/search', 'EventController::search');
$routes->get('event/coming_soon', 'EventController::comingSoon');
$routes->get('event/peserta', 'PendaftaranController::peserta');
$routes->get('event/peserta/(:num)', 'EventController::peserta/$1');
$routes->get('/user/history_event', 'UserHistoryController::index');

//Kategori
$routes->get('categories', 'KategoriEventController::index'); // Rute untuk halaman daftar kategori
$routes->get('categories/create/(:num)', 'KategorieventController::create/$1');
$routes->post('categories/store', 'KategoriEventController::store'); // Rute untuk menyimpan kategori baru
$routes->get('categories/edit/(:num)', 'KategoriEventController::edit/$1'); // Rute untuk halaman edit kategori
$routes->get('kategorievent/edit/(:num)', 'KategorieventController::edit/$1');
$routes->post('categories/update/(:num)', 'KategoriEventController::update/$1'); // Rute untuk mengupdate kategori
$routes->get('categories/delete/(:num)', 'KategoriEventController::delete/$1'); // Rute untuk menghapus kategori
$routes->get('kategorievent', 'KategoriEventController::index');

//Login dan Logout
$routes->get('auth/login', 'AuthController::index');
$routes->post('auth/login', 'AuthController::login');
$routes->get('/auth/register', 'AuthController::register');
$routes->post('/auth/register', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout'); // Tambahkan ini untuk logout
$routes->post('login', 'AuthController::submit'); // Rute untuk proses login
$routes->post('register', 'AuthController::submitRegister'); // Rute untuk proses register

//Pembayaran
$routes->get('payment/form/(:num)', 'PembayaranController::form/$1');
$routes->post('payment/submit_payment', 'PembayaranController::submit_payment');

//Uploads
$routes->get('uploads/(:any)', 'Uploads::serve/$1');

//Admin
$routes->get('admin', 'AdminController::index', ['filter' => 'auth']);
$routes->get('/auth/createAdmin', 'AuthController::createAdmin');

//Pendaftaran
$routes->get('pendaftaran', 'PendaftaranController::index');
$routes->get('pendaftaran/index', 'PendaftaranController::index');
$routes->get('pendaftaran/success', 'PendaftaranController::success');
$routes->get('pendaftaran/create', 'PendaftaranController::create'); // Menampilkan form pendaftaran
$routes->post('pendaftaran/store', 'PendaftaranController::store'); // Menyimpan data pendaftaran
$routes->get('pendaftaran/delete/(:num)', 'PendaftaranController::delete/$1');
$routes->get('pendaftaran/edit/(:num)', 'PendaftaranController::edit/$1');
$routes->get('pendaftaran/get_kabupaten/(:num)', 'PendaftaranController::get_kabupaten/$1');
$routes->get('/pendaftaran/peserta', 'PendaftaranController::peserta');
$routes->post('/pendaftaran/store_berbayar', 'PendaftaranController::storeBerbayar');
$routes->post('/pendaftaran/store_gratis', 'PendaftaranController::storeGratis');
$routes->get('pendaftaran/formBerbayar/(:num)', 'PendaftaranController::formBerbayar/$1');
$routes->get('pendaftaran/formGratis/(:num)', 'PendaftaranController::formGratis/$1');
$routes->get('pendaftaran/form_gratis/(:num)', 'PendaftaranController::showForm/$1');
$routes->get('pendaftaran/form-berbayar/(:num)', 'PendaftaranController::formBerbayar/$1');
$routes->post('pendaftaran/storeBerbayar', 'PendaftaranController::storeBerbayar');
$routes->post('p2', 'PendaftaranController::storeGratis');
$routes->post('pendaftaran/update/(:num)', 'PendaftaranController::update/$1');
