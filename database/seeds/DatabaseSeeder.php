<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SetPermissionSeeder::class);
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
            'id' => 1,
            'name' => 'admin',
            'email' => 'chuck@norris.com',
            'password' => Hash::make('secret')
        ]);

    }

}

class RoleSeeder extends Seeder {

    public function run()
    {
        Role::create([
            'name' => 'PageEditor'
        ]);

        Role::create([
            'name' => 'ContentEditor'
        ]);

    }

}

class PermissionSeeder extends Seeder {

    public function run()
    {
        Permission::create([
            'name' => 'edit pages'
        ]);

        Permission::create([
            'name' => 'edit contents'
        ]);

    }

}

class SetPermissionSeeder extends Seeder {

    public function run()
    {
        # connect page permissions to group
        $pageEditorRole = Role::where('name', 'PageEditor')->first();
        $pageEditorRole->givePermissionTo('edit pages');

        # connect content permissions to group
        $ContentEditorRole = Role::where('name', 'ContentEditor')->first();
        $ContentEditorRole->givePermissionTo('edit contents');

        # set admin user to Editor groups.
        $user = \App\User::find(1);
        $user->assignRole('PageEditor', 'ContentEditor');
    }

}
