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

use App\Models\Book;
use App\Models\BookChapter;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BookChapterRequest;

class BookChapterController extends Controller
{
    public function index(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $chapters = $book->chapters()->publishedDesc()->get();

        return view('admin.book_chapter.index', compact('chapters', 'book'),[
            'pitch'=>'book'
        ]);
    }

    public function create($bookId)
    {
        $book = Book::findOrFail($bookId);

        return view('admin.book_chapter.create', compact('book'),[
            'pitch'=>'book'
        ]);
    }

    public function store(BookChapterRequest $request, $bookId)
    {
        BookChapter::create($request->filldata());
        flash('创建成功', 'success');

        return back();
    }

    public function edit($bookId, $id){

        $book = Book::findOrFail($bookId);
        $chapter = $book->chapters()->whereId($id)->firstOrFail();

        return view('admin.book_chapter.edit', compact('book', 'chapter'),[
            'pitch'=>'book'
        ]);
    }

    public function update(BookChapterRequest $request, $bookId, $id)
    {
        $book = BookChapter::findOrFail($id);
        $book->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($bookId, $id)
    {
        BookChapter::destroy($id);
        flash('删除成功', 'success');

        return back();
    }
}
