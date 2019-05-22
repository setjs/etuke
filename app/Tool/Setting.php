<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Tool;

use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;

class Setting
{
    protected $files;
    protected $dist;

    public function __construct()
    {
        $this->files = new Filesystem();
        $this->dist = config('etuke.save');
    }

    /**
     * @param $param
     */
    public function save($param)
    {
        $data = $param;
        if ($data instanceof Request) {
            $data = $param->all();
        }
        $setting = collect($data)->filter(function ($item, $index) {
            return preg_match('/\*/', $index);
        })->mapWithKeys(function ($item, $index) {
            $index = str_replace('*', '.', $index);

            return [$index => $item];
        })->toArray();
        $this->put($setting);
    }

    /**
     * 自定义配置同步到Laravel系统中.
     */
    public function sync()
    {
        collect($this->get())->map(function ($item, $key) {
            config([$key => $item]);
        });
        $this->specialSync();
    }

    /**
     * 一些特殊配置.
     */
    protected function specialSync(): void
    {
        // 短信服务注册
        config(['sms.default.gateways' => [config('etuke.system.sms')]]);
    }

    /**
     * 修改配置.
     *
     * @param array $setting
     */
    public function put(array $setting): void
    {
        $this->files->put($this->dist, json_encode($setting));
    }

    /**
     * 读取自定义配置.
     *
     * @return array
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function get(): array
    {
        if (! $this->files->exists($this->dist)) {
            return [];
        }
        $jsonContent = $this->files->get($this->dist);
        $arrayContent = json_decode($jsonContent, true);

        return $arrayContent;
    }
}
