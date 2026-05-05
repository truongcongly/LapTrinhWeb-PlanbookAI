<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Session;
use App\Models\SystemSetting;
use App\Middleware\RoleMiddleware;

class SystemSettingController extends Controller
{
    private function authorize()
    {
        RoleMiddleware::handle('admin');
    }

    public function index()
    {
        $this->authorize();

        $model = new SystemSetting();
        $settings = $model->getAllAssoc();

        $this->view('admin/settings/index', compact('settings'));
    }

    public function update()
    {
        $this->authorize();

        $model = new SystemSetting();

        $fields = ['system_name', 'system_logo_text', 'ai_enabled', 'ocr_enabled', 'workflow_mode'];

        foreach ($fields as $field) {
            $model->updateValue($field, $_POST[$field] ?? '');
        }

        Session::flash('success', 'System settings updated successfully.');
        $this->redirect('/admin/settings');
    }
}
