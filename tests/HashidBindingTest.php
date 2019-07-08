<?php
namespace Leuverink\HashidBinding\Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Leuverink\HashidBinding\Tests\TestCase;
use Leuverink\HashidBinding\Tests\TestModel;

class HashidBindingTest extends TestCase
{
    private $model;

    public function setUp() :void
    {
        parent::setUp();

        // Create a table for testing
        DB::statement("DROP TABLE IF EXISTS hashid_binding_test;");
        DB::statement("CREATE TABLE hashid_binding_test (id INTEGER PRIMARY KEY AUTOINCREMENT);");

        // Register a test route
        Route::middleware('web')
            ->name('test-route')
            ->get('test/{model}', function (TestModel $model) {
                return response()->json($model->toJson());
            });

        $this->model = TestModel::create();
    }


    /** @test */
    public function it_resolves_a_model_instance_with_route_binding()
    {
        $encodedKey = $this->model->encodedRouteKey;
        
        $response = $this->get(route('test-route', $encodedKey));

        $response->assertOk();
    }

    
    /** @test */
    public function it_throws_not_found_exception_when_resolving_by_id()
    {
        $key = $this->model->id;
        
        $response = $this->get(route('test-route', $key));

        $response->assertNotFound();
    }

    /** @test */
    public function it_throws_not_found_exception_exception_when_the_key_could_not_be_decoded()
    {
        $response = $this->get(route('test-route', 'this-will-surely-fail-to-decode'));
        $response->assertNotFound();
    }

    /** @test */
    public function it_appends_encoded_route_key_attribute()
    {
        $encodedKey = $this->model->encodedRouteKey;

        $this->assertNotNull($encodedKey);
    }

    /** @test */
    public function it_has_encoded_route_key_in_serialized_model()
    {
        $model = json_decode($this->model->toJson());
        $encodedKey = $model->encoded_route_key;

        $this->assertSame($encodedKey, $this->model->encodedRouteKey);
    }

    /** @test */
    public function it_generates_expected_url_with_encoded_key_using_the_route_helper()
    {
        $routeKey = $this->model->encodedRouteKey;
        $generatedUrl = route('test-route', $this->model);

        $this->assertSame($generatedUrl, "http://localhost/test/$routeKey");
    }
}
