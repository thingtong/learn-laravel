@extends('layouts.app')

@section('content')
<div class="container">

    <h3>{{ $course->title }}</h3>
    <p class="text-muted">{{ $course->description }}</p>

    <hr>

    <h5>บทเรียน</h5>

    <ul class="list-group mb-4">
        @foreach($course->lessons as $lesson)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <span>{{ $lesson->title }}</span>

            <a href="/lessons/{{ $lesson->id }}"
               class="btn btn-sm btn-outline-primary">
                ดูบทเรียน
            </a>
        </li>
        @endforeach
    </ul>

    <a href="/quiz/{{ $course->id }}/start"
       class="btn btn-success">
        ทำข้อสอบ
    </a>

</div>
@endsection