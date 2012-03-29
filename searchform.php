<form role="search" method="get" id="searchform" action="<? esc_url( home_url('/')) ?>" name="searchform">
	<div>
		<!-- <label class="screen-reader-text" for="s"><?= __('Search for:') ?></label> -->
		<input type="submit" id="searchsubmit" value="<?= __('Search') ?>">
		<input type="text" value="<? get_search_query() ?>" placeholder="----------------------------------------" name="s" id="s">
		
	</div>
</form>