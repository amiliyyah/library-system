<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['Amel', 'AGT-001', '081234567801', 'Karawang'],
            ['Lia', 'AGT-002', '081234567802', 'Karawang'],
            ['Amy', 'AGT-003', '081234567803', 'Bekasi'],
            ['Dhani', 'AGT-004', '081234567804', 'Cikampek'],
            ['Baxchan', 'AGT-005', '081234567805', 'Purwakarta'],
        ];

        foreach ($members as [$name, $code, $phone, $address]) {
            Member::firstOrCreate(
                ['member_code' => $code],
                ['name' => $name, 'phone' => $phone, 'address' => $address]
            );
        }
    }
}