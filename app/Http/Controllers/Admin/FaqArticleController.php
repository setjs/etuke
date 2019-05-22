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

use App\Models\FaqArticle;
use App\Models\FaqCategory;
use App\Http\Requests\Admin\FaqArticleRequest;

class FaqArticleController extends Controller
{
    public function index()
    {
        $articles = FaqArticle::with('category')->orderByDesc('updated_at')->paginate(15);

        return view('admin.faq_article.index', compact('articles'),[
            'pitch'=>'fqa'
        ]);
    }

    public function create()
    {
        $categories = FaqCategory::all();

        return view('admin.faq_article.create', compact('categories'),[
            'pitch'=>'fqa'
        ]);
    }

    public function store(FaqArticleRequest $request)
    {
        FaqArticle::create($request->filldata());
        flash('添加成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $article = FaqArticle::findOrFail($id);
        $categories = FaqCategory::all();

        return view('admin.faq_article.edit', compact('article', 'categories'),[
            'pitch'=>'fqa'
        ]);
    }

    public function update(FaqArticleRequest $request, $id)
    {
        $article = FaqArticle::findOrFail($id);
        $article->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        $article = FaqArticle::findOrFail($id);
        $article->delete();
        flash('删除成功', 'success');

        return back();
    }
}
