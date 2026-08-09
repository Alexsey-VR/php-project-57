<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\LogMail;
use App\Models\User;
use App\Listeners\LogMailListener;
use App\Providers\AppServiceProvider;
use App\Providers\EventListenProvider;
use App\Providers\FortifyServiceProvider;

#[CoversClass(LogMail::class)]
#[CoversClass(LogMailListener::class)]
#[CoversClass(User::class)]
#[CoversClass(AppServiceProvider::class)]
#[CoversClass(EventListenProvider::class)]
#[CoversClass(FortifyServiceProvider::class)]
class LogMailSendTest extends TestCase
{
    public function testMailIsSentToLog(): void
    {
        $testEmail = 'test@example.ru';
        $user = User::factory()->make([
            'name' => 'Test Name',
            'email' => $testEmail
        ]);
        $this->actingAs($user);
        View::share('user', $user);
        Mail::to($user->email)->send(new LogMail());
        $log = file_get_contents(storage_path('logs/mail.log')) ?: '';

        $this->assertTrue(mb_strpos($log, $testEmail) !== false);
    }
}
