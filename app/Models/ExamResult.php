<?php

namespace App\Models;

use App\Core\Database;

class ExamResult
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;

        $sql = "SELECT r.*, e.title AS exam_title
                FROM exam_results r
                LEFT JOIN exams e ON r.exam_id = e.id
                WHERE r.teacher_id = $teacherId
                ORDER BY r.id DESC";

        $result = $this->conn->query($sql);

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function getRecentByTeacher($teacherId, $limit = 5)
    {
        $teacherId = (int)$teacherId;
        $limit = max(1, (int)$limit);

        $sql = "SELECT r.*, e.title AS exam_title
                FROM exam_results r
                LEFT JOIN exams e ON r.exam_id = e.id
                WHERE r.teacher_id = $teacherId
                ORDER BY r.id DESC
                LIMIT $limit";

        $result = $this->conn->query($sql);

        $items = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public function getStatsByTeacher($teacherId)
    {
        $teacherId = (int)$teacherId;
        $stats = [
            'total' => 0,
            'auto_graded' => 0,
            'needs_review' => 0,
            'reviewed' => 0,
            'failed' => 0,
        ];

        $sql = "SELECT status, COUNT(*) AS total
                FROM exam_results
                WHERE teacher_id = $teacherId
                GROUP BY status";
        $result = $this->conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $status = $row['status'] ?? '';
                $count = (int)($row['total'] ?? 0);
                if (array_key_exists($status, $stats)) {
                    $stats[$status] = $count;
                }
                $stats['total'] += $count;
            }
        }

        return $stats;
    }

    public function findById($id)
    {
        $id = (int)$id;

        $sql = "SELECT r.*, e.title AS exam_title, e.subject, e.grade_level
                FROM exam_results r
                LEFT JOIN exams e ON r.exam_id = e.id
                WHERE r.id = $id
                LIMIT 1";

        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function findByIdForTeacher($id, $teacherId)
    {
        $id = (int)$id;
        $teacherId = (int)$teacherId;

        $sql = "SELECT r.*, e.title AS exam_title, e.subject, e.grade_level
                FROM exam_results r
                LEFT JOIN exams e ON r.exam_id = e.id
                WHERE r.id = $id AND r.teacher_id = $teacherId
                LIMIT 1";

        $result = $this->conn->query($sql);

        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data)
    {
        $examId = (int)$data['exam_id'];
        $teacherId = (int)$data['teacher_id'];
        $studentName = $this->conn->real_escape_string($data['student_name']);
        $scanFile = $this->conn->real_escape_string($data['scan_file'] ?? '');
        $scannedAnswers = $this->conn->real_escape_string($data['scanned_answers'] ?? '');
        $submittedAnswers = $this->conn->real_escape_string($data['submitted_answers'] ?? '');
        $totalQuestions = (int)$data['total_questions'];
        $correctCount = (int)$data['correct_count'];
        $score = (float)$data['score'];
        $feedback = $this->conn->real_escape_string($data['feedback'] ?? '');
        $status = $this->conn->real_escape_string($data['status'] ?? 'auto_graded');
        $ocrStatus = $this->conn->real_escape_string($data['ocr_status'] ?? 'manual');
        $ocrConfidence = isset($data['ocr_confidence']) && $data['ocr_confidence'] !== null ? (float)$data['ocr_confidence'] : 'NULL';
        $ocrError = $this->conn->real_escape_string($data['ocr_error'] ?? '');

        $sql = "INSERT INTO exam_results
                (exam_id, teacher_id, student_name, scan_file, scanned_answers, submitted_answers, total_questions, correct_count, score, feedback, status, ocr_status, ocr_confidence, ocr_error)
                VALUES
                ($examId, $teacherId, '$studentName', '$scanFile', '$scannedAnswers', '$submittedAnswers', $totalQuestions, $correctCount, $score, '$feedback', '$status', '$ocrStatus', $ocrConfidence, '$ocrError')";

        if (!$this->conn->query($sql)) {
            return false;
        }

        return $this->conn->insert_id;
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $studentName = $this->conn->real_escape_string($data['student_name']);
        $feedback = $this->conn->real_escape_string($data['feedback']);
        $score = (float)$data['score'];
        $status = $this->conn->real_escape_string($data['status']);

        $sql = "UPDATE exam_results SET
                student_name = '$studentName',
                feedback = '$feedback',
                score = $score,
                status = '$status'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function updateGrading($id, $data)
    {
        $id = (int)$id;
        $scannedAnswers = $this->conn->real_escape_string($data['scanned_answers'] ?? '');
        $submittedAnswers = $this->conn->real_escape_string($data['submitted_answers'] ?? '');
        $totalQuestions = (int)$data['total_questions'];
        $correctCount = (int)$data['correct_count'];
        $score = (float)$data['score'];
        $status = $this->conn->real_escape_string($data['status'] ?? 'reviewed');
        $ocrStatus = $this->conn->real_escape_string($data['ocr_status'] ?? 'completed');
        $ocrConfidence = isset($data['ocr_confidence']) && $data['ocr_confidence'] !== null ? (float)$data['ocr_confidence'] : 'NULL';
        $ocrError = $this->conn->real_escape_string($data['ocr_error'] ?? '');

        $sql = "UPDATE exam_results SET
                scanned_answers = '$scannedAnswers',
                submitted_answers = '$submittedAnswers',
                total_questions = $totalQuestions,
                correct_count = $correctCount,
                score = $score,
                status = '$status',
                ocr_status = '$ocrStatus',
                ocr_confidence = $ocrConfidence,
                ocr_error = '$ocrError'
                WHERE id = $id";

        return $this->conn->query($sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $this->conn->query("DELETE FROM exam_result_details WHERE result_id = $id");
        return $this->conn->query("DELETE FROM exam_results WHERE id = $id");
    }
}
