<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Services\Tweet\CreateTweetService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TweetController extends Controller
{
    /**
     * @param TweetRequest $request
     * @param CreateTweetService $tweetService
     * @return Application|ResponseFactory|\Illuminate\Http\Response
     */
    public function store(TweetRequest $request, CreateTweetService $tweetService)
    {
        $tweet = $tweetService->handle($request->validated() + ['user_id' => \auth()->id()]);
        return $this->successResponse(['id' => $tweet->id], __('success.tweets.created'),Response::HTTP_CREATED);
    }
}
