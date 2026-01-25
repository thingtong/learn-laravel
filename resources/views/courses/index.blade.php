@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">หลักสูตรทั้งหมด</h3>

    <div class="row g-3">
        @foreach($courses as $course)

        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">

            <a href="/courses/{{ $course->id }}"
               class="text-decoration-none text-dark">

                <div class="card shadow-sm course-card h-100">
                    <div class="row g-0 h-100">

                        {{-- IMAGE --}}
                        <div class="col-4">
                            @if($course->image)
                                <img src="{{ asset('storage/'.$course->image) }}"
                                     class="img-fluid h-100 w-100"
                                     style="object-fit:cover; min-height:110px;">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center h-100"
                                     style="min-height:110px; font-size:12px;">
                                    No Image
                                </div>
                            @endif
                        </div>

                        {{-- DETAIL --}}
                        <div class="col-8">
                            <div class="card-body p-2">

                                <h6 class="card-title mb-1">
                                    {{ Str::limit($course->title, 40) }}
                                </h6>

                                <p class="card-text text-muted small mb-1">
                                    {{ Str::limit($course->description, 70) }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-secondary">
                                        📘 {{ $course->lessons_count }} บท
                                    </span>
                                    <span class="badge bg-primary small">
                                        เปิด
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </a>
        </div>

        @endforeach
    </div>
</div>

<style>
.course-card {
    transition: all .15s ease;
    cursor: pointer;
    font-size: 13px;
}
.course-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 14px rgba(0,0,0,.12) !important;
}
</style>
@endsection