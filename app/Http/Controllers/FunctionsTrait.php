<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait FunctionsTrait
{
    /**
     * Generate a short URL.
     *
     * @return string
     */
    public function generateShortUrl()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = substr(str_shuffle($characters), 0, 5);

        return $randomString;
    }

    public function getUserIp()
    {
        return request()->header('X-Forwarded-For') ?? request()->ip();
    }
}
