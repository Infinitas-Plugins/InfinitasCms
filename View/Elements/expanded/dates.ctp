<?php
	$title = empty($title) ? __d('cms', 'Dates') : $title;
?>
<div class="image">
	<?php echo sprintf('<span>%s</span>', $title); ?>
	<table>
		<tr>
			<td><?php echo __d('cms', 'Created'); ?>&nbsp;</td>
			<td><?php echo CakeTime::niceShort($data['created']); ?>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo __d('cms', 'Modified'); ?>&nbsp;</td>
			<td><?php echo CakeTime::niceShort($data['modified']); ?>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo __d('cms', 'Published'); ?>&nbsp;</td>
			<td><?php echo CakeTime::niceShort($data['start'] ? $data['start'] : $data['created']); ?>&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo __d('cms', 'Expires'); ?>&nbsp;</td>
			<td><?php echo $data['end'] ? CakeTime::niceShort($data['end']) : '-'; ?>&nbsp;</td>
		</tr>
	</table>
</div>