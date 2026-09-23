<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use App\Models\User;
use App\Models\TaskStatus;
use App\Providers\AppServiceProvider;
use App\Providers\EventListenProvider;
use App\Providers\FortifyServiceProvider;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

#[CoversClass(User::class)]
#[CoversClass(TaskStatus::class)]
#[CoversClass(AppServiceProvider::class)]
#[CoversClass(FortifyServiceProvider::class)]
#[CoversClass(TaskStatusController::class)]
#[CoversClass(EventListenProvider::class)]
class TaskStatusControllerTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
        $this->user = User::factory()->make([
            'name' => 'Test name',
            'email' => 'test@example.ru'
        ]);
    }

    public function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    public function testGuestCannotAccessTheCreateForm(): void
    {
        $response = $this->get('/task_statuses/create');

        $response->assertRedirect('/register');
    }

    public function testAuthenticatedUserCanSeeTheCreateForm(): void
    {
        $response = $this->actingAs($this->user)
            ->get('/task_statuses/create');

        $response->assertStatus(200);
        $response->assertSee(__('tasks.status.confirm'));
    }

    public function testAuthenticatedUserCanCreateATaskStatus(): void
    {
        $token = 'test-csrf-token';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $token])
            ->post('/task_statuses', [
                'name' => 'New Status',
                '_token' => $token
            ]);

        $response->assertRedirect('/task_statuses');
        $this->assertDatabaseHas('task_statuses', ['name' => 'New Status']);
    }

    public function testValidationFailsWhenNameIsMissing(): void
    {
        $token = 'test-csrf-token';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $token])
            ->postJson('/task_statuses', ['_token' => $token]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function testValidationFailsWhenNameIsTooLong(): void
    {
        $token = 'test-csrf-token';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $token])
            ->postJson('/task_statuses', [
                'name' => str_repeat('a', 256),
                '_token' => $token
            ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function testAuthenticatedUserCanSeeAllowedOptions(): void
    {
        $token = 'test-csrf-token';
        $response = $this->actingAs($this->user)
            ->get('/task_statuses/create');

        $response->assertStatus(200);
        $response->assertSee(__('tasks.status.options.new'));
        $response->assertSee(__('tasks.status.options.in_progress'));
        $response->assertSee(__('tasks.status.options.testing'));
        $response->assertSee(__('tasks.status.options.completed'));
    }

    public function testAuthenticateduserCanUpdateTaskStatus(): void
    {
        $taskStatus = TaskStatus::factory()->create([
            'name' => 'Новый'
        ]);

        $token = 'test-csrf-token';
        $updatedStatus = 'Завершён';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $token])
            ->put("/task_statuses/{$taskStatus->id}", [
                'name' => $updatedStatus,
                '_token' => $token
            ]);

        $response->assertRedirect('/task_statuses');
        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
    }

    public function testAuthenticateduserCanDeleteTaskStatus(): void
    {
        $taskStatus = TaskStatus::factory()->create([
            'name' => 'Новый'
        ]);

        $token = 'csrf-test-token';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $token])
            ->delete("/task_statuses/{$taskStatus->id}", ['_token' => $token]);

        $response->assertRedirect('/task_statuses');
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
