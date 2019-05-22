<?php

Route::group(['domain'=>'et.io'],function(){
    require ('www.php');
});

Route::group(['domain'=>'admin.et.io'],function(){
    require ('admins.php');
});