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

use App\Models\Link;
use App\Http\Requests\Admin\LinkRequest;

class LinkController extends Controller
{
    public function index()
    {
        $links = Link::orderBy('sort')->get();

        return view('admin.link.index', compact('links'),[
            'pitch'=>'operated'
        ]);
    }

    public function create()
    {
        return view('admin.link.create',[
            'pitch'=>'operated'
        ]);
    }

    public function store(LinkRequest $request)
    {
        Link::create($request->filldata());
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $link = Link::findOrFail($id);

        return view('admin.link.edit', compact('link'),[
            'pitch'=>'operated'
        ]);
    }

    public function update(LinkRequest $request, $id)
    {
        $role = Link::findOrFail($id);
        $role->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        Link::destroy($id);
        flash('删除成功', 'success');

        return back();
    }
}
