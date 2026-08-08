<?php

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogMailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent|MessageSending $event): void
    {
        $mail = $event->message;
        $messageInfo = [
            'subject' => $mail->getSubject(),
            'from'    => $mail->getFrom(),
            'to'      => $mail->getTo(),
            'replyTo' => $mail->getReplyTo()
        ];

        if ($event instanceof MessageSending) {
            Log::channel('mail')->info('MessageSending', $messageInfo);
        } else {
            Log::channel('mail')->info('MessageSent', $messageInfo);
        }
    }
}
