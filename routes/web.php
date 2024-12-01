<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TypesOfAttractionController;

use App\Http\Controllers\SpotController;
use App\Http\Controllers\RecommendationController;

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\UserProfileController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('website.index');
})->name('website');


Route::get('/dashboard', function () {
    //return view('dashboard');

    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Division

Route::get('dashboard/division', [DivisionController::class, 'index'])->name('all_division');
Route::get('dashboard/division/add', [DivisionController::class, 'add'])->name('add_division');
Route::get('dashboard/division/edit/{slug}', [DivisionController::class, 'edit'])->name('edit_division');
Route::post('dashboard/division/submit', [DivisionController::class, 'submit'])->name('submit_division');
Route::post('dashboard/division/update', [DivisionController::class, 'update'])->name('update_division');

// District
Route::get('dashboard/district', [DistrictController::class, 'index'])->name('all_district');
Route::get('dashboard/district/add', [DistrictController::class, 'add'])->name('add_district');
Route::get('dashboard/district/edit/{slug}', [DistrictController::class, 'edit'])->name('edit_district');
Route::post('dashboard/district/submit', [DistrictController::class, 'submit'])->name('submit_district');
Route::post('dashboard/district/update', [DistrictController::class, 'update'])->name('update_district');


// Types of attraction 

Route::get('dashboard/types-of-attraction', [TypesOfAttractionController::class, 'index'])->name('all_types_of_attraction');
Route::get('dashboard/types-of-attraction/add', [TypesOfAttractionController::class, 'add'])->name('add_types_of_attraction');

Route::get('dashboard/types-of-attraction/edit/{slug}', [TypesOfAttractionController::class, 'edit'])->name('edit_types_of_attraction');
Route::post('dashboard/types-of-attraction/submit', [TypesOfAttractionController::class, 'submit'])->name('submit_types_of_attraction');

Route::post('dashboard/types-of-attraction/update', [TypesOfAttractionController::class, 'update'])->name('update_types_of_attraction');

// Spot
Route::get('dashboard/spot', [SpotController::class, 'index'])->name('all_spot');
Route::get('dashboard/spot/add', [SpotController::class, 'add'])->name('add_spot');

Route::get('dashboard/spot/add/district/under/division/{id}', [SpotController::class, 'district_under_division'])->name('district_under_division');


Route::get('dashboard/spot/edit/{slug}', [SpotController::class, 'edit'])->name('edit_spot');
Route::get('dashboard/spot/view/{slug}', [SpotController::class, 'view'])->name('view_spot');

Route::post('dashboard/spot/submit', [SpotController::class, 'submit'])->name('submit_spot');
Route::post('dashboard/spot/update', [SpotController::class, 'update'])->name('update_spot');


Route::post('dashboard/spot/delete', [SpotController::class, 'delete'])->name('delete_spot');

// User profile

Route::get('dashboard/my-profile/view/{slug}', [UserProfileController::class, 'view'])->name('view_user_profile');
Route::get('dashboard/my-profile/edit/{slug}', [UserProfileController::class, 'edit'])->name('edit_user_profile');


Route::post('dashboard/my-profile/update', [UserProfileController::class, 'update'])->name('update_user_profile');
Route::get('dashboard/my-profile/change-password/{slug}', [UserProfileController::class, 'change_password'])->name('change_password');
Route::post('dashboard/my-profile/change-password/update', [UserProfileController::class, 'change_password_update'])->name('change_password_update');

// Website
// Recommendation 
Route::get('recommendation/search', [RecommendationController::class, 'index'])->name('recommendation_search');
Route::get('recommendation/fetch/district/under/division/{id}', [RecommendationController::class, 'district_under_division'])->name('recommendation_fetch_district_under_division');

Route::get('recommendation/tourist-place', [RecommendationController::class, 'recommendation'])->name('recommendation_tourist_place');
Route::get('recommended/spot-details/{slug}', [RecommendationController::class, 'details'])->name('recommended_spot_details');

// Spot Review & Rating
Route::middleware(['auth'])->group(function () {
    Route::post('recommended-spot/review-and-rating/submit', [RecommendationController::class, 'review_rating_submit'])->name('submit_spot_review_and_rating');
});

// Contact us
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard/contact', [ContactUsController::class, 'index'])->name('all_contact');
    Route::get('dashboard/contact/view/{slug}', [ContactUsController::class, 'view'])->name('view_contact');
    Route::post('dashboard/contact/delete', [ContactUsController::class, 'delete'])->name('delete_contact');
});
Route::post('dashboard/contact/submit', [ContactUsController::class, 'submit'])->name('submit_contact');

require __DIR__.'/auth.php';


