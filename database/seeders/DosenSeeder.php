<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosenUsers = User::where('role', 'dosen')->get();

        $dosen = [
            ['NIP' => '198501012010011001', 'Nama' => 'Dr. Ahmad Hidayat, M.Kom', 'Alamat' => 'Jl. Merdeka No. 10', 'Nohp' => '081234567890'],
            ['NIP' => '198602022011012001', 'Nama' => 'Dr. Siti Nurjanah, M.T', 'Alamat' => 'Jl. Sudirman No. 20', 'Nohp' => '081234567891'],
            ['NIP' => '198703032012011001', 'Nama' => 'Budi Santoso, M.Kom', 'Alamat' => 'Jl. Ahmad Yani No. 30', 'Nohp' => '081234567892'],
            ['NIP' => '198804042013012001', 'Nama' => 'Rina Wati, M.T', 'Alamat' => 'Jl. Gatot Subroto No. 40', 'Nohp' => '081234567893'],
            ['NIP' => '198905052014011001', 'Nama' => 'Prof. Dedi Irawan, Ph.D', 'Alamat' => 'Jl. Diponegoro No. 50', 'Nohp' => '081234567894'],
            ['NIP' => '199006062015012001', 'Nama' => 'Eka Putri, M.Kom', 'Alamat' => 'Jl. Pahlawan No. 60', 'Nohp' => '081234567895'],
            ['NIP' => '199107072016011001', 'Nama' => 'Fajar Nugroho, M.T', 'Alamat' => 'Jl. Veteran No. 70', 'Nohp' => '081234567896'],
            ['NIP' => '199208082017012001', 'Nama' => 'Gita Permata, M.Kom', 'Alamat' => 'Jl. Kartini No. 80', 'Nohp' => '081234567897'],
            ['NIP' => '199309092018011001', 'Nama' => 'Hendra Wijaya, M.T', 'Alamat' => 'Jl. Cut Nyak Dien No. 90', 'Nohp' => '081234567898'],
            ['NIP' => '199410102019012001', 'Nama' => 'Indah Lestari, M.Kom', 'Alamat' => 'Jl. RA Kartini No. 100', 'Nohp' => '081234567899'],
        ];

        foreach ($dosen as $index => $dsn) {
            if (isset($dosenUsers[$index])) {
                $dsn['user_id'] = $dosenUsers[$index]->id;
            }
            Dosen::create($dsn);
        }
    }
}
