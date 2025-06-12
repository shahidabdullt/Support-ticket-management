<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Ticketcontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//support-ticket-creation routes
Route::prefix('ticket')->group(function () {
    Route::get('/create', [TicketController::class, 'create']);
    Route::post('/store', [TicketController::class, 'store']);
});

//admin-login-routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login']);
Route::post('/login', [AdminController::class, 'authenticate']);
});

//admin routes to view support tickets
Route::middleware(['adminmiddleware'])->group(function () {
    Route::get('/ticketlist', [AdminController::class, 'ticketlist']);
    Route::get('/admin/tickets/{id}/{type}', [AdminController::class, 'viewTicket']);
    Route::post('/admin/tickets/{id}/{type}/note', [AdminController::class, 'addNote']);
    Route::post('Logout', [AdminController::class, 'Logout'])->name('Logout');
});

