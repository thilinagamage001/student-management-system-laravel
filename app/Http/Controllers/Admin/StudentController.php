<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $students = Student::with('user')->get();
       
        return view('admin.students.index', compact('students'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
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
                'nic' => 'required|string|max:20|unique:students,nic',
                'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                 


            ]);

             DB::transaction(function () use ($validated, $request) {
                    $user = User::create([
                            'first_name' => $validated['first_name'],
                            'last_name' => $validated['last_name'],
                            'email' => $validated['email'],
                            'password' => Hash::make($validated['password']),
                            'role' => 'student',
                        ]);
                        
                        $year = date('Y');
                        $nextNumber = Student::count() + 1;

                        $studentId = 'STU'.$year.'-'.str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                        
                        $profile_picture = null;
                        if ($request->hasFile('profile_picture')) {
                                $profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
                        }

                        $student = Student::create([
                            'user_id' => $user->id,
                            'reg_no' => $studentId,
                            'phone' => $validated['phone'],
                            'dob' => $validated['dob'],
                            'age' => $validated['age'],
                            'address' => $validated['address'],
                            'gender' => $validated['gender'],
                            'nic' => $validated['nic'],
                            'profile_picture' => $profile_picture,
                            'status' => 'active',
                        ]);

             });

 

        }
        
        catch (\Exception $e) {
             return $e;
        }
        return view('admin.students.create')->with('success', 'Student created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.students.view', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::query()->where('id', $id)->first( );
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

                DB::transaction(function () use ($request) {
                    $student = Student::findOrFail($id);

                    $user = User::findOrFail($student->user_id);

                    $user->update([
                        'first_name' => $request->first_name,
                        'last_name'  => $request->last_name,
                        'email'      => $request->email,
                        'role'       => 'student',
                    ]);

                    if (!empty($request->password)) {
                        $userData['password'] = Hash::make($request->password);
                    }

                    $profile_picture = $student->profile_picture;

                    if ($request->hasFile('profile_picture')) {
                        $profile_picture = $request->file('profile_picture')
                            ->store('profile_pictures', 'public');
                    }

                    $student->update([
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

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $student = Student::findOrFail($id);
            $user = $student->user;

            // Delete the student record
            $student->delete();

            // Delete the associated user record
            if ($user) {
                $user->delete();
            }
        }
        catch (\Exception $e) {
            return $e;
        }
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
          
    }
}
