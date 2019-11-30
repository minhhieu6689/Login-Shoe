<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Product;
use App\Models\ProductDetail;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    $array = ["Yezzy 700", "Nike Air Max", "Yezzy 350", "Balenciaga", "Adidas Stan Smith", "Human Race", "Ultra Boots", "Alexander Mcqueen", "Nike Jordan", "Adidas Alphabounce", "Adidas Prophere"];

    $random = Arr::random($array);
    return [
        'name' => $random,
        'description' => $faker->title,

        'category_id' => $faker->numberBetween(0, 1),
    ];
});

$factory->define(ProductDetail::class, function (Faker $faker) {
    $idProduct = [5, 6, 7, 8, 9, 10, 11, 12];
    $color = ["White", "Black", "Grey"];
    $size = [36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46];
    $randomProduct = Arr::random($idProduct);
    $randomColor = Arr::random($color);
    $randomSize = Arr::random($size);
    return [
        'color' => $randomColor,
        'size' => $randomSize,
        'price' => $faker->numberBetween(100, 500),
        'quantity' => $faker->numberBetween(100, 200),
        'product_id' => $randomProduct
    ];
});
