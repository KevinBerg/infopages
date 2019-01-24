<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ContentTypeSeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(PageSeeder::class);
    }
}

class ContentTypeSeeder extends Seeder {

    public function run()
    {
        App\ContentType::create([
            'title' => 'text',
            'description' => 'Just for Text...'
        ]);

        App\ContentType::create([
            'title' => 'text_and_image',
            'description' => 'Text with an image'
        ]);

    }

}

class ContentSeeder extends Seeder {

    public function run()
    {
        App\Content::create([
            'title' => 'der erste',
            'description' => 'asdf',
            'type' => 1,
            'status' => 0
        ]);

    }

}

class PageSeeder extends Seeder {

    public function run()
    {
        App\Page::create([
            'title' => 'erste page',
            'description' => 'asdf'
        ]);

    }

}
