<?php
	
	/**
		* bs_full.php - - Bootstrap 5.3.1 Pager Template.
		* @var \CodeIgniter\Pager\PagerRenderer $pager
	*/
	$pager->setSurroundCount(2);
?>

<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
	<ul class="pager pagination justify-content-center">
		<?php if ($pager->hasPreviousPage()) : ?>
		<li class="page-item">
			<a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
				<span aria-hidden="true"><?= lang('Pager.first') ?></span>
			</a>
		</li>
		<li class="page-item">
			<a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
				<span aria-hidden="true"><?= lang('Pager.previous') ?></span>
			</a>
		</li>
		<?php endif ?>
		
		<?php foreach ($pager->links() as $link) : ?>
		<li <?= $link['active']  ? 'class="page-item active"' : '' ?>>
			<a class="page-link" href="<?= $link['uri'] ?>">
				<?= $link['title'] ?>
			</a>
		</li>
		<?php endforeach ?>
		
		<?php if ($pager->hasNextPage()) : ?>
		<li class="page-item">
			<a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
				<span aria-hidden="true"><?= lang('Pager.next') ?></span>
			</a>
		</li>
		<li class="page-item">
			<a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
				<span aria-hidden="true"><?= lang('Pager.last') ?></span>
			</a>
		</li>
		<?php endif ?>
	</ul>
	</nav> 	