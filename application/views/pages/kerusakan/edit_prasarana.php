<div class="col-xs-12">
	<div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Form Update Kerusakan</h3> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?=site_url('kerusakan/edit_prasarana/'.$kerusakan->id);?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Kerusakan</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" value="<?= $kerusakan->deskripsi?>" disabled="true">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Prasarana</label>
                  <select class="form-control" name="nama_prasarana">
                  	<?php foreach($prasarana as $k => $v):?>
                  	<option value="<?=$v->id?>"><?=$v->nama;?></option>
                  	<?php endforeach;?>
                  </select>
                </div>

                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?=site_url('kerusakan');?>" class="btn btn-default">Kembali</a>
              </div>
            </form>
          </div>
	
</div>