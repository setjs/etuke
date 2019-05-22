<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Albums extends Model
{
    use SoftDeletes;

    const SHOW_YES = 1;
    const SHOW_NO = -1;

    protected $table = 'albums';

    protected $fillable = [
        'id', 'name', 'thumb',
        'created_at',  'desc'
    ];

    protected $appends = [
        'edit_url', 'destroy_url', 'chapter_url',
    ];
    public $timestamps= false ;
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $model->chapters()->delete();
        });
    }

    /**
     * @return string
     */
    public function getEditUrlAttribute()
    {
        return route('photo.edit', $this);
    }

    /**
     * @return string
     */
//    public function getDestroyUrlAttribute()
//    {
//        return route('backend.book.destroy', $this);
//    }

    /**
     * @return string
     */
//    public function getChapterUrlAttribute()
//    {
//        return route('backend.book.chapter.index', $this);
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function users(){

        return $this->belongsToMany(User::class, 'user_book', 'book_id', 'id');
    }

    /**
     * 作用域：显示.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeShow($query)
    {
        return $query->where('is_show', self::SHOW_YES);
    }

    /**
     * 作用域：不显示.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeNotShow($query)
    {
        return $query->where('is_show', self::SHOW_NO);
    }

    /**
     * 作用域：上线的视频.
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', date('Y-m-d H:i:s'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters()
    {
        return $this->hasMany(BookChapter::class, 'book_id');
    }

    /**
     * 获取已出版且显示的章节
     *
     * @return mixed
     */
    public function showAndPublishedChapter()
    {
        return $this->chapters()->published()->show()->orderBy('published_at')->get();
    }
}
