<?php

namespace Byg\Admin\database\seeders;

use Illuminate\Database\Seeder;

class AdminUsersSeeder extends Seeder
{
    public $data = [
        [
            'name'      =>  'Admin',
            'account'   =>  'admin',
            'status'    =>  1,
            'password'  =>  '123qwe',
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
        \DB::transaction(function() {
            foreach ($this->data as $item) {
                //取出除了infos的其他欄位
                $infos = $item['infos'];
                unset($item['infos']);
                //新增使用者
                $item['password'] = bcrypt($item['password']);
                $user = \Byg\Admin\Models\Admin\User::create($item);
                foreach ($infos as $info) {
                    $user->info()->create($info);
                }
            }
        });
        
    }
}
