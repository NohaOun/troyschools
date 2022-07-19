<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\School;

class StudentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $schools = School::all();
        return view('students.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request) {
        $school = School::findOrFail($request->school_id);

        //check latest order id in this school 
        $order = $this->checkOrder($request->school_id);
     
        $new_order = $order + 1;
        $school->students()->create([
            'name' => $request->name,
            'school_id' => $request->school_id,
            'order' => $new_order,
        ]);
        return redirect()->route('students.index')
                        ->with('success', 'New Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student) {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student) {
         $schools = School::all();
        return view('students.edit', compact('student', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student) {
        $student = School::findOrFail($request->school_id)
                        ->products()->where('id', $request->id)->first();
        $student->update($request->all());
        return redirect()->route('students.index')
                        ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student) {
        $student->delete();
        return redirect()->route('students.index')
                        ->with('success', 'Student deleted successfully');
    }

    public function checkOrder($school_id) {

        $student_order = Student::where('school_id', $school_id)->latest()->first();      
        if ($student_order) {
            $order = $student_order->order;
        } else {
            $order = 0;
        }
        return $order;
    }

}
