<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Estimasi</h3>

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
                </tr>
                <?php $i=1;$total=0;foreach($estimasi as $pem => $p):?>
                <tr>
                  <td><?=$i;?></td>
                  <td><?=$p->nama_barang;?></td>
                  <td><?=$p->harga;?></td>
                  <?php $total +=$p->harga;?>

                </tr>
              <?php $i++;endforeach;?>
                <tr>
                  <td>Total</td>
                  <td></td>
                  <td><?php echo $total; ?></td>
                </tr>

              </tbody></table>
              <center>
              <a href="<?=site_url('kerusakan');?>" class="btn btn-default btn-flat">Kembali</a>
              <a href="<?=site_url('kerusakan/terima_estimasi/'.$id_kerusakan);?>" class="btn btn-success btn-flat pull-center">Terima</a>
              </center>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>