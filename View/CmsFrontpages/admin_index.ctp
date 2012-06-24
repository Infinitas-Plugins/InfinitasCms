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

    echo $this->Form->create('CmsFrontpage', array('action' => 'mass'));
        $massActions = $this->Infinitas->massActionButtons(array('add', 'delete'));
		echo $this->Infinitas->adminIndexHead(null, $massActions);
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
                    $this->Paginator->sort('CmsContent.title', __d('contents', 'Content Item')),
                    $this->Paginator->sort('GlobalCategory.title', __d('contents', 'Category')),
                    $this->Paginator->sort('created') => array(
                        'style' => 'width:100px;'
                    ),
                    $this->Paginator->sort('modified') => array(
                        'style' => 'width:100px;'
                    ),
                    $this->Paginator->sort('ordering') => array(
                        'style' => 'width:50px;'
                    ),
                    __d('cms', 'Status') => array(
                        'style' => 'width:50px;'
                    )
                )
            );

            $i = 0;
            foreach ($frontpages as $frontpage) {
                ?>
                	<tr class="<?php echo $this->Infinitas->rowClass(); ?>">
                        <td><?php echo $this->Infinitas->massActionCheckBox($frontpage, array('model' => 'Frontpage')); ?>&nbsp;</td>
                		<td><?php echo $this->Html->link($frontpage['CmsContent']['title'], array('controller' => 'cms_contents', 'action' => 'view', $frontpage['CmsContent']['id'])); ?>&nbsp;</td>
                		<td>
							<?php
								echo $this->Html->adminQuickLink(
									$frontpage['GlobalCategory'],
									array(
										'plugin' => 'contents',
										'controller' => 'global_categories',
										'action' => 'edit'
									)
								);
							?>&nbsp;
                		</td>
                		<td><?php echo $this->Time->niceShort($frontpage['Frontpage']['created']); ?>&nbsp;</td>
                		<td><?php echo $this->Time->niceShort($frontpage['Frontpage']['modified']); ?>&nbsp;</td>
                		<td><?php echo $this->Infinitas->ordering($frontpage['Frontpage']['id'], $frontpage['Frontpage']['ordering']); ?>&nbsp;</td>
                		<td><?php echo $this->Infinitas->status($frontpage['CmsContent']['active']); ?>&nbsp;</td>
                	</tr>
                <?php
            }
        ?>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element('pagination/admin/navigation'); ?>