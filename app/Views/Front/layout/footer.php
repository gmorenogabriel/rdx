<!-- Inicio Footer -->
<div class="footer">
	<div class="content has-text-centered">
		<p>
			<strong>Bulma</strong> by <a href="https://jgthms.com">Jeremy Thomas</a>. The source code is licensed
			<a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
			is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
			<?php echo "</br> "; ?>
			<div class="environment">
				Displayed at <?= esc(date('H:i:sa')) ?> &mdash;
				PHP: <?= esc(PHP_VERSION) ?>  &mdash;
				CodeIgniter: <?= Codeigniter\CodeIgniter::CI_VERSION ?> --
				Environment: <?= ENVIRONMENT ?>
				<!-- < ? = anchor($locale, lang('category.title'))?> -->
			</div>
		</p>
	</div>
</div>
<!-- Fin Footer -->
