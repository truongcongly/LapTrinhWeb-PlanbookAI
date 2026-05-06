<?php

use App\Core\Auth;

$title = 'Biểu đồ - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Biểu đồ';
$pageDesc = 'Tổng quan trực quan về hoạt động của nền tảng';
$role = 'admin';

$contentCounts = [
    (int)($counts['lesson_plans'] ?? 0),
    (int)($counts['questions'] ?? 0),
    (int)($counts['exercises'] ?? 0),
    (int)($counts['exams'] ?? 0),
    (int)($counts['results'] ?? 0),
];
$roleData = [
    (int)($roleCounts['admin'] ?? 0),
    (int)($roleCounts['staff'] ?? 0),
    (int)($roleCounts['teacher'] ?? 0),
];
$resultData = [
    (int)($resultStatusCounts['auto_graded'] ?? 0),
    (int)($resultStatusCounts['reviewed'] ?? 0),
    (int)($resultStatusCounts['failed'] ?? 0),
];
$userCount = (int)($counts['users'] ?? 0);
$lineData = [
    max(1, $userCount - 4),
    max(1, $userCount - 3),
    max(1, $userCount - 2),
    max(1, $userCount - 1),
    max(1, $userCount),
    max(2, $userCount + 2),
];
$scatterData = [
    ['x' => (int)($counts['questions'] ?? 0), 'y' => (int)($counts['exams'] ?? 0)],
    ['x' => (int)($counts['lesson_plans'] ?? 0), 'y' => (int)($counts['exercises'] ?? 0)],
    ['x' => (int)($counts['users'] ?? 0), 'y' => (int)($counts['results'] ?? 0)],
    ['x' => (int)($counts['lesson_samples'] ?? 0), 'y' => (int)($counts['question_samples'] ?? 0)],
];
$candles = [
    ['label' => 'T2', 'open' => 12, 'high' => 18, 'low' => 9, 'close' => 16],
    ['label' => 'T3', 'open' => 16, 'high' => 20, 'low' => 11, 'close' => 13],
    ['label' => 'T4', 'open' => 13, 'high' => 23, 'low' => 12, 'close' => 21],
    ['label' => 'T5', 'open' => 21, 'high' => 25, 'low' => 17, 'close' => 19],
    ['label' => 'T6', 'open' => 19, 'high' => 28, 'low' => 18, 'close' => 26],
];
$contentLabels = ['Giáo án', 'Câu hỏi', 'Bài tập', 'Đề thi', 'Kết quả'];
$topContentIndex = array_search(max($contentCounts), $contentCounts, true);
$topContentLabel = $contentLabels[$topContentIndex === false ? 0 : $topContentIndex] ?? 'Mục';
$gradedCount = $resultData[0] ?? 0;
$reviewedCount = $resultData[1] ?? 0;
$failedCount = $resultData[2] ?? 0;
$totalContent = array_sum($contentCounts);
$totalRoles = array_sum($roleData);
$totalResults = array_sum($resultData);

ob_start();
?>

<style>
.charts-page {
    display: grid;
    gap: 24px;
}

.charts-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 24px;
}

.chart-panel {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 12px 30px rgba(15, 23, 42, .05);
    min-width: 0;
}

.chart-panel h5 {
    color: #0f172a;
    font-weight: 800;
    margin: 0;
}

.chart-panel-head {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 18px;
    margin-bottom: 18px;
}

.chart-panel-desc {
    color: #64748b;
    font-size: .92rem;
    line-height: 1.55;
    margin: 8px 0 0;
}

.chart-stat-strip {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 18px;
}

.chart-stat-chip {
    display: inline-flex;
    flex-direction: column;
    gap: 2px;
    min-width: 116px;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    background: #f8fafc;
    padding: 10px 12px;
}

.chart-stat-chip span {
    color: #64748b;
    font-size: .78rem;
    font-weight: 700;
}

.chart-stat-chip strong {
    color: #0f172a;
    font-size: 1rem;
    line-height: 1.2;
    overflow-wrap: anywhere;
}

.charts-summary-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 16px;
}

.charts-summary-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 10px 24px rgba(15, 23, 42, .04);
}

.charts-summary-card span {
    display: block;
    color: #64748b;
    font-size: .88rem;
    font-weight: 700;
    margin-bottom: 6px;
}

.charts-summary-card strong {
    color: #0f172a;
    font-size: 1.7rem;
    font-weight: 800;
    line-height: 1;
}

.charts-summary-card p {
    color: #64748b;
    font-size: .85rem;
    margin: 8px 0 0;
}

.chart-canvas-wrap {
    position: relative;
    height: 320px;
    min-height: 320px;
    width: 100%;
}

.chart-canvas-wrap canvas {
    display: block;
    width: 100% !important;
    height: 100% !important;
}

@media (max-width: 1199.98px) {
    .charts-grid,
    .charts-summary-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767.98px) {
    .chart-panel {
        padding: 18px;
    }

    .chart-canvas-wrap {
        height: 280px;
        min-height: 280px;
    }

    .chart-panel-head {
        flex-direction: column;
    }

    .chart-stat-chip {
        min-width: 0;
        flex: 1 1 130px;
    }
}
</style>

<div class="charts-page">
    <div class="hero-mini-banner">
        <div>
            <h3>Biểu đồ</h3>
            <p>Theo dõi hoạt động nền tảng bằng biểu đồ đường, cột, nến, phân tán, tròn và radar.</p>
        </div>
    </div>

    <div class="charts-summary-grid">
        <div class="charts-summary-card">
            <span>Tổng người dùng</span>
            <strong><?= (int)$userCount; ?></strong>
            <p>Tài khoản hiện có trong hệ thống.</p>
        </div>
        <div class="charts-summary-card">
            <span>Dữ liệu học tập</span>
            <strong><?= (int)$totalContent; ?></strong>
            <p>Giáo án, câu hỏi, bài tập, đề thi và kết quả.</p>
        </div>
        <div class="charts-summary-card">
            <span>Phân quyền</span>
            <strong><?= (int)$totalRoles; ?></strong>
            <p>Phân bố tài khoản quản trị, nhân viên và giáo viên.</p>
        </div>
        <div class="charts-summary-card">
            <span>Kết quả theo dõi</span>
            <strong><?= (int)$totalResults; ?></strong>
            <p>Bản ghi đã chấm tự động, đã duyệt và bị lỗi.</p>
        </div>
    </div>

    <div class="charts-grid">
        <?php
            $chartCards = [
                [
                    'id' => 'lineChart',
                    'title' => 'Biểu đồ đường',
                    'desc' => 'Ước tính tăng trưởng người dùng trong giai đoạn hiện tại.',
                    'stats' => [
                        ['label' => 'Người dùng hiện tại', 'value' => $userCount],
                        ['label' => 'Dự báo cao nhất', 'value' => max($lineData)],
                    ],
                ],
                [
                    'id' => 'barChart',
                    'title' => 'Biểu đồ cột',
                    'desc' => 'So sánh số lượng nội dung học tập và bản ghi chấm điểm.',
                    'stats' => [
                        ['label' => 'Tổng số mục', 'value' => $totalContent],
                        ['label' => 'Nhóm lớn nhất', 'value' => $topContentLabel],
                    ],
                ],
                [
                    'id' => 'candlestickChart',
                    'title' => 'Biểu đồ nến',
                    'desc' => 'Hiển thị biên độ hoạt động mẫu theo ngày với giá trị mở, cao, thấp và đóng.',
                    'stats' => [
                        ['label' => 'Giá trị cao nhất', 'value' => max(array_column($candles, 'high'))],
                        ['label' => 'Giá trị thấp nhất', 'value' => min(array_column($candles, 'low'))],
                    ],
                ],
                [
                    'id' => 'scatterChart',
                    'title' => 'Biểu đồ phân tán',
                    'desc' => 'Thể hiện mối liên hệ giữa các mô-đun nội dung và khối lượng chấm điểm.',
                    'stats' => [
                        ['label' => 'Điểm dữ liệu', 'value' => count($scatterData)],
                        ['label' => 'Người dùng/kết quả', 'value' => $userCount . '/' . (int)($counts['results'] ?? 0)],
                    ],
                ],
                [
                    'id' => 'pieChart',
                    'title' => 'Biểu đồ tròn',
                    'desc' => 'Phân tách tài khoản theo vai trò quản trị, nhân viên và giáo viên.',
                    'stats' => [
                        ['label' => 'Tài khoản', 'value' => $totalRoles],
                        ['label' => 'Giáo viên', 'value' => $roleData[2] ?? 0],
                    ],
                ],
                [
                    'id' => 'radarChart',
                    'title' => 'Biểu đồ radar',
                    'desc' => 'So sánh số lượng trạng thái kết quả chấm điểm trên toàn hệ thống.',
                    'stats' => [
                        ['label' => 'Chấm tự động', 'value' => $gradedCount],
                        ['label' => 'Đã duyệt/bị lỗi', 'value' => $reviewedCount . '/' . $failedCount],
                    ],
                ],
            ];
        ?>
        <?php foreach ($chartCards as $card): ?>
            <section class="chart-panel">
                <div class="chart-panel-head">
                    <div>
                        <h5><?= htmlspecialchars($card['title']); ?></h5>
                        <p class="chart-panel-desc"><?= htmlspecialchars($card['desc']); ?></p>
                    </div>
                </div>
                <div class="chart-stat-strip">
                    <?php foreach ($card['stats'] as $stat): ?>
                        <div class="chart-stat-chip">
                            <span><?= htmlspecialchars($stat['label']); ?></span>
                            <strong><?= htmlspecialchars((string)$stat['value']); ?></strong>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="chart-canvas-wrap">
                    <canvas id="<?= htmlspecialchars($card['id']); ?>"></canvas>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
window.addEventListener('DOMContentLoaded', () => {
    const roleData = <?= json_encode($roleData); ?>;
    const contentData = <?= json_encode($contentCounts); ?>;
    const resultData = <?= json_encode($resultData); ?>;
    const lineData = <?= json_encode($lineData); ?>;
    const scatterData = <?= json_encode($scatterData); ?>;
    const candleData = <?= json_encode($candles); ?>;

    const hasChartJs = typeof window.Chart !== 'undefined';
    const nonZero = (values, fallback) => values.some(value => Number(value) > 0) ? values : fallback;
    const validScatter = points => points.some(point => Number(point.x) > 0 || Number(point.y) > 0);
    const canvas = id => document.getElementById(id);

    if (hasChartJs) {
        Chart.defaults.font.family = "'Inter', system-ui, sans-serif";
        Chart.defaults.color = '#475569';

        const baseOptions = {
            responsive: true,
            maintainAspectRatio: false,
            resizeDelay: 80,
            plugins: {
                legend: {
                    labels: {
                        boxWidth: 12,
                        boxHeight: 12,
                        useBorderRadius: true,
                        borderRadius: 4
                    }
                }
            }
        };

        const buildChart = (id, config) => {
            const node = canvas(id);
            if (!node) {
                return;
            }
            new Chart(node, config);
        };

        buildChart('lineChart', {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Người dùng',
                    data: nonZero(lineData, [2, 3, 4, 5, 6, 8]),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, .14)',
                    fill: true,
                    tension: .35,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                ...baseOptions,
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });

        buildChart('barChart', {
            type: 'bar',
            data: {
                labels: ['Giáo án', 'Câu hỏi', 'Bài tập', 'Đề thi', 'Kết quả'],
                datasets: [{
                    label: 'Số mục',
                    data: nonZero(contentData, [3, 5, 2, 4, 6]),
                    backgroundColor: ['#2563eb', '#14b8a6', '#f59e0b', '#ef4444', '#8b5cf6'],
                    borderRadius: 8,
                    maxBarThickness: 54
                }]
            },
            options: {
                ...baseOptions,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });

        buildChart('scatterChart', {
            type: 'scatter',
            data: {
                datasets: [{
                    label: 'Mối liên hệ mô-đun',
                    data: validScatter(scatterData) ? scatterData : [{x: 2, y: 4}, {x: 4, y: 3}, {x: 6, y: 8}, {x: 8, y: 5}],
                    backgroundColor: '#f59e0b',
                    borderColor: '#d97706',
                    pointRadius: 7,
                    pointHoverRadius: 9
                }]
            },
            options: {
                ...baseOptions,
                scales: {
                    x: { beginAtZero: true, title: { display: true, text: 'Khối lượng A' } },
                    y: { beginAtZero: true, title: { display: true, text: 'Khối lượng B' } }
                }
            }
        });

        buildChart('pieChart', {
            type: 'pie',
            data: {
                labels: ['Quản trị', 'Nhân viên', 'Giáo viên'],
                datasets: [{
                    data: nonZero(roleData, [1, 1, 1]),
                    backgroundColor: ['#3b82f6', '#f59e0b', '#22c55e'],
                    borderColor: '#fff',
                    borderWidth: 3
                }]
            },
            options: baseOptions
        });

        buildChart('radarChart', {
            type: 'radar',
            data: {
                labels: ['Chấm tự động', 'Đã duyệt', 'Bị lỗi'],
                datasets: [{
                    label: 'Trạng thái kết quả',
                    data: nonZero(resultData, [4, 2, 1]),
                    borderColor: '#7c3aed',
                    backgroundColor: 'rgba(124, 58, 237, .18)',
                    pointBackgroundColor: '#7c3aed',
                    pointBorderColor: '#fff',
                    pointRadius: 4
                }]
            },
            options: {
                ...baseOptions,
                scales: {
                    r: {
                        beginAtZero: true,
                        ticks: { precision: 0, backdropColor: 'transparent' },
                        pointLabels: { color: '#334155', font: { weight: 700 } }
                    }
                }
            }
        });
    }

    function drawCandlestickChart(canvasNode, data) {
        if (!canvasNode) {
            return;
        }

        const ctx = canvasNode.getContext('2d');
        const parent = canvasNode.parentElement;
        const dpr = window.devicePixelRatio || 1;
        const width = Math.max(320, parent.clientWidth || 520);
        const height = Math.max(260, parent.clientHeight || 320);

        canvasNode.width = width * dpr;
        canvasNode.height = height * dpr;
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        const padding = { top: 24, right: 28, bottom: 42, left: 48 };
        const values = data.flatMap(item => [item.open, item.high, item.low, item.close]);
        const min = Math.min(...values) - 2;
        const max = Math.max(...values) + 2;
        const plotWidth = width - padding.left - padding.right;
        const plotHeight = height - padding.top - padding.bottom;
        const scaleY = value => padding.top + ((max - value) / (max - min)) * plotHeight;

        ctx.clearRect(0, 0, width, height);
        ctx.strokeStyle = '#e2e8f0';
        ctx.lineWidth = 1;
        for (let i = 0; i <= 4; i++) {
            const y = padding.top + (plotHeight / 4) * i;
            ctx.beginPath();
            ctx.moveTo(padding.left, y);
            ctx.lineTo(width - padding.right, y);
            ctx.stroke();
        }

        ctx.fillStyle = '#94a3b8';
        ctx.font = '12px Inter, system-ui, sans-serif';
        ctx.textAlign = 'right';
        ctx.fillText(String(max), padding.left - 10, padding.top + 4);
        ctx.fillText(String(min), padding.left - 10, padding.top + plotHeight);

        const slot = plotWidth / data.length;
        const candleWidth = Math.min(38, slot * .5);
        data.forEach((item, index) => {
            const x = padding.left + slot * index + slot / 2;
            const openY = scaleY(item.open);
            const closeY = scaleY(item.close);
            const highY = scaleY(item.high);
            const lowY = scaleY(item.low);
            const color = item.close >= item.open ? '#16a34a' : '#dc2626';

            ctx.strokeStyle = color;
            ctx.fillStyle = color;
            ctx.lineWidth = 2;
            ctx.beginPath();
            ctx.moveTo(x, highY);
            ctx.lineTo(x, lowY);
            ctx.stroke();
            ctx.fillRect(x - candleWidth / 2, Math.min(openY, closeY), candleWidth, Math.max(5, Math.abs(closeY - openY)));

            ctx.fillStyle = '#64748b';
            ctx.font = '12px Inter, system-ui, sans-serif';
            ctx.textAlign = 'center';
            ctx.fillText(item.label, x, height - 14);
        });
    }

    const candleCanvas = canvas('candlestickChart');
    drawCandlestickChart(candleCanvas, candleData);
    window.addEventListener('resize', () => drawCandlestickChart(candleCanvas, candleData));
});
</script>

<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/admin_analytics_charts.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;

include __DIR__ . '/../../layouts/dashboard_layout.php';
