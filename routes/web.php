<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\GostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RezervacijaController;
use App\Http\Controllers\StoController;
use App\Http\Controllers\KomentarController;
use App\Models\Sto;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', function () {
    return redirect('/contact')->with('success', 'Poruka je uspešno poslata!');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/stos/{id}/komentari', [KomentarController::class, 'store'])->name('komentari.store');
    Route::get('/komentari/{id}/edit', [KomentarController::class, 'edit'])->name('komentari.edit');
    Route::put('/komentari/{id}', [KomentarController::class, 'update'])->name('komentari.update');
    Route::delete('/komentari/{id}', [KomentarController::class, 'destroy'])->name('komentari.destroy');
});

Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {

    Route::get("/", [ChartController::class,"index"])->name("chart.index");
    Route::prefix("stos")->group(function(){
        Route::get("/", [StoController::class, 'index'])->name('stos.index');

        Route::get("/create", [StoController::class, 'create'])->name('stos.create');
        Route::post("/store", [StoController::class, 'store'])->name('stos.store');

        Route::get("/edit/{id}", [StoController::class, 'edit'])->name('stos.edit');
        Route::put("/update/{id}", [StoController::class, 'update'])->name('stos.update');

        Route::delete('/delete/{id}', [StoController::class, 'destroy'])->name('stos.delete');
    });
    Route::prefix("gosts")->group(function(){
        Route::get("/", [GostController::class, 'index'])->name('gosts.index');

        Route::get("/create", [GostController::class, 'create'])->name('gosts.create');
        Route::post("/store", [GostController::class, 'store'])->name('gosts.store');

        Route::get("/edit/{id}", [GostController::class, 'edit'])->name('gosts.edit');
        Route::put("/update/{id}", [GostController::class, 'update'])->name('gosts.update');

        Route::delete('/delete/{id}', [GostController::class, 'destroy'])->name('gosts.delete');
    });
    Route::prefix("rezervacijas")->group(function(){
        Route::get("/", [RezervacijaController::class, 'index'])->name('rezervacijas.index');

        Route::get("/create", [RezervacijaController::class, 'create'])->name('rezervacijas.create');
        Route::post("/store", [RezervacijaController::class, 'store'])->name('rezervacijas.store');

        Route::get("/edit/{id}", [RezervacijaController::class, 'edit'])->name('rezervacijas.edit');
        Route::put("/update/{id}", [RezervacijaController::class, 'update'])->name('rezervacijas.update');

        Route::delete('/delete/{id}', [RezervacijaController::class, 'destroy'])->name('rezervacijas.delete');
        Route::patch('/confirm/{id}', [RezervacijaController::class, 'confirm'])->name('rezervacijas.confirm');
    });
    Route::prefix("komentari")->group(function(){
        Route::get("/", [App\Http\Controllers\Admin\KomentarController::class, 'index'])->name('komentari.index');

        Route::get("/edit/{id}", [App\Http\Controllers\Admin\KomentarController::class, 'edit'])->name('komentari.edit');
        Route::put("/update/{id}", [App\Http\Controllers\Admin\KomentarController::class, 'update'])->name('komentari.update');
        
        Route::delete('/delete/{id}', [App\Http\Controllers\Admin\KomentarController::class, 'delete'])->name('komentari.delete');
    });
});
Route::middleware('isEditor')->prefix('editor')->group(function () {
    Route::prefix("stos")->group(function(){
        Route::get("/", [StoController::class, 'index'])->name('editor.stos.index');

        Route::get("/create", [StoController::class, 'create'])->name('editor.stos.create');
        Route::post("/store", [StoController::class, 'store'])->name('editor.stos.store');

        Route::get("/edit/{id}", [StoController::class, 'edit'])->name('editor.stos.edit');
        Route::put("/update/{id}", [StoController::class, 'update'])->name('editor.stos.update');
    });
    Route::prefix("gosts")->group(function(){
        Route::get("/", [GostController::class, 'index'])->name('editor.gosts.index');
        Route::get("/create", [GostController::class, 'create'])->name('editor.gosts.create');
        Route::post("/store", [GostController::class, 'store'])->name('editor.gosts.store');
        Route::get("/edit/{id}", [GostController::class, 'edit'])->name('editor.gosts.edit');
        Route::put("/update/{id}", [GostController::class, 'update'])->name('editor.gosts.update');
    });
    Route::prefix("rezervacijas")->group(function(){
        Route::get("/", [RezervacijaController::class, 'index'])->name('editor.rezervacijas.index');
        Route::get("/create", [RezervacijaController::class, 'create'])->name('editor.rezervacijas.create');
        Route::post("/store", [RezervacijaController::class, 'store'])->name('editor.rezervacijas.store');
        Route::get("/edit/{id}", [RezervacijaController::class, 'edit'])->name('editor.rezervacijas.edit');
        Route::put("/update/{id}", [RezervacijaController::class, 'update'])->name('editor.rezervacijas.update');
        Route::patch('/confirm/{id}', [RezervacijaController::class, 'confirm'])->name('editor.rezervacijas.confirm');
    });
});


Route::middleware('isUser')->prefix('user')->group(function () {
    Route::get('/rezervacije', [RezervacijaController::class, 'userReservations'])->name('user.rezervacije.index');
    Route::get('/rezervacije/create', [RezervacijaController::class, 'create'])->name('user.rezervacije.create');
    Route::post('/rezervacije/store', [RezervacijaController::class, 'store'])->name('user.rezervacije.store');
});

Route::get('/stos', [StoController::class, 'index'])->name('stos.index');
Route::get('/stos/{id}', [StoController::class, 'show'])->name('stos.show');
Route::get('/rezervacije-stolova', [StoController::class, 'reservations'])->name('stos.reservations');
Route::get('/kontakt', [App\Http\Controllers\KontaktController::class, 'show'])->name('kontakt');

require __DIR__.'/auth.php';
