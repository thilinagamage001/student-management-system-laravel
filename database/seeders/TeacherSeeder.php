<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            [
                'first_name' => 'John',
                'last_name' => 'Silva',
                'email' => 'john.silva@sms.com',
                'phone' => '0771111111',
                'dob' => '1985-05-10',
                'age' => 41,
                'address' => 'Colombo',
                'gender' => 'Male',
                'nic' => '851301111V',
            ],
            [
                'first_name' => 'Mary',
                'last_name' => 'Perera',
                'email' => 'mary.perera@sms.com',
                'phone' => '0772222222',
                'dob' => '1988-08-15',
                'age' => 38,
                'address' => 'Kandy',
                'gender' => 'Female',
                'nic' => '886001222V',
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Fernando',
                'email' => 'david.fernando@sms.com',
                'phone' => '0773333333',
                'dob' => '1990-03-20',
                'age' => 36,
                'address' => 'Galle',
                'gender' => 'Male',
                'nic' => '900802333V',
            ],
            [
                'first_name' => 'Kamal',
                'last_name' => 'Jayasinghe',
                'email' => 'kamal.j@sms.com',
                'phone' => '0774444444',
                'dob' => '1987-11-01',
                'age' => 39,
                'address' => 'Kurunegala',
                'gender' => 'Male',
                'nic' => '873051444V',
            ],
            [
                'first_name' => 'Nimal',
                'last_name' => 'Gunawardena',
                'email' => 'nimal.g@sms.com',
                'phone' => '0775555555',
                'dob' => '1989-07-12',
                'age' => 37,
                'address' => 'Badulla',
                'gender' => 'Female',
                'nic' => '895641555V',
            ],
        ];

        DB::transaction(function () use ($teachers) {

            foreach ($teachers as $index => $teacherData) {

                $user = User::create([
                    'first_name' => $teacherData['first_name'],
                    'last_name' => $teacherData['last_name'],
                    'email' => $teacherData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'teacher',
                ]);

                Teacher::create([
                    'user_id' => $user->id,
                    'reg_no' => 'TCH' . date('Y') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                    'phone' => $teacherData['phone'],
                    'dob' => $teacherData['dob'],
                    'age' => $teacherData['age'],
                    'address' => $teacherData['address'],
                    'gender' => $teacherData['gender'],
                    'nic' => $teacherData['nic'],
                    'profile_picture' => null,
                    'status' => 'active',
                ]);
            }
        });
    }
}
