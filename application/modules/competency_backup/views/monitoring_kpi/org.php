<select id="org" class="select2" style="width:100%">
  <option value="0">-- Pilih  Departement/Bagian --</option>
  <?php foreach($org as $r){?>
  <option value="<?=$r['ID']?>"><?php echo $r['DESCRIPTION']?></option>
  <?php } ?>
</select>
<script type="text/javascript">
$("#org").change(function() {
        var id = $(this).val();
        var comp_session_id = $("#comp_session_id").val();

        if(id!=0){
            $("#loader").show();
            $.ajax({
                url : base_url+'competency/monitoring_kpi/get_kpi/'+id+'/'+comp_session_id,
                type: "POST",
                success: function(data)
                {  
                    $("#loader").hide();
                    $("#mapping-kpi").html(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Terjadi Kesalahan, Silakan Refresh Halaman Ini');
                }
            });
        }
    })
    .change();
</script>