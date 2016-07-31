<div class="col-xs-12">
	<div class="box box-primary">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">Form Update Kerusakan</h3> -->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?=site_url('kerusakan/buat_estimasi/'.$kerusakan->id);?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Kerusakan</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $kerusakan->deskripsi?>" disabled="true" name="nama_kerusakan">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Prasarana</label>
                  <input type="text" class="form-control" name="nama_prasarana" id="exampleInputEmail1" value="<?= $prasarana->nama?>" disabled="true" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Pelapor</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $pelapor->nama?>" disabled="true" name="nama_pelapor">
                </div>
                  <hr>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Barang</label>
                  <input type="text" class="form-control" id="exampleInputEmail1"  name="nama_barang">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Harga</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" name="harga">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="<?=site_url('kerusakan');?>" class="btn btn-default">Kembali</a>
              </div>
            </form>
          </div>
	
</div>
<?php if($this->session->userdata('pembelian')):?>
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pembelian</h3>

              <!-- <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
                <?php $i=1;$total=0;foreach($this->session->userdata('pembelian') as $pem => $p):?>
                <tr>
                  <td><?=$i;?></td>
                  <td><?=$p['nama_barang'];?></td>
                  <td><?=$p['harga'];?></td>
                  <?php $total +=$p['harga'];?>
                  <td>
                    <a href="<?=site_url('kerusakan/remove_ses_estimasi/'.$pem.'/'.$kerusakan->id);?>" class="btn btn-danger btn-flat">Hapus</a>
                  </td>
                </tr>
              <?php $i++;endforeach;?>
                <tr>
                  <td>Total</td>
                  <td></td>
                  <td><?php echo $total; ?></td>
                </tr>

              </tbody></table>
              <a href="<?=site_url('kerusakan/selesai_estimasi/'.$kerusakan->id);?>" class="btn btn-success btn-flat pull-right">Selesai</a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
<?php endif;?>