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
use Illuminate\Http\Request;
use App\Http\Requests\Admin\BookRequest;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::latest()->paginate($request->input('page_size', 10));

        return view('admin.book.index', compact('books'),[
            'pitch'=>'book'
        ]);
    }

    public function create()
    {
        return view('admin.book.create',[
            'pitch'=>'book'
        ]);
    }

    public function store(BookRequest $request)
    {

        $result = Book::create($request->fillData());

        return $result ;
        flash('创建成功', 'success');

        return back();
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('admin.book.edit', compact('book'),[
            'pitch'=>'book'
        ]);
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->fill($request->filldata())->save();
        flash('编辑成功', 'success');

        return back();
    }

    public function destroy($id)
    {
        Book::destroy($id);
        flash('删除成功', 'success');

        return back();
    }
}
