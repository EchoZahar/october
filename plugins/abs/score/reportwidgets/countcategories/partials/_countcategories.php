<div class="report-widget">
    <h3><?= e($this->property('title')) ?></h3>

    <?php if (!isset($error)): ?>
        <p class="text-primary">категории найдено: <strong class="text-danger"><?= $catCount ?></strong>.</p>
        <p class="text-primary">товаров найдено: <strong class="text-danger"><?= $prodCount ?></strong></p>
    <?php else: ?>
        <p class="flash-message static warning"><?= e($error) ?></p>
    <?php endif ?>
</div>
