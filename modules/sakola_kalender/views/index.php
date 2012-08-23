<section class="title">
    <h4><?php echo lang('kalender:events_calendar'); ?></h4>
</section>

<section class="item">
    
    <!-- <p>calendar is here</p> -->
    <p>
        <?php echo $calendar;?>
    </p>

    <?php if ($events['total'] > 0 ): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><?php echo lang('kalender:event'); ?></th>
                    <th><?php echo lang('kalender:description'); ?></th>
                    <th><?php echo lang('kalender:date'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($events['entries'] as $event ): ?>
                <tr>
                    <td><?php echo $event['event']; ?></td>
                    <td><?php echo $event['description']; ?></td>
                    <td><?php echo date_format(new DateTime('@'.$event['date']), 'd/m/Y h:m'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    <?php else: ?>
        <div class="no_data"><?php echo lang('kalender:no_events'); ?></div>
    <?php endif;?>
    
</section>