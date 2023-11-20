<?php 

namespace Mbarwick83\TwitterApi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mbarwick83\Twitter\Twitter
 */
class TwitterApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Mbarwick83\TwitterApi\TwitterApi';
    }
}