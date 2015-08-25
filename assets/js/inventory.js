$(document).ready(function() {				
	$(".select2").select2();

	var url = $.url();
    var baseurl = url.attr('protocol')+'://'+url.attr('host')+'/'+url.segment(1)+'/';
    var uri1 = url.segment(2)+'/update/'+url.segment(4)+'/hrd';
    var uri2 = url.segment(2)+'/update/'+url.segment(4)+'/it';
    var uri3 = url.segment(2)+'/update/'+url.segment(4)+'/logistik';
    var uri4 = url.segment(2)+'/update/'+url.segment(4)+'/koperasi';
    var uri5 = url.segment(2)+'/update/'+url.segment(4)+'/perpus';
    var uri6 = url.segment(2)+'/update/'+url.segment(4)+'/keuangan';
    var urilogistik = url.segment(2)+'/do_approve/'+url.segment(4)+'/logistik';
    var urikoperasi = url.segment(2)+'/do_approve/'+url.segment(4)+'/koperasi';
    var uriperpus = url.segment(2)+'/do_approve/'+url.segment(4)+'/perpus';
    var urihrd = url.segment(2)+'/do_approve/'+url.segment(4)+'/hrd';
    var uriit = url.segment(2)+'/do_approve/'+url.segment(4)+'/it';
    var urikeuangan = url.segment(2)+'/do_approve/'+url.segment(4)+'/keuangan';

    $('#btnUpdateInvhrd').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvhrd').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri1,
                data: $('#formUpdateInvhrd').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvit').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvit').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri2,
                data: $('#formUpdateInvit').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvlogistik').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvlogistik').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri3,
                data: $('#formUpdateInvlogistik').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvkoperasi').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvkoperasi').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri4,
                data: $('#formUpdateInvkoperasi').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvperpus').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvperpus').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri5,
                data: $('#formUpdateInvperpus').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

    $('#btnUpdateInvkeuangan').click(function(){
        var $btn = $(this).button('loading');
        $('#formUpdateInvkeuangan').submit(function(ev){
            $.ajax({
                type: 'POST',
                url: baseurl+uri6,
                data: $('#formUpdateInvkeuangan').serialize(),
                success: function() {
                     $("[data-dismiss=modal]").trigger({ type: "click" });
                     location.reload(),
                     $btn.button('reset')
                }
            });
            ev.preventDefault(); 
        });  
    });

	$('#btnAppLv1hrd').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urihrd,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
    		});
        });

    $('#btnAppLv1it').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+uriit,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1logistik').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urilogistik,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1koperasi').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urikoperasi,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1perpus').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+uriperpus,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

    $('#btnAppLv1keuangan').click(function(){
        var $btn = $(this).button('loading');
            $.ajax({
                type: 'POST',
                url: baseurl+urikeuangan,
                data: {'submit':true},
                success: function(result) {
                     location.reload(),
                     setTimeout(function(){
                     $btn.button('reset')},
                     5000)
                }
            });
        });

});