<?php

namespace Tests\Feature\Admin;

use Martin\Customers\Pet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PetsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_guest_is_redirected_from_admin_pets_page() {
        $pet = factory(Pet::class)->create();

        $this->get('/admin/pets')                  // index
            ->assertStatus(302);

        $this->get('/admin/pets/create')           // create
            ->assertStatus(302);

        $this->get('/admin/pets/' . $pet->id)     // show
            ->assertStatus(302);

        $this->get('/admin/pets/' . $pet->id . '/edit')     // edit
            ->assertStatus(302);

        $this->post('/admin/pets')                 // store
            ->assertStatus(302);

        $this->patch('/admin/pets/' . $pet->id)   // update
            ->assertStatus(302);

        $this->delete('/admin/pets/' . $pet->id)  // delete
            ->assertStatus(302);
    }

    /** @test */
    public function an_admin_may_visit_the_admin_pets_page() {
        $this->loginAsAdmin();
        $this->assertTrue($this->user->isAdmin());

        $this->get('/admin/pets')   // INDEX method
            ->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_existing_pets_on_the_index() {
        $pet = factory(Pet::class)->create();
        $this->loginAsAdmin();


        $this->get('/admin/pets')   // INDEX method
            ->assertSee($pet->name);
    }

    /** @test */
    public function an_admin_can_view_a_single_pet() {
        $this->loginAsAdmin();

        $pet = factory(Pet::class)->create();

        $this->get('/admin/pets/' . $pet->id)     // SHOW method
            ->assertSee($pet->name)
            ->assertSee($pet->breed);
    }

    /** @test */
    public function an_admin_can_see_the_form_to_add_a_pet() {
        $this->loginAsAdmin();

        $this->get('/admin/pets/create')    // CREATE method
            ->assertStatus(200)
            ->assertSee('<form');
    }

    /** @test */
    public function an_admin_can_submit_a_form_to_add_a_pet() {
        $this->loginAsAdmin();

        $pet = factory(Pet::class)->make();

        $request = $pet->toArray();
        $request['_token'] = csrf_token();

        $this->post('/admin/pets', $request) // STORE method
            ->assertStatus(302);
        unset($request['_token']);

        // Adjust for the mutation on activity_level
        $request['activity_level'] *= 100;
        $this->assertDatabaseHas('pets', $request);
    }

    /** @test */
    public function an_admin_can_edit_a_pet() {
        $this->loginAsAdmin();

        $pet = factory(Pet::class)->create();

        $this->get('/admin/pets/' . $pet->id . '/edit')   // EDIT method
            ->assertStatus(200)
            ->assertSee('<form')
            ->assertSee($pet->name);
    }

    /** @test */
    public function an_admin_can_save_changes_to_a_pet() {
        $this->loginAsAdmin();

        $pet = factory(Pet::class)->create();
        $id = $pet->id;

        $post_data = $pet->toArray();
        unset($post_data['id']);

        $post_data['name'] = 'NEW_NAME';
        $post_data['_method'] = 'PATCH';

        $this->post('/admin/pets/'. $id, $post_data)   // UPDATE method
        ->assertStatus(302);
        $this->assertDatabaseHas('pets', [
            'name' => $post_data['name'],
            'weight' => $post_data['weight'],
            'id' => $id
        ]);
    }

    /** @test */
    public function an_admin_can_delete_a_pet_from_the_db() {
        $this->loginAsAdmin();

        $pet = factory(Pet::class)->create();
        $id = $pet->id;

        $post_data = [
            '_method' => 'DELETE',
        ];

        $this->post('/admin/pets/'. $id, $post_data)   // UPDATE method
        ->assertStatus(302);
        $this->seeIsSoftDeletedInDatabase('pets', [
            'id' => $id
        ]);
    }
}