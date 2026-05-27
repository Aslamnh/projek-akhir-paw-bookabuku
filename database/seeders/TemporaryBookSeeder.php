<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemporaryBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('books')->insert([
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A story of the fabulously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'price' => 150000,
                'stock' => 10,
                'image' => 'book-images/image 89.png',
                'rating' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'The unforgettable novel of a childhood in a sleepy Southern town and the crisis of conscience that rocked it.',
                'price' => 120000,
                'stock' => 15,
                'image' => 'book-images/image 89.png',
                'rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'Among the seminal texts of the 20th century, Nineteen Eighty-Four is a rare work that grows more haunting as its futuristic purgatory becomes more real.',
                'price' => 135000,
                'stock' => 8,
                'image' => 'book-images/image 89.png',
                'rating' => 4.7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'Since its immediate success in 1813, Pride and Prejudice has remained one of the most popular novels in the English language.',
                'price' => 95000,
                'stock' => 20,
                'image' => 'book-images/image 89.png',
                'rating' => 4.6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'description' => 'The hero-narrator of The Catcher in the Rye is an ancient child of sixteen, a native New Yorker named Holden Caulfield.',
                'price' => 110000,
                'stock' => 12,
                'image' => 'book-images/image 89.png',
                'rating' => 4.2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'description' => 'Kisah persahabatan sepuluh anak dari keluarga miskin yang bersekolah di sebuah sekolah Muhammadiyah di Belitung.',
                'price' => 85000,
                'stock' => 25,
                'image' => 'book-images/image 89.png',
                'rating' => 4.9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'description' => 'Novel berlatar belakang masa kolonial Belanda yang menceritakan kehidupan Minke, seorang pribumi cerdas.',
                'price' => 140000,
                'stock' => 18,
                'image' => 'book-images/image 89.png',
                'rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'description' => 'Cara mudah dan terbukti untuk membentuk kebiasaan baik dan menghilangkan kebiasaan buruk.',
                'price' => 115000,
                'stock' => 30,
                'image' => 'book-images/image 89.png',
                'rating' => 4.7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'description' => 'Perjalanan Santiago, seorang gembala Andalusia, yang mencari harta karun duniawi di piramida Mesir.',
                'price' => 95000,
                'stock' => 14,
                'image' => 'book-images/image 89.png',
                'rating' => 4.6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cantik Itu Luka',
                'author' => 'Eka Kurniawan',
                'description' => 'Kisah epik keluarga yang menggabungkan sejarah, mitos, dan tragedi dengan gaya realisme magis.',
                'price' => 135000,
                'stock' => 22,
                'image' => 'book-images/image 89.png',
                'rating' => 4.7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Hujan',
                'author' => 'Tere Liye',
                'description' => 'Tentang persahabatan, cinta, melupakan, dan hujan.',
                'price' => 88000,
                'stock' => 40,
                'image' => 'book-images/image 89.png',
                'rating' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sapiens',
                'author' => 'Yuval Noah Harari',
                'description' => 'Eksplorasi sejarah umat manusia dari zaman batu hingga abad ke-21.',
                'price' => 165000,
                'stock' => 15,
                'image' => 'book-images/image 89.png',
                'rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
