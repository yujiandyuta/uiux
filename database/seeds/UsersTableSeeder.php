<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $date = Carbon::now();

      DB::table('users')->insert([
        'name' => 'hamada',
        'email' => 'oc.yuji@gmail.com',
        'password' => bcrypt('hamada'),
        'avatar_image_path' => '/images/user_images/myimages/YujiHamada.jpeg',
        'biography' => 'hamadaだお',
        'confirmed_at' => $date,
        'confirmation_sent_at' => $date

      ]);
      DB::table('users')->insert([
        'name' => 'yutamaro0405',
        'email' => 'yutamaro0405@gmail.com',
        'password' => bcrypt('yutamaro0405'),
        'avatar_image_path' => '/images/user_images/myimages/yutamaro0405.jpeg',
        'biography' => 'yutamaro0405だお',
        'confirmed_at' => $date,
        'confirmation_sent_at' => $date
      ]);

      DB::table('users')->insert([
        'name' => 'yoshimi',
        'email' => 'yoshimi@gmail.com',
        'password' => bcrypt('yoshimi'),
        'avatar_image_path' => '/images/user_images/myimages/yoshimi.jpeg',
        'biography' => 'yoshimiだお',
        'confirmed_at' => $date,
        'confirmation_sent_at' => $date
      ]);
      DB::table('users')->insert([
        'name' => 'rika',
        'email' => 'rika@gmail.com',
        'password' => bcrypt('rika'),
        'avatar_image_path' => '/images/user_images/myimages/rika.jpeg',
        'biography' => 'rikaだお',
        'confirmed_at' => $date,
        'confirmation_sent_at' => $date
      ]);
    }
}
