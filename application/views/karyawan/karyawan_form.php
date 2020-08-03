<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DATA KARYAWAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
                <table class='table table-bordered'>       

	    
                    <tr>
                        <td width='200'>Nama <?php echo form_error('nama') ?>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                        </td>
                    </tr>
	    
                    <tr>
                        <td width='200'>Jabatan <?php echo form_error('jabatan') ?>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
                        </td>
                    </tr>
	    
                    <tr>
                        <td width='200'>Nomor Hp <?php echo form_error('nomor_hp') ?>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="Nomor Hp" value="<?php echo $nomor_hp; ?>" />
                        </td>
                    </tr>
	    
                    <tr>
                        <td width='200'>Alamat <?php echo form_error('alamat') ?>
                        </td>
                        <td>
                            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                        </td>
                    </tr>
	    
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    
                            <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    
                            <a href="<?php echo site_url('karyawan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
                        </td>
                    </tr>
	
                </table>
            </form>
        </div>
    </section>
</div>