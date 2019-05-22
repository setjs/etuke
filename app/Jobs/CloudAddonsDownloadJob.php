<?php

/*
 * This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Jobs;

use App\Models\Addons;
use GuzzleHttp\Client;
use App\Models\AddonsLog;
use App\Models\AddonsVersion;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use App\Events\AddonsInstallFailEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CloudAddonsDownloadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $addons;
    public $version;
    public $downloadUrl;
    public $nextStep;

    /**
     * Create a new job instance.
     */
    public function __construct(Addons $addons, AddonsVersion $version, string $downloadUrl)
    {
        $this->addons = $addons;
        $this->version = $version;
        $this->downloadUrl = $downloadUrl;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $client = new Client(['verify' => false]);
        $savePath = storage_path('app/addons/'.str_random(32).'.zip');
        $response = $client->get($this->downloadUrl, ['save_to' => $savePath]);
        if ($response->getStatusCode() != 200) {
            // TODO 记录到插件日志
            Log::error('插件下载出错，错误信息：'.$response->getBody());

            event(new AddonsInstallFailEvent($this->addons, $this->version, AddonsLog::TYPE_DOWNLOAD, $response->getBody()));

            return;
        }
        // 到这里下载成功，接下来是插件的安装或者升级[提交给任务立即处理]
        dispatch_now(new AddonsInstallJob($this->addons, $this->version, $savePath));
    }
}
