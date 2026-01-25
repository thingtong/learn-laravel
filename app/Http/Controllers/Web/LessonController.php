<?php

// namespace App\Http\Controllers;

// use App\Models\Lesson;
// use App\Models\LessonProgress;
// use Illuminate\Http\Request;


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\Request;


class LessonController extends Controller
{
    // แสดงบทเรียน
   public function show($id)
    {
        $lesson = Lesson::with(['videos', 'documents'])
            ->findOrFail($id);

        return view('lessons.show', compact('lesson'));
    }

    // บันทึกว่าดูบทเรียนจบแล้ว
    // public function complete($id)
    // {
    //     LessonProgress::updateOrCreate(
    //         [
    //             'user_id' => auth()->id(),
    //             'lesson_id' => $id,
    //         ],
    //         [
    //             'completed' => 1
    //         ]
    //     );

    //     return back()->with('success', 'Lesson completed');
    // }
     public function complete($id)
    {
        LessonProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson_id' => $id
            ],
            [
                'completed_at' => now(),
                'completed' => 1
            ]
        );

        return back()->with('success', 'บันทึกความคืบหน้าแล้ว');
    }
}