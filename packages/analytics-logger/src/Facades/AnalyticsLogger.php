<?php
/**
 * User: Dario.Alfredo
 * Date: 9/12/2017
 * Time: 10:53 AM
 */
namespace EONConsulting\AnalyticsLogger;

use Illuminate\Support\Facades\Facade;
use EONConsulting\AnalyticsLogger\LoggerInterface as Logger;

class AnalyticsLogger extends Facade implements Logger
{
    protected static function getFacadeAccessor()
    {
        //return 'alogger';
    }
}
