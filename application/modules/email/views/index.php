 
  <!-- BEGIN PAGE -->
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
    <div class="tabbable tabs-top">
      <ul class="nav nav-tabs" id="tab-1">
        <li class="active"><a href="#">Inbox</a></li>
        <li><a href="<?php echo site_url('email/sent')?>">Sent</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tabpersonnel">
          <div id="email-list">    
           <?php if($_num_rows > 0) { ?>   
           <div class="row">
                <div class="col-md-6">
                <h4><?php echo lang('search_of_subheading')?>&nbsp;<span class="semi-bold"><?php echo 'Email';?></span></h4>
                </div>
            </div>
            <?php echo form_open(site_url('email/keywords'))?>

                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-3 search_label"><?php echo form_label('Email Subject','first_name')?></div>
                            <div class="col-md-9"><input type="text" class="form-control" name="email_subject" /></div>
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
            <table class="table table-fixed-layout table-hover" id="emails" > 
              <thead>
              <tr>
                <th class="small-cell">
                  <div class="checkbox check-success ">
                    <input id="selectall" class="" type="checkbox">
                    <label for="selectall"></label>
                  </div>
                </th>
                <?php if(is_admin()){ ?>
                <th width="11%"></th>
                <?php } ?>
                <th width="15%"></th>
                <th width="60%"></th>
                <th class="medium-cell"></th>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($email as $row):?>
              <tr id="<?php echo $row->id?>" <?php if($row->is_read == 0){?>style="background-color: #ffffcc;border: medium none;"<?php } ?>>
               <td valign="middle" class="small-cell">
                <div class="checkbox check-success ">
                <input name="checkbox[]" class="checkbox1" type="checkbox" id="checkbox<?php echo $row->id ?>" value="<?php echo $row->id ?>">
                  <label for="checkbox<?php echo $row->id ?>"></label>
                </div>
                </td>
                <?php if(is_admin()){?>
                <td valign="middle" halign="middle"><?php if($row->is_request_activation == 1){?><h2 class="label label-success"><a href="<?php echo site_url('email/activate/'.$row->userid)?>">inactive</h2><?php } ?></td>
                <?php } ?>
                <td valign="large"><a href="<?php echo site_url('email/detail/'.$row->id)?>"><?php echo get_name($row->sender_id) ?></a></td>
                <td valign="large" class="tablefull"><span class="muted"><a href="<?php echo site_url('email/detail/'.$row->id)?>"><?php echo word_limiter('<b>'.$row->subject.'</b>'.' - '.$row->email_body, 15)?></a></span></td>
                <td class=""><span class="muted"><?php  $now = date('Y-m-d',strtotime('now'));

                  if (date('Y-m-d', strtotime($row->sent_on)) == $now)
                  {
                   echo 'Today';
                  }elseif(date('Y-m-d', strtotime($row->sent_on)) == date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 day" ) )){
                   echo "Yesterday";
                  }else{
                   echo date('d M', strtotime($row->sent_on));
                  }
                ?></span></td>
              </tr>
              <?php endforeach;?>
                 <?php   
              }else{?>
              <tr>
                <td valign="middle" colspan="9">
                    <p class="text-center">No Email</p>
                </td>
              </tr>
              <?php } ?>
              
              </tbody>
            </table>

            <?php if($_num_rows > 0) : ?>
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
                      echo '&nbsp;'.lang('found_subheading').'&nbsp;'.$num_rows_all.'&nbsp;'.'Mails';
                  ?>
                  <?php echo form_close();?>
              </div>
            <?php endif; ?>
              <div class="col-md-10">
                <ul class="dataTables_paginate paging_bootstrap pagination">
                    <?php echo $halaman;?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
                <div class="admin-bar" id="quick-access" style="z-index:100;display:">
                  <div class="admin-bar-inner">
                    <button id="delBtn" class="btn btn-danger  btn-add" type="button"><i class="icon-trash"></i>Delete</button>
                    <button class="btn btn-white  btn-cancel" type="button">Cancel</button>
                  </div>
                </div> 
      <!-- END PAGE --> 
    </div>
  </div>

    