<?php

/*
* This file is part of the setjs/etuke.
 *
 * (c) etuke <etuke@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Pc;

use App\Models\Order;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use App\Repositories\VideoRepository;
use App\Http\Requests\Frontend\CourseOrVideoCommentCreateRequest;

class VideoController extends FrontendController
{
    public function show($courseId, $id, $slug)
    {
        $video = Video::with(['course', 'comments', 'user', 'comments.user'])
            ->published()
            ->show()
            ->whereId($id)
            ->firstOrFail();
        $title = sprintf('视频《%s》', $video->title);
        $keywords = $video->keywords;
        $description = $video->description;
        $comments = $video->comments()->orderByDesc('created_at')->paginate(8);

        // 视频观看次数[UV]
        $video->view_num++;
        $video->save();

        return v('frontend.video.show', compact('video', 'title', 'keywords', 'description', 'comments'));
    }

    public function commentHandler(CourseOrVideoCommentCreateRequest $request, $videoId)
    {
        $video = Video::findOrFail($videoId);
        $comment = $video->commentHandler($request->input('content'));
        $comment ? flash('评论成功', 'success') : flash('评论失败');

        return back();
    }

    public function showBuyPage($id)
    {
        $video = Video::findOrFail($id);
        $title = sprintf('购买视频《%s》', $video->title);

        return v('frontend.video.buy', compact('video', compact('title')));
    }

    public function buyHandler(VideoRepository $repository, $id)
    {
        $video = Video::findOrFail($id);
        $user = Auth::user();

        $order = $repository->createOrder($user, $video);
        if (! ($order instanceof Order)) {
            flash($order, 'warning');

            return back();
        }

        flash('下单成功，请支付', 'success');

        return redirect(route('order.show', $order->order_id));
    }
}
