<nav class="pagination is-dark" aria-label="<?= lang('Pager.pageNavigation') ?>">
    <?php if ($pager->hasPreviousPage()) : ?>
        <a class="pagination-previous" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
            <span aria-hidden="true">Anterior</span>
        </a>
    <?php endif ?>

    <?php if ($pager->hasNextPage()) : ?>
        <a class="pagination-next" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
            <span aria-hidden="true">Sig.</span>
        </a>
    <?php endif ?>

    <ul class="pagination-list">
        <?php foreach ($pager->links() as $link): ?>
            <li>
                <a href="<?= $link['uri'] ?>" class="pagination-link <?= $link['active'] ? 'is-current' : ''?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>
    </ul>
</nav>