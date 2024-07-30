<?php

namespace Byg\Admin\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    protected $data = [
        [
            'name'      =>  'Admin',
            'account'   =>  'admin',
            'status'    =>  1,
            'password'  =>  bcrypt('123qwe'),
            'infos'     =>  [
                [
                    'key'   =>  'type',
                    'value' =>  'admin',
                ]
            ],
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $item) {
            $user = \Byg\Admin\Models\Admin\User::create($item);
            foreach ($item['infos'] as $info) {
                $user->info()->create($info);
            }
        }
    }
}
