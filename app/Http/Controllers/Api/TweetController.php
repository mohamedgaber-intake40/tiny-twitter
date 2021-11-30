<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TweetRequest;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Services\Tweet\CreateTweetService;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
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
