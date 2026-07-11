<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@rowerowo.pl',
        ], [
            'name'              => 'Administrator',
            'password'          => Hash::make('Crmm1234'),
            'role'              => 'administrator',
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate([
            'email' => 'kierownik@rowerowo.pl',
        ], [
            'name'              => 'Jan Kierownik',
            'password'          => Hash::make('Crmm1234'),
            'role'              => 'kierownik',
            'email_verified_at' => now(),
        ]);

        User::updateOrCreate([
            'email' => 'klient@rowerowo.pl',
        ], [
            'name'              => 'Anna Klient',
            'password'          => Hash::make('Crmm1234'),
            'role'              => 'client',
            'email_verified_at' => now(),
        ]);

        $products = [
            [
                'name'        => 'Trek FX 3 Disc',
                'description' => 'Lekki rower miejski z hamulcami tarczowymi. Idealny do codziennych dojazdów.',
                'price'       => 3299.00,
                'stock'       => 5,
            ],
            [
                'name'        => 'Giant Escape 3',
                'description' => 'Rower crossowy dla aktywnych rowerzystów. Rama aluminiowa, 24 biegi.',
                'price'       => 2199.00,
                'stock'       => 8,
            ],
            [
                'name'        => 'Kross Trans 3.0',
                'description' => 'Komfortowy rower trekkingowy z sakwami. Amortyzowany widelec.',
                'price'       => 1899.00,
                'stock'       => 3,
            ],
            [
                'name'        => 'Specialized Allez Sport',
                'description' => 'Rower szosowy dla entuzjastów prędkości. Rama aluminiowa, koła 700c.',
                'price'       => 4999.00,
                'stock'       => 2,
            ],
            [
                'name'        => 'Merida Big.Nine 20',
                'description' => 'Górski hardtail z kołami 29". Napęd Shimano Acera, 24 biegi.',
                'price'       => 2799.00,
                'stock'       => 6,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate([
                'name' => $product['name'],
            ], $product);
        }
    }
}
