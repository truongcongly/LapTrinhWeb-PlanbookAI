<?php

namespace App\Controllers\Teacher;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\Exam;
use App\Models\Question;
use App\Models\ExamQuestion;
use App\Models\ExamResult;
use App\Models\PromptTemplate;

class ExamController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('teacher');
    }

    public function index()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examModel = new Exam();
        $exams = $examModel->getAllSimpleByTeacher($teacher['id']);

        $this->view('teacher/exams/index', compact('exams'));
    }

    public function create()
    {
        $this->authorize();

        $teacher = Auth::user();
        $questionModel = new Question();
        $questions = $questionModel->getAllByTeacherSimple($teacher['id']);
        $promptModel = new PromptTemplate();
        $promptTemplates = $promptModel->getActiveTemplates('exam');

        $this->view('teacher/exams/create', compact('questions', 'promptTemplates'));
    }

    public function store()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();

        $selectedQuestions = $_POST['questions'] ?? [];

        if (empty($selectedQuestions)) {
            Session::flash('error', 'Bạn phải chọn ít nhất 1 câu hỏi cho đề thi.');
            $this->redirect('/teacher/exams/create');
        }

        $examId = $examModel->create([
            'teacher_id' => $teacher['id'],
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'total_questions' => count($selectedQuestions),
            'duration_minutes' => $_POST['duration_minutes'] ?? 45,
            'status' => $_POST['status'] ?? 'draft',
            'instructions' => $_POST['instructions'] ?? '',
        ]);

        $answerKey = [];

        foreach ($selectedQuestions as $questionId) {
            $examQuestionModel->create($examId, $questionId);
        }

        $questionModel = new Question();
        $pickedQuestions = $questionModel->findManyByIds($selectedQuestions);

        foreach ($pickedQuestions as $q) {
            $answerKey[] = $q['correct_answer'];
        }

        $examModel->saveAnswerKey($examId, implode(',', $answerKey));

        Session::flash('success', 'Tạo đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();

        $exam = $examModel->findById($id);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $examQuestionModel->getQuestionsByExam($id);

        $this->view('teacher/exams/show', compact('exam', 'questions'));
    }

    public function edit()
    {
        $this->authorize();

        $teacher = Auth::user();
        $id = $_GET['id'] ?? 0;

        $examModel = new Exam();
        $questionModel = new Question();
        $examQuestionModel = new ExamQuestion();

        $exam = $examModel->findById($id);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $questionModel->getAllByTeacherSimple($teacher['id']);
        $selectedQuestionIds = $examQuestionModel->getQuestionIdsByExam($id);
        $promptModel = new PromptTemplate();
        $promptTemplates = $promptModel->getActiveTemplates('exam');

        $this->view('teacher/exams/edit', compact('exam', 'questions', 'selectedQuestionIds', 'promptTemplates'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;

        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();
        $questionModel = new Question();

        $exam = $examModel->findById($id);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $selectedQuestions = $_POST['questions'] ?? [];

        if (empty($selectedQuestions)) {
            Session::flash('error', 'Bạn phải chọn ít nhất 1 câu hỏi.');
            $this->redirect('/teacher/exams/edit?id=' . $id);
        }

        $examModel->update($id, [
            'title' => $_POST['title'] ?? '',
            'subject' => $_POST['subject'] ?? '',
            'grade_level' => $_POST['grade_level'] ?? '',
            'total_questions' => count($selectedQuestions),
            'duration_minutes' => $_POST['duration_minutes'] ?? 45,
            'status' => $_POST['status'] ?? 'draft',
            'instructions' => $_POST['instructions'] ?? '',
        ]);

        $examQuestionModel->deleteByExamId($id);

        foreach ($selectedQuestions as $questionId) {
            $examQuestionModel->create($id, $questionId);
        }

        $pickedQuestions = $questionModel->findManyByIds($selectedQuestions);
        $answerKey = [];

        foreach ($pickedQuestions as $q) {
            $answerKey[] = $q['correct_answer'];
        }

        $examModel->saveAnswerKey($id, implode(',', $answerKey));

        Session::flash('success', 'Cập nhật đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $examModel = new Exam();

        $exam = $examModel->findById($id);
        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $examModel->delete($id);
        Session::flash('success', 'Xóa đề thi thành công.');
        $this->redirect('/teacher/exams');
    }

    public function take()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();

        $exam = $examModel->findById($id);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $examQuestionModel->getQuestionsByExam($id);

        $this->view('teacher/exams/take', compact('exam', 'questions'));
    }

    public function submit()
    {
        $this->authorize();

        $teacher = Auth::user();
        $examId = $_GET['id'] ?? 0;

        $examModel = new Exam();
        $examQuestionModel = new ExamQuestion();
        $resultModel = new ExamResult();

        $exam = $examModel->findById($examId);

        if (!$exam) {
            Session::flash('error', 'Không tìm thấy đề thi.');
            $this->redirect('/teacher/exams');
        }

        $questions = $examQuestionModel->getQuestionsByExam($examId);
        $submittedAnswers = $_POST['answers'] ?? [];
        $studentName = trim($_POST['student_name'] ?? 'Student Demo');

        $correctCount = 0;
        $totalQuestions = count($questions);
        $submittedAnswerList = [];
        $scannedAnswersList = [];

        foreach ($questions as $q) {
            $qid = $q['id'];
            $studentAnswer = strtoupper(trim($submittedAnswers[$qid] ?? ''));
            $correctAnswer = strtoupper(trim($q['correct_answer'] ?? ''));

            $submittedAnswerList[] = $qid . ':' . $studentAnswer;
            $scannedAnswersList[] = $studentAnswer;

            if ($studentAnswer !== '' && $studentAnswer === $correctAnswer) {
                $correctCount++;
            }
        }

        $score = $totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 10, 2) : 0;

        $resultModel->create([
            'exam_id' => $examId,
            'teacher_id' => $teacher['id'],
            'student_name' => $studentName,
            'scanned_answers' => implode(',', $scannedAnswersList),
            'submitted_answers' => implode('|', $submittedAnswerList),
            'total_questions' => $totalQuestions,
            'correct_count' => $correctCount,
            'score' => $score,
            'feedback' => '',
            'status' => 'auto_graded',
        ]);

        Session::flash('success', 'Nộp bài và chấm điểm thành công.');
        $this->redirect('/teacher/results');
    }
}
