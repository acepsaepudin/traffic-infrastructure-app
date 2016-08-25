<div class="col-xs-12">
  <div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Kerusakan </h3>
  <div class="pull-right">
  <?php if($this->session->userdata('status') == 5):?>
    <a href="<?=site_url('kerusakan/add')?>"  class="btn btn-lg btn-success btn-flat">new</a><br>
  <?php endif;?>
  </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="tabel-kategori" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama Prasarana</th>
          <th>Tanggal</th>
          <th>Foto</th>
          <th>Deskripsi</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($kerusakan as $k):?>
        <tr>
          <td><?php echo $k->nama_prasarana; ?></td>
          <td><?php echo $k->tanggal; ?></td>
          <td>
            <img src="<?php echo asset_url('uploads/'.$k->foto)?>" width="200px" height="200px">
          </td>
          <td><?php echo $k->deskripsi; ?></td>
          <td><?=konversi('status_kerusakan', $k->status)?></td>
          <td>
          <!-- pegawai kantor -->
          <?php if($this->session->userdata('status') == 5):?>
            <?php if($k->id_prasarana == ''):?>
              <a href="<?= site_url('kerusakan/edit_prasarana/'.$k->id);?>" class="btn btn-flat btn-info">Masukan ke Prasarana</a>
            <?php else:?>
              <?php if($k->status == 1):?>
              <a href="<?= site_url('kerusakan/edit_kerusakan/'.$k->id.'/'.'2');?>" class="btn btn-flat btn-success">Cek Tim Lapangan</a>
              <?php endif;?>
              <!-- ada kerusakan dan buat estimasi -->
              <?php if($k->status == 4):?>
              <a href="<?= site_url('kerusakan/buat_estimasi/'.$k->id);?>" class="btn btn-flat btn-warning">Buat Estimasi</a>
              <?php endif;?>
              <!-- estimasi diapprove -->
              <?php if($k->status == 6):?>
              <a href="<?= site_url('kerusakan/edit_kerusakan/'.$k->id.'/'.'7');?>" class="btn btn-flat btn-warning">Lakukan Perbaikan</a>
              <?php endif;?>

            <?php endif;?>
          <?php endif;?><!--end if pegawai kantor-->
          <!-- pegawai lapangan -->
          <?php if($this->session->userdata('status') == 4):?>
            <?php if($k->status == 2):?>
              <a href="<?= site_url('kerusakan/upload_laporan_lapangan/'.$k->id.'/'.'3');?>" class="btn btn-flat btn-info">Tidak Ada Kerusakan</a>
              <a href="<?= site_url('kerusakan/upload_laporan_lapangan/'.$k->id.'/'.'4');?>" class="btn btn-flat btn-danger">Ada Kerusakan</a>
            <?php endif;?>
            <!-- perbaikan dilapangan sudah dilakukan,maka update ke 8 -->
            <?php if($k->status == 7):?>
              <a href="<?= site_url('kerusakan/edit_kerusakan/'.$k->id.'/'.'9');?>" class="btn btn-flat btn-info">Siap Diperbaiki</a>
            <?php endif;?>
            <?php if($k->status == 9):?>
              <a href="<?= site_url('kerusakan/edit_kerusakan/'.$k->id.'/'.'8');?>" class="btn btn-flat btn-info">Sudah Diperbaiki</a>
            <?php endif;?>
          <?php endif;?>
          <!-- pegawai lapangan -->
          
          <!-- Kepala Dinas -->
          <?php if($this->session->userdata('status') == 3):?>
            <?php if($k->status == 5):?>
              <a href="<?= site_url('kerusakan/detail_estimasi/'.$k->id);?>" class="btn btn-flat btn-info">Detail Estimasi</a>
            <?php endif;?>

            <?php endif;?>

          <!-- Kepala Dinas -->
            <!-- <button class="btn btn-sm btn-info btn-flat" onclick="EditKerusakan(<?php echo $k->id ?>)">Edit</button> -->
            <!-- <button class="btn btn-sm btn-danger btn-flat" onclick="deleteFunc(<?php echo $k->id ?>)">Delete</button> -->
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nama</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->
<!--modal new kategori -->
<div class="modal fade new-modal-karyawan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Form Pengguna</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
        <?php echo form_open('pengguna/create',array('class' => 'form-horizontal form-new-karyawan')) ?>
          <div class="box-body">
            <div class="form-group has-error form-group-nama">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama-karyawan" placeholder="Nama Pengguna">
                <p class="error-message-nama"></p>
              </div>
            </div>
            <div class="form-group form-group-jk">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" name="jenis_kelamin">
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group has-error form-group-notlp">
              <label for="inputEmail3" class="col-sm-2 control-label">No Tlp</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="notlp" id="notlp" placeholder="No Telepon">
                <p class="error-message-notlp"></p>
              </div>
            </div>

            <div class="form-group has-error form-group-email">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                <p class="error-message-email"></p>
              </div>
            </div>

            <div class="form-group has-error form-group-password">
              <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <p class="error-message-password"></p>
              </div>
            </div>
            <div class="form-group form-group-jabatan">
              <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>
              <div class="col-sm-10">
                <select class="form-control" name="jabatan">
                  <?php foreach($this->config->item('status_pengguna') as $k => $v):?>
                    <option value="<?=$k?>"><?=$v?></option>
                  <?php endforeach?>
                </select>
              </div>
            </div>

            <div class="form-group form-group-alamat">
              <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10"> 
                <textarea class="form-control" row="3" name="alamat"></textarea>
                <p class="error-message-alamat"></p>
              
              </div>
            </div>

          </div><!-- /.box-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Save</button>
          </div><!-- /.box-footer -->
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--modal delete confirm kategori -->
<div class="modal fade delete-modal-karyawan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Konfirmasi Hapus Pengguna</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
          <div class="box-body">
            <p>Yakin akan menghapus Pengguna ini ?</p>
          </div>
      </div>
      <div class="modal-footer">
        <?php echo form_open('pengguna/destroy',array('class' => 'form-horizontal form-delete-karyawan')) ?>
            <input type="hidden" name="karyawan_id" id="karyawan_id">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--modal update kategori -->
<div class="modal fade update-modal-kerusakan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Form Update Data Pengguna</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
        <?php echo form_open('kerusakan/update',array('class' => 'form-horizontal form-update-karyawan')) ?>
          <div class="box-body">
            <div class="form-group form-group-prasarana-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama Prasarana</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="prasarana_edit" id="prasarana-edit" disabled="true">
                <p class="error-message-prasarana-edit"></p>
              </div>
            </div>

            <div class="form-group form-group-pelapor-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Pelapor</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="pelapor_edit" id="pelapor-edit" disabled="true">
                <p class="error-message-deskripsi-edit"></p>
              </div>
            </div>

            <div class="form-group form-group-deskripsi-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Deskripsi</label>
              <div class="col-sm-10">
                <input type="hidden" name="id_edit" id="id_edit">
                <input type="text" class="form-control" name="deskripsi_edit" id="deskripsi-edit" disabled="true">
                <p class="error-message-deskripsi-edit"></p>
              </div>
            </div>

            <div class="form-group form-group-tanggal-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="tanggal_edit" id="tanggal-edit" disabled="true">
                <p class="error-message-tanggal-edit"></p>
              </div>
            </div>
 
            <div class="form-group form-group-status-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status_edit" id="status-edit">
                  <?php foreach($this->config->item('status_kerusakan') as $k => $v):?>
                    <option value="<?=$k?>"><?=$v?></option>
                  <?php endforeach?>
                </select>
              </div>
            </div>

          </div><!-- /.box-body -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info pull-right">Save</button>
          </div><!-- /.box-footer -->
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
