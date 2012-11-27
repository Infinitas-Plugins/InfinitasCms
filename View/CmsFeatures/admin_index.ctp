<?php
    /**
     * Comment Template.
     *
     * @todo -c Implement .this needs to be sorted out.
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://infinitas-cms.org
     * @package       sort
     * @subpackage    sort.comments
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     * @since         0.5a
     */

     echo $this->Form->create('CmsFeature', array('action' => 'mass'));
		echo $this->Infinitas->adminIndexHead(null, array(
			'add',
			'delete'
		));
?>
<table class="listing">
	<?php
		echo $this->Infinitas->adminTableHeader(array(
			$this->Form->checkbox('all') => array(
				'class' => 'first',
			),
			$this->Paginator->sort('CmsContent.title', __d('contents', 'Content Item')),
			$this->Paginator->sort('GlobalCategory.title', __d('contents', 'Category')) => array(
				'style' => 'width:100px;'
			),
			$this->Paginator->sort('created') => array(
				'style' => 'width:100px;'
			),
			$this->Paginator->sort('ordering') => array(
				'style' => 'width:50px;'
			),
			__d('cms', 'Status') => array(
				'style' => 'width:50px;'
			)
		));

		foreach ($features as $feature) { ?>
			<tr>
				<td><?php echo $this->Infinitas->massActionCheckBox($feature); ?>&nbsp;</td>
				<td><?php echo $this->Infinitas->adminQuickLink($feature['CmsContent']); ?>&nbsp;</td>
				<td>
					<?php
						echo $this->Html->adminQuickLink($feature['GlobalCategory'], array(
							'plugin' => 'contents',
							'controller' => 'global_categories',
							'action' => 'edit'
						));
					?>&nbsp;
				</td>
				<td><?php echo $this->Infinitas->date($feature['Feature']['created']); ?></td>
				<td><?php echo $this->Infinitas->ordering($feature['Feature']['id'], $feature['Feature']['ordering']); ?>&nbsp;</td>
				<td><?php echo $this->Infinitas->status($feature['CmsContent']['active']); ?>&nbsp;</td>
			</tr> <?php
		}
	?>
</table>
<?php
	echo $this->Form->end();
	echo $this->element('pagination/admin/navigation');