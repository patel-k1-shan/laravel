<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.index');
    }

    public function getStudentAjax() {
        $students = Student::all();
        return response()->json(['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $destinationPath = "images/";
        $imageName = date('YmdHis') .''.$image->getClientOriginalName();
        $image->move($destinationPath,$imageName);

        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->image = $imageName;
        $student->save();

        return response()->json(['res'=>'Student Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student,$id)
    {
        $student = Student::where('id',$id)->get();
        return view('student.edit',['student'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $student = Student::find($request->id);
        
        $student->name = $request->name;
        $student->email = $request->email;

        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $imageName = date('YmdHis'). ''.$image->getClientOriginalName();
            $image->move($destinationPath,$imageName);
            $student->image = $imageName;
        }
        
        $student->save();
        return response()->json(['result'=>'data updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student,$id)
    {
        Student::where('id',$id)->delete();
        
        return response()->json(['result'=>'Student deleted']);
    }
}
