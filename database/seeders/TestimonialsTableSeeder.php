<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;

class TestimonialsTableSeeder extends BaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Sarah Johnson',
                'company' => 'TechStart Solutions',
                'position' => 'CEO',
                'content' => 'AxeTech transformed our digital presence with their innovative web development solutions. Their team\'s attention to detail and commitment to excellence exceeded our expectations.',
                'rating' => 5,
                'image' => 'sarah-johnson.jpg',
                'order' => 1,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_name' => 'Michael Chen',
                'company' => 'InnovatePro',
                'position' => 'CTO',
                'content' => 'Working with AxeTech on our AI automation project was a game-changer. Their expertise and professionalism delivered results that significantly improved our operational efficiency.',
                'rating' => 5,
                'image' => 'michael-chen.jpg',
                'order' => 2,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_name' => 'Emily Rodriguez',
                'company' => 'Growth Marketing Co',
                'position' => 'Marketing Director',
                'content' => 'AxeTech\'s lead generation strategies helped us achieve a 300% increase in qualified leads. Their data-driven approach and continuous optimization were key to our success.',
                'rating' => 4,
                'image' => 'emily-rodriguez.jpg',
                'order' => 3,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_name' => 'David Smith',
                'company' => 'E-commerce Plus',
                'position' => 'Product Manager',
                'content' => 'The mobile app developed by AxeTech revolutionized our customer experience. Their team\'s technical expertise and user-centric design approach delivered an exceptional product.',
                'rating' => 5,
                'image' => 'david-smith.jpg',
                'order' => 4,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'client_name' => 'Lisa Thompson',
                'company' => 'Digital First Agency',
                'position' => 'Creative Director',
                'content' => 'AxeTech\'s design team brought our brand vision to life with stunning visuals and intuitive user interfaces. Their collaborative approach made the entire process smooth and enjoyable.',
                'rating' => 4,
                'image' => 'lisa-thompson.jpg',
                'order' => 5,
                'is_visible' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        $this->safeRun('testimonials', $testimonials);
    }
}