<?php

declare(strict_types=1);

namespace App\Presentation\Controllers\Telegramm;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;

class TelegramController extends Command
{
    /**
     * Handle the request.
     */
    public function handle(Nutgram $bot)
    {
        $bot->sendMessage('send message ' . date('D, d M Y H:i:s'));

//        dump(app());
//        Telegram::sendMessage('Hello, world facade!');
//        $bot->sendMessage('send message ' . date('D, d M Y H:i:s'), 351518004);

//        Log::channel('telegram')->info('Hello world2!' . date('D, d M Y H:i:s'), ['xyz' => 123]);
    }
}
