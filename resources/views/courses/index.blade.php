@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">หลักสูตรทั้งหมด</h3>

    <div class="row">
        @foreach($courses as $course)
        <div class="col-md-4">
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text text-muted">
                        {{ $course->description }}
                    </p>

                    <p class="small text-secondary">
                        บทเรียน {{ $course->lessons_count }} บท
                    </p>

                    <a href="/courses/{{ $course->id }}"
                       class="btn btn-primary w-100">
                        เข้าเรียน
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection