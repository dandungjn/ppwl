<?php

namespace Database\Seeders;

use App\Models\SimpleSearch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SimpleSearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tanggal' => now()->subDays(10)->format('Y-m-d'),
                'pekerjaan' => 'Konsultasi Sistem Informasi',
                'client' => 'PT. Maju Jaya',
                'nilai' => 50000000,
                'status' => 'Selesai',
            ],
            [
                'tanggal' => now()->subDays(8)->format('Y-m-d'),
                'pekerjaan' => 'Pengembangan Website E-Commerce',
                'client' => 'CV. Bintang Usaha',
                'nilai' => 75000000,
                'status' => 'Pembayaran',
            ],
            [
                'tanggal' => now()->subDays(5)->format('Y-m-d'),
                'pekerjaan' => 'Audit Sistem Database',
                'client' => 'PT. Indonesia Sejahtera',
                'nilai' => 40000000,
                'status' => 'Draft',
            ],
            [
                'tanggal' => now()->subDays(3)->format('Y-m-d'),
                'pekerjaan' => 'Pelatihan IT Staff',
                'client' => 'Universitas ABC',
                'nilai' => 30000000,
                'status' => 'Selesai',
            ],
            [
                'tanggal' => now()->subDay()->format('Y-m-d'),
                'pekerjaan' => 'Maintenance Server',
                'client' => 'PT. Global Tech',
                'nilai' => 25000000,
                'status' => 'Pembayaran',
            ],
            [
                'tanggal' => now()->format('Y-m-d'),
                'pekerjaan' => 'Implementasi Cloud Solution',
                'client' => 'PT. Digital Indonesia',
                'nilai' => 100000000,
                'status' => 'Draft',
            ],
        ];

        foreach ($data as $item) {
            SimpleSearch::create($item);
        }
    }
}
