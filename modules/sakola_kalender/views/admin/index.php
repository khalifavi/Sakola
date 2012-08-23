<section class="title">
    <h4><?php echo lang('kalender:events'); ?></h4>
</section>

<section class="item">
    
    <?php if ($events['total'] > 0 ): ?>
    
        <table>
            <thead>
                <tr>
                    <th><?php echo lang('kalender:event'); ?></th>
                    <th><?php echo lang('kalender:description'); ?></th>
                    <th><?php echo lang('kalender:date'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach($events['entries'] as $event ): ?>
                <tr>
                    <td><?php echo $event['event']; ?></td>
                    <td><?php echo $event['description']; ?></td>
                    <td><?php echo date_format(new DateTime('@'.$event['date']), 'd/m/Y h:m'); ?></td>
                    <td><?php echo anchor('admin/sakola_kalender/edit/' . $event['id'], lang('global:edit'), 'class="btn orange edit"'); ?>
                                            <?php echo anchor('admin/sakola_kalender/delete/' . $event['id'], lang('global:delete'), array('class' => 'confirm btn red delete')); ?>
                                        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php echo $events['pagination']; ?>
        
    <?php else: ?>
        <div class="no_data"><?php echo lang('kalender:no_events'); ?></div>
    <?php endif;?>
    
</section>