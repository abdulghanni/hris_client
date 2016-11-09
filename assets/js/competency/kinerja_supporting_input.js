$(document).ready(function() {
    $(".select2").select2();
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

	var totalBobot = 0,
	 	totalNilai = 0,
	 	totalPersentase = 0;

	$('.bobot_performance').each(function (index, element) {
        totalBobot = totalBobot + parseInt($(element).val());
    });

    $('.nilai_performance').each(function (index, element) {
        totalNilai = totalNilai + parseInt($(element).val());
    });

    $('.persentase_performance').each(function (index, element) {
        totalPersentase = totalPersentase + parseInt($(element).val());
    });

    $("#sub_total_bobot_performance").val(totalBobot);
    $("#sub_total_nilai_performance").val(totalNilai);
    $("#sub_total_persentase_performance").val(totalPersentase);
    

    var c = $("#sub_total_persentase_performance").val(),
    	d = $("#sub_total_persentase_kompetensi").val(),
    	total = c * (60/100) + d * (40/100);

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
        totalBobot = totalBobot + parseInt($(element).val());
    });

    $('.nilai_kompetensi').each(function (index, element) {
        totalNilai = totalNilai + parseInt($(element).val());
    });

    $('.persentase_kompetensi').each(function (index, element) {
        totalPersentase = totalPersentase + parseInt($(element).val());
    });

    $("#sub_total_bobot_kompetensi").val(totalBobot);
    $("#sub_total_nilai_kompetensi").val(totalNilai);
    $("#sub_total_persentase_kompetensi").val(totalPersentase);

    var c = $("#sub_total_persentase_performance").val(),
    	d = $("#sub_total_persentase_kompetensi").val(),
    	total = c * (60/100) + d * (40/100),
    	konversi = 'E';

    	if(total > 90){
    		konversi = "A";
    	}else if(total >= 70 && total < 90){
    		konversi = "B";
    	}else if(total >= 50 && total < 70){
    		konversi = "C";
    	}else if(total < 50){
    		konversi = "D";
    	}

    	$("#total_nilai").val(total);
    	$("#konversi_nilai").val(konversi);
}