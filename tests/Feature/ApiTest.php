<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Method getActiveAustrianUsers test
     *
     * @return void
     */
    public function testGetActiveAustrianUsers()
    {
        $response = $this->get('api/active-austrian-users');
        $response->assertStatus(200);
    }

    /**
     * Method getActiveAustrianUsers test
     *
     * @return void
     */
    public function testDeleteUsers()
    {
        $response = $this->delete('api/delete-user/1');
        $response->assertStatus(403);
    }

    /**
     * Method getTransactions test
     *
     * @return void
     */
    public function testGetTransactions()
    {
        $response = $this->get('api/transactions/all');
        $response->assertStatus(200);
    }

    /**
     * Method updateUserDetails test
     *
     * @return void
     */
    public function testUpdateUserDetails()
    {
        $response = $this->put('api/user-details/4', [
            "citizenship_country_id" => 2,
            "first_name" => "Update",
            "last_name" => "Test",
            "phone_number" => "0043664777778"
        ]);
        $response->assertStatus(200);
    }
}
