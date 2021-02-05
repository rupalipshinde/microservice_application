<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase {

    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;

    public function testIndex() {
//        $response = $this->get('/');

        $response = $this->json('GET', '/api/users');
        $response->assertStatus(200);
    }

    public function testStoreSuccess() {

        $requests = array(
            array(
                'data' => [
                    'name' => 'Test name',
                    'email' => 'testing@example.com',
                ],
            ), array(
                'data' => [
                    'name' => 'Test name2',
                    'email' => 'testing2@example.com',
                ],
            )
        );

        foreach ($requests as $request) {
            $response = $this->json('POST', '/api/users', $request['data'])->assertRedirect('/api/users');
        }
    }

    public function testStoreFailure() {
        $requests = array(
            array(
                'data' => [
                ],
                'errors' => [
                    'name', 'email'
                ]
            ),
        );

        foreach ($requests as $request) {
            $response = $this->json('POST', '/api/users', $request['data']);
            $response->assertStatus(422);
            $response->assertJsonStructure(array(
                'errors' => $request['errors']
            ));
        }
    }

    public function testUpdateSuccess() {
        $requests = array(
            array(
                'data' => [
                    'name' => 'Test update',
                    'email' => 'testupdate@example.com'
                ],
            ),
        );

        foreach ($requests as $request) {
            $response = $this->json('PUT', '/api/users/3', $request['data']);
            $response->assertRedirect('/api/users');
        }
    }

    public function testUpdateFailure() {
        $response = $this->json('PUT', '/api/users/4');

        $response->assertStatus(422);
        $requests = array(
            array(
                'data' => [
                ],
                'errors' => [
                    'name', 'email'
                ]
            ),
        );

        foreach ($requests as $request) {
            $response = $this->json('PUT', '/api/users/2', $request['data']);
            $response->assertStatus(422);
            $response->assertJsonStructure(array(
                'errors' => $request['errors']
            ));
        }
    }

    public function testDeleteSuccess() {
        $response = $this->json('DELETE', '/api/users/1');
        $response->assertRedirect('/api/users');
    }

    public function testDeleteFailure() {
        $requests = array(
            array(
                'data' => '20',
                'errors' => 404
            ),
        );

        foreach ($requests as $request) {
            $response = $this->json('DELETE', '/api/users/' . $request['data']);
            $response->assertStatus($request['errors']);
        }
    }

}
