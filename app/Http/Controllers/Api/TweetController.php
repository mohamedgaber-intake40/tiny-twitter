<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\SuccessResource;
use App\Services\Tweet\CreateTweetService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TweetController extends Controller
{
    /**
     * @param TweetRequest $request
     * @param CreateTweetService $tweetService
     * @return JsonResponse|object
     */
    public function store(TweetRequest $request, CreateTweetService $tweetService)
    {
        $tweet = $tweetService->handle($request->validated() + ['user_id' => \auth()->id()]);
        return SuccessResource::make(['id' => $tweet->id])
                              ->additional([  'message' => __('success.tweets.created')])
                              ->response()
                              ->setStatusCode(Response::HTTP_CREATED);
    }
}
