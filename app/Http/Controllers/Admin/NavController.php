<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Admin;



class NavController extends Controller
{
    public function index()
    {
       return view('admin.nav.index',[
           'pitch'=>'system'
       ]);
    }




}
