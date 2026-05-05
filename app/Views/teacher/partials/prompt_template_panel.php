<?php
$promptTemplates = $promptTemplates ?? [];
$promptTemplateCategoryLabel = $promptTemplateCategoryLabel ?? 'Prompt';
$promptPanelId = $promptPanelId ?? ('prompt-panel-' . uniqid());
$promptImportTargets = $promptImportTargets ?? [];
$promptTemplateVariables = $promptTemplateVariables ?? [];
?>

<div class="prompt-template-panel mb-4" id="<?= htmlspecialchars($promptPanelId); ?>">
    <div class="mb-3">
        <div>
            <h6 class="mb-1">Import prompt template tu staff cho <?= htmlspecialchars($promptTemplateCategoryLabel); ?></h6>
            <p class="text-secondary mb-0">Prompt dang active se hien o day. Teacher co the xem noi dung va chen nhanh vao dung o nhap lieu cua module hien tai.</p>
        </div>
    </div>

    <?php if (!empty($promptTemplates)): ?>
        <div class="row g-3 align-items-start">
            <div class="col-lg-5">
                <label class="form-label fw-semibold">Chon prompt template</label>
                <select class="form-select rounded-4 prompt-template-select">
                    <option value="">-- Chon prompt staff --</option>
                    <?php foreach ($promptTemplates as $prompt): ?>
                        <option
                            value="<?= (int) $prompt['id']; ?>"
                            data-title="<?= htmlspecialchars($prompt['title'], ENT_QUOTES, 'UTF-8'); ?>"
                            data-description="<?= htmlspecialchars($prompt['description'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            data-content="<?= htmlspecialchars($prompt['prompt_content'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            data-rendered-content="<?= htmlspecialchars($prompt['rendered_content'] ?? ($prompt['prompt_content'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                            data-staff="<?= htmlspecialchars($prompt['staff_name'] ?? 'Staff', ENT_QUOTES, 'UTF-8'); ?>"
                        >
                            <?= htmlspecialchars($prompt['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-lg-7">
                <div class="prompt-template-preview">
                    <div class="prompt-template-meta mb-2">
                        <span class="prompt-template-badge">Prompt template</span>
                        <span class="small text-secondary prompt-template-staff">Chua chon prompt</span>
                    </div>
                    <div class="fw-semibold prompt-template-title">Hay chon mot prompt mau</div>
                    <p class="text-secondary mt-2 mb-2 prompt-template-description">Mo ta ngan cua prompt se hien o day de teacher nam muc dich su dung.</p>
                    <textarea class="form-control rounded-4 prompt-template-content" rows="7" readonly placeholder="Noi dung prompt staff se hien tai day..."></textarea>
                    <?php if (!empty($promptImportTargets)): ?>
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            <?php foreach ($promptImportTargets as $target): ?>
                                <button
                                    type="button"
                                    class="btn btn-outline-primary rounded-pill px-3 prompt-import-btn"
                                    data-target="<?= htmlspecialchars($target['selector']); ?>"
                                >
                                    <i class="bi bi-box-arrow-in-down-right me-2"></i><?= htmlspecialchars($target['label']); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-light border rounded-4 mb-0">
            Hien chua co prompt template nao o trang thai active cho module nay.
        </div>
    <?php endif; ?>
</div>

<?php if (!empty($promptTemplates)): ?>
<script>
(() => {
    const panel = document.getElementById('<?= addslashes($promptPanelId); ?>');
    if (!panel) return;

    const select = panel.querySelector('.prompt-template-select');
    const title = panel.querySelector('.prompt-template-title');
    const description = panel.querySelector('.prompt-template-description');
    const content = panel.querySelector('.prompt-template-content');
    const staff = panel.querySelector('.prompt-template-staff');
    const importButtons = panel.querySelectorAll('.prompt-import-btn');

    const render = () => {
        const option = select.options[select.selectedIndex];
        if (!option || !option.value) {
            title.textContent = 'Hay chon mot prompt mau';
            description.textContent = 'Mo ta ngan cua prompt se hien o day de teacher nam muc dich su dung.';
            content.value = '';
            staff.textContent = 'Chua chon prompt';
            return;
        }

        title.textContent = option.dataset.title || '';
        description.textContent = option.dataset.description || 'Prompt nay chua co mo ta.';
        content.value = option.dataset.renderedContent || option.dataset.content || '';
        staff.textContent = 'Tao boi: ' + (option.dataset.staff || 'Staff');
    };

    importButtons.forEach((button) => {
        button.addEventListener('click', () => {
            if (!content.value.trim()) return;
            const selector = button.dataset.target;
            const target = document.querySelector(selector);
            if (!target) return;

            const imported = content.value.trim();
            target.value = target.value.trim()
                ? target.value.replace(/\s*$/, '\n\n') + imported
                : imported;
            target.dispatchEvent(new Event('input', { bubbles: true }));
            target.focus();
        });
    });

    if (select.options.length > 1 && !select.value) {
        select.selectedIndex = 1;
    }

    select.addEventListener('change', render);
    render();
})();
</script>
<?php endif; ?>
