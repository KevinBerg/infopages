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
        $this->call(UserSeeder::class);
    }
}

class ContentTypeSeeder extends Seeder {

    public function run()
    {
        App\ContentType::create([
            'title' => 'text',
            'description' => 'Just text'
        ]);

        App\ContentType::create([
            'title' => 'text_and_image',
            'description' => 'Text with image'
        ]);

    }

}

class ContentSeeder extends Seeder {

    public function run()
    {
        App\Content::create([
            'title' => 'First Content',
            'description' => 'This is the description of the first content.',
            'type' => 1, # text type
            'status' => 1,
            'duration' => 30,
            'runtime' => 5,
            'text' => 'This is the content area!'
        ]);

    }

}

class PageSeeder extends Seeder {

    public function run()
    {
        App\Page::create([
            'title' => 'test',
            'description' => 'this is just a test page.'
        ]);

    }

}

class UserSeeder extends Seeder {

    public function run()
    {
        App\User::create([
            'name' => 'admin',
            'email' => 'chuck@norris.com',
            'password' => Hash::make('secret')
        ]);

    }

}
