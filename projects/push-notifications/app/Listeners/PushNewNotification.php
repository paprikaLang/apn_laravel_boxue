<?php

namespace App\Listeners;

use App\Events\NewNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
/**
* Guzzle is a PHP HTTP client that makes it easy to send HTTP requests and trivial to integrate with web services.
*  Simple interface for building query strings, POST requests, streaming large uploads, streaming large downloads, using HTTP cookies, uploading JSON data, etc...
*    Can send both synchronous and asynchronous requests using the same interface.
*    Uses PSR-7 interfaces for requests, responses, and streams. This allows you to utilize other PSR-7 compatible libraries with Guzzle.
*    Abstracts away the underlying HTTP transport, allowing you to write environment and transport agnostic code; i.e., no hard dependency on cURL, PHP streams, sockets, or non-blocking event loops.
*    Middleware system allows you to augment and compose client behavior.
 */

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use App\Device;
use App\Traits\APN;

// 向APN推送请求
class PushNewNotification implements ShouldQueue
{
    //这样，PushNewNotification就可以使用APN中定义的所有方法了
    use APN;
    public $client;
    public $succCounter = 0;
    public $failCounter = 0;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewNotification  $event
     * @return void
     */
    public function handle(NewNotification $event)
    {
        // Log::debug("Push new notification to APN.");
        $notification = $event->notification;

        // 1. Get the notification
        $title = $notification->title;
        $body = $notification->body;
        $locale = $notification->locale;
        $badge = $notification->badge;
        $sound = $notification->sound;
        $environment = $notification->environment;

        // 2. Filter all devices
        // TODO:
        // - If there are too many devices, we should get the records
        // page by page.
        $devices = Device::where('environment', $environment)
        ->where('locale', $locale)
        ->get();
         // 3. Create a Guzzle client
         /**
          * version表示使用的HTTP版本，设置成2.0可以让我们使用它的TCP长连接特性，这也是APN要求的. vapor 不具备http2的特性
          * headers / base_uri / body分别表示请求的HTTP header、URI以及payload。直接用trait APN中的方法
         */
        $client = new Client([
            'timeout' => 5.0,
            'version' => 2.0,
            'headers' => $this->generateAPNHeader(),
            'base_uri' => $this->generateAPNUri($environment),
            'body' => $this->generateAPNPayload($title, $body, $badge, $sound),
        ]);
        // 4. Push notification for each devices: yield为每一个要推送的设备，生成一个Request对象
        $requests = function($devices) use ($client) {
            foreach ($devices as $device) {
                yield function() use ($client, $device) {
                    return $client->postAsync($device->token);
                };
            }
        };
        // 为了逐个执行这些请求，直接把它们扔到Guzzle的请求池里
        // php artisan queue:work 
        $pool = new Pool($client, $requests($devices), [
            'concurrency' => 1,
            'fulfilled' => function ($response, $index) {
                $this->succCounter++;
            },
            'rejected' => function ($reason, $index) {
                $this->failCounter++;
            },
        ]);
    
        $pool->promise()->wait();
    }
}
