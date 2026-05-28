<?php
 
namespace Database\Seeders;
 
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
 
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Main User
        $mainUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
 
        $mainUserBooks = [
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'description' => 'Kisah inspiratif tentang sepuluh anak dari keluarga miskin di Belitung yang berjuang menempuh pendidikan.',
                'price' => 75000,
                'stock' => 5,
                'category' => 'Novel',
                'image' => 'book-images/image 89.png',
                'rating' => 4.8,
            ],
            [
                'title' => 'Belajar Laravel 11 untuk Pemula',
                'author' => 'Taylor Otwell',
                'description' => 'Buku panduan lengkap membangun aplikasi web modern menggunakan framework Laravel 11.',
                'price' => 120000,
                'stock' => 3,
                'category' => 'Teknologi',
                'image' => 'book-images/image 89.png',
                'rating' => 4.9,
            ],
            [
                'title' => 'Detektif Conan Vol. 100',
                'author' => 'Gosho Aoyama',
                'description' => 'Petualangan seru detektif cilik Shinichi Kudo dalam memecahkan misteri Organisasi Hitam.',
                'price' => 45000,
                'stock' => 10,
                'category' => 'Komik',
                'image' => 'book-images/image 89.png',
                'rating' => 4.7,
            ],
        ];
 
        foreach ($mainUserBooks as $bookData) {
            $mainUser->books()->create($bookData);
        }
 
        $seller1 = User::factory()->create([
            'name' => 'Budiono Siregar',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
        ]);
 
        $seller1Books = [
            [
                'title' => 'That Time I Got Reincarnated as a Slime',
                'author' => 'Fuse',
                'description' => 'Seorang pria biasa bereinkarnasi menjadi slime di dunia fantasi dan memulai petualangannya.',
                'price' => 95000,
                'stock' => 15,
                'category' => 'Novel',
                'image' => 'book-images/image 89.png',
                'rating' => 4.8,
            ],
            [
                'title' => 'Solo Leveling',
                'author' => 'Chugong',
                'description' => 'Seseorang yang aura farming.',
                'price' => 100000,
                'stock' => 13,
                'category' => 'Novel',
                'image' => 'book-images/image 89.png',
                'rating' => 4.9,
            ],
        ];
 
        foreach ($seller1Books as $bookData) {
            $seller1->books()->create($bookData);
        }
 
        $seller2 = User::factory()->create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
        ]);
 
        $seller2Books = [
            [
                'title' => 'Matematika Dasar & Penerapan',
                'author' => 'Prof. Yohanes',
                'description' => 'Buku teks komprehensif mengenai konsep-konsep dasar matematika untuk siswa dan mahasiswa.',
                'price' => 60000,
                'stock' => 8,
                'category' => 'Edukasi',
                'image' => 'book-images/image 89.png',
                'rating' => 4.5,
            ],
            [
                'title' => 'Dasar Pemrograman Web',
                'author' => 'John Doe',
                'description' => 'Panduan terstruktur belajar HTML, CSS, dan JavaScript untuk pemula.',
                'price' => 110000,
                'stock' => 7,
                'category' => 'Teknologi',
                'image' => 'book-images/image 89.png',
                'rating' => 4.4,
            ],
        ];
 
        foreach ($seller2Books as $bookData) {
            $seller2->books()->create($bookData);
        }
    }
}
