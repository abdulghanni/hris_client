<select id="org" class="select2" style="width:100%">
  <option value="0">-- Pilih  Departement/Bagian --</option>
  <?php foreach($org as $r){?>
  <option value="<?=$r['ID']?>"><?php echo $r['DESCRIPTION']?></option>
  <?php } ?>
</select>
<script type="text/javascript">
$("#org").change(function() {
        var id = $(this).val();
        if(id!=0){
            $.ajax({
                url : base_url+'competency/mapping_kpi/get_mapping_from_org/'+id,
                type: "POST",
                success: function(data)
                {  
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