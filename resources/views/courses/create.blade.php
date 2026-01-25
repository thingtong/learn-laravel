<!doctype html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มหลักสูตร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <h2 class="mb-4">➕ เพิ่มหลักสูตรใหม่</h2>

    {{-- ===== GLOBAL ERROR ===== --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>กรุณาตรวจสอบข้อมูล</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- ================= COURSE ================= --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">ข้อมูลหลักสูตร</div>
            <div class="card-body row g-3">

                <div class="col-md-6">
                    <label class="form-label">ชื่อหลักสูตร *</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">คะแนนผ่าน *</label>
                    <input type="number"
                           name="pass_score"
                           value="{{ old('pass_score') }}"
                           class="form-control @error('pass_score') is-invalid @enderror">

                    @error('pass_score')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">รูปหลักสูตร</label>
                    <input type="file"
                           name="image"
                           class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">รายละเอียดหลักสูตร</label>
                    <textarea name="description"
                              class="form-control">{{ old('description') }}</textarea>
                </div>

            </div>
        </div>

        {{-- ================= LESSONS ================= --}}
        <div id="lessons-container"></div>

        <div class="mb-4">
            <button type="button" onclick="addLesson()" class="btn btn-primary">
                ➕ เพิ่มบทเรียน
            </button>
            <small class="text-danger ms-2">* ต้องมีอย่างน้อย 1 บทเรียน</small>
        </div>

        {{-- ================= SUBMIT ================= --}}
        <div class="text-end">
            <button class="btn btn-success btn-lg">
                💾 บันทึกหลักสูตร
            </button>
        </div>

    </form>
</div>

{{-- ================= JS ================= --}}
<script>
let lessonIndex = 0;

function addLesson() {
    const container = document.getElementById('lessons-container');

    container.insertAdjacentHTML('beforeend', `
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <strong>บทเรียนที่ ${lessonIndex + 1}</strong>
            <button type="button" class="btn btn-sm btn-danger"
                onclick="this.closest('.card').remove()">
                ลบ
            </button>
        </div>

        <div class="card-body row g-3">

            <div class="col-md-6">
                <label class="form-label">ชื่อบทเรียน *</label>
                <input type="text"
                       name="lessons[${lessonIndex}][title]"
                       class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">เนื้อหาบทเรียน</label>
                <textarea name="lessons[${lessonIndex}][content]"
                          class="form-control"></textarea>
            </div>

            <div class="col-12">
                <label class="form-label">วิดีโอการสอน</label>
                <input type="file"
                       name="lessons[${lessonIndex}][videos][]"
                       class="form-control"
                       multiple accept="video/*">
            </div>

            <div class="col-12">
                <label class="form-label">เอกสารประกอบ</label>
                <input type="file"
                       name="lessons[${lessonIndex}][documents][]"
                       class="form-control"
                       multiple>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">ข้อสอบ</label>
                <div id="quiz-${lessonIndex}"></div>
                <button type="button"
                        class="btn btn-outline-secondary btn-sm mt-2"
                        onclick="addQuiz(${lessonIndex})">
                    ➕ เพิ่มคำถาม
                </button>
            </div>
        </div>
    </div>
    `);

    addQuiz(lessonIndex);
    lessonIndex++;
}

function addQuiz(lessonIdx) {
    const container = document.getElementById(`quiz-${lessonIdx}`);
    const qIndex = container.children.length;

    container.insertAdjacentHTML('beforeend', `
    <div class="border rounded p-3 mb-3">
        <input type="text"
               name="lessons[${lessonIdx}][quiz][${qIndex}][question]"
               class="form-control mb-2"
               placeholder="คำถาม *">

        <div class="row g-2">
            <div class="col"><input type="text" name="lessons[${lessonIdx}][quiz][${qIndex}][a]" class="form-control" placeholder="A"></div>
            <div class="col"><input type="text" name="lessons[${lessonIdx}][quiz][${qIndex}][b]" class="form-control" placeholder="B"></div>
            <div class="col"><input type="text" name="lessons[${lessonIdx}][quiz][${qIndex}][c]" class="form-control" placeholder="C"></div>
            <div class="col"><input type="text" name="lessons[${lessonIdx}][quiz][${qIndex}][d]" class="form-control" placeholder="D"></div>
        </div>

        <div class="row g-2 mt-2">
            <div class="col-md-4">
                <input type="text"
                       name="lessons[${lessonIdx}][quiz][${qIndex}][correct]"
                       class="form-control"
                       placeholder="คำตอบที่ถูก (A-D)">
            </div>
            <div class="col-md-2">
                <input type="number"
                       name="lessons[${lessonIdx}][quiz][${qIndex}][score]"
                       class="form-control"
                       placeholder="คะแนน">
            </div>
        </div>
    </div>
    `);
}
</script>

</body>
</html>
