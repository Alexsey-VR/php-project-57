<?php

namespace Tests\Feature;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use App\Listeners\LogMailListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\SentMessage as SymfonySentMessage;
use App\Providers\AppServiceProvider;
use App\Providers\EventListenProvider;
use App\Providers\FortifyServiceProvider;
use Illuminate\Mail\SentMessage;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Mail\Events\MessageSending;

#[CoversClass(LogMailListener::class)]
#[CoversClass(AppServiceProvider::class)]
#[CoversClass(EventListenProvider::class)]
#[CoversClass(FortifyServiceProvider::class)]
class LogMailListenerTest extends TestCase
{
    public function testLogMailListenerIsHandleTheMessageSending(): void
    {
        $subject = 'Test mail';
        $fromAddress = 'admin@taskmanager.ru';
        $toAddress = 'test@taskmanager.ru';
        $email = (new Email())
            ->subject($subject)
            ->from($fromAddress)
            ->to($toAddress)
            ->replyTo($fromAddress);

        Log::shouldReceive('channel')
            ->with('mail')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->with(
                'MessageSending',
                [
                    'subject'   => $subject,
                    'from'      => [$fromAddress],
                    'to'        => [$toAddress],
                    'replyTo'   => [$fromAddress]
                ]
            )
            ->once();

        Event::dispatch(new MessageSending($email));
    }

    public function testLogMailListenerIsHandleTheMessageSent(): void
    {
        $subject = 'Test mail';
        $fromAddress = 'admin@taskmanager.ru';
        $toAddress = 'test@taskmanager.ru';
        $email = (new Email())
            ->subject($subject)
            ->from($fromAddress)
            ->to($toAddress)
            ->replyTo($fromAddress)
            ->text('test body');

        Log::shouldReceive('channel')
            ->with('mail')
            ->once()
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->with(
                'MessageSent',
                [
                    'subject'   => $subject,
                    'from'      => [$fromAddress],
                    'to'        => [$toAddress],
                    'replyTo'   => [$fromAddress]
                ]
            )
            ->once();

        $symfonySent = new SymfonySentMessage($email, Envelope::create($email));
        Event::dispatch(new MessageSent(new SentMessage($symfonySent)));
    }
}
