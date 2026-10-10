<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use App\Models\{User, Task, TaskStatus};
use App\Services\TaskService;
use App\Providers\{AppServiceProvider, EventListenProvider, FortifyServiceProvider};
use App\Http\Controllers\TaskController;
use App\Http\Requests\{TaskFormRequest, TaskFilterRequest};
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

#[CoversClass(User::class)]
#[CoversClass(Task::class)]
#[CoversClass(TaskStatus::class)]
#[CoversClass(TaskService::class)]
#[CoversClass(AppServiceProvider::class)]
#[CoversClass(FortifyServiceProvider::class)]
#[CoversClass(TaskController::class)]
#[CoversClass(TaskFormRequest::class)]
#[CoversClass(TaskFilterRequest::class)]
#[CoversClass(EventListenProvider::class)]
class TaskControllerTest extends TestCase
{
    private User $user;
    private User $assignee;
    private TaskStatus $status;
    private string $token;

    private const int LABEL_ID = 5;

    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();

        $this->token = 'test-csrf-token';
        $this->user = User::factory()->create([
            'name' => 'Author name',
            'email' => 'test@example.ru'
        ]);
        $this->assignee = User::factory()->create([
            'name' => 'Assignee name',
            'email' => 'assignee@example.ru'
        ]);
        $this->status = TaskStatus::factory()->create();
    }

    public function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
    }

    public function testGuestCannotAccessTheCreateForm(): void
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect(route('login'));
    }

    public function testAuthenticatedUserCanSeeTheCreateForm(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.create'));

        $response->assertStatus(200);
        $response->assertSee(__('tasks.confirm'));
    }

    public function testAuthenticatedUserCanCreateTask(): void
    {
        $taskName = 'Task 1';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->post(route('tasks.store'), [
                'name' => $taskName,
                'description' => 'test task',
                'status' => $this->status->name,
                'assigned_to_id' => $this->assignee->id,
                'label_id' => self::LABEL_ID,
                '_token' => $this->token
            ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => $taskName]);
    }

    public function testAuthenticatedUserCanViewTaskList(): void
    {
        $taskName = 'Test task';
        Task::factory()->create(['name' => $taskName]);
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->get(route('tasks.index'));

        $response->assertStatus(200);
        $response->assertSee($taskName);
    }

    public function testValidationFailWhenNameIsMissing(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->postJson(route('tasks.store'), ['_token' => $this->token]);

        $response->assertStatus(422);
    }

    public function testValidationFailsWhenNameIsTooLong(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->postJson(route('tasks.store'), [
                'name' => str_repeat('n', 256),
                '_token' => $this->token
            ]);

        $response->assertStatus(422);
    }

    public function testAuthenticatedUserCanViewTask(): void
    {
        $response = Task::factory()->create();
        $response = $this->actingAs($this->user)
            ->withSession(['token' => $this->token])
            ->get(route('tasks.show', Task::first()));

        $response->assertStatus(200);
    }

    public function testAuthenticatedUserCanEditTask(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->post(route('tasks.store'), [
                'name' => 'Test task',
                'description' => 'test task',
                'status' => $this->status->name,
                'assigned_to_id' => $this->assignee->id,
                'label_id' => self::LABEL_ID,
                '_token' => $this->token
            ]);

        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->get(route('tasks.edit', $this->user->createdTasks()->first()));

        $response->assertStatus(200);
    }

    public function testAuthenticatedUserCanUpdateTask(): void
    {
        $taskName = 'Task';
        $task = Task::factory()->create(['name' => $taskName]);

        $updatedTaskName = "Updated task";
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->put(route('tasks.update', $task), [
                'name' => $updatedTaskName,
                'description' => 'test task',
                'status' => $this->status->name,
                'assigned_to_id' => $this->assignee->id,
                'label_id' => self::LABEL_ID,
                '_token' => $this->token
            ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['name' => $updatedTaskName]);
    }

    public function testAuthenticatedUserCanDeleteCreatedTask(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->post(route('tasks.store'), [
                'name' => 'Test task',
                'description' => 'test task',
                'status' => $this->status->name,
                'assigned_to_id' => $this->assignee->id,
                'label_id' => self::LABEL_ID,
                '_token' => $this->token
            ]);

        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->deleteJson(
                route('tasks.destroy', $this->user->createdTasks()->first()),
                ['_token' => $this->token]
            );

        $response->assertRedirect(route('tasks.index'));
    }
}
