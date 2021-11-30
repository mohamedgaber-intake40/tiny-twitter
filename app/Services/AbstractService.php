<?php


namespace App\Services;


abstract class AbstractService implements ServiceInterface
{

    /**
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public static function make()
    {
        return app()->make(static::class);
    }
}
