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

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MemberRequest;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');

        $members = User::when($keywords, function ($query) use ($keywords) {
            return $query->where('nickname', 'like', "%{$keywords}%")
                ->orWhere('mobile', 'like', "%{$keywords}%");
        })->orderByDesc('created_at')
            ->paginate($request->input('page_size', 15));

        $members->appends($request->input());

        return view('admin.member.index', compact('members'),[
            'pitch'=>'member'
        ]);
    }

    public function show($id)
    {
        $member = User::findOrFail($id);

        return view('admin.member.show', compact('member'),[
            'pitch'=>'member'
        ]);
    }

    public function create(){

        return view('admin.member.create',[
            'pitch'=>'member'
        ]);
    }

    public function store(MemberRequest $request){

        User::create($request->fillData());
       // flash('添加成功', 'success');

//        return back();
    }
}
