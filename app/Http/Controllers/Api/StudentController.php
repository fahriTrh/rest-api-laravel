<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return new StudentResource(true, 'List Data Students', $students);
    }

    public function show(Student $student)
    {
        return new StudentResource(true, 'Detail Data Student', $student);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'nim' => 'required|max:11',
            'jk' => 'required',
            'alamat' => 'required',
            'jurusan' => 'required' 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $student = Student::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'jurusan' => $request->jurusan
        ]);

        return new StudentResource(true, 'Student Added Successfully', $student);
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'nim' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'jurusan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $student_data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'jurusan' => $request->jurusan
        ];

        $student = Student::where('id', $student->id)->update($student_data);

        return new StudentResource(true, 'Student Updated Successfully', $student_data);
    }

    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return new StudentResource(true, 'Student Deleted Successfully', null);
    }

}
