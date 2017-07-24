<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Martin\ACL\User;
use Martin\Core\Address;
use Martin\Customers\Pet;
use Martin\Products\Meal;
use Martin\Subscriptions\Package;
use Martin\Subscriptions\Plan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlansUnitTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_has_a_model_factory() {
        $plan = factory(Plan::class)->create();
        $this->assertTrue($plan instanceof Plan);
    }

    /** @test */
    public function it_has_all_fields_assignable() {
        $user = factory(User::class)->create();
        $address = factory(Address::class)->create();
        $pet = factory(Pet::class)->create();
        $package = factory(Package::class)->create();

        $plan = factory(Plan::class)->create([
            'user_id'  => $user->id,
            'delivery_id'  => $address->id,
            'shipping_cost' => 11.5,
            'pet_id'  => $pet->id,
            'pet_weight' => 55,
            'package_id' => $package->id,
            'package_stripe_code' => 'BASIC',
            'package_base' => 10,
            'weeks_at_a_time' => 1,
            'active' => 1,
        ]);

        $this->assertEquals(11.5, $plan->shipping_cost);
        $this->assertEquals(55, $plan->pet_weight);
        $this->assertEquals(10, $plan->package_base);
        $this->assertEquals(1, $plan->weeks_at_a_time);
    }

    /**
     * Mutators
     */

    /** @test */
    public function package_base_is_mutated_when_saving() {
        $package_baseInDollars = 1;
        $package_baseInCents = $package_baseInDollars * 100;

        factory(Plan::class)->create(['package_base' => $package_baseInDollars]);
        $this->assertDatabaseHas('plans', ['package_base' => $package_baseInCents]);
    }

    /** @test */
    public function package_base_is_mutated_when_retrieving() {
        $package_baseInDollars = 1;
        $package_baseInCents = $package_baseInDollars * 100;

        $plan = factory(Plan::class)->make([
            'package_stripe_code'=> 'THIS_PLAN',
            'package_base' => $package_baseInCents
        ]);
        DB::table('plans')->insert($plan->toArray());
        $plan_clone = Plan::where('package_stripe_code', 'THIS_PLAN')->firstOrFail();
        $this->assertEquals($package_baseInDollars, $plan_clone->package_base);
    }

}