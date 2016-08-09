<div class="row form-row">
							<div class="col-md-12">
								<a href="<?php echo site_url('inventory/cetak/'.$id)?>" target="_blank"><button class="btn btn-primary pull-right"><i class="icon-print"> Cetak</i></button></a><br/>
							</div>
						  <div class="col-md-12">
						    <h4>Inventaris yang dimiliki</h4>
						  </div>
						  </div>
						  <div class="row form-row">
						    <div class="col-md-12">
						      <table class="table no-more-tables">
						        <tr>
						          <th>No</th>
						          <th>Item</th>
						          <th>Keterangan</th>
						        </tr>
						        <?php
						          $i=0;
						          if($users_inventory->num_rows()>0){
						            foreach ($users_inventory->result() as $inv) :
						              ?>
						        <tr>
						        	<td><?php echo 1+$i++ ?></td>
						          <td><?php echo $inv->title?></td>
						          <td><?php echo $inv->note?></td>
						        </tr>
						            <?php endforeach;}?>
						      </table>
						    </div>
						  </div>