<?php if (validation_errors()): ?>
  <div class='alert alert-danger alert-dismissible fade show'>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class='alert-heading'>
      <?php echo lang('gr_inventory_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
  </div>
<?php endif; ?>

<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><?php echo lang('gr_inventory_area_title'); ?></h3>
      </div>
      <?php echo form_open($this->uri->uri_string(), 'class=""'); ?>
      <div class="card-body">
        <!-- Gudang -->
        <!-- <div class='col-md-12'>
          <?php
          $options = array();
          foreach ($gudang as $g) {
            $options[$g->id] = $g->nama;
          }
          echo form_dropdown_lte(array('name' => 'gudang_id', 'id' => 'gudang', 'class' => 'form-control select2', 'required' => 'required'), $options, set_value('gudang', isset($gr_inventory->gudang_id) ? $gr_inventory->gudang_id : ''), lang('gr_inventory_field_gudang') . lang('bf_form_label_required'));

          ?>
        </div> -->

        <!-- Tanggal -->
        <div class='col-md-12'>
          <div class='form-group<?php echo form_error('tanggal') ? ' error' : ''; ?>'>
            <?php echo form_label(lang('gr_inventory_field_tanggal') . lang('bf_form_label_required'), 'tanggal', array('class' => '')); ?>
            <input id='tanggal' type='text' class='form-control' required='required' name='tanggal' maxlength='30'
              value='<?php echo set_value('tanggal', isset($gr_inventory->tanggal) ? $gr_inventory->tanggal : ''); ?>'
              data-dd-large-default="true" placeholder='Klik untuk mengisi tanggal' />
            <span class='help-inline'><?php echo form_error('tanggal'); ?></span>
          </div>
        </div>

        <!-- Deskripsi -->
        <div class='col-md-12'>
          <div class='form-group<?php echo form_error('deskripsi') ? ' error' : ''; ?>'>
            <?php echo form_label(lang('gr_inventory_field_deskripsi'), 'deskripsi', array('class' => '')); ?>
            <?php echo form_textarea(array('name' => 'deskripsi', 'placeholder' => 'Masukkan deskripsi GR Inventory (opsional)', 'id' => 'deskripsi', 'class' => 'form-control', 'rows' => '5', 'cols' => '80', 'value' => set_value('deskripsi', isset($gr_inventory->deskripsi) ? $gr_inventory->deskripsi : ''))); ?>
            <span class='help-inline'><?php echo form_error('deskripsi'); ?></span>
          </div>
        </div>
      </div>


      <div class="card-body text-sm">
        <div class="row">
          <div class="col-md-12">
            <h4>List Detail GR Inventory</h4>
            <table class="table table-bordered table-hover" id="selected_table">
              <thead>
                <tr>
                  <th width="10%">Gudang</th>
                  <th width="10%">Nama Material</th>
                  <th width="10%">Jumlah Barang</th>
                  <th width="10%">Harga Satuan</th>
                  <th width="10%">Satuan</th>
                  <th width="10%">Job</th>
                  <th width="10%">Tanggal GR</th>
                  <th width="10%">Total Harga</th>
                  <th width="5%">Aksi</th>
                </tr>
              </thead>
              <tbody id="selected_body">
                <tr>
                  <td colspan="10" class="text-center">Belum ada item yang dipilih</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>


      <div class="card-body text-sm">
        <div class="row">
          <div class="col-md-12">
            <h4>Detail GR Inventory</h4>
            <table class="table table-bordered table-hover" id="detail_table">
              <thead>
                <tr>
                  <th width="10%">Pilih</th>
                  <th width="10%">Gudang</th>
                  <th width="10%">Nama Material</th>
                  <th width="10%">Jumlah Barang</th>
                  <th width="10%">Harga Satuan</th>
                  <th width="10%">Satuan</th>
                  <th width="10%">Job</th>
                  <th width="10%">Tanggal GR</th>
                  <th width="10%">Total Harga</th>
                  <th width="5%">Aksi</th>
                </tr>
              </thead>
              <tbody id="detail_body">
                <?php if (!empty($detil)) : ?>
                  <?php foreach ($detil as $row) : ?>
                    <?php if (is_null($row->penerimaan_id)) { ?>
                      <tr class="clickable-row" style="cursor: pointer;" data-id="<?php echo $row->id; ?>"
                        data-jumlah="<?= $row->jumlah_barang ?>" data-deskripsi="<?= $row->deskripsi_barang ?>"
                        data-gudang="<?= $row->gudang_id ?>">
                        <td>
                          <div class="form-check d-flex justify-content-center">
                            <input type="checkbox" name="selected_item[]" value="<?php echo $row->id; ?>"
                              class="form-check-input row-checkbox" style="margin-top: 0;">
                          </div>
                        </td>
                        <td width="10%"><?= $row->nama_gudang ?></td>
                        <td width="10%"><?php echo $row->material_nama; ?></td>
                        <td width="10%" class="text-end"><?php echo number_format($row->jumlah_barang, 0, '', '.'); ?></td>
                        <td width="10%" class="text-end">Rp <?php echo number_format($row->harga_satuan, 2, ',', '.'); ?></td>
                        <td width="10%"><?php echo $row->satuan_nama; ?></td>
                        <td width="10%"><?php echo $row->job_id; ?></td>
                        <td width="10%"><?php echo $row->tanggal_gr; ?></td>
                        <td width="10%" class="text-end">Rp
                          <?php echo number_format($row->harga_satuan * $row->jumlah_barang, 2, ',', '.'); ?></td>
                        <td width="5%" class="text-center">
                          <button type="button" class="btn btn-danger btn-sm delete-row">
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  <tr>
                    <td colspan="11" class="text-center">Tidak ada data detail</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>

            <button type="button" id="btn_tambahkan" class="btn btn-primary mb-3">
              <i class="fas fa-plus"></i> Tambahkan Item Terpilih
            </button>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <button type="submit" name="save" class="btn btn-info">Simpan</button>
        <?php echo anchor(SITE_AREA . '/inventory/gr_inventory', lang('gr_inventory_cancel'), 'class="btn btn-warning float-right"'); ?>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>