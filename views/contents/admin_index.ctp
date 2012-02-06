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

    echo $this->Form->create('Content', array('url' => array('controller' => 'contents', 'action' => 'mass', 'admin' => 'true')));
        $massActions = $this->Cms->massActionButtons(
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
            echo $this->Cms->adminTableHeader(
                array(
                    $this->Form->checkbox('all') => array(
                        'class' => 'first',
                        'style' => 'width:25px;'
                    ),
                    $this->Paginator->sort('title' ),
                    $this->Paginator->sort('GlobalCategory', 'GlobalCategory.title'),
                    $this->Paginator->sort('Group', 'Group.name') => array(
                        'style' => 'width:100px;'
                    ),
                    $this->Paginator->sort('Layout', 'Layout.name') => array(
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
                    __('Status', true) => array(
                        'style' => 'width:100px;'
                    )
                )
            );

            foreach ($contents as $content){
                ?>
                	<tr class="<?php echo $this->Cms->rowClass(); ?>">
                        <td><?php echo $this->Infinitas->massActionCheckBox($content); ?>&nbsp;</td>
                		<td>
							<?php
								echo $this->Html->link($content['Content']['title'], array('action' => 'edit', $content['Content']['id']));
								echo $this->Html->adminPreview($content['Content']);
							?>&nbsp;</td>
                		<td>
                			<?php
								echo $this->Html->adminQuickLink(
									$content['GlobalCategory'],
									array(
										'plugin' => 'contents',
										'controller' => 'categories'
									),
									'GlobalCategory'
								);
                        	?>&nbsp;
                		</td>
                		<td>
                			<?php 
								echo isset($content['Group']['name']) && !empty($content['Group']['name'])
									? $content['Group']['name']
									: __('Public', true);
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
                			<?php echo $content['Content']['views']; ?>&nbsp;
                		</td>
                		<td>
                			<?php echo $this->Time->niceShort($content['Content']['modified']); ?>&nbsp;
                		</td>
                		<td class="status">
                			<?php echo $this->Infinitas->ordering($content['Content']['id'], $content['Content']['ordering'], 'Cms.Content'); ?>&nbsp;
                		</td>
                		<td class="status">
                			<?php
                			    echo $this->Cms->homePageItem($content),
                        			$this->Infinitas->featured($content),
                			        $this->Infinitas->status($content['Content']['active'], $content['Content']['id']),
                    			    $this->Locked->display($content);
                			?>&nbsp;
                		</td>
                	</tr>
                <?php
            }
        ?>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element('pagination/admin/navigation'); ?>