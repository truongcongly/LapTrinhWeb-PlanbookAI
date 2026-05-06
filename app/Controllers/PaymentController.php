<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

class PaymentController extends Controller
{
    private const PROFESSIONAL_PLAN = [
        'key' => 'professional',
        'name' => 'Chuyên nghiệp',
        'price' => 199000,
        'cycle' => 'tháng',
    ];

    public function checkout()
    {
        $plan = $_GET['plan'] ?? self::PROFESSIONAL_PLAN['key'];

        if ($plan !== self::PROFESSIONAL_PLAN['key']) {
            $this->redirect('/bang-gia');
        }

        $orderCode = 'PBAI' . date('YmdHis');
        $paymentMethods = $this->paymentMethods();
        $selectedMethod = $_GET['method'] ?? 'vnpay';

        if (!isset($paymentMethods[$selectedMethod])) {
            $selectedMethod = 'vnpay';
        }

        $this->view('payment/checkout', [
            'plan' => self::PROFESSIONAL_PLAN,
            'orderCode' => $orderCode,
            'paymentMethods' => $paymentMethods,
            'selectedMethod' => $selectedMethod,
        ]);
    }

    public function complete()
    {
        $method = $_POST['method'] ?? '';
        $plan = $_POST['plan'] ?? self::PROFESSIONAL_PLAN['key'];
        $paymentMethods = $this->paymentMethods();

        if (!isset($paymentMethods[$method])) {
            Session::flash('error', 'Vui lòng chọn phương thức thanh toán hợp lệ.');
            $this->redirect('/thanh-toan?plan=professional');
        }

        if ($plan !== self::PROFESSIONAL_PLAN['key']) {
            Session::flash('error', 'Gói dịch vụ không hợp lệ.');
            $this->redirect('/bang-gia');
        }

        if (!Auth::check()) {
            Session::flash('success', 'Thanh toán gói Chuyên nghiệp thành công qua ' . $paymentMethods[$method]['name'] . '. Vui lòng đăng nhập để tiếp tục.');
            $this->redirect('/login');
        }

        $currentUser = Auth::user();
        $userModel = new User();

        if (!$userModel->updateServicePlan((int)($currentUser['id'] ?? 0), self::PROFESSIONAL_PLAN['key'])) {
            Session::flash('error', 'Thanh toán thành công nhưng chưa cập nhật được gói dịch vụ. Vui lòng liên hệ admin.');
            $this->redirect('/bang-gia');
        }

        $updatedUser = $userModel->findById((int)$currentUser['id']);
        if ($updatedUser) {
            Auth::login($updatedUser);
        }

        Session::flash('success', 'Thanh toán gói Chuyên nghiệp thành công qua ' . $paymentMethods[$method]['name'] . '. Gói dịch vụ của bạn đã được cập nhật.');

        if (($updatedUser['role'] ?? $currentUser['role'] ?? '') === 'teacher') {
            $this->redirect('/teacher/dashboard');
        }

        $this->redirect('/bang-gia');
    }

    public function gateway(string $method)
    {
        $paymentMethods = $this->paymentMethods();

        if (!isset($paymentMethods[$method])) {
            $this->redirect('/thanh-toan?plan=professional');
        }

        $this->view('payment/gateway', [
            'plan' => self::PROFESSIONAL_PLAN,
            'methodKey' => $method,
            'method' => $paymentMethods[$method],
            'orderCode' => $_GET['order'] ?? ('PBAI' . date('YmdHis')),
        ]);
    }

    private function paymentMethods(): array
    {
        return [
            'vnpay' => [
                'name' => 'VNPay',
                'icon' => 'bi-credit-card-2-front-fill',
                'description' => 'Thanh toán qua cổng VNPay bằng thẻ ATM, Visa, MasterCard hoặc QR ngân hàng.',
                'note' => 'Bản demo sẽ xác nhận thành công ngay khi bạn bấm thanh toán.',
            ],
            'momo' => [
                'name' => 'MoMo',
                'icon' => 'bi-wallet2',
                'description' => 'Thanh toán nhanh bằng ví MoMo hoặc quét mã QR trên ứng dụng MoMo.',
                'note' => 'Khi tích hợp thật, hệ thống sẽ chuyển sang trang/ứng dụng MoMo để xác thực.',
            ],
            'bank' => [
                'name' => 'Ngân hàng',
                'icon' => 'bi-bank2',
                'description' => 'Chuyển khoản ngân hàng theo thông tin đơn hàng và nội dung thanh toán.',
                'note' => 'Nội dung chuyển khoản nên bao gồm mã đơn để đối soát tự động.',
            ],
        ];
    }
}
