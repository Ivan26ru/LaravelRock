<?php

use App\Domain\Models\User;
use App\Http\Controllers\ProfileController;
use App\Presentation\Controllers\HomeController;
use App\Presentation\Controllers\Posts\Create;
use App\Presentation\Controllers\Posts\Index;
use App\Presentation\Controllers\Posts\Show;
use App\Presentation\Controllers\Posts\Update;
use App\Presentation\Controllers\Telegramm\TelegramController;
use Illuminate\Support\Facades\Route;

// @todo сделать только для дев режима
Route::get('/force_login/{user}', function (User $user) {
    Auth::login($user);
    print_r($user->toArray());
})->where('user', '[0-9]+');

Route::get('telegram', [TelegramController::class, 'handle'])->name('telegram');

// user, postID
Route::get('p/{postId}/edit', function (int $post) {
//    dump(request()->user()->toArray());
    return 123; // Здесь можно вернуть ваше представление
})->where('postId', '[0-9]+');
//    ->middleware([
//        'auth',
//        'postMiddleware',
////        'access:admin,editor'
//    ]);


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', function () {
    return redirect('/');
});
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/skills', [HomeController::class, 'skills'])->name('skills');

Route::prefix('posts')->group(function () {
    Route::get('secure', function (){
        return 'ok';
    })->middleware('auth')->name('posts.secure');

    Route::get('/', Index::class)->name('posts.index');
    Route::get('{postId}', Show::class)->where('postId', '[0-9]+')->name('posts.show');

    Route::middleware(['auth'])->group(function () {
        Route::get('create', [Create::class, 'form'])
            ->name('posts.create');
        Route::post('/', [Create::class, 'store'])
            ->name('posts.store');

        Route::middleware('postMiddleware')->group(function () {
            Route::get('{postId}/edit', [Update::class, 'form'])->where('postId', '[0-9]+')->name(
                'posts.edit'
            );
            Route::post('{postId}/edit', [Update::class, 'update'])->where('postId', '[0-9]+')->name(
                'posts.update'
            );
        });
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
