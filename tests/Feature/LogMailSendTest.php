<?php

namespace Tests\Feature;

// Illuminate\Foundation\Testing\RefreshDatabase;
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
use Illuminate\Support\Facades\DB;

#[CoversClass(LogMail::class)]
#[CoversClass(LogMailListener::class)]
#[CoversClass(User::class)]
#[CoversClass(AppServiceProvider::class)]
#[CoversClass(EventListenProvider::class)]
#[CoversClass(FortifyServiceProvider::class)]
class LogMailSendTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    public function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    public function testMailIsSentToLog(): void
    {
        //$this->withoutMiddleware();
        $testEmail = 'test@example.ru';
        $user = User::factory()->create([
            'name' => 'Test Name',
            'email' => $testEmail
        ]);
        $this->actingAs($user);

        Mail::fake();

        View::share('user', $user);
        Mail::to($user->email)->send(new LogMail());

        Mail::assertSent(LogMail::class, function ($mail) {
            return $mail->envelope()->subject === 'User Greeting';
        });
    }
}
