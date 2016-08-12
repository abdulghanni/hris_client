$(document).ready(function() {    
    $(".select2").select2(); 
    $('.input-append.date').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                todayHighlight: true
       });

    $('.timepicker-24').timepicker({
                minuteStep: 1,
                //showSeconds: true,
                showMeridian: false
     });
    //approval script
    var base_url    = $("#base_url").val(),
        form        = $("#form").val(),       
        id          = $("#id").val(),       
        uri5        = base_url+form+'/kirim_undangan/'+id;

    
    $("#hrd_list").change(function() {
        var empId = $(this).val();
        getHrdPhone(empId);
    })
    .change();

    function getHrdPhone(empId)
    {
        $.ajax({
            type: 'POST',
            url: '../get_hrd_phone',
            data: {id : empId},
            success: function(data) {
                $('#hrd_phone').val(data);
            }
        });
    }
            
    //approval script

    $('#btn_undangan').click(function(){
        $('#formUndangan').submit(function(ev){
            var $btn = $('#btn_undangan').button('loading');
            $.ajax({
                type: 'POST',
                url: uri5,
                data: $('#formUndangan').serialize(),
                success: function() {
                    $("[data-dismiss=modal]").trigger({ type: "click" });
                    location.reload(),
                    $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });
}); 

    function reload_status(lv)
    {
        uri = base_url+form+'/detail/'+id+'/'+lv;
        $('#'+lv).html('<img src="/hris_client/assets/img/loading.gif"> loading...');
        $('#note').html('<img src="/hris_client/assets/img/loading.gif"> loading...');
        $.ajax({
            type: 'POST',
            url: uri,
            dataType: "JSON",
            success: function(data) {
                $('#'+lv).html(data.app);
                $('#note').html(data.note);
            }
        });
    }   