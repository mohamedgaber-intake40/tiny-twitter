<?php

namespace App\Services\Tweet;

use App\Repositories\Interfaces\TweetRepositoryInterface;
use App\Services\AbstractService as Service;
use Illuminate\Support\Arr;

class CreateTweetService extends Service
{
    /**
     * @var TweetRepositoryInterface
     */
    private $tweetRepository;

    /**
     * @param TweetRepositoryInterface $tweetRepository
     */
    public function __construct(TweetRepositoryInterface $tweetRepository)
    {
        $this->tweetRepository = $tweetRepository;
    }

    /**
     * @param array|null $data ['content','user_id]
     * @return mixed
     */
    public function handle(array $data = null)
    {
        $tweetData = Arr::only($data,[
            'content',
            'user_id'
        ]);
        return $this->tweetRepository->createTweet($tweetData);
    }
}
