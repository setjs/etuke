<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    const SHOW_YES = 1;
    const SHOW_NO = -1;

    protected $table = 'photo';

    protected $fillable = [
        'id', 'published_at','uid', 'album_id', 'thumb',
        'created_at', 'category_id', 'desc','amount','tag_id','platform',
        'title','total', 'seo_keywords', 'seo_description'
    ];

    protected $appends = [
        'edit_url', 'destroy_url', 'chapter_url',
    ];

    public $timestamps = false ;

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
        return route('get.double.edit', $this);
    }

    /**
     * @return string
     */
    public function getDestroyUrlAttribute()
    {
        return route('photo.destroy', $this);
    }

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

        return $this->belongsToMany(User::class, 'photo', 'uid', 'id');
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
    public function showAndPublishedChapter(){

        return $this->chapters()->published()->show()->orderBy('published_at')->get();
    }

    protected function homeList(){

        return self::leftJoin('albums as a','a.id' , '=' , 'photo.album_id')
            ->orderBy('photo.id' , 'desc')
            ->select('photo.*' , 'a.name')
            ->paginate(24);
    }

    protected function photoLine($id){

        return self::where('photo.id' , $id)
            ->first();
    }
}
