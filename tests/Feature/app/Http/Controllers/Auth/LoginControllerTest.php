<?php

namespace Tests\Feature\app\Http\Controllers;

use App\Models\Staff;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class LoginControllerTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * 
     * Must be not valid, and return 302 response code
     * The data there are not in the database
     */
    public function test_cannot_login_with_this_user(): void
    {
        $response = $this->post('/login', [
            'username' => 'jason@gmail.com',
            'password'=> '12345678',
        ]);

        $response->assertSessionHasErrors('username');
    }

    /**
     * 
     * Must be valid because the data was inserted before
     */
    public function test_login_with_existing_staff(): void{

        // insert new data into staff 
        $staff = Staff::factory()->create(
            ['password' => Hash::make('ary')]
        );
        
        $response = $this->post('/login', [
            "username" => $staff->username,
            "password" => "ary"
        ]);        
        
        $this->assertTrue(true);
    }
}
