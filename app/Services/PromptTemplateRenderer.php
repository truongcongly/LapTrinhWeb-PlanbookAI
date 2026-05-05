<?php

namespace App\Services;

class PromptTemplateRenderer
{
    public static function render(string $template, array $variables): string
    {
        $replacements = [];

        foreach ($variables as $key => $value) {
            $replacements['{' . $key . '}'] = (string)$value;
        }

        return strtr($template, $replacements);
    }

    public static function enrichTemplates(array $templates, array $variables): array
    {
        foreach ($templates as &$template) {
            $template['rendered_content'] = self::render($template['prompt_content'] ?? '', $variables);
        }

        return $templates;
    }

    public static function buildResultVariables(array $result, array $details = []): array
    {
        $totalQuestions = (int)($result['total_questions'] ?? 0);
        $correctCount = (int)($result['correct_count'] ?? 0);
        $wrongCount = max(0, $totalQuestions - $correctCount);
        $score = (float)($result['score'] ?? 0);

        return [
            'student_name' => $result['student_name'] ?? '',
            'exam_title' => $result['exam_title'] ?? '',
            'subject' => $result['subject'] ?? '',
            'grade_level' => $result['grade_level'] ?? '',
            'topic' => $result['exam_title'] ?? ($result['subject'] ?? ''),
            'student_work' => self::formatStudentWork($result, $details),
            'score' => number_format($score, 2),
            'total_questions' => $totalQuestions,
            'correct_count' => $correctCount,
            'wrong_count' => $wrongCount,
            'scanned_answers' => $result['scanned_answers'] ?? '',
            'submitted_answers' => $result['submitted_answers'] ?? '',
            'status' => $result['status'] ?? '',
        ];
    }

    public static function generateFeedback(array $result, array $details = []): string
    {
        $variables = self::buildResultVariables($result, $details);
        $score = (float)($result['score'] ?? 0);
        $correctCount = (int)$variables['correct_count'];
        $totalQuestions = (int)$variables['total_questions'];
        $wrongNumbers = [];
        $blankNumbers = [];

        foreach ($details as $detail) {
            if (empty($detail['student_answer'])) {
                $blankNumbers[] = '#' . (int)$detail['question_number'];
            } elseif ((int)($detail['is_correct'] ?? 0) !== 1) {
                $wrongNumbers[] = '#' . (int)$detail['question_number'];
            }
        }

        if ($score >= 8) {
            $level = 'Ket qua tot, em nam chac phan lon noi dung bai kiem tra.';
            $next = 'Hay tiep tuc luyen cac cau van dung cao de giu do on dinh.';
        } elseif ($score >= 6.5) {
            $level = 'Ket qua kha, em da hieu nhieu kien thuc trong bai.';
            $next = 'Nen xem lai cac cau sai va ghi chu ly do chon dap an dung.';
        } elseif ($score >= 5) {
            $level = 'Em da dat muc co ban nhung can cung co them kien thuc nen.';
            $next = 'Nen on lai ly thuyet trong chu de va lam lai cac cau da sai.';
        } else {
            $level = 'Bai lam cho thay em can duoc ho tro them de nam chac kien thuc cot loi.';
            $next = 'Hay bat dau bang viec on tung muc kien thuc nho va hoi giao vien khi chua ro.';
        }

        $wrongText = empty($wrongNumbers) ? 'khong co cau sai duoc ghi nhan' : implode(', ', array_slice($wrongNumbers, 0, 8));
        $blankText = empty($blankNumbers) ? 'khong co cau bo trong' : implode(', ', array_slice($blankNumbers, 0, 8));

        return trim(
            "Nhan xet cho {$variables['student_name']}:\n" .
            "- Diem: {$variables['score']}/10 ({$correctCount}/{$totalQuestions} cau dung).\n" .
            "- Diem manh: {$level}\n" .
            "- Can cai thien: xem lai {$wrongText}; {$blankText}.\n" .
            "- Goi y tiep theo: {$next}"
        );
    }

    private static function formatStudentWork(array $result, array $details): string
    {
        $lines = [];
        $lines[] = 'Bai: ' . ($result['exam_title'] ?? '');
        $lines[] = 'Dap an nhan dien: ' . ($result['scanned_answers'] ?? '');
        $lines[] = 'Diem: ' . ($result['score'] ?? '0') . '/10';

        foreach ($details as $detail) {
            $status = (int)($detail['is_correct'] ?? 0) === 1 ? 'dung' : 'sai';
            $lines[] = sprintf(
                'Cau %d: HS=%s, Dung=%s, %s',
                (int)$detail['question_number'],
                $detail['student_answer'] ?: '-',
                $detail['correct_answer'] ?: '-',
                $status
            );
        }

        return implode("\n", $lines);
    }
}
