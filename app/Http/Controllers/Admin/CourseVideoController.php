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

use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CourseVideoRequest;

class CourseVideoController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');

        $videos = Video::with(['course'])
            ->when($keywords, function ($query) use ($keywords) {
                return $query->where('title', 'like', "%{$keywords}%");
            })
            ->orderByDesc('published_at')
            ->select([
                'id', 'user_id', 'course_id', 'title',
                'slug', 'url', 'charge', 'view_num',
                'short_description', 'description',
                'seo_keywords', 'seo_description',
                'published_at', 'is_show', 'created_at',
                'updated_at',
            ])
            ->paginate($request->input('page_size', 10));

        $videos->appends($request->input());

        return view('admin.video.index', compact('videos'),[
            'pitch'=>'video'
        ]);
    }

    public function create()
    {
        $courses = Course::all();

        return view('admin.video.create', compact('courses'),[
            'pitch'=>'video'
        ]);
    }

    public function store(CourseVideoRequest $request, Video $video)
    {
        $video->fill($request->filldata())->save();
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);

        $courses = Course::all();

        return view('admin.video.edit', compact('video', 'courses'),[
            'pitch'=>'video'
        ]);
    }

    public function update(CourseVideoRequest $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        Video::destroy($id);
        flash('删除成功', 'success');

        return back();
    }
}
