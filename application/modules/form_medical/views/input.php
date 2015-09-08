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
              		<div class="grid simple ">
		                <div class="grid-title no-border">
		                  <h4>Input Rekapitulasi <span class="semi-bold"><a href="<?php echo site_url('form_medical')?>">Rawat Jalan & Inap</a></span></h4>
		                </div>
                  	<div class="grid-body no-border">
                  	<h6 class="bold">BAGIAN : <span class="semi-bold" id="organization"><?php echo $bagian?></span></h6>
					 		      <div class="col-md-4">
                        <div class="row">
                            <button type="button" id="btnAdd" class="btn btn-primary btn-lg" onclick="addRow('dataTable')"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button');?></button>
                            <button type="button" id="btnRemove" class="btn btn-danger" onclick="deleteRow('dataTable')" style="display: none;"><i class="icon-remove"></i>&nbsp;<?php echo 'Remove'?></button>
                        </div>
                    </div> 
                    <br/><br/>
                            <div class="row">
                              <div class="col-md-12">
              							 	<?php //echo form_open("form_medical/add",array("id"=>"formaddmedical"));?>
                              <form action="<?php echo base_url()?>form_medical/add" id="formaddmedical" method="post" enctype="multipart/form-data">
              							    <table id="dataTable" class="table table-bordered">
              							    	<thead>
  			                            <tr>
  			                              <th width="5%"></th>
  			                              <th width="5%">No</th>
  			                              <th width="25%">Nama</th>
  			                              <th width="25%">Nama Pasien</th>
  			                              <th width="15%">Hubungan</th>
  			                              <th width="15%">Jenis Pemeriksaan</th>
  			                              <th width="10%">Rupiah</th>
  			                            </tr>
  		                            </thead>
            							        <tbody>
            							        </tbody>
              						    	</table>

                                <br/>
                                <div class="row form-row">
                                  <div class="col-md-12">
                                    <label class="bold form-label text-left">Attachment : </label>
                                  </div>
                                  <div class="col-md-12">
                                    <table id="attachment">
                                      <tr>
                                        <td><input type='file' class="file" id="file" name='userfile[]' size='20'/></td>
                                      </tr>
                                    </table>
                                    <button type="button" id="btnAddAttachment" class="btn-primary btn-xs" onclick="addAttachment()"><i class="icon-plus"></i>&nbsp;<?php echo lang('add_button').' Attachment';?></button><br/><br/>
                                  </div>
                                <?php if(is_admin()){?>
            					          <div class="row form-row">
                                  <div class="col-md-2">
                                    <label class="form-label text-left"><?php echo 'Pembuat Rekapitulasi' ?></label>
                                  </div>
                                  <div class="col-md-5">
                                    <select id="emp" class="select2" style="width:100%" name="pengaju">
                                      <?php
                                      foreach ($all_users->result() as $u) :
                                        $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                                        <option value="<?php echo $u->id?>" <?php echo $selected?>><?php echo $u->username.' - '.get_nik($u->id); ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                  </div>
                                </div>
                                <?php }else{?>
                                <input type="hidden" name="pengaju" value="<?php echo $sess_id?>" />
                                <?php } ?>
                                <br/>
                                <div class="col-md-12">
            					          <div class="row form-row">
                                  <div class="col-md-12">
                                    <label class="bold form-label text-left"><?php echo 'Approval' ?></label>
                                  </div>
                                </div>
                                <div class="row form-row">
                                  <div class="col-md-2">
                                    <label class="form-label text-left"><?php echo 'Supervisor' ?></label>
                                  </div>
                                  <div class="col-md-5">
                                    <?php if(is_admin()){?>
                                    <select id="atasan1" class="select2" style="width:100%" name="atasan1" >
                                    <option value="0">- Pilih Supervisor -</option>
                                      <?php
                                      foreach ($all_users->result() as $u) :
                                        $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                                        <option value="<?php echo $u->nik?>" <?php echo $selected?>><?php echo $u->username?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <?php }else{ ?>
                                    <select name="atasan1" id="atasan1" class="select2" style="width:100%">
                                        <option value="0">- Pilih Supervisor -</option>
                                        <?php foreach ($user_atasan as $key => $up) : ?>
                                          <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                        <?php }?>
                                  </div>
                                </div>

                                <div class="row form-row">
                                  <div class="col-md-2">
                                    <label class="form-label text-left"><?php echo 'Ka. Bagian' ?></label>
                                  </div>
                                  <div class="col-md-5">
                                  <?php if(is_admin()){?>
                                    <select id="atasan2" class="select2" style="width:100%" name="atasan2">
                                      <?php
                                      foreach ($all_users->result() as $u) :
                                        $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                                        <option value="<?php echo $u->nik?>" <?php echo $selected?>><?php echo $u->username?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <?php }else{ ?>
                                    <select name="atasan2" id="atasan2" class="select2" style="width:100%">
                                        <option value="0">- Pilih Ka. Bagian -</option>
                                        <?php foreach ($user_atasan as $key => $up) : ?>
                                        <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                  <?php }?>
                                  </div>
                                </div>

                                <div class="row form-row">
                                  <div class="col-md-2">
                                    <label class="form-label text-left"><?php echo 'Atasan Lainnya' ?></label>
                                  </div>
                                  <div class="col-md-5">
                                  <?php if(is_admin()){
                                    ?>
                                    <select id="atasan3" class="select2" style="width:100%" name="atasan3">
                                    <option value="0">- Pilih Atasan Lainnya -</option>
                                      <?php
                                      foreach ($all_users->result() as $u) :
                                        $selected = $u->id == $sess_id ? 'selected = selected' : '';?>
                                        <option value="<?php echo $u->nik?>" <?php echo $selected?>><?php echo $u->username?></option>
                                      <?php endforeach; ?>
                                    </select>
                                    <?php }else{ ?>
                                    <select name="atasan3" id="atasan3" class="select2" style="width:100%">
                                        <option value="0">- Pilih Atasan Lainnya -</option>
                                        <?php foreach ($user_atasan as $key => $up) : ?>
                                        <option value="<?php echo $up['ID'] ?>"><?php echo $up['NAME']; ?></option>
                                        <?php endforeach;?>
                                    </select>
                                        <?php }?>
                                  </div>
                                </div>
                                </div>
                                </div>


				                 <div class="form-actions">
				                  <div class="pull-right">
				                    <button id="btnSaveMedical" class="btn btn-success btn-cons" type="submit" style="display: none;"><i class="icon-ok"></i> <?php echo lang('save_button') ?></button>
				                    <a href="<?php echo site_url('form_medical') ?>"><button id="btnCancelMedical" class="btn btn-white btn-cons" type="button" style="display: none;"><?php echo lang('cancel_button') ?></button></a>
				                  </div>
				                </div>
              					<?php echo form_close(); ?>
              			</div></div>
						</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> 
<!-- END PAGE --> 
<?php $all_users = $all_users->result_array();?>
<script type="text/javascript">
	function addRow(tableID){
	var table=document.getElementById(tableID);
	var rowCount=table.rows.length;
	var row=table.insertRow(rowCount);

	var cell1=row.insertCell(0);
	var element1=document.createElement("input");
	element1.type="checkbox";
	element1.name="chkbox[]";
	element1.className="checkbox1";
	cell1.appendChild(element1);

	var cell2=row.insertCell(1);
	cell2.innerHTML=rowCount+1-1;
  <?php if(is_admin()){?>
	var cell3=row.insertCell(2);
	cell3.innerHTML = "<select name='emp[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($all_users);$i++):?><option value='<?php echo $all_users[$i]['nik']?>'><?php echo $all_users[$i]['username'].' - '.$all_users[$i]['nik']?></option><?php endfor;?></select>";  
  <?php }else{?>
  var cell3=row.insertCell(2);
  cell3.innerHTML = "<select name='emp[]' class='select2' style='width:100%'><?php foreach ($user_same_org as $key => $up) :?><option value='<?php echo $up['ID'] ?>'><?php echo $up['NAME'].' - '.$up['ID'] ?></option><?php endforeach;?></select>";  
  <?php } ?>

	var cell4=row.insertCell(3);
	cell4.innerHTML = '<input name="pasien[]" type="text" class="form-control" required="required">';

	var cell5=row.insertCell(4);
	cell5.innerHTML = "<select name='hubungan[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($hubungan);$i++):?><option value='<?php echo $hubungan[$i]['id']?>'><?php echo $hubungan[$i]['title']?></option><?php endfor;?></select>";  

	var cell6=row.insertCell(5);
	cell6.innerHTML = "<select name='jenis[]' class='select2' style='width:100%'><?php for($i=0;$i<sizeof($jenis);$i++):?><option value='<?php echo $jenis[$i]['id']?>'><?php echo $jenis[$i]['title']?></option><?php endfor;?></select>";  

	var cell7=row.insertCell(6);
	cell7.innerHTML = '<input name="rupiah[]" id="rupiah" type="text" class="rupiah text-right" required="required">';
	}


	function deleteRow(tableID){try{var table=document.getElementById(tableID);var rowCount=table.rows.length;for(var i=0;i<rowCount;i++){var row=table.rows[i];var chkbox=row.cells[0].childNodes[0];if(null!=chkbox&&true==chkbox.checked){table.deleteRow(i);rowCount--;i--;}}}catch(e){alert(e);}}

  function addAttachment(){
    var table=document.getElementById('attachment');
    var rowCount=table.rows.length;
    var row=table.insertRow(rowCount);

    var cell1=row.insertCell(0);
    var element1=document.createElement("input");
    element1.type="file";
    element1.name="userfile[]";
    element1.class="file";
    cell1.appendChild(element1);
  }
</script>