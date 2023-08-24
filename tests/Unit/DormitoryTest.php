<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Dormitory;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class DormitoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_create_dormitory_form()
    {

        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/dormitory/create');
        $response->assertStatus(200);
    }

    public function test_dormitory_store()
    {
        $user = User::first();
        $this->actingAs($user);

        $token = csrf_token();
        Session::put('_token', $token);
        
        $response = $this->withHeaders(['X-CSRF-Token' => $token])
        ->post('/dormitory/store',[
            "name"=>"Dormitory Test",
            "type"=>"boys",
            "status"=>"Vacant",
            "address"=>"Test Address"
        ]);
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }

        $response->assertStatus(200);
    }

    public function test_dormitory_edit()
    {
        $user = User::first();
        $this->actingAs($user);

        $dormitory = Dormitory::first();

        $response = $this->get("dormitory/edit/$dormitory->id");
        $response->assertStatus(200);
    }

    public function test_dormitory_update()
    {
        $user = User::first();
        $this->actingAs($user);

        $token = csrf_token();
        Session::put('_token', $token);
        
        $dormitory = Dormitory::first();

        $response = $this->withHeaders(['X-CSRF-Token' => $token])
        ->put("/dormitory/update/$dormitory->id",[
            "name"=>"Dormitory Test",
            "type"=>"boys",
            "status"=>"Vacant",
            "address"=>"Test Address"
        ]);
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }

        $response->assertStatus(200);
    }

    
    public function test_dormitory_delete()
    {
        $user = User::first();
        $this->actingAs($user);

        $dormitory = Dormitory::first();

        $response = $this->delete("dormitory/delete/$dormitory->id");
        $response->assertStatus(200);
    }


}
