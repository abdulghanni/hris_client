<!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
        
        
        <div id="container">
            <div class="row">
        <div class="col-md-12">
          <div class="grid simple">
            <div class="grid-title no-border">
              <h4>Form <a href="<?php echo site_url('form_spd_dalam_group')?>">Perjalanan Dinas <span class="semi-bold">Dalam Kota (Group)</span></a></h4>
            </div>
            <div class="grid-body no-border">
              <form class="form-no-horizontal-spacing" id="form_spd_dalam_group" action="<?php echo site_url().'form_spd_dalam_group/do_submit/'.$id = $this->uri->segment(3, 0);?>" method="post"> 
                <div class="row column-seperation">
                  <div class="col-md-5">
                    <h4>Yang Memberi Tugas</h4>
                    <?php if ($td_num_rows > 0) {
                      foreach ($task_detail as $td) :
                        $id_spd_group = $td->id;
                    ?>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Nama</label>
                      </div>
                      <div class="col-md-9">
                        <input name="name" id="name" type="text"  class="form-control" placeholder="Nama" value="<?php echo get_name($td->task_creator) ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Dept/Bagian</label>
                      </div>
                      <div class="col-md-9">
                        <input name="org" id="org" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['ORGANIZATION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-right">Jabatan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="position" id="position" type="text"  class="form-control" placeholder="Nama" value="<?php echo (!empty($user_info))?$user_info['POSITION']:'-';?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tujuan</label>
                      </div>
                      <div class="col-md-9">
                        <input name="destination" id="destination" type="text"  class="form-control" placeholder="Tujuan" value="<?php echo $td->destination ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Dalam Rangka</label>
                      </div>
                      <div class="col-md-9">
                        <input name="title" id="title" type="text"  class="form-control" placeholder="Dalam Rangka" value="<?php echo $td->title; ?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Tgl. Berangkat</label>
                      </div>
                      <?php $task_date = dateIndo($td->date_spd) ?>
                      <div class="col-md-9">
                        <!-- <div class="input-append date success no-padding"> -->
                          <input type="text" class="form-control" name="start_cuti" value="<?php echo $task_date; ?>" disabled="disabled">
                          <!-- <span class="add-on"><span class="arrow"></span><i class="icon-th"></i></span> --> 
                        <!-- </div> -->
                      </div>
                    </div>
                    <div class="row form-row">
                      <div class="col-md-3">
                        <label class="form-label text-left">Waktu</label>
                      </div>
                      <div class="col-md-3">
                            <input type="text" class="form-control" name="spd_start_time" value="<?php echo date('H:i:s',strtotime($td->start_time)) ?>" disabled="disabled">
                      </div>
                      <div class="col-md-2">
                        <label class="form-label text-left">s/d</label>
                      </div>
                      <div class="col-md-3">
                            <input type="text" class="form-control" name="spd_start_time" value="<?php echo date('H:i:s',strtotime($td->end_time)) ?>" disabled="disabled">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <h4>List Report PJD Dalam Kota (Group)</h4>
                    
                    <div class="row form-row">
                      <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Nama</th>
                                <th>Dept/Bagian</th>
                                <th>Jabatan</th>
                                <th>Report</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                            for($i=0;$i<sizeof($receiver);$i++):
                              if(!empty(get_id($receiver[$i]))){
                                $report_num = getAll('users_spd_dalam_report_group', array('user_spd_dalam_group_id'=>'where/'.$td->id, 'created_by'=>'where/'.get_id($receiver[$i])))->num_rows();
                              }else{
                                 $report_num == 0 ;
                              }
                                $btn_report = (in_array(get_nik($sess_id), $receiver_submit) && $report_num==0 && get_nik($sess_id)== $receiver[$i]) ?'<div class="btn btn-info btn-small" data-toggle="modal" data-target="#createreportModal" title="Create Report"><i class="icon-edit"></i></div><br/>':(($report_num>0)?'<a href='.site_url('form_spd_dalam_group/report_detail/'.$td->id.'/'.get_id($receiver[$i])).'>View Report</a>':'<i class="icon-minus"></i>');
                            ?>
                              <tr>
                                <td><?php echo get_name($receiver[$i])?></td>
                                <td><?php echo get_user_organization($receiver[$i])?></td>
                                <td><?php echo get_user_position($receiver[$i])?></td>
                                <td class="text-center"><?php echo $btn_report?></td>
                              </tr>
                            <?php endfor?>
                            </tbody>
                          </table>
                      </div>
                    </div>
                    
                    
                  </div>
                </div>
                <?php endforeach;} ?>
              </form>
            </div>
          </div>
        </div>
      </div>
                
        
      </div>
        
    </div>  
    <!-- END PAGE --> 

    <!-- Edit spd dalam Modal -->
<div class="modal fade" id="createreportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo 'Laporan PJD'?></h4>
      </div>
      <p class="error_msg" id="MsgBad" style="background: #fff; display: none;"></p>
      <div class="modal-body">
        <?php echo form_open_multipart('form_spd_dalam_group/add_report/'.$id_spd_group)?>
            <h4>Laporan Kegiatan PJD</h4>
            <div class="row form-row">
              <div class="col-md-4">
                <label class="form-label text-left">Sudah Terlaksana : </label>
              </div>
                <div class="col-md-8">
                  <label class="radio-inline">
                    <input type="radio" name="is_done" id="is_done1" required value="1" >Ya
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="is_done" id="is_done2" value="0" >Tidak
                  </label>
                </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Maksud dan Tujuan : </label>
              </div>
              <div class="col-md-12">
                <textarea name="maksud" id="text-editor" placeholder="maksud dan tujuan ..." class="form-control" rows="5" required></textarea>
              </div>
            </div>
            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Hasil Kegiatan : </label>
              </div>
              <div class="col-md-12">
                <textarea name="hasil" id="text-editor" placeholder="Hasil Kegiatan ..." class="form-control" rows="5" required></textarea>
              </div>
            </div>

            <div class="row form-row">
              <div class="col-md-12">
                <label class="form-label text-left">Attachment : </label>
              </div>
              <div class="col-md-12">
                 <input type='file' name='userfile' id="file" size='20'/>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i>&nbsp;<?php echo lang('close_button')?></button> 
        <button type="submit" class="btn btn-primary lnkBlkWhtArw" name="btn_add" id="btnRetPass" style="margin-top: 3px;"><i class="icon-ok-sign"></i>&nbsp;<?php echo lang('save_button')?></button> 
      </div>
        <?php echo form_close()?>
    </div>
  </div>
</div>
<!--end add modal-->