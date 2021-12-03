<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\SuccessResource;
use App\Services\Tweet\CreateTweetService;

class TweetController extends Controller
{
    /**
     * @param TweetRequest $request
     * @param CreateTweetService $tweetService
     * @return SuccessResource
     */
    public function store(TweetRequest $request, CreateTweetService $tweetService)
    {
        $tweet = $tweetService->handle($request->validated() + ['user_id' => \auth()->id()]);
        return SuccessResource::make(['id' => $tweet->id])
                              ->additional([  'message' => __('success.tweets.created')]);
    }
}
