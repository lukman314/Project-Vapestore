<?php

namespace Database\Seeders;

use App\Models\SpkCriteria;
use Illuminate\Database\Seeder;

class SpkCriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $criteria = [
            ['name' => 'Harga',              'attribute' => 'price',          'type' => 'cost',    'weight' => 0.25],
            ['name' => 'Rating',             'attribute' => 'rating',         'type' => 'benefit', 'weight' => 0.4],
            ['name' => 'Jumlah Pembelian',   'attribute' => 'purchase_count', 'type' => 'benefit', 'weight' => 0.35],
        ];

        foreach ($criteria as $c) {
            SpkCriteria::create($c);
        }
    }
}
