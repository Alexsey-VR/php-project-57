<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use App\Mail\LogMail;
use App\Models\User;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Auth;
use Mockery;

#[CoversClass(LogMail::class)]
#[CoversClass(User::class)]
class LogMailTest extends TestCase
{
    private LogMail $mail;

    protected function setUp(): void
    {
        $this->mail = new LogMail();
    }

    public function testEnvelopeWithAuthenticatedUser(): void
    {
        $testName = 'Test Name';
        $testAddress = 'test@example.ru';
        Auth::shouldReceive('user')->once()->andReturn(new User([
            'name' => $testName,
            'email' => $testAddress
        ]));
        $envelope = $this->mail->envelope();

        $this->assertInstanceOf(Address::class, $envelope->from);
        $this->assertSame($testName, $envelope->from->name);
        $this->assertSame($testAddress, $envelope->from->address);
    }

    public function testEnvelopeWithUnauthenticatedUser(): void
    {
        Auth::shouldReceive('user')->once()->andReturn(null);

        $this->expectExceptionMessage('User not authenticated');

        $envelope = $this->mail->envelope();
    }

    public function testMailContentShouldExist(): void
    {
        Auth::shouldReceive('user')->once()->andReturn(new User([
            'name' => 'Test Name',
            'email' => 'test@example.ru'
        ]));
        $content = $this->mail->content();

        $this->assertEquals($content->view, 'users.show');
    }

    public function testMailAttachmentShouldEmpty(): void
    {
        Auth::shouldReceive('user')->once()->andReturn(new User([
            'name' => 'Test Name',
            'email' => 'test@example.ru'
        ]));
        $attachments = $this->mail->attachments();

        $this->assertEmpty($attachments);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
