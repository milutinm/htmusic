<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinkTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = App\User::find(1);

        $this->actingAs($user)
            ->visit('/link/create')
            ->see('link')
            ->see('<input class="btn btn-primary col-md-offset-2" type="submit"');
    }
}
