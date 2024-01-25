<?php

namespace App\Database\Seeds;

use App\Models\Comment;
use CodeIgniter\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $comments = new Comment();
        for($i=0; $i < 10; $i++) {
            $faker = \Faker\Factory::create();
            $data = [
                'name' => $faker->email,
                'text' => $faker->text(50),
            ];
            $comments->save($data);
        }
    }
}
