<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Exceptions;

use Exception;

class ToolErrorResponseJsonException extends Exception
{
    public function render()
    {
        return exception_response($this);
    }
}
