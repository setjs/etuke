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

use Carbon\Carbon;
use App\Models\AdFrom;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdFromRequest;

class AdFromController extends Controller
{
    public function index()
    {
        $rows = AdFrom::orderBy('id')->paginate(10);

        return view('admin.adfrom.index', compact('rows'),[
            'pitch'=>'operated'
        ]);
    }

    public function create()
    {
        return view('admin.adfrom.create',[
            'pitch'=>'operated'
        ]);
    }

    public function store(AdFromRequest $request)
    {
        AdFrom::create($request->filldata());
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $one = AdFrom::findOrFail($id);

        return view('admin.adfrom.edit', compact('one'),[
            'pitch'=>'operated'
        ]);
    }

    public function update(AdFromRequest $request, $id)
    {
        $one = AdFrom::findOrFail($id);
        $one->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        AdFrom::destroy($id);
        flash('删除成功', 'success');

        return back();
    }

    public function number(Request $request, $id)
    {
        $one = AdFrom::findOrFail($id);
        $startDate = $request->input('start_date', date('Y-m-d', Carbon::now()->subDays(30)->timestamp));
        $endDate = $request->input('end_date', date('Y-m-d', Carbon::now()->timestamp));
        $records = $one->numbers()->whereBetween('day', [$startDate, $endDate])->get();
        $rows = collect([]);
        foreach ($records as $item) {
            $rows->push([
                'x' => $item->day,
                'y' => $item->num,
            ]);
        }

        return view('admin.adfrom.number', compact('one', 'rows'),[
            'pitch'=>'operated'
        ]);
    }
}
