<?php

namespace Tests\Unit;

use App\Models\RoomType;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RoomTypeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_room_type_form()
    {

        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/room-type/create');
        $response->assertStatus(200);
    }

    public function test_room_type_store()
    {
        $user = User::first();
        $this->actingAs($user);

        $token = csrf_token();
        Session::put('_token', $token);
        
        $response = $this->withHeaders(['X-CSRF-Token' => $token])
        ->post('/room-type/store',[
            "type"=>"A Type",
            "fee"=>"500",
            "status"=>"Vacant",
        ]);
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }

        $response->assertStatus(200);
    }

    public function test_room_type_edit()
    {
        $user = User::first();
        $this->actingAs($user);

        $room_type = RoomType::first();

        $response = $this->get("room-type/edit/$room_type->id");
        $response->assertStatus(200);
    }

    public function test_dormitory_update()
    {
        $user = User::first();
        $this->actingAs($user);

        $token = csrf_token();
        Session::put('_token', $token);
        
        $room_type = RoomType::first();

        $response = $this->withHeaders(['X-CSRF-Token' => $token])
        ->put("/room-type/update/$room_type->id",[
            "type"=>"A Type",
            "fee"=>"600",
            "status"=>"Vacant",
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

        $room_type = RoomType::first();

        $response = $this->delete("room-type/delete/$room_type->id");
        $response->assertStatus(200);
    }

}
