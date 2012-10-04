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

    echo $this->Form->create('CmsContent', array('action' => 'mass'));
        $massActions = $this->Infinitas->massActionButtons(
            array(
                'add',
                'edit',
                'preview',
                'toggle',
                'copy',
                'move',
                'delete'
            )
        );
	echo $this->Infinitas->adminIndexHead($filterOptions, $massActions);
?>
<div class="table">
    <table class="listing" cellpadding="0" cellspacing="0">
        <?php
            echo $this->Infinitas->adminTableHeader(
                array(
                    $this->Form->checkbox('all') => array(
                        'class' => 'first',
                        'style' => 'width:25px;'
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
                        'style' => 'width:100px;'
                    ),
                    $this->Paginator->sort('ordering') => array(
                        'style' => 'width:50px;'
                    ),
                    __d('cms', 'Status') => array(
                        'style' => 'width:100px;'
                    )
                )
            );

            foreach ($contents as $content) {
				$rowClass = $this->Infinitas->rowClass(); ?>
                	<tr class="parent <?php echo $rowClass; ?>">
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
							?>&nbsp;</td>
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
                		<td style="text-align:center;">
                			<?php echo $content['CmsContent']['views']; ?>&nbsp;
                		</td>
                		<td>
                			<?php echo $this->Infinitas->date($content['CmsContent']['modified']); ?>&nbsp;
                		</td>
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
					<tr class="details <?php echo $rowClass; ?>">
						<td colspan="100">
							<?php
								echo $this->element('Contents.expanded/body', array('data' => $content['CmsContent']));
								echo $this->element('Contents.expanded/seo', array('data' => $content['CmsContent']));
								echo $this->element('Contents.expanded/image', array('data' => $content['CmsContent']));
								echo $this->element('Contents.expanded/views', array('data' => $content['CmsContent'], 'model' => 'Cms.CmsContent'));
								echo $this->element('Cms.expanded/dates', array('data' => $content['CmsContent']));
							?>
						</td>
					</tr>
                <?php
            }
        ?>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element('pagination/admin/navigation'); ?>