<?php

use Illuminate\Database\Seeder;

class DBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Base tables
		$base_tables	= [
			'artist_alias_types' => [
				['name' => 'N/A'],
				['name' => 'Person'],
				['name' => 'Group']
			],
			'artist_types' => [
				['name' => 'N/A'],
				['name' => 'Person'],
				['name' => 'Group'],
			],
			'genres' => [
				['name' => 'N/A'],
				['name' => 'Konpa'],
				['name' => 'Zouk'],
				['name' => 'Hip Hop'],
				['name' => 'R&B'],
				['name' => 'Reggae'],
				['name' => 'Rock'],
				['name' => 'Jazz'],
				['name' => 'Pop'],
				['name' => 'Rap Kreyòl'],
			],
			'release_status' => [
				['name' => 'N/A'],
				['name' => 'Official'],
				['name' => 'Promotion'],
				['name' => 'Bootleg'],
				['name' => 'Pseudo-Release'],
			],
			'release_types' => [
				['name' => 'N/A'],
				['name' => 'Album'],
				['name' => 'Single'],
				['name' => 'EP'],
				['name' => 'Other'],
				['name' => 'Live'],
				['name' => 'Remix'],
				['name' => 'Mixtape/Street'],
				['name' => 'Remastered'],
				['name' => 'Promo'],
			],
			'mediums' => [
				['name'			=> 'N/A'],
				['name'			=> 'CD'],
				['name'			=> 'Digital Media'],
				['name'			=> 'Vinyl'],
			],
			'artist_credit'	=> [
				[
					'name'			=> 'N/A',
					'artist_count'	=> 0,
					'ref_count'		=> 0,
				]
			],
			'work_type'		=> [
				['name'	=>	'N/A'],
				['name'	=> 'Producer'],
				['name'	=> 'Co-Producer'],
				['name'	=> 'Writer'],
				['name'	=> 'Executive Producer'],
				['name'	=> 'Artwork'],
				['name'	=> 'Composer'],
				['name'	=> 'Vocal'],
			]
		];

		foreach ($base_tables as $table => $data) {
			echo 'TABLE: '.$table.PHP_EOL;
			DB::table($table)->delete();

			foreach ($data as $n => $row) {
				if (!isset($row['id'])) {
					$row['id']	= $n + 1;
				}
				DB::table($table)->insert($row);
			}
		}






		$mediums_id		= [
			'CD'			=> 2,
			'CDR'			=> 2,
			'Digital Media'	=> 3,
			'Vinyl'			=> 4,
			'LP'			=> 4,
		];
		$releases_id	= [''];
		$artists_id		= [''];



		// Parsing CSV

		$artist_d	= [
//			'id'		 		=> '',
			'name'				=> '',
			'sort_name'			=> '',
			'begin_date'		=> '',
			'is_ended'			=> '',
			'end_date'			=> '',
			'type_id'			=> 1,
			'gender'			=> 'other',
			'bio'				=> '',
			'photo_url'			=> '',
		];

		$release_d	= [ // release
//			'id'				=> '',
			'artist_credit_id'	=> 1,
			'medium_id'			=> 1,
			'name'				=> '',
			'barcode'			=> '',
			'notes'				=> '',
			'date'				=> '',
			'release_status_id'	=> 2,
		];

		$track_d	= [
//			'id'				=> '',
//			'recording_id'		=> 0, table removed
			'position'			=> '',
			'number'			=> '',
			'name'				=> '',
			'artist_credit_id'	=> 1,
			'length'			=> '',
			'notes'				=> '',
		];

		// relations
		$artist_credit_name_d	= [
//			'id'				=> '',
			'artist_credit_id'	=> '',
			'artist_id'			=> '',
			'work_type_id'		=> 1,
			'position'			=> '',
			'name'				=> '',
			'join_phrase'		=> '&',
		];

		$artist_credit_d	= [
//			'id'			=> '',
			'name'			=> '',
			'artist_count'	=> 1,
			'ref_count'		=> 1,
		];

		$file = base_path('_storage/seed.csv');

		$content = file_get_contents($file);
		$content = explode(PHP_EOL,$content);

		foreach ($content as $n => $row) {
//			$search = '/[^\"](.*)[^\"]/';
			$search = '/"([^"]+)"/';

			preg_match_all($search,$row,$matches);
			if (count($matches[1]) > 0) {
				foreach ($matches[0] as $match) {
					$match_new = str_replace(['"',','],['','&#44;'],$match);
					$row = str_replace($match,$match_new,$row);
				}
			}

			$row = explode(',',$row);

			if ($n == 0) {
				array_walk($row,function(&$val, $key){
					$val = strtolower($val);
					$val = str_replace(["\r","\t","\n",' '],['','','','_'],$val);
				});

				$keys = $row;
				continue;
			}

			$row = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $row);

			if (count($row) <= 1) {
				continue;
			}

			if (count($keys) != count($row)) {
				print_r($keys);
				print_r($row);
				die();
			}

			$row = array_combine($keys,$row);

			$row['artists_id'] = array_search($row['head_band'],$artists_id);
			if ($row['artists_id'] === false) {
				$artists_id[] = $row['head_band'];
				$row['artists_id'] = array_search($row['head_band'],$artists_id);

				$artist = $artist_d;
				$artist['id']	= $row['artists_id'];
				$artist['name']	= $row['head_band'];
				$artist['sort_name']	= str_ireplace('the ','',$row['head_band']);

		//		print_r($artist);
				$out['artists'][]	= $artist;

				$artist_credit	= $artist_credit_d;
				$artist_credit['id']	= $row['artists_id'];
				$artist_credit['name']	= $artist['name'];
				$out['artist_credit'][]	= $artist_credit;

				$artist_credit_name						= $artist_credit_name_d;
				$artist_credit_name['id']				= $row['artists_id'];
				$artist_credit_name['artist_credit_id']	= $row['artists_id'];
				$artist_credit_name['artist_id']		= $row['artists_id'];
				$artist_credit_name['name']				= $artist['name'];
				$out['artist_credit_name'][]			= $artist_credit_name;
			}

			$row['albums_id'] = array_search($row['head_album'],$releases_id);
			if ($row['albums_id'] === false) {
				$releases_id[] = $row['head_album'];
				$row['albums_id'] = array_search($row['head_album'],$releases_id);

				$release = $release_d;
				$release['id']					= $row['albums_id'];
				$release['artist_credit_id']	= $row['artists_id'];
				$release['name']				= $row['head_album'];
				$release['date']				= $row['year'].'-00-00';
				if (isset($mediums_id[$row['medium']])) {
					$release['medium_id'] = $mediums_id[$row['medium']];
				}

//				print_r($release);
				$out['releases'][]	= $release;
			}

			$track	= $track_d;

			$track['name']		= $row['track_title'];
			$track['number']	= $row['track_number'];
			$track['position']	= $row['track_number'];
			$track['artist_credit_id']	= $row['artists_id'];

		//	print_r($track);
			$out['tracks'][]	= $track;


		//	print_r($row);

//			if ($n >= 15) break;
		}

		// labels
		$label_id	= ['N/A'];
		$label_d	= [
//			'id'			=> '',
			'name'			=> '',
			'begin_date'	=> '',
			'is_ended'		=> '',
			'end_date'		=> '',
			'description'	=> '',
		];

		$file = base_path('_storage/seed_r.csv');

		$content = file_get_contents($file);
		$content = explode(PHP_EOL,$content);

		foreach ($content as $n => $row) {
			$row = explode(',', $row);

			if ($n == 0) {
				//		$keys = array_map('strtolower', $row);
				array_walk($row, function (&$val, $key) {
					$val = strtolower($val);
					$val = str_replace(["\r", "\t", "\n", ' '], ['', '', '', '_'], $val);
				});

				$keys = $row;
				continue;
			}

			if (count($row) <= 1) {
				continue;
			}

			if (count($keys) != count($row)) {
				print_r($keys);
				print_r($row);
				die();
			}

			$row = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $row);
			$row = array_combine($keys,$row);

			if ($row['label'] != '') {
				$row['label_id'] = array_search($row['label'], $label_id);
				if ($row['label_id'] === false) {
					$label_id[] = $row['label'];
					$row['label_id'] = array_search($row['label'], $label_id);

					$label = $label_d;
					$label['name'] = $row['label'];

					//		print_r($artist);
					$out['labels'][] = $label;

					$row['release_id'] = array_search($row['release'], $releases_id);

					if ((int)$row['release_id'] > 0 && (int)$row['label_id'] > 0) {
						$out['label_release'][] = [
							'release_id'	=> $row['release_id'],
							'label_id'		=> $row['label_id'],
						];
					}

				}
			}
		}
		//---------------------
		// Relations  tables



		//---------------------

		foreach ($out as $table => $data) {
			echo 'TABLE: '.$table.PHP_EOL;
			DB::table($table)->delete();

			foreach ($data as $n => $row) {
				if (!isset($row['id'])) {
					$row['id']	= $n + 1;
				}
				DB::table($table)->insert($row);
			}
		}
	}
}
