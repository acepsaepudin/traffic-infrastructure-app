<div class="col-xs-12">
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Kategori Prasarana</h3>
  <div class="pull-right">
    <a href="javascript:void(0)" onclick="newFunc()" class="btn btn-lg btn-success btn-flat">New</a><br>
  </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="tabel-kategori" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($categories as $cat):?>
        <tr>
          <td><?php echo $cat->nama_kategori ?></td>
          <td>
            <button class="btn btn-sm btn-info btn-flat" onclick="EditKategori(<?php echo $cat->id ?>)">Edit</button>
            <button class="btn btn-sm btn-danger btn-flat" onclick="deleteFunc(<?php echo $cat->id ?>)">Delete</button>
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
<div class="modal fade new-modal-kategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Form Kategori</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
        <?php echo form_open('kategori/create',array('class' => 'form-horizontal form-new-kategori')) ?>
          <div class="box-body">
            <div class="form-group has-error form-group-nama">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama-kategori" placeholder="Nama Kategori">
                <p id="error-message"></p>
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
<div class="modal fade delete-modal-kategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Konfirmasi Hapus Kategori</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
          <div class="box-body">
            <p>Yakin akan menghapus Kategori ini ?</p>
          </div>
      </div>
      <div class="modal-footer">
        <?php echo form_open('kategori/destroy',array('class' => 'form-horizontal form-delete-kategori')) ?>
            <input type="hidden" name="kategori_id" id="kategori_id">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--modal update kategori -->
<div class="modal fade update-modal-kategori">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Form Kategori</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
        <?php echo form_open('kategori/update',array('class' => 'form-horizontal form-update-kategori')) ?>
          <div class="box-body">
            <div class="form-group form-group-nama-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="hidden" name="id_edit" id="id_edit">
                <input type="text" class="form-control" name="nama" id="nama-kategori-edit" >
                <p id="error-message-edit"></p>
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
