<?php

namespace Tests\Feature;

use Martin\ACL\User;
use Martin\Products\Topping;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminToppingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_guest_is_redirected_from_admin_toppings_page() {
        $topping = factory(Topping::class)->create();

        $this->get('/admin/toppings')                  // index
            ->assertStatus(302);

        $this->get('/admin/toppings/create')           // create
            ->assertStatus(302);

        $this->get('/admin/toppings/' . $topping->id)     // show
            ->assertStatus(302);

        $this->get('/admin/toppings/' . $topping->id . '/edit')     // edit
            ->assertStatus(302);

        $this->post('/admin/toppings')                 // store
            ->assertStatus(302);

        $this->patch('/admin/toppings/' . $topping->id)   // update
            ->assertStatus(302);

        $this->delete('/admin/toppings/' . $topping->id)  // delete
            ->assertStatus(302);
    }

    /** @test */
    public function an_admin_may_visit_the_admin_toppings_page() {
        $this->loginAsAdmin();
        $this->assertTrue($this->user->isAdmin());

        $this->get('/admin/toppings')
            ->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_see_existing_toppings_on_the_index() {
        $topping = factory(Topping::class)->create();
        $this->loginAsAdmin();

        $this->get('/admin/toppings')
            ->assertSee($topping->code);
    }

    /** @test */
    public function an_admin_can_see_the_form_to_add_a_topping() {
        $this->loginAsAdmin();

        $this->get('/admin/toppings/create')
            ->assertStatus(200)
            ->assertSee('<form');
    }

    /** @test */
    public function an_admin_can_submit_a_form_to_add_a_topping() {
        $this->loginAsAdmin();

        $topping = factory(Topping::class)->make();

        $request = $topping->toArray();
        $request['_token'] = csrf_token();
        $this->post('/admin/toppings', $topping->toArray());

        // Make adjustment for the mutator on create();
        $topping->cost_per_kg *= 100;

        $this->assertDatabaseHas('toppings', $topping->toArray());
    }
}