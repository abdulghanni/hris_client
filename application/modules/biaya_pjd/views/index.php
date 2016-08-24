<input type="hidden" id="form_name" value="<?=$form_name?>">
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
      <div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <div class="grid-title">
              <h4>Pengaturan <span class="semi-bold"><?php echo 'Biaya PJD' ?></span></h4>
            </div>

            <div class="grid-body ">
            <br/>
            <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered table-hover table-full-width " id="table" style="width: 100%;">
                    <thead>
                         <tr>
                          <th rowspan="2" scope="col" width="20%">Komponen Biaya</th>
                          <th colspan="7" scope="col" width="70%" class="text-center">Biaya PJD/Golongan</th>
                        </tr>
                        <tr>
                          <th scope="col" class="text-center" width="10%">1</th>
                          <th scope="col" class="text-center" width="10%">2</th>
                          <th scope="col" class="text-center" width="10%">3</th>
                          <th scope="col" class="text-center" width="10%">4</th>
                          <th scope="col" class="text-center" width="10%">5</th>
                          <th scope="col" class="text-center" width="10%">6</th>
                          <th scope="col" class="text-center" width="10%">7</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Uang Makan</td>
                        <?php for($i=1;$i<=19;$i+=3){
                            $v = number_format(getValue('jumlah_biaya', 'pjd_biaya', array('id'=>'where/'.$i)), 0);
                          ?>

                        <td align="right">
                            <a href="javascript:void(0);" onclick="updateVal('<?php echo $i?>')">
                              <span id="td<?php echo $i?>" class="td-val">
                                <u><?= $v ?></u>
                              </span>
                            </a>
                            <input type="text" style="display:none" value="<?=$v?>" id="text<?php echo $i?>" class="text-val text-right form-control money" onKeydown="Javascript: if (event.keyCode==13) changeVal(<?=$i?>);">
                        </td>
                        <?php } ?>
                      </tr>
                       <tr>
                        <td>Uang Saku</td>
                        <?php for($i=2;$i<=20;$i+=3){
                            $v = number_format(getValue('jumlah_biaya', 'pjd_biaya', array('id'=>'where/'.$i)), 0);
                          ?>
                        <td align="right">
                            <a href="javascript:void(0);" onclick="updateVal('<?php echo $i?>')">
                              <span id="td<?php echo $i?>" class="td-val">
                                <u><?= $v ?></u>
                              </span>
                            </a>
                            <input type="text" style="display:none" value="<?=$v?>" id="text<?php echo $i?>" class="text-val text-right form-control money" onKeydown="Javascript: if (event.keyCode==13) changeVal(<?=$i?>);">
                        </td>
                        <?php } ?>
                      </tr>
                      <tr>
                        <td>Hotel</td>
                        <?php for($i=3;$i<=21;$i+=3){
                          $v = number_format(getValue('jumlah_biaya', 'pjd_biaya', array('id'=>'where/'.$i)), 0);
                          ?>
                        <td align="right">
                            <a href="javascript:void(0);" onclick="updateVal('<?php echo $i?>')">
                              <span id="td<?php echo $i?>" class="td-val">
                                <u><?= $v ?></u>
                              </span>
                            </a>
                            <input type="text" style="display:none" value="<?=$v?>" id="text<?php echo $i?>" class="text-val text-right form-control money" onKeydown="Javascript: if (event.keyCode==13) changeVal(<?=$i?>);">
                        </td>
                        <?php } ?>
                      </tr>
                    </tbody>
                </table>
            </div>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>
</div>
<!-- END CONTAINER -->

<script type="text/javascript"> 
  window.updateVal = function(a){
      var ID = a;
      $("#td"+ID).hide();
      $("#text"+ID).show();
      $("#text"+ID).focus();
      $(".money").maskMoney({allowZero:true, precision:0});
  }

 function changeVal(ID){
        var first=$("#text"+ID).val();
        var dataString = 'value='+first;
        $.ajax({
          type: "POST",
          url: "<?=base_url()?>biaya_pjd/update/"+ID,
          data: dataString,
          cache: false,
          success: function(html){
            $("#text"+ID).hide();
            $("#td"+ID).html(addCommas(first));
            $("#td"+ID).show();
          }
        });
  }

  function addCommas(nStr)
  {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
  }
</script>