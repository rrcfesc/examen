<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class TodoListTest extends TestCase
{
    use RefreshDatabase;

    public function testTodoListControllerAsAGuest():void
    {
        $response = $this->get('/todo');
        $response->assertRedirect('/login');
    }


    public function testAnAuthenticatedUser()
    {
        $user = $this->createAuthenticatedUser();
        TodoList::factory()->forUser($user->id)->create();
        $response = $this->actingAs($user)->get('/todo');
        $response->assertStatus(200);

        $response = $this->actingAs($user)->getJson('/todo-list/data');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'draw',
                'recordsTotal',
                'recordsFiltered',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'description',
                        'completed',
                    ]
                ]
            ]);
    }


    public function testAnAuthenticatedUserCreateTodo()
    {
        $user = $this->createAuthenticatedUser();
        $this->actingAs($user);

        $response = $this->get(route('todo.create'));
        $response->assertStatus(200);

        $data = [
            'title' => 'Test Todo',
            'description' => 'This is a test description',
            'completed' => false,
        ];

        $response = $this->post(route('todo.store'), $data);
        $response->assertStatus(302);
        $this->assertDatabaseHas('todo_lists', [
            'title' => 'Test Todo',
            'description' => 'This is a test description',
            'completed' => false,
            'user_id' => $user->id,
        ]);

        $todoList = TodoList::factory()->forUser($user->id)->create();

        $data = [
            'title' => 'Updated Todo Title',
            'description' => 'Updated description',
            'completed' => true,
        ];

        $response = $this->put(route('todo.update', $todoList->id), $data);

        $response->assertStatus(302);
        $this->assertDatabaseHas('todo_lists', [
            'id' => $todoList->id,
            'title' => 'Updated Todo Title',
            'description' => 'Updated description',
            'completed' => true,
        ]);

        $response = $this->delete(route('todo.destroy', $todoList->id));

        $this->assertDatabaseMissing('todo_lists', [
            'id' => $todoList->id,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Operación exitosa',
        ]);

    }


    public function testAnAuthenticatedUserAndOperations()
    {
        $user = $this->createAuthenticatedUser();
        TodoList::factory()->forUser($user->id)->create();
        $response = $this->actingAs($user)->get('/todo');
        $response->assertStatus(200);
    }


    protected function createAuthenticatedUser()
    {
        return User::factory()->create();
    }
}
