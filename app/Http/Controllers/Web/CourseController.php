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
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // <<< สำคัญ
use Illuminate\Support\Facades\Storage;
use App\Models\Lesson;
use App\Models\LessonVideo;
use App\Models\LessonDocument;
use Illuminate\Support\Facades\Auth; // ⭐ สำคัญมาก
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


    public function create()
    {
        return view('courses.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'pass_score' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',

            'lessons' => 'required|array|min:1',
            'lessons.*.title' => 'required|string|max:255',

            'lessons.*.quiz.*.question' => 'required_with:lessons.*.quiz|string',
            //'lessons.*.quiz.*.correct' => 'nullable|in:A,B,C,D',
            'lessons.*.quiz.*.correct' => 'required|string|max:255',
            'lessons.*.quiz.*.score' => 'nullable|integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            $imagePath = $request->hasFile('image')
                ? $request->file('image')->store('courses', 'public')
                : null;

            $course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'pass_score' => $request->pass_score,
                'image' => $imagePath,
                'created_by'  => Auth::id(),   // ⭐ สำคัญ
                'updated_by'  => Auth::id(),   // ถ้ามี column นี้
            ]);







            foreach ($request->lessons as $index => $lessonData) {

                $lesson = Lesson::create([
                    'course_id' => $course->id,
                    'title' => $lessonData['title'],
                    'content' => $lessonData['content'] ?? null,
                ]);

                // ================== SAVE VIDEOS ==================
                if ($request->hasFile("lessons.$index.videos")) {
                    foreach ($request->file("lessons.$index.videos") as $video) {
                        $videoPath = $video->store('lesson_videos', 'public');

                        LessonVideo::create([
                            'lesson_id' => $lesson->id,
                            'path' => $videoPath,
                        ]);
                    }
                }

                // ================== SAVE DOCUMENTS ==================
                if ($request->hasFile("lessons.$index.documents")) {
                    foreach ($request->file("lessons.$index.documents") as $doc) {
                        $docPath = $doc->store('lesson_docs', 'public');

                        LessonDocument::create([
                            'lesson_id' => $lesson->id,
                            'path' => $docPath,
                        ]);
                    }
                }

                // ================== QUIZ ==================
                if (!empty($lessonData['quiz'])) {
                    foreach ($lessonData['quiz'] as $q) {
                        QuizQuestion::create([
                            'lesson_id' => $lesson->id,
                            'question' => $q['question'],
                            'a' => $q['a'] ?? null,
                            'b' => $q['b'] ?? null,
                            'c' => $q['c'] ?? null,
                            'd' => $q['d'] ?? null,
                            'correct' => $q['correct'] ?? null,
                            'score' => $q['score'] ?? 1,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect('/courses')
                ->with('success', 'บันทึกหลักสูตรเรียบร้อย');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }


}