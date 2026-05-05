<?php
namespace App\Controllers\Staff;
use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Middleware\RoleMiddleware;
use App\Models\PromptTemplate;

class PromptTemplateController extends Controller
{
    private const ALLOWED_CATEGORIES = ['lesson_plan', 'question_bank'];

    private function authorize()
    {
        RoleMiddleware::handle('staff');
    }

    private function categoryFromPost(): string
    {
        $category = $_POST['category'] ?? 'lesson_plan';

        return in_array($category, self::ALLOWED_CATEGORIES, true) ? $category : 'lesson_plan';
    }

    public function index()
    {
        $this->authorize();

        $staff = Auth::user();
$model = new PromptTemplate();
        $prompts = $model->getAllByStaff($staff['id']);

        $this->view('staff/prompts/index', compact('prompts'));
    }

    public function create()
    {
        $this->authorize();
        $this->view('staff/prompts/create');
    }

    public function store()
    {
        $this->authorize();

        $staff = Auth::user();
        $model = new PromptTemplate();

        $model->create([
            'staff_id' => $staff['id'],
            'title' => $_POST['title'] ?? '',
            'category' => $this->categoryFromPost(),
            'prompt_content' => $_POST['prompt_content'] ?? '',
            'description' => $_POST['description'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        Session::flash('success', 'Tạo prompt template thành công.');
        $this->redirect('/staff/prompts');
    }

    public function show()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new PromptTemplate();
        $prompt = $model->findById($id);

        if (!$prompt) {
            Session::flash('error', 'Không tìm thấy prompt template.');
            $this->redirect('/staff/prompts');
        }

        $this->view('staff/prompts/show', compact('prompt'));
    }

    public function edit()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new PromptTemplate();
        $prompt = $model->findById($id);

        if (!$prompt) {
            Session::flash('error', 'Không tìm thấy prompt template.');
            $this->redirect('/staff/prompts');
        }

        $this->view('staff/prompts/edit', compact('prompt'));
    }

    public function update()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new PromptTemplate();
        $prompt = $model->findById($id);

        if (!$prompt) {
            Session::flash('error', 'Không tìm thấy prompt template.');
            $this->redirect('/staff/prompts');
        }

        $model->update($id, [
            'title' => $_POST['title'] ?? '',
            'category' => $this->categoryFromPost(),
            'prompt_content' => $_POST['prompt_content'] ?? '',
            'description' => $_POST['description'] ?? '',
            'status' => $_POST['status'] ?? 'draft',
        ]);

        Session::flash('success', 'Cập nhật prompt template thành công.');
        $this->redirect('/staff/prompts');
    }
    public function delete()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new PromptTemplate();
        $prompt = $model->findById($id);

        if (!$prompt) {
            Session::flash('error', 'Không tìm thấy prompt template.');
            $this->redirect('/staff/prompts');
        }

        $model->delete($id);
        Session::flash('success', 'Xóa prompt template thành công.');
        $this->redirect('/staff/prompts');

        }

    public function import()
    {
        $this->authorize();

        $id = $_GET['id'] ?? 0;
        $model = new PromptTemplate();
        $prompt = $model->findById($id);

        if (!$prompt) {
            Session::flash('error', 'KhÃ´ng tÃ¬m tháº¥y prompt template.');
            $this->redirect('/staff/prompts');
        }

        $model->importToTeacher($id);
        Session::flash('success', 'Import prompt thanh cong. Teacher da nhan duoc prompt theo dung module tuong ung.');
        $this->redirect('/staff/prompts');
    }
}
