<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Telegramm;

use Illuminate\Routing\Controller;
use Log;
use Nutgram\Laravel\Facades\Telegram;
use SergiX44\Nutgram\Nutgram;

class TelegramController extends Controller
{
    /**
     * Handle the request.
     */
    public function handle(Nutgram $bot)
    {
//        Telegram::sendMessage('Hello, world facade!');
//        $bot->sendMessage('send message ' . date('D, d M Y H:i:s'), 351518004);

        Log::channel('telegram')->info('Hello world2!' . date('D, d M Y H:i:s'), ['xyz' => 123]);
    }
}
