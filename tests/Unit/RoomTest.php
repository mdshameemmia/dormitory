<?php

namespace Tests\Unit;

use App\Models\Dormitory;
use App\Models\RoomType;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RoomTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_room_form()
    {

        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/room/create');
        $response->assertStatus(200);
    }

    public function test_room_store()
    {
        $user = User::first();
        $this->actingAs($user);

        $token = csrf_token();
        Session::put('_token', $token);
        
        $response = $this->withHeaders(['X-CSRF-Token' => $token])
        ->post('/room/store',[
            "room_number"=>"101",
            "number_of_bed"=>"4",
            "number_of_booked"=>0,
            "description"=>"This is awesome",
            "status"=>"Vacant",
            "dormitory_id"=>1,
            "room_type_id"=>1
        ]);
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }

        $response->assertStatus(200);
    }

}
