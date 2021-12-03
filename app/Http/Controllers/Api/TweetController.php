<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Services\Tweet\CreateTweetService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class TweetController extends Controller
{
    /**
     * @param TweetRequest $request
     * @param CreateTweetService $tweetService
     * @return Application|ResponseFactory|Response
     */
    public function store(TweetRequest $request, CreateTweetService $tweetService)
    {
        //todo move messages to lang files
        $tweet = $tweetService->handle($request->validated() + ['user_id' => \auth()->id()]);
        return response([
            'data'    => [
                'id' => $tweet->id
            ],
            'message' => 'Tweet created successfully.'
        ]);
    }
}
