<?php

namespace App\Repositories;

use App\Models\Tweet;
use App\Repositories\Interfaces\TweetRepositoryInterface;

class TweetRepository implements TweetRepositoryInterface
{
    public function createTweet($data)
    {
        return Tweet::create($data);
    }
}
