<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 38; $i++) {
            Avatar::query()->create([
                'icon' => 'uploads/avatar/avatar_'.str_pad($i, 2, '0', STR_PAD_LEFT).'.png',
            ]);
        }
    }
}
