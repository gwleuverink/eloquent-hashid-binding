<?php
namespace Leuverink\HashidBinding;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Leuverink\HashidBinding\Tests\TestCase;
use Leuverink\HashidBinding\Tests\TestModel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HashidBindingTest extends TestCase {

    use RefreshDatabase;

    private $model;

    function setUp() :void
    {   
        parent::setUp();

        // Create a table for testing
        DB::statement("CREATE TABLE hashid_binding_test (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY);");

        // Register a test route
        Route::get('test/{model}', function (TestModel $model) {
            return response()->json($model->toJson());
        })->name('test-route');

        $this->model = TestModel::create();
    }


    /** @test */
    function it_resolves_a_model_instance_with_route_binding()
    {
        $encodedKey = $this->model->encodedRouteKey;
        $response = $this->get(route('test-route', $encodedKey));
        
        $response->assertOk();
    }

    
    /** @test */
    function it_does_not_resolve_a_model_instance_by_id()
    {
        // $key = $this->model->id;
        // $response = $this->get(route('test-route', $key));

        // $response->assertNotFound();
    }

    /** @test */
    function it_throws_exception_if_the_key_could_not_be_decoded()
    {
        //
    }

    /** @test */
    function it_appends_encoded_route_key_attribute() 
    {
        $encodedKey = $this->model->encodedRouteKey;

        $this->assertNotNull($encodedKey);
    }

    /** @test */
    function it_has_encoded_route_key_in_serialized_model() 
    {
        $model = json_decode($this->model->toJson());
        $encodedKey = $model->encoded_route_key;

        $this->assertNotNull($encodedKey);
    }
}