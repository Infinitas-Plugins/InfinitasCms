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
	 * @copyright	 Copyright (c) 2009 Carl Sutton ( dogmatic69 )
	 * @link		  http://infinitas-cms.org
	 * @package	   sort
	 * @subpackage	sort.comments
	 * @license	   http://www.opensource.org/licenses/mit-license.php The MIT License
	 * @since		 0.5a
	 */

	echo $this->Form->create('CmsContent', array('action' => 'mass'));
	echo $this->Infinitas->adminIndexHead($filterOptions, array(
		'add',
		'edit',
		'preview',
		'toggle',
		'copy',
		'move',
		'delete'
	));
?>
<table class="listing">
	<?php
		echo $this->Infinitas->adminTableHeader(array(
			$this->Form->checkbox('all') => array(
				'class' => 'first'
			),
			$this->Paginator->sort('title' ),
			$this->Paginator->sort('GlobalCategory.title', __d('cms', 'Category')),
			$this->Paginator->sort('Group.name', __d('cms', 'Group')) => array(
				'style' => 'width:100px;'
			),
			$this->Paginator->sort('Layout.name', __d('contents', 'Layout')) => array(
				'style' => 'width:100px;'
			),
			$this->Paginator->sort('views') => array(
				'style' => 'width:35px;'
			),
			$this->Paginator->sort('modified') => array(
				'class' => 'date'
			),
			$this->Paginator->sort('ordering') => array(
				'style' => 'width:50px;'
			),
			__d('cms', 'Status') => array(
				'style' => 'width:100px;'
			)
		));

		foreach ($contents as $content) { ?>
			<tr class="parent">
				<td>
					<?php
						echo '<span class="toggle"><a href="#">+</a></span>',
						$this->Infinitas->massActionCheckBox($content);
					?>&nbsp;
				</td>
				<td>
					<?php
						echo $this->Html->link($content['CmsContent']['title'], array('action' => 'edit', $content['CmsContent']['id']));
						echo $this->Html->adminPreview($content['CmsContent']);
					?>&nbsp;
				</td>
				<td>
					<?php
						echo $this->Html->adminQuickLink(
							$content['GlobalCategory'],
							array(
								'plugin' => 'contents',
								'controller' => 'global_categories'
							)
						);
					?>&nbsp;
				</td>
				<td>
					<?php
						echo isset($content['Group']['name']) && !empty($content['Group']['name'])
							? $content['Group']['name']
							: __d('cms', 'Public');
					?>&nbsp;
				</td>
				<td>
					<?php
						echo $this->Html->adminQuickLink(
							$content['Layout'],
							array(
								'plugin' => 'contents',
								'controller' => 'global_layouts'
							),
							'GlobalLayout'
						);
					?>&nbsp;
				</td>
				<td>
					<?php echo $this->Design->count($content['CmsContent']['views']); ?>&nbsp;
				</td>
				<td><?php echo $this->Infinitas->date($content['CmsContent']['modified']); ?></td>
				<td class="status">
					<?php echo $this->Infinitas->ordering($content['CmsContent']['id'], $content['CmsContent']['ordering'], 'Cms.CmsContent'); ?>&nbsp;
				</td>
				<td class="status">
					<?php
						echo $this->Cms->homePageItem($content),
							$this->Cms->featuredItem($content),
							$this->Infinitas->status($content['CmsContent']['active'], $content['CmsContent']['id']),
							$this->Locked->display($content);
					?>&nbsp;
				</td>
			</tr>
			<tr class="details">
				<td colspan="100">
					<?php
						echo $this->element('Contents.expanded/body', array('data' => $content['CmsContent']));
						echo $this->element('Contents.expanded/seo', array('data' => $content['CmsContent']));
						echo $this->element('Contents.expanded/image', array('data' => $content['CmsContent']));
						echo $this->element('Contents.expanded/views', array('data' => $content['CmsContent'], 'model' => 'Cms.CmsContent'));
						echo $this->element('Cms.expanded/dates', array('data' => $content['CmsContent']));
					?>
				</td>
			</tr> <?php
		}
	?>
</table>
<?php
	echo $this->Form->end();
	echo $this->element('pagination/admin/navigation');