<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReleaseTest extends TestCase
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
            ->visit('/release')
            ->see('releases')
            ->see('>new</a>');

        $this->actingAs($user)
            ->visit('/release/create')
            ->see('release')
            ->see('<input class="btn btn-primary col-md-offset-2" type="submit"');

        $this->actingAs($user)
            ->visit('/release/681')
            ->see('à Paris (1978)')
            ->click('edit')
            ->see('<input class="btn btn-primary col-md-offset-2" type="submit"');

        $this->actingAs($user)
            ->visit('/release/681')
            ->click('add track')
            ->seePageIs('/track/create?release_id=681')
            ->see('<input class="btn btn-primary col-md-offset-2" type="submit"')
            ->see('à Paris')
            ->see('Les Diplomates de Haïti');
    }
}
