<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0;$i < 15; $i++)
        {
            $title_az = $faker->realText(90);
            $title_en = $faker->realText(90);
            $title_ru = $faker->realText(90);
            Blog::create([
                'cover'=>$faker->imageUrl(rand(100,500),rand(100,500),'corn'),
                'title_az'=>$title_az,
                'slug_az'=>str_slug($title_az),
                'slug_en'=>str_slug($title_en),
                'slug_ru'=>str_slug($title_ru),
                'title_en'=>$title_en,
                'title_ru'=>$title_ru,
                'sub_title_az'=>$faker->realText(90),
                'sub_title_en'=>$faker->realText(90),
                'sub_title_ru'=>$faker->realText(90),
                'content_az'=>$faker->realText(400),
                'content_en'=>$faker->realText(400),
                'content_ru'=>$faker->realText(400),
                'status'=>1
            ]);
        }

    }
}
