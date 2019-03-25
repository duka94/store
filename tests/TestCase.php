<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    protected $user;


    public function authenticateUser()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get('/');

        $this->user = $user;
    }
}
