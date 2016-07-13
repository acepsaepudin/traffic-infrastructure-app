<div class="col-xs-12">
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Prasarana</h3>
  <div class="pull-right">
    <a href="javascript:void(0)" onclick="newFunc()" class="btn btn-lg btn-success btn-flat">new</a><br>
  </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="tabel-kategori" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Lokasi</th>
          <th>Longitude</th>
          <th>Latitude</th>
          <th>Kategori</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($prasarana as $p):?>
        <tr>
          <td><?php echo $p->nama; ?></td>
          <td><?php echo $p->lokasi; ?></td>
          <td><?php echo $p->longitude; ?></td>
          <td><?php echo $p->latitude; ?></td>
          
          <td><?php echo $p->kategori; ?></td>
          <td>
            <button class="btn btn-sm btn-info btn-flat" onclick="EditPrasarana(<?php echo $p->id ?>)">Edit</button>
            <button class="btn btn-sm btn-danger btn-flat" onclick="deleteFunc(<?php echo $p->id ?>)">Delete</button>
          </td>
        </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col -->
<!--modal new kategori -->
<div class="modal fade new-modal-prasarana">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Form Prasarana</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
        <?php echo form_open('prasarana/create',array('class' => 'form-horizontal form-new-prasarana')) ?>
          <div class="box-body">
            <div class="form-group has-error form-group-nama">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                <p class="error-message-nama"></p>
              </div>
            </div>
            <div class="form-group has-error form-group-lokasi">
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi">
                <p class="error-message-lokasi"></p>
              </div>
            </div>

            <div class="form-group has-error form-group-longitude">
              <label for="inputEmail3" class="col-sm-2 control-label">Longitude</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude">
                <p class="error-message-longitude"></p>
              </div>
            </div>

            <div class="form-group has-error form-group-latitude">
              <label for="inputEmail3" class="col-sm-2 control-label">Latitude</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude">
                <p class="error-message-latitude"></p>
              </div>
            </div>

            <div class="form-group form-group-kategori">
              <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-10">
                <select class="form-control" name="kategori">
                <?php foreach($kategori as $k => $v): ?> 
                <option value="<?php echo $v->id; ?>"><?php echo $v->nama_kategori; ?></option>
                <?php endforeach;?>
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

<!--modal delete confirm kategori -->
<div class="modal fade delete-modal-prasarana">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Konfirmasi Hapus Prasarana</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
          <div class="box-body">
            <p>Yakin akan menghapus Prasaran ini ?</p>
          </div>
      </div>
      <div class="modal-footer">
        <?php echo form_open('prasarana/destroy',array('class' => 'form-horizontal form-delete-prasarana')) ?>
            <input type="hidden" name="prasarana_id" id="prasarana_id">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--modal update kategori -->
<div class="modal fade update-modal-prasarana">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Form Update Data Prasaran</h4>
      </div>
      <div class="modal-body">
        <!-- <form class="form-horizontal form-new-kategori"> -->
        <?php echo form_open('prasarana/update',array('class' => 'form-horizontal form-update-prasarana')) ?>
          <div class="box-body">
            <div class="form-group form-group-nama-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="hidden" name="id_edit" id="id_edit">
                <input type="text" class="form-control" name="nama_edit" id="nama-edit" >
                <p class="error-message-nama-edit"></p>
              </div>
            </div>
           <div class="form-group form-group-lokasi-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Lokasi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="lokasi_edit" id="lokasi-edit" >
                <p class="error-message-lokasi-edit"></p>
              </div>
           </div> 
          <div class="form-group form-group-longitude-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Longitude</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="longitude_edit" id="longitude-edit" >
                <p class="error-message-longitude-edit"></p>
              </div>
          </div> 
          <div class="form-group form-group-latitude-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Latitude</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="latitude_edit" id="latitude-edit" >
                <p class="error-message-latitude-edit"></p>
              </div>
          </div>
          <div class="form-group form-group-kategori-edit">
              <label for="inputEmail3" class="col-sm-2 control-label">Kategori</label>
              <div class="col-sm-10">
                <select class="form-control" name="kategori_edit">
                <?php foreach($kategori as $k => $v): ?> 
                <option value="<?php echo $v->id; ?>"><?php echo $v->nama_kategori; ?></option>
                <?php endforeach;?>
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
