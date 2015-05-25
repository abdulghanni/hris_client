 <?php
            $menu = $this->uri->segment(2);
            $active1= $active2=$active3=$active4=$active5=$active6=$active7=$active8=$active9=$active10="";
            switch ($menu) {
                case 'detail':
                    $active1 = "class='active'";
                    break;
                case 'detail_certificate':
                    $active2 = "class='active'";
                    break;
                case 'detail_education':
                    $active3 = "class='active'";
                    break;
                case 'detail_experience':
                    $active4 = "class='active'";
                    break;
                case 'detail_sk':
                    $active5 = "class='active'";
                    break;
                case 'detail_sti':
                    $active6 = "class='active'";
                    break;
                case 'detail_jabatan':
                    $active7 = "class='active'";
                    break;
                 case 'detail_award':
                    $active8 = "class='active'";
                    break;
                case 'detail_ikatan_dinas':
                    $active9 = "class='active'";
                    break;
                case 'detail_course':
                    $active10 = "class='active'";
                    break;
                 
                default:
                    $active1 = "class='active'";
                    break;
            }
            ?>
<div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-pills nav-justified" style="">
                                    <li role="presentation"<?php echo $active1?>><a href="<?php echo base_url('auth/detail/'.$user->id)?>"><?php echo lang('person_employement_label')?></a></li>
                                    <li role="presentation"<?php echo $active10?>><a href="<?php echo base_url('auth/detail_course/'.$user->id)?>"><?php echo lang('person_course_label')?></a></li>
                                    <li role="presentation"<?php echo $active2?>><a href="<?php echo base_url('auth/detail_certificate/'.$user->id)?>"><?php echo lang('person_certificate_label')?></a></li>
                                    <li role="presentation"<?php echo $active3?>><a href="<?php echo base_url('auth/detail_education/'.$user->id)?>"><?php echo lang('person_education_label')?></a></li>
                                    <li role="presentation"<?php echo $active4?>><a href="<?php echo base_url('auth/detail_experience/'.$user->id)?>"><?php echo lang('person_experience_label')?></a></li>
                                    <li role="presentation"<?php echo $active5?>><a href="<?php echo base_url('auth/detail_sk/'.$user->id)?>"><?php echo lang('person_sk_label')?></a></li>
                                    <li role="presentation"<?php echo $active6?>><a href="<?php echo base_url('auth/detail_sti/'.$user->id)?>"><?php echo lang('person_sti_label')?></a></li>
                                    <li role="presentation"<?php echo $active7?>><a href="<?php echo base_url('auth/detail_jabatan/'.$user->id)?>"><?php echo lang('person_jabatan_label')?></a></li>
                                    <li role="presentation"<?php echo $active8?>><a href="<?php echo base_url('auth/detail_award/'.$user->id)?>"><?php echo lang('person_award_label')?></a></li>
                                    <li role="presentation"<?php echo $active9?>><a href="<?php echo base_url('auth/detail_ikatan_dinas/'.$user->id)?>"><?php echo lang('person_ikatan_label')?></a></li>
                                </ul>
                            </div>
                        </div>