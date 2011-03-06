<div class="alert" id="alert_<?= $this->id; ?>">
	<?= $this->formatMessage(); ?>
	<a href="#" onclick="return markAlertAsRead(<?= $this->id; ?>);" class="markAsRead">x</a>
</div>