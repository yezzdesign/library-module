<?php

namespace Modules\Library\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Library\Entities\Book;
use Modules\Library\Entities\Booklink;

class LibraryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach (Book::all() as $post) {

            for ($i=0; $i < rand(1,9); $i++)
            {
                Booklink::factory()->create([
                    'book_id'   =>  $post->id,
                ]);
            }

        }

        //Booklink::factory(400)->create();
    }
}
