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

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CourseRequest;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');
        $courses = Course::when($keywords, function ($query) use ($keywords) {
            return $query->where('title', 'like', '%'.$keywords.'%');
        })
            ->orderByDesc('created_at')
            ->paginate(10);

        $courses->appends($request->input());

        return view('admin.course.index', compact('courses'),[
            'pitch'=>'video'
        ]);
    }

    public function create()
    {
        return view('admin.course.create',[
            'pitch'=>'video'
        ]);
    }

    public function store(CourseRequest $request, Course $course){

        $course->fill($request->fillData())->save();

        return ['code'=>0 , 'msg'=>'success'];
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.course.edit', compact('course'),[
            'pitch'=>'video'
        ]);
    }

    public function update(CourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->fill($request->filldata())->save();
        flash('课程编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if ($course->videos()->exists()) {
            flash('该课程下存在视频，无法删除');
        } else {
            $course->delete();
            flash('删除成功', 'success');
        }

        return back();
    }
}
