
 var base_url    = $("#base_url").val(),
      form        = $("#form").val(),       
      id          = $("#id").val();
    uriMgr = form+'/do_approve/'+id+'/mgr';
    uriKoperasi = form+'/do_approve/'+id+'/koperasi';
    uriPerpus = form+'/do_approve/'+id+'/perpus';
    uriHrd = form+'/do_approve/'+id+'/hrd';
    uriIt = form+'/do_approve/'+id+'/it';
    urikeuangan = form+'/do_approve/'+id+'/keuangan';
    uriAsset = form+'/do_approve/'+id+'/asset';
    uridropdown = base_url+'dropdown/get_atasan/';

    $('#btnAppMgr').click(function(){
      var $btn = $(this).button('loading');
                $('#formAppMgr').submit(function(ev){
                    $.ajax({
                        type: 'POST',
                        url: base_url+uriMgr,
                        data: $('#formAppMgr').serialize(),
                        success: function() {
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            location.reload(),
                            $btn.button('reset')
                        }
                    });
                    ev.preventDefault(); 
                });  
            });

        $('#btnAppKoperasi').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppKoperasi').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: base_url+uriKoperasi,
                          data: $('#formAppKoperasi').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });

        $('#btnAppPerpus').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppPerpus').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: base_url+uriPerpus,
                          data: $('#formAppPerpus').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });

        $('#btnAppHrd').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppHrd').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: base_url+uriHrd,
                          data: $('#formAppHrd').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });

      $('#btnAppIt').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppIt').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: base_url+uriIt,
                          data: $('#formAppIt').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });
       $('#btnAppkeuangan').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppkeuangan').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: base_url+urikeuangan,
                          data: $('#formAppkeuangan').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });
      $('#btnAppAsset').click(function(){
        var $btn = $(this).button('loading');
                  $('#formAppAsset').submit(function(ev){
                      $.ajax({
                          type: 'POST',
                          url: base_url+uriAsset,
                          data: $('#formAppAsset').serialize(),
                          success: function() {
                              $("[data-dismiss=modal]").trigger({ type: "click" });
                              location.reload(),
                              $btn.button('reset')
                          }
                      });
                      ev.preventDefault(); 
                  });  
              });