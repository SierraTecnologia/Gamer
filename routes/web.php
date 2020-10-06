<?php

// @todo Ja usando
// Route::group(
//     ['middleware' => ['web']], function () {

//         Route::prefix('gamer')->group(
//             function () {
//                 Route::group(
//                     ['as' => 'gamer.'], function () {
            
//                         Route::group(
//                             ['middleware' => 'profile', 'prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Profile'], function () {
//                                 Route::get('home', 'HomeController@index')->name('home');
//                             }
//                         );
//                         Route::group(
//                             ['middleware' => 'root', 'prefix' => 'root', 'as' => 'root.', 'namespace' => 'Root'], function () {
//                                 Route::get('home', 'HomeController@index')->name('home');
//                             }
//                         );

            
//                     }
//                 );
//             }
//         );

//     }
// );
