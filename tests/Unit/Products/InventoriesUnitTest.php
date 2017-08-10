<?php

namespace Tests\Unit;

use Martin\Products\Inventory;
use Martin\Products\Meat;
use Martin\Transactions\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InventoriesUnitTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_has_a_model_factory() {
        $inventory = factory(Inventory::class)->create();
        $this->assertTrue($inventory instanceof Inventory);
    }

    /** @test */
    public function it_has_most_fields_mass_assignable() {
        $order = factory(Order::class)->create();
        $meat = factory(Meat::class)->create();

        $inventoryData = [
            'inventoryable_type' => get_class($meat),
            'inventoryable_id' => $meat->id,
            'size' => null,
            'change' => -14,
            'changeable_type' => get_class($order),
            'changeable_id' => $order->id,
            'current' => 150,
        ];
        $inventory = factory(Inventory::class)->create($inventoryData);
        $this->assertDatabaseHas('inventories', $inventoryData);
    }
}