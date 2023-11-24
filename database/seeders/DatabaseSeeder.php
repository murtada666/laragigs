<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Basically its like creating a fake DB just for testing purposes!
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
         - php artisan db:seed => This command will run this function which will create 10 fake users
         - php artisan migrate:refresh => This command will delete all the users data
         - php artisan migrate:refresh --seed => This command will delete the users data & create new ones
        */
        // \App\Models\User::factory(5)->create();

        // We specify only the columns that we wanna control.
        $user = User::factory()->create([
            "name"=> "john doe",
            "email"=> "john@gmail.com",
        ]);

        Listing::factory(5)->create([
            'user_id' => $user->id
        ]);

        // We can write the path for the model like the UserClass above or else we can just import the Class(Ctrl + Alt + L)
        // Listing::create(
        //     [
        //         'title' => 'Laravel Senior Developer', 
        //         'tags' => 'laravel, javascript',
        //         'company' => 'Acme Corp',
        //         'location' => 'Boston, MA',
        //         'email' => 'email1@email.com',
        //         'website' => 'https://www.acme.com',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
        //     ]
        // );

        // Listing::create(
        //     [
        //         'title' => 'Full-Stack Engineer',
        //         'tags' => 'laravel, backend ,api',
        //         'company' => 'Stark Industries',
        //         'location' => 'New York, NY',
        //         'email' => 'email2@email.com',
        //         'website' => 'https://www.starkindustries.com',
        //         'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam minima et illo reprehenderit quas possimus voluptas repudiandae cum expedita, eveniet aliquid, quam illum quaerat consequatur! Expedita ab consectetur tenetur delensiti?'
        //       ]
        // );

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
