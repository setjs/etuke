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

use App\Models\FaqCategory;
use App\Http\Requests\Admin\FaqCategoryRequest;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::sortAsc()->get();

        return view('admin.faq_category.index', compact('categories'),[
            'pitch'=>'fqa'
        ]);
    }

    public function create()
    {
        return view('admin.faq_category.create',[
            'pitch'=>'fqa'
        ]);
    }

    public function store(FaqCategoryRequest $request)
    {
        FaqCategory::create($request->filldata());
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $category = FaqCategory::findOrFail($id);

        return view('admin.faq_category.edit', compact('category'),[
            'pitch'=>'fqa'
        ]);
    }

    public function update(FaqCategoryRequest $request, $id)
    {
        $category = FaqCategory::findOrFail($id);
        $category->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        $category = FaqCategory::findOrFail($id);
        if ($category->articles()->exists()) {
            flash('该分类下存在文章，无法删除');
        } else {
            $category->delete();
            flash('删除成功', 'success');
        }

        return back();
    }
}
