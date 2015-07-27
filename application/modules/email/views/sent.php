 
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
          <li><a href="<?php echo site_url('email')?>">Inbox</a></li>
          <li class="active"><a href="#">Sent</a></li>
        </ul>
      <div class="tab-content">

        <!-- tabcertificate -->
        <div class="tab-pane active" id="tabsent">
          
                                    <div id="email-list">                 
                        <table class="table table-striped table-fixed-layout table-hover" id="emails" > 
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
                          <?php if($_num_rows > 0) { ?>
                          <?php foreach ($email as $row):?>
                          <tr id="<?php echo $row->id?>" >
                           <td valign="middle" class="small-cell">
                            <div class="checkbox check-success ">
                            <input name="checkbox[]" class="checkbox1" type="checkbox" id="checkbox<?php echo $row->id ?>" value="<?php echo $row->id ?>">
                              <label for="checkbox<?php echo $row->id ?>"></label>
                            </div>
                            </td>
                            <?php if(is_admin()){?>
                            <td valign="middle" halign="middle"><?php if($row->is_request_activation == 1){?><h2 class="label label-success"><a href="<?php echo site_url('email/activate/'.$row->userid)?>">inactive</h2><?php } ?></td>
                            <?php } ?>
                            <td valign="large"><a href="<?php echo site_url('email/detail/'.$row->id)?>"><?php echo get_name($row->receiver_id) ?></a></td>
                            <td valign="large" class="tablefull"><span class="muted"><?php echo  word_limiter('<b>'.$row->subject.'</b>'.' - '.$row->email_body, 15)?></span></td>
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

                          <div class="col-md-10">
                            <ul class="dataTables_paginate paging_bootstrap pagination">
                                <?php echo $halaman;?>
                            </ul>
                          </div>
                          
                        </div>
                      </div>
                      </a></h2></td></tr></tbody></table></div>

                <div class="clearfix"></div>
                <div class="admin-bar" id="quick-access" style="display:">
                  <div class="admin-bar-inner">
                    <button id="delBtn" class="btn btn-danger  btn-add" type="button"><i class="icon-trash"></i> Move to trash</button>
                    <button class="btn btn-white  btn-cancel" type="button">Cancel</button>
                  </div>
                </div> 
      </div>
    </div>
      <!-- END PAGE --> 
    </div>
  </div>

    