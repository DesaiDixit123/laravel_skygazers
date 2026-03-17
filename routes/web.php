<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TalentController;
use App\Http\Controllers\Admin\TalentSettingController;
use App\Http\Controllers\Admin\TalentCountryController;
use App\Http\Controllers\Admin\TalentCategoryController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Admin\ContactMessageController;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ModelApplicationController;
use App\Http\Controllers\Admin\ModelApplicationController as AdminModelApplicationController;
use App\Http\Controllers\Admin\ExportController;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/talent/{name}', [FrontendController::class, 'talentDetails'])->name('talent.details');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/talent-network', [FrontendController::class, 'talentNetwork'])->name('talent.network');

Route::get('/become-a-model', function () {
    return view('become-a-model');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/become-a-model', [ModelApplicationController::class, 'store'])->name('model-application.store');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/', function() { return redirect()->route('admin.dashboard'); });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::patch('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('admin.services.toggle-status');
        Route::resource('services', ServiceController::class, ['as' => 'admin']);
        
        // Talent Network Dropdown Routes
        Route::get('talent-settings', [TalentSettingController::class, 'index'])->name('admin.talent-settings.index');
        Route::post('talent-settings', [TalentSettingController::class, 'update'])->name('admin.talent-settings.update');
        
        Route::patch('talent-countries/{talentCountry}/toggle-status', [TalentCountryController::class, 'toggleStatus'])->name('admin.talent-countries.toggle-status');
        Route::resource('talent-countries', TalentCountryController::class, ['as' => 'admin']);
        
        Route::patch('talent-categories/{talentCategory}/toggle-status', [TalentCategoryController::class, 'toggleStatus'])->name('admin.talent-categories.toggle-status');
        Route::resource('talent-categories', TalentCategoryController::class, ['as' => 'admin']);
        
        Route::patch('talent/{talent}/toggle-status', [TalentController::class, 'toggleStatus'])->name('admin.talent.toggle-status');
        Route::delete('talent/image/{image}', [TalentController::class, 'deleteImage'])->name('admin.talent.delete-image');
        Route::resource('talent', TalentController::class, ['as' => 'admin']);
        
        Route::resource('messages', ContactMessageController::class, ['as' => 'admin'])->only(['index', 'show', 'destroy']);
        Route::resource('model-applications', AdminModelApplicationController::class, ['as' => 'admin'])->only(['index', 'show', 'destroy']);
        
        Route::resource('content', SiteContentController::class, ['as' => 'admin']);
        
        Route::get('export/{resource}/{format}', [ExportController::class, 'export'])->name('admin.export');
    });
});
