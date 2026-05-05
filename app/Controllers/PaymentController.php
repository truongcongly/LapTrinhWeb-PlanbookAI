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
        'name' => 'Chuyen nghiep',
        'price' => 199000,
        'cycle' => 'thang',
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
            Session::flash('error', 'Vui long chon phuong thuc thanh toan hop le.');
            $this->redirect('/thanh-toan?plan=professional');
        }

        if ($plan !== self::PROFESSIONAL_PLAN['key']) {
            Session::flash('error', 'Goi dich vu khong hop le.');
            $this->redirect('/bang-gia');
        }

        if (!Auth::check()) {
            Session::flash('success', 'Thanh toan goi Chuyen nghiep thanh cong qua ' . $paymentMethods[$method]['name'] . '. Vui long dang nhap de tiep tuc.');
            $this->redirect('/login');
        }

        $currentUser = Auth::user();
        $userModel = new User();

        if (!$userModel->updateServicePlan((int)($currentUser['id'] ?? 0), self::PROFESSIONAL_PLAN['key'])) {
            Session::flash('error', 'Thanh toan thanh cong nhung chua cap nhat duoc goi dich vu. Vui long lien he admin.');
            $this->redirect('/bang-gia');
        }

        $updatedUser = $userModel->findById((int)$currentUser['id']);
        if ($updatedUser) {
            Auth::login($updatedUser);
        }

        Session::flash('success', 'Thanh toan goi Chuyen nghiep thanh cong qua ' . $paymentMethods[$method]['name'] . '. Goi dich vu cua ban da duoc cap nhat.');

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
                'description' => 'Thanh toan qua cong VNPay bang the ATM, Visa, MasterCard hoac QR ngan hang.',
                'note' => 'Ban demo se xac nhan thanh cong ngay khi ban bam thanh toan.',
            ],
            'momo' => [
                'name' => 'MoMo',
                'icon' => 'bi-wallet2',
                'description' => 'Thanh toan nhanh bang vi MoMo hoac quet ma QR tren ung dung MoMo.',
                'note' => 'Khi tich hop that, he thong se chuyen sang trang/ung dung MoMo de xac thuc.',
            ],
            'bank' => [
                'name' => 'Ngan hang',
                'icon' => 'bi-bank2',
                'description' => 'Chuyen khoan ngan hang theo thong tin don hang va noi dung thanh toan.',
                'note' => 'Noi dung chuyen khoan nen bao gom ma don de doi soat tu dong.',
            ],
        ];
    }
}
