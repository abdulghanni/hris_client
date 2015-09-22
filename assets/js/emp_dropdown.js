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
            //getSubordinateGroup(empId);
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
            getAtasan1(empId);
            getAtasan3(empId);
            getEmpOrg(empId);
            getEmpPos(empId);
            //getPenerimaTugasLuarGroup(empId);
            break;
    }
})
.change();

$("#peserta").change(function() {
    var empId = $(this).val();
    getEmpOrg(empId);
    getEmpNik(empId);
    getEmpPos(empId);
    getAtasan3(empId);
})
.change();

$("#penerima_tugas").change(function() {
    var empId = $(this).val();
    getEmpOrgTr(empId);
    getEmpPosTr(empId);
})
.change();

$("#penerima_tugas_luar").change(function() {
    var empId = $(this).val();
    getEmpOrgTr(empId);
    getEmpPosTr(empId);
    getEmpGrade(empId);
    getBiayaFix(empId);
    $('.rupiah').maskMoney({precision: 0});
})
.change();

$("#penerima_tugas_luar").change(function() {
    var empId = $(this).val();
    getEmpOrgTr(empId);
    getEmpPosTr(empId);
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

    function getBiayaFix(empId)
    {
        $.ajax({
                type: 'POST',
                url: baseurl+'dropdown/get_biaya_fix/',
                data: {id : empId},
                success: function(data) {
                    $('#biaya_fix').html(data);
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

function getSubordinateGroup(empId)
{
 $.ajax({
        type: 'POST',
        url: 'get_subordinate',
        data: {id : empId},
        success: function(data) {
            $('#peserta_group').html(data);
        }
    });
}

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

function getPenerimaTugasGroup(empId)
{
 $.ajax({
        type: 'POST',
        url: baseurl+'dropdown/get_penerima_tugas_group/'+empId,
        data: {id : empId},
        success: function(data) {
            $('#penerima_tugas').html(data);
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



  $.validator.addMethod('notEqual',function(value, element, param){
    return this.optional(element)||value != param;
  });

});