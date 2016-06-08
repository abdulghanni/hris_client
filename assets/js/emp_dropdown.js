$(document).ready(function() {
    var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    $("#emp").change(function() {
        var empId = $(this).val();
        switch (url.segment(2)) 
        {
            case 'form_absen':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpPosGroup(empId);
                break;
            case 'form_tidak_masuk':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpPos(empId);
                getEmpPosGroup(empId);
                break;
            case 'form_cuti':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpNik(empId);
                getEmpPos(empId);
                getEmpSenDate(empId);
                getSisaCuti(empId);
                getPenggantiCuti(empId);
            break;
            case 'form_training':
                getAtasan1(empId);
                getAtasan3(empId);
                getSubordinate(empId);
            break;
            case 'form_training_group':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpNik(empId);
                getEmpPos(empId);
            break;
            case 'form_medical':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrgMedical(empId);
            break;
            case 'form_resignment':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpBu(empId);
                getEmpOrg(empId);
                getEmpNik(empId);
                getEmpPos(empId);
                getEmpSenDate(empId);
            break;
            case 'form_spd_dalam':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpPos(empId);
                getPenerimaTugas(empId);
                break;
            case 'form_spd_luar':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpPos(empId);
                getPenerimaTugasLuar(empId);
                break;
            case 'form_spd_dalam_group':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpPos(empId);
                break;
            case 'form_spd_luar_group':
            case 'form_pjd':
                getAtasan1(empId);
                getAtasan3(empId);
                getEmpOrg(empId);
                getEmpPos(empId);
                break;
            case 'form_promosi':
            case 'form_demotion':
            case 'form_rolling':
            case 'form_phk':
                getEmpBu(empId);
                getEmpOrg(empId);
                getEmpPos(empId);
                getEmpBuId(empId);
                getEmpOrgId(empId);
                getEmpPosId(empId);
                getEmpSenDate(empId);
                isGradeTujuh(empId);
                getAtasan1(empId);
                getAtasan3(empId);
                break;
            case 'form_kontrak':
            case 'form_pengangkatan':
                getEmpBu(empId);
                getEmpOrg(empId);
                getEmpPos(empId);
                getEmpStat(empId);
                getEmpBuId(empId);
                getEmpOrgId(empId);
                getEmpPosId(empId);
                getEmpStatId(empId);
                getLamaKontrak(empId);
                getMulaiKontrak(empId);
                getAkhirKontrak(empId);
                getEmpSenDate(empId);
                isGradeTujuh(empId);
                getAtasan1(empId);
                getAtasan3(empId);
                break;
            case 'form_recruitment':
            getAtasan1(empId);
            getAtasan3(empId);
            break;
        }
    })
    .change();

    //form training
    $("#peserta").change(function() {
        var empId = $(this).val();
        getEmpOrg(empId);
        getEmpNik(empId);
        getEmpPos(empId);
        getAtasan3(empId);
    })
    .change();

    //form pjd dalam
    $("#penerima_tugas").change(function() {
        var empId = $(this).val();
        getEmpOrgTr(empId);
        getEmpPosTr(empId);
    })
    .change();

    //form pjd luar
    $("#penerima_tugas_luar").change(function() {
        var empId = $(this).val();
        getEmpOrgTr(empId);
        getEmpPosTr(empId);
        getEmpGrade(empId);
        getBiayaFix(empId);
        $('.rupiah').maskMoney({precision: 0});
    })
    .change();

    function hitung(){
    var total = 0;
    $('.biaya').each(function (index, element) {
        total = total + parseFloat($(element).val());
    });
    $('#total').val(total);
}

    //promosi,demosi,rolling, kontrak
    $("#empBawahan").change(function() {
            var empId = $(this).val();
            getEmpBu(empId);
            getEmpOrg(empId);
            getEmpPos(empId);
            getEmpStat(empId);
            getEmpBuId(empId);
            getEmpOrgId(empId);
            getEmpPosId(empId);
            getEmpStatId(empId);
            getEmpSenDate(empId);
            isGradeTujuh(empId);
            //getAtasan3(empId);
    })
    .change();

    $("#empBawahanKontrak").change(function() {
            var empId = $(this).val();
            getEmpBu(empId);
            getEmpOrg(empId);
            getEmpPos(empId);
            getEmpStat(empId);
            getEmpBuId(empId);
            getEmpOrgId(empId);
            getEmpPosId(empId);
            getEmpStatId(empId);
            getEmpSenDate(empId);
            getLamaKontrak(empId);
            getMulaiKontrak(empId);
            getAkhirKontrak(empId);
            isGradeTujuh(empId);
            //getAtasan3(empId);
    })
    .change(); 

    $("#empSess").change(function() {
        var empId = $(this).val();
        getAtasan1(empId);
        getAtasan3(empId);
    })
    .change(); 
    $("#atasan1").change(function() {
                var empId = $(this).val();
                getAtasan2(empId);
            })
            .change();
    /*
    $("#atasan2").change(function() {
                var empId = $(this).val();
                getAtasan3(empId);
            })
            .change();
    */

    function getEmpBu(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_bu/',
            data: {id : empId},
            success: function(data) {
                $('#bu').val(data);
            }
        });
    }

    function getEmpOrg(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_org/',
            data: {id : empId},
            success: function(data) {
                $('#organization').val(data);
            }
        });
    }

    function getEmpPos(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_pos/',
            data: {id : empId},
            success: function(data) {
                $('#position').val(data);
            }
        });
    }

    function getEmpPosGroup(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_pos_group/',
            data: {id : empId},
            success: function(data) {
                $('#position-group').val(data);
                if(data == "AMD"){
                    $("#atasan").hide();
                }else{
                    $("#atasan").show();
                }
            }
        });
    }

    function getEmpStat(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_stat/',
            data: {id : empId},
            success: function(data) {
                $('#status').val(data);
            }
        });
    }

    function getEmpStatId(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_stat_id/',
            data: {id : empId},
            success: function(data) {
                $('#status_id').val(data);
            }
        });
    }

    function getLamaKontrak(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'form_kontrak/get_lama_kontrak/',
            data: {id : empId},
            success: function(data) {
                $('#lama_kontrak').val(data);
            }
        });
    }

    function getMulaiKontrak(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'form_kontrak/get_mulai_kontrak/',
            data: {id : empId},
            success: function(data) {
                $('#mulai_kontrak').val(data);
            }
        });
    }

    function getAkhirKontrak(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'form_kontrak/get_akhir_kontrak/',
            data: {id : empId},
            success: function(data) {
                $('#akhir_kontrak').val(data);
            }
        });
    }


    function getEmpBuId(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_bu_id/',
            data: {id : empId},
            success: function(data) {
                $('#bu_id').val(data);
            }
        });
    }

    function getEmpOrgId(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_org_id/',
            data: {id : empId},
            success: function(data) {
                $('#organization_id').val(data);
            }
        });
    }

    function getEmpPosId(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_pos_id/',
            data: {id : empId},
            success: function(data) {
                $('#position_id').val(data);
            }
        });
    }

    function getEmpSenDate(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_sen_date/',
            data: {id : empId},
            success: function(data) {
                $('#seniority_date').val(data);
            }
        });
    }

    function getEmpNik(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_nik/',
            data: {id : empId},
            success: function(data) {
                $('#nik').val(data);
            }
        });
    }

    function getEmpGrade(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_grade/',
            data: {id : empId},
            success: function(data) {
                $('#grade').text(data);
            }
        });
    }

    function isGradeTujuh(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/is_grade_tujuh_keatas/',
            data: {id : empId},
            success: function(data) {
                $('#grade').val(data);

                if($('#grade').val() == 1){
                    $('#lima_atasan').show();
                    getAtasanLain(empId);
                }else{
                    $('#lima_atasan').hide();
                }
            }
        });
    }

    //pjd
    function getEmpOrgTr(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_org/',
            data: {id : empId},
            success: function(data) {
                $('#org_tr').val(data);
            }
        });
    }

    function getEmpPosTr(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_pos/',
            data: {id : empId},
            success: function(data) {
                $('#pos_tr').val(data);
            }
        });
    }

    //PJD Dalam
    function getPenerimaTugas(empId)
    {
     $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_penerima_tugas/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#penerima_tugas').html(data);
            }
        });
    }

    //PJD Luar Kota
    function getBiayaFix(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_biaya_fix/',
            data: {id : empId},
            success: function(data) {
                $('#biaya_fix').html(data);
                hitung();
                $('.rupiah').maskMoney({precision: 0});
            }
        });
    }

    function getPenerimaTugasLuar(empId)
    {
     $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_penerima_tugas/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#penerima_tugas_luar').html(data);
            }
        });
    }

    //Cuti
    function getPenggantiCuti(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_pengganti_cuti/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#user_pengganti').html(data);
            }
        });
    }

    function getSisaCuti(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_sisa_cuti/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#sisa_cuti').val(data);
            }
        });
    }


    //medical
    function getEmpOrgMedical(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_emp_org/',
            data: {id : empId},
            success: function(data) {
                $('#organization').text(data);
            }
        });
    }

    function getAtasan1(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_atasan/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#atasan1').html(data);
            }
        });
    }

    function getAtasan2(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_atasan2/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#atasan2').html(data);
            }
        });
    }

    function getAtasan3(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_atasan3/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#atasan3').html(data);
            }
        });
    }

    function getAtasanLain(empId)
    {
        $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_atasan3/'+empId,
            data: {id : empId},
            success: function(data) {
                $('#atasan4').html(data);
                $('#atasan5').html(data);
            }
        });
    }

    function getSubordinate(empId)
    {
     $.ajax({
            type: 'POST',
            url: baseurl+'dropdown/get_subordinate/',
            data: {id : empId},
            success: function(data) {
                $('#peserta').html(data);
            }
        });
    }

    $.validator.addMethod('notEqual',function(value, element, param){
        return this.optional(element)||value != param;
    });

});