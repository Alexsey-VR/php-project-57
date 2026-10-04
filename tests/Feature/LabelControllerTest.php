<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use App\Models\{User, Label};
use App\Providers\{AppServiceProvider, EventListenProvider, FortifyServiceProvider};
use App\Http\Controllers\LabelController;
use App\Http\Requests\LabelFormRequest;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

#[CoversClass(User::class)]
#[CoversClass(Label::class)]
#[CoversClass(LabelFormRequest::class)]
#[CoversClass(AppServiceProvider::class)]
#[CoversClass(FortifyServiceProvider::class)]
#[CoversClass(LabelController::class)]
#[CoversClass(EventListenProvider::class)]
class LabelControllerTest extends TestCase
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
        $response = $this->get(route('labels.create'));

        $response->assertRedirect(route('register'));
    }

    public function testAuthenticatedUserCanSeeTheCreateForm(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.create'));

        $response->assertStatus(200);
        $response->assertSee(__('tasks.label.confirm'));
    }

    public function testAuthenticatedUserCanCreateLabel(): void
    {
        $labelName = 'Test';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->post('/labels', [
                'name' => $labelName,
                'description' => 'Test label',
                '_token' => $this->token
            ]);

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['name' => $labelName]);
    }

    public function testValidationFailsWhenNameIsMissing(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->postJson(route('labels.store'), ['_token' => $this->token]);

        $response->assertStatus(422);
    }

    public function testValidationFailsWhenNameIsTooLong(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->postJson('/labels', [
                'name' => str_repeat('a', 256),
                '_token' => $this->token
            ]);

        $response->assertStatus(422);
    }

    public function testAuthenticateduserCanUpdateLabel(): void
    {
        $label = Label::factory()->create(['name' => 'Test']);
        $updatedLabel = 'Edit';
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->put(route('labels.update', $label->id), [
                'name' => $updatedLabel,
                '_token' => $this->token
            ]);

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }

    public function testAuthenticatedUserCanDeleteLabel(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)
            ->withSession(['_token' => $this->token])
            ->delete("/labels/{$label->id}", ['_token' => $this->token]);

        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
