<?php

use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\SocialNetworkController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('/students',StudentController::class );
Route::resource('/experience',ExperienceController::class );
Route::resource('/projects',ProjectController::class );
Route::resource('/education',StudentController::class );
Route::resource('/skills',SkillController::class);
Route::resource('/social_networks',SocialNetworkController::class );
Route::resource('/languages',LanguageController::class );
