<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
             <h3>Widget Settings</h3>
        </div>
        <div class="modal-body">Widget settings form goes here</div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
        <div class="page-title">
            <i class="icon-custom-left"></i>
            <h3>Daftar Inventaris Karyawan</span></h3> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">                            
                    <div class="grid-body no-border">
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <h4><?php echo lang('search_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo lang('user_subheading');?></span></h4>
                            </div>
                        </div>
                        <?php echo form_open(site_url('inventory/keywords'))?>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3 search_label">Nama</div>
                                        <div class="col-md-9"><?php echo bs_form_input($fname_search)?></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info"><i class="icon-search"></i>&nbsp;<?php echo lang('search_button')?></button>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <?php echo form_close()?>
                        <br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="1%">
                                        <div class="checkbox check-default">
                                            <input id="checkbox10" type="checkbox" value="1" class="checkall">
                                            <label for="checkbox10"></label>
                                        </div>
                                    </th>
                                    <th width="5%"><?php echo anchor('inventory/index/'.$fname_param.'/'.$email_param.'/nik/'.(($sort_order == 'asc' && $sort_by == 'nik') ? 'desc' : 'asc'), 'NIK');?></th>
                                    <th width="15%"><?php echo anchor('inventory/index/'.$fname_param.'/'.$email_param.'/username/'.(($sort_order == 'asc' && $sort_by == 'username') ? 'desc' : 'asc'), 'Nama');?></th>
                                    <th width="15%"><?php echo anchor('inventory/index/'.$fname_param.'/'.$email_param.'/email/'.(($sort_order == 'asc' && $sort_by == 'email') ? 'desc' : 'asc'), lang('index_email_th'));?></th>
                                    <th width="15%">Dept/Bagian</th>
                                    <th width="5%">Inventaris</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user):?>
                                <tr>
                                    <td valign="middle">
                                         <div class="checkbox check-default">
                                            <input id="checkbox11" type="checkbox" value="1">
                                            <label for="checkbox11"></label>
                                        </div>
                                    </td>
                                    <td valign="middle"><?php echo $user->nik;?></td>
                                    <td valign="middle"><?php echo $user->username;?></td>
                                    <td valign="middle"><span class="muted"><?php echo $user->email;?></span></td>
                                    <td valign="middle"><?php echo get_user_organization($user->nik);?></td>
                                    <td valign="middle" class="text-center">
                                      <a href="<?php echo site_url('inventory/detail/'.$user->id)?>">
                                          <button type="button" class="btn btn-info btn-small" title="Lihat Inventaris"><i class="icon-briefcase"></i></button>
                                      </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-4 page_limit">
                                <?php echo form_open(uri_string());?>
                                <?php 
                                    $selectComponentData = array(
                                        10  => '10',
                                        25 => '25',
                                        50 =>'50',
                                        75 => '75',
                                        100 => '100',);
                                    $selectComponentJs = 'class="select2" onChange="this.form.submit()" id="limit"';
                                    echo "Per page: ".form_dropdown('limit', $selectComponentData, $limit, $selectComponentJs);
                                    echo '&nbsp;'.lang('found_subheading').'&nbsp;'.$num_rows_all.'&nbsp;'.lang('users_subheading');
                                ?>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-md-10">
                                <ul class="pagination">
                                    <?php echo $halaman;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE -->
</div>