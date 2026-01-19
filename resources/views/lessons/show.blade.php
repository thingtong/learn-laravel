@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-3">{{ $lesson->title }}</h4>

    {{-- วิดีโอ --}}
    <h5>วิดีโอ</h5>

    @forelse($lesson->videos as $video)
        <div class="mb-3">
            <video controls width="100%" class="rounded shadow-sm">
                <source src="{{ asset('storage/'.$video->file_path) }}">
            </video>
        </div>
    @empty
        <p class="text-muted">ไม่มีวิดีโอ</p>
    @endforelse

    {{-- เอกสาร --}}
    <h5 class="mt-4">เอกสารประกอบ</h5>

    <ul class="list-group mb-4">
        @forelse($lesson->documents as $doc)
            <li class="list-group-item">
                <a href="{{ asset('storage/'.$doc->file_path) }}"
                   target="_blank">
                    ดาวน์โหลดเอกสาร
                </a>
            </li>
        @empty
            <li class="list-group-item text-muted">
                ไม่มีเอกสาร
            </li>
        @endforelse
    </ul>

    {{-- ปุ่มเรียนจบ --}}
    <form method="POST" action="/lessons/{{ $lesson->id }}/complete">
        @csrf
        <button class="btn btn-success">
            เรียนบทเรียนนี้จบแล้ว
        </button>
    </form>

</div>
@endsection