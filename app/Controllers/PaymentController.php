<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

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
        $paymentMethods = $this->paymentMethods();

        if (!isset($paymentMethods[$method])) {
            Session::flash('error', 'Vui lòng chọn phương thức thanh toán hợp lệ.');
            $this->redirect('/thanh-toan?plan=professional');
        }

        Session::flash('success', 'Thanh toán gói Chuyên nghiệp thành công qua ' . $paymentMethods[$method]['name'] . '. Hãy đăng nhập để tiếp tục sử dụng PlanbookAI.');
        $this->redirect('/login');
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
