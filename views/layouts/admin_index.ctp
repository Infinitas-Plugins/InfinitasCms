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

    echo $this->Form->create( 'Layout', array( 'url' => array( 'controller' => 'layouts', 'action' => 'mass', 'admin' => 'true' ) ) );
        $massActions = $this->Cms->massActionButtons(
            array(
                'add',
                'edit',
                'preview',
                'toggle',
                'copy',
                'export',
                'delete'
            )
        );
        echo $this->Cms->adminIndexHead( $this, $filterOptions, $massActions );
?>
<div class="table">
    <table class ="listing" cellpadding="0" cellspacing="0">
        <?php
            echo $this->Cms->adminTableHeader(
                array(
                    $this->Form->checkbox( 'all' ) => array(
                        'class' => 'first',
                        'style' => 'width:25px;'
                    ),
                    $this->Paginator->sort( 'name' ),
                    $this->Paginator->sort( 'Contents', 'content_count' ) => array(
                        'style' => 'width:100px;'
                    ),
                    $this->Paginator->sort( 'modified' ) => array(
                        'style' => 'width:100px;'
                    ),
                    __( 'Status', true ) => array(
                        'style' => 'width:100px;'
                    )
                )
            );

            $i = 0;
            foreach ( $layouts as $layout )
            {
                ?>
                	<tr class="<?php echo $this->Cms->rowClass(); ?>">
                        <td><?php echo $this->Form->checkbox( $layout['Layout']['id'] ); ?>&nbsp;</td>
                		<td>
                			<?php
                    			echo $this->Html->link(
                    			    $layout['Layout']['name'],
                    			    array(
                        			    'action' => 'edit',
                        			    $layout['Layout']['id']
                        			)
                        		);
                        	?>
                		</td>
                		<td>
                			<?php echo $layout['Layout']['content_count']; ?>
                		</td>
                		<td>
                			<?php echo $this->Time->niceShort($layout['Layout']['modified']); ?>
                		</td>
                		<td class="status">
                			<?php
                			    echo $this->Infinitas->status( $layout['Layout']['active'] ),
                    			    $this->Infinitas->locked( $layout, 'Layout' );
                			?>
                		</td>
                	</tr>
                <?php
            }
        ?>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element( 'admin/pagination/navigation' ); ?>