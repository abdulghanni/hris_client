$(document).ready(function() {
    $(".select2").select2();
    $("#comp_session_id").change(function() {
        var id = $(this).val();
        var organization_id = $("#organization_id").val();
        var position_id = $("#position_id").val();
        var user_nik = $("#emp").val();
        $("#mohon_tunggu_kompetensi").hide();
        //var table_=document.getElementById("#tbl_performance");
        //var rowCount=table_.rows.length-2;
        if(id!=0){
            $("#mohon_tunggu_kompetensi").show();
            //alert('comp_session_id : '+id+' organization_id : '+organization_id+' position_id : '+position_id);
            $.ajax({
                url : base_url+'competency/kinerja_supporting/get_kpi_detail/'+id+'/'+organization_id+'/'+position_id+'/'+user_nik,
                type: "POST",
                success: function(data)
                {  
                    $("#mohon_tunggu_kompetensi").hide();
                    //$("#mapping-kpi").html(data);
                    $("#tbl_performance").find('tbody').remove().end().append(data.html_performance);
                    $("#tbl_kompetensi").find('tbody').remove().end().append(data.html_kompetensi);  
                    $("#tbl_kedisiplinan").find('tbody').remove().end().append(data.html_kedisiplinan);  
                    //$("#btnAddPerformance").attr('disabled',false);
                    //$("#btnAddPerformance").text('Tambah Aspek Penilaian Performance');
                    $(document).find("select.select2").select2({
                        dropdownAutoWidth : true
                    });
                    //$("#tbl_kompetensi_footer").show();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#mohon_tunggu_kompetensi").hide();
                    alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini org');
                },
                dataType:"json"
            });
        }
    })
    .change();
});

function addPerformance(tableID){
    var table=document.getElementById(tableID);
    var rowCount=table.rows.length-2;
    $("#btnAddPerformance").attr('disabled',true);
    $("#btnAddPerformance").text('loading....');
    $.ajax({
        url: base_url+'competency/kinerja_supporting/add_performance/'+rowCount,
        success: function(response){
            $("#"+tableID).find('tbody').append(response);	
            $("#btnAddPerformance").attr('disabled',false);
            $("#btnAddPerformance").text('Tambah Aspek Penilaian Performance');
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
            $("#tbl_performance_footer").show();
         },
         dataType:"html"
    });
}



function addKompetensi(tableID){
    var table=document.getElementById(tableID);
    var rowCount=table.rows.length-2;
    $("#btnAddKompetensi").attr('disabled',true);
    $("#btnAddKompetensi").text('loading....');
    $.ajax({
        url: base_url+'competency/kinerja_supporting/add_kompetensi/'+rowCount,
        success: function(response){
            $("#"+tableID).find('tbody').append(response);	
            $("#btnAddKompetensi").attr('disabled',false);
            $("#btnAddKompetensi").text('Tambah Aspek Penilaian Kompetensi');
            $(document).find("select.select2").select2({
                dropdownAutoWidth : true
            });
            $("#tbl_kompetensi_footer").show();
         },
         dataType:"html"
    });
}

function hitungPerformance(id){
	var a = $("#bobot_performance"+id).val();
	var b = $("#nilai_performance"+id).val();

	var persentase = (a/100) * b;
	console.log(persentase);
	$("#persentase_performance"+id).val(persentase);

	var totalBobot = 0.00,
	 	totalNilai = 0.00,
	 	totalPersentase = 0.00;

	$('.bobot_performance').each(function (index, element) {
        totalBobot = totalBobot + parseFloat($(element).val());
    });

    $('.nilai_performance').each(function (index, element) {
        totalNilai = totalNilai + parseFloat($(element).val());
    });

    $('.persentase_performance').each(function (index, element) {
        totalPersentase = totalPersentase + parseFloat($(element).val());
    });

    $("#sub_total_bobot_performance").val(totalBobot);
    $("#sub_total_nilai_performance").val(totalNilai);
    $("#sub_total_persentase_performance").val(totalPersentase);
    

    var c = $("#sub_total_persentase_performance").val(),
    	d = $("#sub_total_persentase_kompetensi").val(),
        e = $("#sub_total_persentase_kedisiplinan").val(),
        total = (c * (60/100)) + (d * (30/100)) + (e * (10/100));

    	$("#total_nilai").val(total);
}

function hitungkompetensi(id){
	var a = $("#bobot_kompetensi"+id).val();
	var b = $("#nilai_kompetensi"+id).val();
    

	var persentase = (a/100) * b;
	console.log(persentase);
	$("#persentase_kompetensi"+id).val(persentase);

	var totalBobot = 0,
	 	totalNilai = 0,
	 	totalPersentase = 0;

	$('.bobot_kompetensi').each(function (index, element) {
        totalBobot = totalBobot + parseFloat($(element).val());
    });

    $('.nilai_kompetensi').each(function (index, element) {
        totalNilai = totalNilai + parseFloat($(element).val());
    });

    $('.persentase_kompetensi').each(function (index, element) {
        totalPersentase = totalPersentase + parseFloat($(element).val());
    });

    $("#sub_total_bobot_kompetensi").val(totalBobot);
    $("#sub_total_nilai_kompetensi").val(totalNilai);
    $("#sub_total_persentase_kompetensi").val(totalPersentase);

    var c = $("#sub_total_persentase_performance_id").val(),
        d = $("#sub_total_persentase_kompetensi").val(),
    	e = $("#sub_total_persentase_kedisiplinan_id").val(),
    	total = (c * (60/100)) + (d * (30/100)) + (e * (10/100)),
    	konversi = 'E';

    	if(total >= 100){
    		konversi = "A+";
    	}else if(total < 100 && total > 90 ){
            konversi = "A";
        }else if(total > 71 && total < 89){
    		konversi = "B";
    	}else if(total >= 60 && total < 70){
    		konversi = "C";
    	}else if(total < 60){
    		konversi = "D";
    	}

    	$("#total_nilai").val(total);
    	$("#konversi_nilai").val(konversi);
}

function hitungkedisiplinan(id){
    //alert('hit');
    var a = $("#bobot_kedisiplinan"+id).val();
    var b = $("#nilai_kedisiplinan"+id).val();

    var persentase = (a/100) * b;
    console.log(persentase);
    $("#persentase_kedisiplinan"+id).val(persentase);

    var totalBobot = 0,
        totalNilai = 0,
        totalPersentase = 0;

    /*$('.bobot_kedisiplinan').each(function (index, element) {
        totalBobot = totalBobot + parseFloat($(element).val());
    });*/

    $('.nilai_kedisiplinan').each(function (index, element) {
        totalNilai = totalNilai + parseFloat($(element).val());
    });

    $('.persentase_kedisiplinan').each(function (index, element) {
        totalPersentase = totalPersentase + parseFloat($(element).val());
    });

    //$("#sub_total_bobot_kedisiplinan").val(totalBobot);
    $("#sub_total_nilai_kedisiplinan").val(totalNilai);
    $("#sub_total_persentase_kedisiplinan").val(totalPersentase);

    var c = $("#sub_total_persentase_performance").val(),
        d = $("#sub_total_persentase_kompetensi").val(),
        e = $("#sub_total_persentase_kedisiplinan").val(),
        total = (c * (60/100)) + (d * (30/100)) + (e * (10/100)),
        konversi = 'E';

        if(total > 90){
            konversi = "A";
        }else if(total > 70 && total < 90){
            konversi = "B";
        }else if(total > 59 && total < 71){
            konversi = "C";
        }else if(total < 60){
            konversi = "D";
        }

        $("#total_nilai").val(total);
        $("#konversi_nilai").val(konversi);
}

function hitungkonversinilai()
{
    var c = $("#sub_total_persentase_performance_id").val(),
        d = $("#sub_total_persentase_kompetensi").val(),
        e = $("#sub_total_persentase_kedisiplinan_id").val(),
        total = (c * (60/100)) + (d * (30/100)) + (e * (10/100)),
        konversi = 'E';

        if(total > 90){
            konversi = "A";
        }else if(total > 70 && total < 90){
            konversi = "B";
        }else if(total > 59 && total < 71){
            konversi = "C";
        }else if(total < 60){
            konversi = "D";
        }

        alert('performance : '+c+' kompetensi : '+d+' kedisiplinan : '+e)
        $("#total_nilai").val(total);
        $("#konversi_nilai").val(konversi);
}