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

class SmsRecord extends Model
{
    protected $table = 'sms_records';
    public $timestamps = false ;
    protected $fillable = [
        'mobile', 'code' , 'created_at'
    ];

    public static function createData(string $mobile, $code){

        $self = new self();
        $self->mobile = $mobile;
        $self->code = $code;
        $self->created_at= time();
        $self->save();
    }
}
