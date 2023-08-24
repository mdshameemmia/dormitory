<?php

namespace Tests\Unit;

use App\Models\Dormitory;
use App\Models\Room;
use App\Models\StudentDormitory;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class StudentDormitoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_create_student_dormitory_form()
    {

        $user = User::first();
        $this->actingAs($user);
        $response = $this->get('/student-dormitory/create');
        $response->assertStatus(200);
    }

    public function test_student_assign_dormitory()
    {
        $user = User::first();
        $this->actingAs($user);

        $token = csrf_token();
        Session::put('_token', $token);

        $response = $this->withHeaders(['X-CSRF-Token' => $token])
            ->post('/student-dormitory/store', [
                "student_name" => "MD. SHAMEEM MIA",
                "status" => 1,
                "dormitory_id" => 1,
                "room_id" => 1
            ]);
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }

        $response->assertStatus(200);
    }


    public function test_filtering_student_dormitory_assignment()
    {
        $user = User::first();
        $this->actingAs($user);

        $token = csrf_token();
        Session::put('_token', $token);

        $response = $this->withHeaders(['X-CSRF-Token' => $token])
            ->post('/student-dormitory/search', [
                "sorting" => "ASC",
                "status" => 1,
                "student_name" => 1
            ]);
        if ($response->isRedirect()) {
            $response = $this->followRedirects($response);
        }

        $response->assertStatus(200);
    }
}
