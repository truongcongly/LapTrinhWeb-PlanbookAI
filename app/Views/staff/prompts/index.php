6. app/Views/staff/prompts/index.php
<?php
 
use App\Core\Auth;
 
$title = 'Prompt Templates - PlanbookAI';
$currentUser = Auth::user();
$pageTitle = 'Prompt Templates';
$pageDesc = 'Quản lý prompt mẫu cho AI workflow';
$role = 'staff';
 
ob_start();
?>
 
<div class="hero-mini-banner mb-4">
   <div>
       <h3>Prompt Templates</h3>
       <p>Tạo và quản lý prompt mẫu cho lesson plan, bài tập, đề thi và phản hồi AI.</p>
   </div>
   <img src="/LapTrinhWeb-PlanbookAI/public/images/staff-workspace.svg" alt="Prompt Templates">
</div>
 
<div class="dashboard-card">
   <div class="card-header-custom">
       <div>
           <h5>Danh sách prompt templates</h5>
           <small class="text-secondary">Tất cả prompt templates của bạn</small>
       </div>
 
       <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/create" class="btn btn-primary rounded-pill px-4">
           <i class="bi bi-plus-circle-fill me-2"></i>Tạo prompt mới
       </a>
   </div>
 
   <div class="table-responsive">
       <table class="table align-middle mb-0">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Tiêu đề</th>
                   <th>Category</th>
                   <th>Trạng thái</th>
                   <th class="text-center">Hành động</th>
               </tr>
           </thead>
           <tbody>
               <?php if (!empty($prompts)): ?>
                   <?php foreach ($prompts as $prompt): ?>
                       <tr>
                           <td>#<?= $prompt['id']; ?></td>
                           <td class="fw-semibold"><?= htmlspecialchars($prompt['title']); ?></td>
                           <td><?= htmlspecialchars($prompt['category']); ?></td>
                           <td>
                               <?php
                               $status = $prompt['status'] ?? 'draft';
                               if ($status === 'active') {
                                   echo '<span class="badge bg-success-subtle text-success">Active</span>';
                               } elseif ($status === 'archived') {
                                   echo '<span class="badge bg-secondary-subtle text-secondary">Archived</span>';
                               } else {
                                   echo '<span class="badge bg-warning-subtle text-warning">Draft</span>';
                               }
                               ?>
                           </td>
                           <td class="text-center">
                               <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/show?id=<?= $prompt['id']; ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">Xem</a>
                               <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/edit?id=<?= $prompt['id']; ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">Sửa</a>
                               <a href="/LapTrinhWeb-PlanbookAI/public/staff/prompts/delete?id=<?= $prompt['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirmDelete()">Xóa</a>
                           </td>
                       </tr>
                   <?php endforeach; ?>
               <?php else: ?>
                   <tr>
                       <td colspan="5" class="text-center py-5">Chưa có prompt template nào.</td>
                   </tr>
               <?php endif; ?>
           </tbody>
       </table>
   </div>
</div>
 
<?php
$content = ob_get_clean();
$tempFile = sys_get_temp_dir() . '/staff_prompts_index.php';
file_put_contents($tempFile, $content);
$contentView = $tempFile;
 
include __DIR__ . '/../../layouts/dashboard_layout.php';
