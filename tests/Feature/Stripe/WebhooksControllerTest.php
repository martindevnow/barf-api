<?php

namespace Tests\Unit;

use App\Http\Controllers\WebhooksController;
use Martin\ACL\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WebhooksControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_maps_a_stripe_event_to_a_method() {
        // Convert  customer.subscription.deleted
        // To:      whenSubscriptionDeleted

        $name = (new WebhooksController())->eventToMethod('customer.subscription.deleted');
        $this->assertEquals('whenCustomerSubscriptionDeleted', $name);
    }

    /** @test */
    public function it_deactivates_a_sub_as_a_response_to_stripe() {
        // Given that I have a subscribed user (with a plan)
        $user = factory(User::class)->create([
            'stripe_id'     => 'FAKE_ID',
            'stripe_active' => 1,
        ]);

        // when a webhook hits our server with this customer id
        // and the sub id,
        $this->post('/stripe/webhook', [
            'type'  => 'customer.subscription.deleted',
            'data'  => [
                'object'    => [
                    'customer'  => $user->stripe_id
                ]
            ]
        ]);

        // that user should no longer be subscribed.
    }
}
