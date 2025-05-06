<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    //get all students
    function list(){
        return Student::all();
    }
    //add a student
    function addStudent(Request $request){
        //validation
        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6|'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = $request->password;
        $student->save();
        return ["result" => "Student Added"];
    }
    //update a student
    function updateStudent(Request $request){
        //validation
        $rules = array(
            'id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $request->id,
            'password' => 'required|min:6'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = $request->password;
        $student->save();
        return ["result" => "Student Updated"];
    }

    //delete a student
    function deleteStudent($id){
        $student = Student::destroy($id);
        return ["result" => "Student Deleted"];
    }
    //search a student
    function searchStudent($name){
        $student = Student::where('name', 'like', '%' . $name . '%')->get();
        return $student;
    }

}
