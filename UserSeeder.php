<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'username' => 'francesca.bustamante',
            'full_name' => 'Francesca Marie Bustamante',
            'email' => 'francesca.bustamante@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
