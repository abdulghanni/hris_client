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
        <div class="row">
            <div class="col-md-12">
                <div class="grid simple ">
                    <div class="grid-body no-border">
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Daftar&nbsp;<span class="semi-bold">Form Template</span></h4>
                            </div>
                        </div>
                        <!--
                        <?php echo form_open(site_url('auth/keywords'))?>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-3 search_label"><?php echo form_label('Nama', 'first_name')?></div>
                                        <div class="col-md-9"><?php echo bs_form_input($fname_search)?></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info"><i class="icon-search"></i>&nbsp;<?php echo lang('search_button')?></button>
                                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php echo form_close()?>
                        -->
                        <?php if (is_admin()) {
    ?>
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addModal"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button'); ?></button>
                        <?php
} ?>
                        <br/>
                        <div <?php (! empty($message)) && print('class="alert alert-info text-center"'); ?> id="infoMessage"><?php echo $message;?></div>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="2%" class="text-center">NO</th>
                                    <th width="30%" class="text-center">Nama Form</th>
                                    <th width="15%" class="text-center">Nama File</th>
                                    <th width="35%" class="text-center">Keterangan</th>
                                    <th width="18%" class="text-center"><?php echo lang('index_action_th');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach ($form_template as $user):?>
                                <tr>
                                    <td valign="middle"><?php echo $i++;?></td>
                                    <td valign="middle"><?php echo $user->form_template;?></td>
                                    <td valign="middle"><span class="muted"><?php echo $user->file;?></span></td>
                                    <td valign="middle"><span class="muted"><?php echo $user->keterangan;?></span></td>
                                    <td valign="middle" class="text-center">
                                    <?php if (is_admin()) {
    ?>
                                        <button type="button" class="btn btn-info btn-small" data-toggle="modal" data-target="#editModal<?php echo $user->id?>" title="<?php echo lang('edit_button')?>"><i class="icon-edit"></i></button>
                                        <button class='btn btn-danger btn-small' type="submit" value="Delete" data-toggle="modal" data-target="#deleteModal<?php echo $user->id?>" title="<?php echo lang('delete_button')?>"><i class="icon-warning-sign"></i></button>
                                    <?php
} ?>
                                        <a href="<?php echo './uploads/template/'.$user->file?>"  target="_blank"><button class='btn btn-primary btn-small' type="submit" title="Download File"><i class="icon-download"></i></button></a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        </div>
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
                                    if ($num_rows_all>10) {
                                        echo "Per page: ".form_dropdown('limit', $selectComponentData, $limit, $selectComponentJs);
                                    }
                                    echo '&nbsp;'.lang('found_subheading').'&nbsp;'.$num_rows_all.'&nbsp;'.'File';
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
<script src="<?php echo assets_url('js/jquery-1.8.3.min.js'); ?>"></script>
<?php foreach ($form_template as $user):?>
        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="editModal<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo 'Edit Approval Khusus'?></h4>
                    </div>
                    <div class="modal-body">
                    <?php
                        $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formupdate');
                        echo form_open_multipart('form_template/update/'.$user->id, $att)
                      ?>
                    <!--<form class="form-no-horizontal-spacing" id="formEdit<?php echo $user->id?>">-->
                        <div class="row form-row">
                            <div class="col-md-3">
                                <?php echo 'Nama Karyawan';?>
                            </div>
                            <div class="col-md-9">
                                <select name="form_template_id" class="select2" id="" style="width:100%">
                                <?php
                                    foreach ($template->result_array() as $key => $value) {
                                        $selected = ($user->form_template_id === $value['id']) ? 'selected = selected' : '';
                                        echo '<option value="'.$value['id'].'" '.$selected.'>'.$value['title'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Template Form</label>
                          </div>
                          <div class="col-md-9">
                            <?php if (!empty($user->file) && file_exists('./uploads/template/'.$user->file)) {
                                        ?>
                            <div id="file_old" class="file_old"><?php echo $user->file.' - '?><button onclick="removeFile()" type='button' class='btn btn-danger btn-small' title='Remove File'><i class='icon-remove'></i></button></div>
                            <input type='file' name='file' id="file" class="file" style="display:none;" />
                            <?php
                                    } else {
                                        ?>
                            <input type='file' name='file' id="file"/>
                            <?php
                                    } ?>
                          </div>
                        </div>
                        <div class="row form-row">
                          <div class="col-md-3">
                            <label class="form-label text-left">Keterangan</label>
                          </div>
                          <div class="col-md-9">
                            <textarea class="form-control" name="keterangan"><?= $user->keterangan ?></textarea>
                          </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button>
                        <button type="submit" class="btn btn-primary" style="margin-top: 3px;" id=""><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
                    </div>
                </div>

                    <?php echo form_close();?>
            </div>
        </div>

<!--Delete Modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="deleteModal<?php echo $user->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('delete_confirmation').' for '.$user->form_template; ?></h4>
        </div>
      <form class="form-no-horizontal-spacing" id="formdelete<?php echo $user->id?>">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none"><span aria-hidden="true">&times;</span></button>
      <div class="modal-body">
        <input type="hidden" value="<?php echo $user->id?>" name="id" id="id" class="id">
        <p><?php echo lang('delete_this_data').$user->form_template.' ?'; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="icon-ban-circle"></i>&nbsp;<?php echo lang('cancel_button')?></button>
        <button type="submit" class="btn btn-danger" style="margin-top: 3px;" id="btndelete<?php echo $user->id?>"><i class="icon-ok-sign"></i>&nbsp;Delete</button>
     </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>

        <script type="text/javascript">

            $('#btndelete'+<?php echo $user->id?>).click(function(){
                var $btn = $(this).button('loading');
                $('#formdelete'+<?php echo $user->id?>).submit(function(ev){
                    $.ajax({
                        type: 'POST',
                        url: 'form_template/delete',
                        data: $('#formdelete'+<?php echo $user->id?>).serialize(),
                        success: function() {
                             $("[data-dismiss=modal]").trigger({ type: "click" });
                             location.reload(),
                             $btn.button('reset')
                        }
                    });
                    ev.preventDefault();
                });
            });

            function removeFile(){
                $('.file_old').hide();
                $('.file').show();
              }
        </script>
        <?php endforeach;?>


        <!-- Add  Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Form Template</h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
      <?php
        $att = array('class' => 'form-no-horizontal-spacing', 'id' => 'formadd');
        echo form_open_multipart('form_template/add/', $att)
      ?>
        <div class="row form-row">
            <div class="col-md-3">Nama Form</div>
            <div class="col-md-9">
                <select name="form_template_id" class="namechange" id="" style="width:100%">
                <?php
                    foreach ($template->result_array() as $key => $value) {
                        echo '<option id="hidename" value="'.$value['id'].'">'.$value['title'].'</option>';
                    }
                    ?>
                    <option class="showname" value="<?php echo $maxid->row('id')+1; ?>">-- Tambah nama template --</option>
                </select>
            </div>
        </div>
        <div class="row form-row nameform">
          <div class="col-md-3">
            <label class="form-label text-left">Tambah Nama Template</label>
          </div>
          <div class="col-  md-9">
            <input type='text' name='name-form' id="name-form"/>
            <input type='hidden' name='id-form' id="id-form" value="<?php echo $maxid->row('id')+1; ?>"/>
          </div>
        </div>
        <div class="row form-row">
          <div class="col-md-3">
            <label class="form-label text-left">Template Form</label>
          </div>
          <div class="col-  md-9">
            <input type='file' name='file' id="file"/>
          </div>
        </div>
        <div class="row form-row">
          <div class="col-md-3">
            <label class="form-label text-left">Keterangan</label>
          </div>
          <div class="col-md-9">
            <textarea class="form-control" name="keterangan"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button>
         <button type="submit" class="btn btn-primary" style="margin-top: 3px;" id=""><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button>
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end add modal-->
