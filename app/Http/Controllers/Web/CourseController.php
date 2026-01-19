<?php

// namespace App\Http\Controllers;

// use App\Models\Course;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use App\Models\Course;
// class CourseController extends Controller
// {
//     // แสดงรายการหลักสูตรทั้งหมด
//     public function index()
//     {
//         $courses = Course::withCount('lessons')->get();

//         return view('courses.index', compact('courses'));
//     }

//     // แสดงรายละเอียดหลักสูตร + บทเรียน
//     public function show($id)
//     {
//         $course = Course::with([
//             'lessons.videos',
//             'lessons.documents'
//         ])->findOrFail($id);

//         return view('courses.show', compact('course'));
//     }
// }



namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('lessons')->get();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::with(['lessons.videos','lessons.documents'])
            ->findOrFail($id);

        return view('courses.show', compact('course'));
    }
}