<?php

namespace Tests\Unit\Transactions;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Martin\ACL\User;
use Martin\Core\Address;
use Martin\Core\Attachment;
use Martin\Delivery\Courier;
use Martin\Delivery\Delivery;
use Martin\Products\Meal;
use Martin\Products\Meat;
use Martin\Subscriptions\Package;
use Martin\Subscriptions\Plan;
use Martin\Transactions\Order;
use Martin\Transactions\Payment;
use Tests\TestCase;

class OrdersDatesTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    public function a_normal_plan_operates_under_normal_circumstances() {
        $this->buildOrder([
            'weeks_of_food_per_shipment'    => 1,
            'ships_every_x_weeks'           => 1,
        ]);
        $this->buildOrder();

        $this->assertEquals(
            Carbon::now()->addDays(4)->format('Y-m-d'),
            $this->order[0]->deliver_by->format('Y-m-d')
        );

        $this->assertEquals(
            $this->order[0]->deliver_by->addDays(7)->format('Y-m-d'),
            $this->order[1]->deliver_by->format('Y-m-d')
        );
    }


    /** @test */
    public function a_normal_plan_operates_with_extra_food_shipped() {
        $this->buildOrder([
            'weeks_of_food_per_shipment'    => 1,
            'ships_every_x_weeks'           => 1,
        ]);
        $this->buildOrder();
        $this->buildOrder();

        // Ship Extra....
        $weeksToShip = 2;
        $this->shipOrder(0, $weeksToShip);
        $this->refreshOrder(1);
        $this->refreshOrder(2);

        $this->assertEquals(
            Carbon::now()->addDays(4 + $weeksToShip * 7)->format('Y-m-d'),
            $this->order[1]->deliver_by->format('Y-m-d')
        );

        $this->assertEquals(
            Carbon::now()->addDays(4 + $weeksToShip * 7 + 7)->format('Y-m-d'),
            $this->order[2]->deliver_by->format('Y-m-d')
        );

        $this->shipOrder(1, $weeksToShip);
        $this->refreshOrder(2);
        $this->assertEquals(
            Carbon::now()->addDays(4 + $weeksToShip * 7 + $weeksToShip * 7)->format('Y-m-d'),
            $this->order[2]->deliver_by->format('Y-m-d')
        );


    }

    /** @test */
    public function a_1wkfood_2weekly_plan_operates_under_normal_circumstances() {
        $this->buildOrder([
            'weeks_of_food_per_shipment'    => 1,
            'ships_every_x_weeks'           => 2,
        ]);
        $this->buildOrder();
        $this->buildOrder();

        $this->assertEquals(
            Carbon::now()->addDays(4)->format('Y-m-d'),
            $this->order[0]->deliver_by->format('Y-m-d')
        );

        $this->assertEquals(
            $this->order[0]->deliver_by->addDays(14)->format('Y-m-d'),
            $this->order[1]->deliver_by->format('Y-m-d')
        );

    }

    /** @test */
    public function a_cancelled_order_affects_next_delivery_date() {
        $this->buildOrder([
            'weeks_of_food_per_shipment'    => 1,
            'ships_every_x_weeks'           => 1,
        ]);
        $this->buildOrder();

        $this->order[0]->cancel();
        $this->refreshOrder(0);

        $this->assertEquals(1, $this->order[0]->cancelled);

        $this->buildOrder();
        $this->assertEquals(
            Carbon::now()->addDays(4 + 7)->format('Y-m-d'),
            $this->order[1]->deliver_by->format('Y-m-d')
        );
    }



}
