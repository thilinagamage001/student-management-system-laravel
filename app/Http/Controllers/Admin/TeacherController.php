<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
                $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'phone' => 'required|string|max:15',
                'dob' => 'required|date',
                'age' => 'required|integer|min:0',
                'address' => 'required|string|max:255',
                'gender' => 'required|in:Male,Female',
                'nic' => 'required|string|max:20|unique:teachers,nic',
                'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                 


            ]);
            
            DB::transaction(function () use ($request) {
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'teacher',
                ]);
                
                $year = date('Y');
                $nextNumber = Teacher::count() + 1;

                $teacherRegNo = 'TCH'.$year.'-'.str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                
                $profile_picture = null;
                if ($request->hasFile('profile_picture')) {
                        $profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
                }

                $student = Teacher::create([
                    'user_id' => $user->id,
                    'reg_no' => $teacherRegNo,
                    'phone' => $request->phone,
                    'dob' => $request->dob,
                    'age' => $request->age,
                    'address' => $request->address,
                    'gender' => $request->gender,
                    'nic' => $request->nic,
                    'profile_picture' => $profile_picture,
                    'status' => 'active',
                ]);
              });

        }
        
        catch (\Exception $e) {
             return $e;
        }
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('admin.teachers.view', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::with('user')->findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            try {

            DB::transaction(function () use ($request) {
                $teacher = Teacher::findOrFail($id);

                    $user = User::findOrFail($teacher->user_id);

                    $user->update([
                        'first_name' => $request->first_name,
                        'last_name'  => $request->last_name,
                        'email'      => $request->email,
                        'role'       => 'teacher',
                    ]);

                    if (!empty($request->password)) {
                        $userData['password'] = Hash::make($request->password);
                    }

                    $profile_picture = $teacher->profile_picture;

                    if ($request->hasFile('profile_picture')) {
                        $profile_picture = $request->file('profile_picture')
                            ->store('profile_pictures', 'public');
                    }

                    $teacher->update([
                        'phone' => $request->phone,
                        'dob' => $request->dob,
                        'age' => $request->age,
                        'address' => $request->address,
                        'gender' => $request->gender,
                        'nic' => $request->nic,
                        'profile_picture' => $profile_picture,
                        'status' => 'active',
                    ]);
            });
 

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $teacher = Teacher::findOrFail($id);
            $user = $teacher->user;

            // Delete the teacher record
            $teacher->delete();

            // Delete the associated user record
            if ($user) {
                $user->delete();
            }
        }
        catch (\Exception $e) {
            return $e;
        }

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
