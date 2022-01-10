@extends('layout.template')
@section('title', 'Course '.$id)
@section('main')
    <h1>{{$courses->name}}</h1>
    <p>{{$courses->description}}</p>
    <hr>
    <p>List of students enrolled</p>
    <ul>
        @foreach($studentCourse as $course)
            <li>{{$course->student->first_name. ' ' . $course->student->last_name. ' (semester '. $course->semester.')'}}</li>
        @endforeach
    </ul>
@endsection
