<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use App\Models\{User, TaskStatus};
use App\Providers\{AppServiceProvider, EventListenProvider, FortifyServiceProvider};
use App\Http\Controllers\TaskStatusController;
use App\Http\Requests\TaskStatusFormRequest;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

#[CoversClass(User::class)]
#[CoversClass(TaskStatus::class)]
#[CoversClass(TaskStatusFormRequest::class)]
#[CoversClass(AppServiceProvider::class)]
#[CoversClass(FortifyServiceProvider::class)]
#[CoversClass(TaskStatusController::class)]
#[CoversClass(EventListenProvider::class)]
class TaskStatusControllerTest extends TestCase
{
    private User $user;
    private string $token;

    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();

        $this->token = 'test-csrf-token';
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
        $response = $this->get(route('task_statuses.create'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthenticatedUserCanSeeTheCreateForm(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.create'));

        $response->assertStatus(200);
        $response->assertSee(__('tasks.status.confirm'));
    }

    public function testAuthenticatedUserCanCreateATaskStatus(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->post('/task_statuses', [
                'name' => 'New Status',
                '_token' => $this->token
            ]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'New Status']);
    }

    public function testValidationFailsWhenNameIsMissing(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->postJson(route('task_statuses.store'), ['_token' => $this->token]);

        $response->assertStatus(422);
    }

    public function testValidationFailsWhenNameIsTooLong(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->postJson('/task_statuses', [
                'name' => str_repeat('a', 256),
                '_token' => $this->token
            ]);

        $response->assertStatus(422);
    }

    public function testAuthenticatedUserCanSeeAllowedOptions(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.create'));

        $response->assertStatus(200);
        $response->assertSee(__('tasks.status.options.new'));
        $response->assertSee(__('tasks.status.options.in_progress'));
        $response->assertSee(__('tasks.status.options.testing'));
        $response->assertSee(__('tasks.status.options.completed'));
    }

    public function testAuthenticateduserCanUpdateTaskStatus(): void
    {
        $taskStatus = TaskStatus::factory()->create(['name' => 'Новый']);
        $updatedStatus = 'Завершён';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->put(route('task_statuses.update', $taskStatus->id), [
                'name' => $updatedStatus,
                '_token' => $this->token
            ]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->id]);
    }

    public function testAuthenticateduserCanDeleteTaskStatus(): void
    {
        $taskStatus = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->delete("/task_statuses/{$taskStatus->id}", ['_token' => $this->token]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->id]);
    }
}
