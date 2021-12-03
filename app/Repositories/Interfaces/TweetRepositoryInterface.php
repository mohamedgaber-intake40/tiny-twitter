<?php

namespace App\Repositories\Interfaces;

interface TweetRepositoryInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function createTweet($data);
}
