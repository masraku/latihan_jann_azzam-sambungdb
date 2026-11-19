<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //ambil database yang udah ada
        $admin = DB::table('admin')->select('nama_admin as name', 'email','id_role')->get();
        $seller = DB::table('seller')->select('nama_seller as name', 'email_seller as email', 'id_role')->get();
        $buyer = DB::table('buyer')->select('nama_buyer as name', 'email_buyer as email', 'id_role')->get();

        foreach ($admin->concat($seller)->concat($buyer) as $orang) {
            User::updateOrCreate(
                ['email' => $orang->email],
                [
                    'name' => $orang->name,
                    'password' => 'password123',
                    'id_role' => $orang->id_role,
                ]
            );
        }
    }
}
