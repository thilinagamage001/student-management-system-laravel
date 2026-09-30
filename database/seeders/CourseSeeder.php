<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'course_code' => 'CS101',
                'name' => 'Programming Fundamentals',
                'description' => 'Introduction to programming concepts.',
                'credits' => 3,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS102',
                'name' => 'Database Management Systems',
                'description' => 'Relational databases and SQL.',
                'credits' => 4,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS103',
                'name' => 'Web Development',
                'description' => 'HTML, CSS, JavaScript and Laravel.',
                'credits' => 4,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS104',
                'name' => 'Data Structures',
                'description' => 'Arrays, linked lists, stacks and queues.',
                'credits' => 3,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS105',
                'name' => 'Object Oriented Programming',
                'description' => 'Classes, objects, inheritance and polymorphism.',
                'credits' => 4,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS106',
                'name' => 'Software Engineering',
                'description' => 'Software development lifecycle and methodologies.',
                'credits' => 3,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS107',
                'name' => 'Computer Networks',
                'description' => 'Networking fundamentals and protocols.',
                'credits' => 3,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS108',
                'name' => 'Operating Systems',
                'description' => 'Processes, memory and file systems.',
                'credits' => 4,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS109',
                'name' => 'Mobile Application Development',
                'description' => 'Android application development basics.',
                'credits' => 3,
                'status' => 'active',
            ],
            [
                'course_code' => 'CS110',
                'name' => 'Artificial Intelligence',
                'description' => 'Introduction to AI concepts and applications.',
                'credits' => 4,
                'status' => 'active',
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['course_code' => $course['course_code']],
                $course
            );
        }
    }
}
