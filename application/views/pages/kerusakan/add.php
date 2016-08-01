<div class="col-xs-12">
	<div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Form Update Kerusakan</h3> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?=site_url('kerusakan/add');?>" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deskripsi</label>
                  <textarea class="form-control" name="deskripsi"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Foto</label>
                  <input type="file" class="form-control" name="foto" id="exampleInputEmail1"  >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Prasarana</label>
                  <select name="prasarana" class="form-control">
                    <?php foreach($prasarana as $k => $v):?>
                      <option value="<?=$v->id;?>"><?=$v->nama;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                  <hr>
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?=site_url('kerusakan');?>" class="btn btn-default">Kembali</a>
              </div>
            </form>
          </div>
	
</div>
