<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;

class FacultyController extends Controller
{
    public function getFaculty()
    {
        return response()->json(Faculty::all()->makeHidden('faculty_password'), 200);
    }

    public function getFacultyByID($id)
    {
        $faculty = Faculty::find($id);
        if (is_null($faculty)) {
            return response()->json(['message' => 'Faculty not Found'], 404);
        }
        return response()->json($faculty->makeHidden('faculty_password'), 200);
    }

    public function addFaculty(Request $request)
    {
        $validatedData = $request->validate([
            'faculty_name' => 'required|string|max:255',
            'faculty_code' => 'required|string|max:15|regex:/^FA[0-9]{4}TG2024$/',
            'faculty_email' => 'required|string|email|max:255|unique:faculties,faculty_email',
            'faculty_type' => 'required|string|max:50',
            'faculty_password' => 'required|string|min:8', // Validate password
        ]);

        $faculty = Faculty::create([
            'faculty_name' => $validatedData['faculty_name'],
            'faculty_code' => $validatedData['faculty_code'],
            'faculty_email' => $validatedData['faculty_email'],
            'faculty_type' => $validatedData['faculty_type'],
            'faculty_password' => bcrypt($validatedData['faculty_password']), // Hash the password
        ]);

        return response()->json($faculty->makeHidden('faculty_password'), 201);
    }
}
