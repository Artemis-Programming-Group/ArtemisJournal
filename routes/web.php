<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;




Volt::route('/', 'pages.home')->name('home');
Volt::route('posts', 'pages.posts.index')->name('posts');
Volt::route('post/{post:slug}/show', 'pages.posts.show')->name('post-details');


Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')->name('register');
    Volt::route('login', 'pages.auth.login')->name('login');
});

Route::middleware('auth')->prefix('user/')->group(function () {

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Volt::route('dashboard', 'pages.dashboard')->name('dashboard');
    Volt::route('profile', 'pages.profile')->name('profile');

    Volt::route('comments/index', 'pages.comments.index')->name('comments.index');

    Volt::route('tag/index', 'pages.tags.index')->name('tags.index');
    Volt::route('tag/create', 'pages.tags.create')->name('tags.create');
    Volt::route('tag/{tag}/edit', 'pages.tags.edit')->name('tags.edit');

    Volt::route('post/index', 'pages.posts.index')->name('posts.index');
    Volt::route('post/create', 'pages.posts.create')->name('posts.create');
    Volt::route('post/{post:slug}/show', 'pages.posts.show')->name('posts.show');
    Volt::route('post/{post}/edit', 'pages.posts.edit')->name('posts.edit');
    Volt::route('post/{post}/destroy', 'pages.posts.edit')->name('posts.destroy');
});


Route::view('theme-page-sample-1', 'theme-page-sample-1');
Route::view('theme-page-sample-2', 'theme-page-sample-2');
Route::view('theme-page-sample-3', 'theme-page-sample-3');
