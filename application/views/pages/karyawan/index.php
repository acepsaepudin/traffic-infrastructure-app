<div class="col-xs-12">
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Pengguna </h3>
  <div class="pull-right">
    <a href="javascript:void(0)" onclick="newFunc()" class="btn btn-lg btn-success btn-flat">new</a><br>
  </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="tabel-kategori" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Email</th>
          <th>Jabatan</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($karyawan as $k):?>
        <tr>
          <td><?php echo $k->nama; ?></td>
          <td><?php echo $k->alamat; ?></td>
          <td><?php echo $k->email; ?></td>
          <td><?=konversi('status_pengguna', $k->status)?></td>
          <td>
            <button class="btn btn-sm btn-info btn-flat" onclick="EditKaryawan(<?php echo $k->id ?>)">Edit</button>
            <button class="btn btn-sm btn-danger btn-flat" onclick="deleteFunc(<?php echo $k->id ?>)">Delete</button>
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
                <input type="text" class="form-control" name="password" id="password" placeholder="Password">
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
<div class="modal fade update-modal-karyawan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Form Update Data Pengguna</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
        <?php echo form_open('pengguna/update',array('class' => 'form-horizontal form-update-karyawan')) ?>
          <div class="box-body">
            <div class="form-group form-group-nama-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="hidden" name="id_edit" id="id_edit">
                <input type="text" class="form-control" name="nama_edit" id="nama-edit" >
                <p class="error-message-nama-edit"></p>
              </div>
            </div>

            <div class="form-group form-group-jenis_kelamin-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" name="jenis_kelamin_edit" id="jenis_kelamin-edit">
                   <option value="1">Laki-laki</option>
                   <option value="2">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="form-group form-group-notlp-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">No Tlp</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="notlp_edit" id="notlp-edit" >
                <p class="error-message-notlp-edit"></p>
              </div>
            </div>

            <div class="form-group form-group-email-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="email_edit" id="email-edit" >
                <p class="error-message-email-edit"></p>
              </div>
            </div>
 
            <div class="form-group form-group-jabatan-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>
              <div class="col-sm-10">
                <select class="form-control" name="jabatan_edit" id="jabatan-edit">
                  <?php foreach($this->config->item('status_pengguna') as $k => $v):?>
                    <option value="<?=$k?>"><?=$v?></option>
                  <?php endforeach?>
                </select>
              </div>
            </div>

            <div class="form-group form-group-alamat-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="alamat_edit" id="alamat-edit"></textarea>
                <p class="error-message-alamat-edit"></p>
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
