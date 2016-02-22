<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TrackTest extends TestCase
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
            ->visit('/track')
            ->see('tracks')
            ->see('>new</a>');

        $this->actingAs($user)
            ->visit('/release/create')
            ->see('release')
            ->see('<input class="btn btn-primary col-md-offset-2" type="submit"');

        $this->actingAs($user)
            ->visit('/track/2726')
            ->see('09 carnaval (Dola)')
            ->click('edit')
            ->see('<input class="btn btn-primary col-md-offset-2" type="submit"');

    }
}
