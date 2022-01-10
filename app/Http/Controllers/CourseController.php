<?php

namespace App\Http\Controllers;

use App\Course;
use App\Programme;
use App\Student;
use App\StudentCourse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request){
        $programme = $request->input('programme') ?? '%';
        $coursename = '%' . $request->input('coursename') . '%'; // $request->input('artist') OR $request->artist OR $request['artist'];;
        $courses = Course::with('programme')
            ->where([
                ['name', 'like', $coursename],
                ['programme_id', 'like', $programme]
            ])
            ->orWhere([
                ['description', 'like', $coursename],
                ['programme_id', 'like', $programme]
            ])
            ->paginate(12);

        $programmes = Programme::orderBy('name')            // short version of orderBy('name', 'asc')
        ->has('courses')        // only genres that have one or more records
        ->withCount('courses')  // add a new property 'records_count' to the Genre models/objects
        ->get()
            ->transform(function ($item, $key) {
                // Set first letter of name to uppercase and add the counter
                $item->name = ucwords($item->name);
                return $item;
            })
            ->makeHidden(['created_at', 'updated_at']);    // Remove all fields that you don't use inside the view
        $result = compact('courses', 'programmes');     // $result = ['genres' => $genres, 'records' => $records]
        //Json::dump($result);
        return view('courses.courses', $result);
    }
    public function show($id){
        $courses= Course::with('studentCourse')->findOrFail($id);
        $studentCourse = StudentCourse::with('student')
            ->where('course_id', $courses->id)
            ->get();
        $result = compact('courses','studentCourse');
        //dd($result);
        return view('courses.show', ['id' => $id],$result);
    }
}
