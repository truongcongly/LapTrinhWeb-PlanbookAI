<h2>Tạo giáo án</h2>

<form method="POST" action="/teacher/lesson-plan/store">
    <label>Chọn framework</label>
    <select name="framework_id">
        <?php foreach($frameworks as $f): ?>
            <option value="<?= $f['id'] ?>">
                <?= $f['title'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Mục tiêu</label>
    <textarea name="objective"></textarea>

    <label>Hoạt động</label>
    <textarea name="activities"></textarea>

    <label>Đánh giá</label>
    <textarea name="assessment"></textarea>

    <label>Trạng thái</label>
    <select name="status">
        <option value="draft">Bản nháp</option>
        <option value="completed">Hoàn chỉnh</option>
    </select>

    <button type="submit">Lưu giáo án</button>
</form>