<?php
	$checkSegment = $this->uri->segment(4);
	$areaUrl = SITE_AREA . '/inventory/gr_inventory';
?>
<div class="float-sm-right">
    <a href="<?php echo site_url($areaUrl); ?>" id='list' class="btn btn-flat btn-<?php echo $checkSegment == '' ? 'primary' : 'default'; ?>">
        <?php echo lang('gr_inventory_list'); ?>
    </a>
    <?php if ($this->auth->has_permission('Gr_inventory.Inventory.Create')): ?>
    <a href="<?php echo site_url($areaUrl . '/create'); ?>" id='create_new' class="btn btn-flat btn-<?php echo $checkSegment == 'create' ? 'primary' : 'default'; ?>">
        <?php echo lang('gr_inventory_new'); ?>
    </a>
    <?php endif;?>
</div>
