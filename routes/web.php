<?php

declare(strict_types=1);

namespace Routes;

require_once __DIR__.'/../vendor/autoload.php';

use Routes\Route;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\ProjectController;
use App\Controllers\UserController;

/**
 * Adicionar rotas
 */

// Página inicial para quem está autenticado
Route::add('/home', HomeController::class.'@index', 'GET');

Route::add('/explore', HomeController::class.'@showExplore', 'GET');

// Rotas relacionadas aos Projetos
Route::add('/projects', ProjectController::class.'@index', 'GET');
Route::add('/projects/create', ProjectController::class.'@showProjectCreationForm', 'GET');
Route::add('/projects/create', ProjectController::class.'@create', 'POST');
Route::add('/projects/{id}/edit', ProjectController::class.'@edit', 'GET');
Route::add('/projects/{id}/update', ProjectController::class.'@update', 'POST');
Route::add('/projects/{id}/delete', ProjectController::class.'@delete', 'GET');

// Registro e login --- autenticação
Route::add('/welcome', AuthController::class.'@showLoginOrRegister', 'GET');
Route::add('/register', AuthController::class.'@showRegistrationForm', 'GET');
Route::add('/register', AuthController::class.'@register', 'POST');
Route::add('/login', AuthController::class.'@showLoginForm', 'GET');
Route::add('/login', AuthController::class.'@login', 'POST');
Route::add('/logout', AuthController::class.'@logout', 'GET'); 

// Postagens
Route::add('/post/view', PostController::class.'@showPosts', 'GET');
Route::add('/post/create', PostController::class.'@showPostCreationForm', 'GET');
Route::add('/post/create', PostController::class.'@create', 'POST');

// Despacho de rotas
$url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
Route::dispatch($url, $method);
