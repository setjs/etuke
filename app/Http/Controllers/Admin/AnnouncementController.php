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

use App\Models\Announcement;
use App\Http\Requests\Admin\AnnouncementRequest;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('administrator')->orderByDesc('created_at')->paginate(10);

        return view('admin.announcement.index', compact('announcements'),[
            'pitch'=>'operated'
        ]);
    }

    public function create()
    {
        return view('admin.announcement.create',[
            'pitch'=>'operated'
        ]);
    }

    public function store(AnnouncementRequest $request)
    {
        admin()->announcements()->save(new Announcement($request->filldata()));
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $announcement = admin()->announcements()->whereId($id)->firstOrFail();

        return view('admin.announcement.edit', compact('announcement'),[
            'pitch'=>'operated'
        ]);
    }

    public function update(AnnouncementRequest $request, $id)
    {
        $announcement = admin()->announcements()->whereId($id)->firstOrFail();
        $announcement->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        Announcement::destroy($id);
        flash('删除成功', 'success');

        return back();
    }
}
