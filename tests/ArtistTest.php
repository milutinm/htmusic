<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArtistTest extends TestCase
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
			->visit('/artist/create')
			->see('artist')
			->see('<input class="btn btn-primary col-md-offset-2" type="submit"');

		$this->actingAs($user)
			->visit('/artist')
			->click('1st Klass')
			->seePageIs('/artist/3')
			->click('edit')
			->see('<input class="btn btn-primary col-md-offset-2" type="submit"');

		$this->actingAs($user)
			->visit('/artist')
			->click('1st Klass')
			->seePageIs('/artist/3')
			->click('add release')
			->seePageIs('/release/create?artist_id=3')
			->see('<input class="btn btn-primary col-md-offset-2" type="submit"')
			->see('<a href="/artist/3" target="_blank">1st Klass</a>');
	}
}
