<!--DARI MESIN ABSEN-->
		   	<?php if(empty($user_att['max_date'])){?>
		   	<div class="row spacing-bottom 2col">	
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">	
					<div class="tiles blue added-margin">
					  <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>		
						</div>		
						<div class="tiles-title">
							KEHADIRAN
						</div>	
						<div class="heading">
						<span class="animate-number" data-value="<?php echo $persen_hadir;?>" data-animation-duration="1200">0</span>%
												
						</div><!-- 
						<div class="progress transparent progress-small no-radius">
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $persen_hadir;?>%"></div>
						</div>	 -->	
						<div class="progress transparent progress-small no-radius">
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo '0';?>%"></div>
						</div>					
						<!--<div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 4% lebih tinggi <span class="blend">dari rata-rata</span></span></div>--->
						</div>	
					</div>
				</div>
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">
					<div class="tiles green added-margin">
					 <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							KETERLAMBATAN
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $persen_terlambat;?>" data-animation-duration="1000">0</span>%	
						</div>
						<div class="progress transparent progress-small no-radius">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $persen_terlambat;?>%" ></div>
						</div>				
						<!--<div class="description"><i class="icon-custom-down"></i><span class="text-white mini-description ">&nbsp; 2% lebih rendah <span class="blend">dari rata-rata</span></span></div>	-->
					 </div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="tiles red added-margin">
					<div class="tiles-body">
						<div class="controller">								
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>										
							</div>	
						<div class="tiles-title">
							TIDAK HADIR
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $rekap_hadir['alpa'];?>" data-animation-duration="1200">0</span> Kali	
						</div>
						<div class="progress transparent progress-white progress-small no-radius">
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="2%" ></div>
						</div>
						<!--<div class="description"><i class="icon-male"></i><span class="text-white mini-description ">&nbsp;  Alpa</span></div>	-->
					</div>
					</div>
			
				</div> 
				<div class="col-md-3 col-sm-6">
					<div class="tiles purple added-margin">
					  <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							CUTI
						</div>	
						<div class="row-fluid">
							<!-- <div class="heading">
								<span class="animate-number" data-value="<?php echo $rekap_hadir['cuti'];?>" data-animation-duration="1200">0</span> Kali
							</div> -->
							<div class="heading">
								<span class="animate-number" data-value="<?php echo '0';?>" data-animation-duration="1200">0</span> Kali
							</div>
							<div class="progress transparent progress-white progress-small no-radius">
								<!-- <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo $rekap_hadir['cuti'];?>%"></div>
							</div> -->
							<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="<?php echo '0';?>%"></div>
							</div>
						</div>
						<!--<div class="description"><i class="icon-male"></i><span class="text-white mini-description ">&nbsp; Mengajukan Cuti </span></div>	-->
						
					 </div>
					</div>
				</div>			
			</div>
			<?php }else{ ?>
			<!-- dari axapta -->
			<div class="row spacing-bottom 2col">	
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">	
					<div class="tiles blue added-margin">
					  	<div class="tiles-body">
							<div class="controller">								
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>		
							</div>		
							<div class="tiles-title">
								KEHADIRAN (<?= date('M', strtotime($user_att['max_date']))?>)
							</div>	
							<div class="heading">
								<span class="animate-number" data-value="<?php echo $user_att['hadir'];?>" data-animation-duration="1200"><?=$user_att['hadir']?></span>x				
							</div>
							<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX s/d <?= dateIndo($user_att['max_date'])?> </span>
							</div>
						</div>	
					</div>
				</div>
				<div class="col-md-3 col-sm-6 spacing-bottom-sm">
					<div class="tiles green added-margin">
					 <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							KETERLAMBATAN (<?= date('M', strtotime($user_att['max_date']))?>)
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $user_att['telat'];?>" data-animation-duration="1000"><?=$user_att['telat']?></span>x	
						</div>
						<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX s/d <?= dateIndo($user_att['max_date'])?> </span></div>
					 </div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="tiles red added-margin">
					<div class="tiles-body">
						<div class="controller">								
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>										
							</div>	
						<div class="tiles-title">
							TIDAK HADIR (<?= date('M', strtotime($user_att['max_date']))?>)
						</div>	
						<div class="heading">
							<span class="animate-number" data-value="<?php echo $user_att['tidak_hadir'];?>" data-animation-duration="1200"><?=$user_att['tidak_hadir']?></span>x	
						</div>
						<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX s/d <?= dateIndo($user_att['max_date'])?> </span></div>
					</div>
					</div>
			
				</div> 
				<div class="col-md-3 col-sm-6">
					<div class="tiles purple added-margin">
					  <div class="tiles-body">
						<div class="controller">								
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>									
						</div>		
						<div class="tiles-title">
							CUTI (<?= date('Y', strtotime($user_att['max_date']))?>)
						</div>	
						<div class="row-fluid">
							<div class="heading">
								<span class="animate-number" data-value="<?php echo (!empty($user_att['cuti'])) ? $user_att['cuti'] : 0;?>" data-animation-duration="1200"><?= (!empty($user_att['cuti'])) ? $user_att['cuti'] : 0;?></span>x
							</div>
						</div>
						<div class="description"><i class="icon-custom-min"></i><span class="text-white mini-description ">&nbsp;Berdasarkan data AX tahun <?= date('Y', strtotime($user_att['max_date']))?> </span>
						</div>
					 </div>
					</div>
				</div>			
			</div>
			<?php } ?>