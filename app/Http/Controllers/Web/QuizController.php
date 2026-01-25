<?php

// namespace App\Http\Controllers;

// use App\Models\Quiz;
// use App\Models\Choice;
// use App\Models\QuizResult;
// use App\Models\LessonProgress;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// namespace App\Http\Controllers\Web;

// use App\Http\Controllers\Controller;
// use App\Models\QuizResult;
// use App\Models\LessonProgress;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Quiz;              // ⭐ สำคัญมาก
use App\Models\Course;
use App\Models\QuizResult;
use App\Models\LessonProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function start($courseId)
    {
        $totalLessons = DB::table('lessons')
            ->where('course_id', $courseId)
            ->count();

        $completedLessons = LessonProgress::where('user_id', auth()->id())
            ->whereIn('lesson_id', function ($q) use ($courseId) {
                $q->select('id')
                  ->from('lessons')
                  ->where('course_id', $courseId);
            })
            ->count();

        if ($completedLessons < $totalLessons) {
            return redirect()->back()
                ->withErrors('ต้องเรียนให้ครบทุกบทก่อนทำข้อสอบ');
        }

        $quiz = Quiz::with('questions.choices')
            ->where('course_id', $courseId)
            ->firstOrFail();

        return view('quiz.start', compact('quiz'));
    }
}

// class QuizController extends Controller
// {
//     // เริ่มทำข้อสอบ
//     public function start($courseId)
//     {
//         // ตรวจสอบว่าผู้เรียนเรียนครบทุกบทหรือยัง
//         $totalLessons = DB::table('lessons')
//             ->where('course_id', $courseId)
//             ->count();

//         $completedLessons = LessonProgress::where('user_id', auth()->id())
//             ->whereIn('lesson_id', function ($q) use ($courseId) {
//                 $q->select('id')
//                   ->from('lessons')
//                   ->where('course_id', $courseId);
//             })
//             ->where('completed', 1)
//             ->count();

//         if ($completedLessons < $totalLessons) {
//             return redirect()->back()
//                 ->withErrors('Please complete all lessons before taking the quiz');
//         }

//         $quiz = Quiz::with('questions.choices')
//             ->where('course_id', $courseId)
//             ->firstOrFail();


//         $course = Course::with('lessons')->findOrFail($courseId);
//         foreach ($course->lessons as $lesson) {
//             if (!$lesson->completedBy(auth()->id())) {
//                 abort(403, 'ต้องเรียนให้ครบทุกบทก่อนทำข้อสอบ');
//             }
//         }

//         return view('quiz.start', compact('quiz'));
//     }

//     // ส่งคำตอบข้อสอบ
//     public function submit(Request $request, $quizId)
//     {
//         $request->validate([
//             'answers' => 'required|array'
//         ]);

//         $score = 0;

//         foreach ($request->answers as $questionId => $choiceId) {
//             $choice = Choice::with('question')->find($choiceId);

//             if ($choice && $choice->is_correct) {
//                 $score += $choice->question->score;
//             }
//         }

//         $quiz = Quiz::with('course')->findOrFail($quizId);

//         $passed = $score >= $quiz->course->pass_score;

//         QuizResult::create([
//             'user_id' => auth()->id(),
//             'quiz_id' => $quizId,
//             'score' => $score,
//             'passed' => $passed,
//             'submitted_at' => now(),
//         ]);

//         return view('quiz.result', compact('score', 'passed'));
//     }
// }