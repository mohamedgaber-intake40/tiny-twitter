<?php


namespace App\Services;


interface ServiceInterface
{
    /**
     * @param array|null $data
     * @return mixed
     */
    public function handle(array $data = null);

}
