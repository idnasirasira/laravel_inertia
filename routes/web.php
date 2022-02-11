<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy']);

Route::middleware('auth')->group(function(){

    Route::get('/', function () {
        return Inertia::render('Home', [
            'username' => 'Aris Arisandi',
            'frameworks' => [
                'Laravel', 'Vue', 'Inertia'
            ],
        ]);
    });

    Route::get('/users', function() {
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function($query, $search){
                    $query->where('name', 'like', "%$search%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class),
                'editUser' => Auth::user()->can('edit', User::class),
                'deleteUser' => Auth::user()->can('delete', User::class),
            ]
        ]);
    });

    Route::get('/users/create', function(){
        return Inertia::render('Users/Create');
    })->can('create', 'App\Models\User');

    Route::get('/users/{user}/edit', function(User $user){
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    })->can('create', 'App\Models\User');

    Route::post('/users', function(){
        Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::create([
            'name' => Request::input('name'),
            'email' => Request::input('email'),
            'password' => Request::input('password'),
        ]);

        return redirect('/users');
    });

    Route::post('/users/{user}', function(User $user){
        Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
        ]);

        $user->name = Request::input('name');
        $user->email = Request::input('email');
        $user->update();

        return redirect('/users');
    });

    Route::delete('/users/{user}', function(User $user){
        $user->delete();

        return redirect('/users');
    });

    Route::get('/settings', function() {
        return Inertia::render('Settings');
    });



});