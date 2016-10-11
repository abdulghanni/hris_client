<div class="table-responsive">
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%" class="text-center">NIK</th>
            <th width="30%" class="text-center">Nama</th>
            <th width="28%" class="text-center">Form</th>
            <th width="10%" class="text-center"><?php echo lang('index_action_th');?></th>                                  
        </tr>
    </thead>
    <tbody>
    <?php foreach ($form as $f):
    $filter = array('bu'=>'where/'.$bu, 'form_type_id'=>'where/'.$f->id);
        $num_rows = getValue('user_nik', 'users_notif_cc',$filter);//lastq();
        $nik = (!empty($num_rows))?getValue('user_nik', 'users_notif_cc', $filter):"-";
        $nama = (!empty($num_rows))?get_name($nik):"Karyawan Belum Dipilih";
    ?>
        <tr>
            <td valign="middle"><?php echo $nik;?></td>
            <td valign="middle"><span class="muted"><?php echo $nama;?></span></td>
            <td valign="middle"><span class="muted"><?php echo ucfirst($f->form_name);?></span></td>
            <td valign="middle" class="text-center">
                <button type="button" class="btn btn-info btn-small" onclick="<?php echo 'edit('.$f->id.')'?>" title="<?php echo lang('edit_button')?>"><i class="icon-edit"></i></button>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
</div>