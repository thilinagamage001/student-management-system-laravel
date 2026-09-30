<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'first_name' => 'Kasun',
                'last_name' => 'Perera',
                'email' => 'kasun.perera@sms.com',
                'phone' => '0771000001',
                'dob' => '2004-03-15',
                'age' => 22,
                'address' => 'Colombo',
                'gender' => 'Male',
                'nic' => '200407500101',
            ],
            [
                'first_name' => 'Nadeesha',
                'last_name' => 'Fernando',
                'email' => 'nadeesha.fernando@sms.com',
                'phone' => '0771000002',
                'dob' => '2005-01-22',
                'age' => 21,
                'address' => 'Kandy',
                'gender' => 'Female',
                'nic' => '200502200102',
            ],
            [
                'first_name' => 'Dilan',
                'last_name' => 'Silva',
                'email' => 'dilan.silva@sms.com',
                'phone' => '0771000003',
                'dob' => '2004-07-10',
                'age' => 22,
                'address' => 'Galle',
                'gender' => 'Male',
                'nic' => '200419200103',
            ],
            [
                'first_name' => 'Tharushi',
                'last_name' => 'Jayawardena',
                'email' => 'tharushi.j@sms.com',
                'phone' => '0771000004',
                'dob' => '2005-04-18',
                'age' => 21,
                'address' => 'Matara',
                'gender' => 'Female',
                'nic' => '200510900104',
            ],
            [
                'first_name' => 'Ravindu',
                'last_name' => 'Gunasekara',
                'email' => 'ravindu.g@sms.com',
                'phone' => '0771000005',
                'dob' => '2004-09-05',
                'age' => 22,
                'address' => 'Badulla',
                'gender' => 'Male',
                'nic' => '200424800105',
            ],
        ];

        DB::transaction(function () use ($students) {

            foreach ($students as $index => $studentData) {

                $user = User::create([
                    'first_name' => $studentData['first_name'],
                    'last_name'  => $studentData['last_name'],
                    'email'      => $studentData['email'],
                    'password'   => Hash::make('password123'),
                    'role'       => 'student',
                ]);

                Student::create([
                    'user_id' => $user->id,
                    'reg_no' => 'STU' . date('Y') . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                    'phone' => $studentData['phone'],
                    'dob' => $studentData['dob'],
                    'age' => $studentData['age'],
                    'address' => $studentData['address'],
                    'gender' => $studentData['gender'],
                    'nic' => $studentData['nic'],
                    'profile_picture' => null,
                    'status' => 'active',
                ]);
            }
        });
    }
}
