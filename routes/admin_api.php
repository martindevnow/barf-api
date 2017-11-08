<?php

use Illuminate\Http\Request;
use Martin\Products\Topping;
use Martin\Subscriptions\Package;
use Martin\Subscriptions\Plan;
use Martin\Transactions\Order;


Route::get('couriers', 'CouriersController@index');

Route::resource('packages', 'PackagesController');
Route::patch('packages/{package}/mealPlan', function(Package $package, Request $request) {
    $meals = $request->get('meals');
    $package->removeAllMeals();
    foreach ($meals as $meal) {
        if ($meal['id'])
            $package->addMeal($meal['id'], $meal['calendar_code']);
//        else
//            $package->removeMeal($meal['calendar_code']);
    }
    return $package->fresh(['meals']);
});


Route::resource('meats', 'MeatsController');

Route::resource('meals', 'MealsController');

Route::post('notes', function(Request $request) {
    $valid = $request->validate([
        'modelName' => 'required|string',
        'modelId'   => 'required|integer',
        'content'   => 'required|string',
    ]);

    switch ($valid['modelName']) {
        case 'plan':
            $model = Plan::find($valid['modelId']);
            break;
        case 'order':
            $model = Order::find($valid['modelId']);
            break;

        default:
            return response('Cannot add note to this type...', 500);
    }

    return $model->notes()->create([
        'content'   => $valid['content'],
        'author_id' => $request->user()->id,
    ]);
});

Route::get('orders', 'OrdersController@index');
Route::post('/orders/{order}/paid', 'OrdersController@storePayment');
Route::post('/orders/{order}/packed', 'OrdersController@markAsPacked');
Route::post('/orders/{order}/picked', 'OrdersController@markAsPicked');
Route::post('/orders/{order}/shipped', 'OrdersController@storeShipment');
Route::post('/orders/{order}/delivered', 'OrdersController@storeDelivery');
Route::post('/orders/{order}/cancel', 'OrdersController@cancel');

Route::resource('pets', 'PetsController');

Route::post('plans/{plan}/replaceMeal', 'PlansController@replaceMeal');
Route::resource('plans', 'PlansController');

Route::post('plans/{plan}/updatePackage', function(Plan $plan, Request $request) {
    $validData = $request->validate([
        'package_id'    => 'required|exists:packages,id',
    ]);

    if ($plan->updatePackage($validData['package_id']))
        return response('Success', 200);
});

Route::get('purchase-orders', 'PurchaseOrdersController@index');
Route::post('purchase-orders/{purchaseOrder}/ordered', 'PurchaseOrdersController@storeOrdered');
Route::post('purchase-orders/{purchaseOrder}/received', 'PurchaseOrdersController@storeReceived');

Route::get('toppings', function() {
    return Topping::all();
});

Route::resource('users', 'UsersController');