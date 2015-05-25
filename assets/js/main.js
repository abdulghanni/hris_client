(function(window, undefined) {
    'use strict';

    var // Localise globals
        document = window.document,
        $ = window.$,
        CIS = window.CIS = window.CIS || {};

    CIS.Ajax = {
        /*
         * Hold the last context that was set by the request.
         * In most case, it will refer to a DOM element that trigger the request.
         * Best use for debugging a response from CIS.Ajax.request function.
         */
        lastContext: undefined,
        /**
         * Perform an Ajax request
         * The response will be handled by CI.Ajax.response function
         * url: the URL to which the request is sent
         * settings: settings for $.ajax() function (optional)
         */
        request: function(url, settings) {
            settings = settings || {};
            var context = settings.context || this;

            settings = $.extend({
                async: true,
                cache: false,
                dataType: 'json',
                type: 'GET',
                success: function(data) {
                    CIS.Ajax.response.call(context, data);
                }
            }, settings);
            $.ajax(url, settings);
        },
        /**
         * Handle JSON data responded from CI.Ajax.request function
         * data: JSON data
         *      contains array of scripts to be executed
         */
        response: function(data) {
            var data = data || {},
                context = this;
            CIS.Ajax.lastContext = context;

            if (typeof data.scripts === 'undefined') {
                return;
            }

            // Execute all scripts from the response
            for (var i = 0, length = data.scripts.length; i < length; i++) {
                try {
                    (new Function(data.scripts[i])).call(context);
                } catch(ex) {
                    console.log(ex);
                }
            }
        }
    };

    CIS.Script = $.extend({
        // Store all of the scripts that were randomly placed inside the page's body
        // to be executed later after the page was completely rendered
        queue: [],
        // List of Javascript files that were already loaded
        // by the CIS.Script.require function
        loadedFiles: {},

        /**
         * Load Javascript files if they were not loaded, then execute them
         * file: string or array of string
         * callback: function
         */
        require: function(file, callback) {
            var self = this,
                files = (file instanceof Array) ? file : [file],
                // List of Javascript files that were not loaded
                unloadedFiles = [],
                // List of functions that will be executed to load the Javascript file
                functions = [];

            // Prepare list of Javascript files that need to be loaded
            for (var i = 0; i < files.length; i++) {
                if (typeof files[i] === 'string' || files[i] instanceof String) {
                    // Check if the file was loaded or not
                    if ( ! self.loadedFiles.hasOwnProperty(files[i])) {
                        unloadedFiles.push(files[i]);
                        functions.push($.ajax({
                            dataType: "script",
                            cache: true,
                            url: files[i]
                        }));
                    }
                }
            }

            if (unloadedFiles.length > 0) {
                // Check if $() is ready
                functions.push($.Deferred(function(deferred) {
                    $(deferred.resolve);
                }));

                // Trigger callback after all Javascript files were loaded completely (random order)
                $.when.apply(self, functions).done(function() {
                    for (var j = 0; j < unloadedFiles.length; j++) {
                        // Mark as loaded
                        self.loadedFiles[unloadedFiles[j]] = true;
                    }
                    callback();
                });
            } else {
                // If all Javascript files were already loaded,
                // trigger callback right away
                callback();
            }
        }
    }, CIS.Script);

    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

        // Ajaxify links
        $(document).on('click', 'a[rel]', function(e) {
            var $a = $(this),
                rel = $a.attr('rel'),
                url = $a.attr('ajaxify');

            if (typeof url === 'undefined') {
                e.preventDefault();
                return;
            }

            switch (rel) {
                case 'async':
                    CIS.Ajax.request(url, {
                        context: this,
                        beforeSend: function() {
                            if ($a.data('disabled')) {
                                return false;
                            }
                            // Disable this DOM element
                            // before performing an Ajax request
                            $a.data('disabled', true).addClass('disabled');
                        },
                        complete: function() {
                            // Enable when the request finished
                            $a.data('disabled', false).removeClass('disabled');
                        }
                    });
                    break;
            }
            return false;
        });
        // Ajaxify forms
        $(document).on('submit', 'form[rel]', function(e) {
            var $form = $(this),
                rel = $form.attr('rel'),
                url = $form.attr('action');

            if (typeof url === 'undefined') {
                e.preventDefault();
                return;
            }

            switch (rel) {
                case 'async':
                    CIS.Ajax.request(url, {
                        type: 'POST',
                        data: $form.serializeArray(),
                        context: this,
                        beforeSend: function() {
                            if ($form.data('disabled')) {
                                return false;
                            }
                            // Disable this form
                            $form.data('disabled', true);
                            // Disable all submit buttons of this form
                            $form.find('[type="submit"]').addClass('disabled');
                        },
                        complete: function() {
                            $form.data('disabled', false);
                            $form.find('[type="submit"]').removeClass('disabled');
                        }
                    });
                    break;
            }
            e.preventDefault();
        });

        $('#limit').select2();
    });

    // Execute queued scripts
    (function(queue) {
        for (var i = 0, length = queue.length; i < length; i++) {
            if (typeof queue[i] === 'function') {
                queue[i]();
            }
        }
    })(CIS.Script.queue);
})(window);


//modal form

$(document).ready(function(){
                $('#formadd').submit(function(response){
                    $.post($('#formadd').attr('action'), $('#formadd').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            getTable();
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgBad').hide();
                            $('#MsgGood').text('Data Saved').fadeIn().delay(3000).fadeOut("slow");
                            $('#modaldialog').find('#formadd')[0].reset();
                        }
                    }, 'json');
                    return false;
                });
                $('#course_status_id').select2();
            });
			
$(document).ready(function(){
                $('#formadd2').submit(function(response){
                    $.post($('#formadd2').attr('action'), $('#formadd2').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').html(json.errors).fadeIn();
                        }else{
                            getTable();getModal();
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgBad').hide();
                            $('#MsgGood').text('Data Saved').fadeIn().delay(3000).fadeOut("slow");
                            $('#modaldialog').find('#formadd')[0].reset();
                        }
                    }, 'json');
                    return false;
                });
            });

$(document).ready(function(){
                $('#formupdate').submit(function(response){
                    $.post($('#formupdate').attr('action'), $('#formupdate').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad2').html(json.errors).fadeIn();
                        }else{
                            getTable();getModal();;
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgBad2').hide();
                            $('#MsgGood').text('Data Updated').fadeIn().delay(3000).fadeOut("slow");
                        }
                    }, 'json');
                    return false;
                });
                $('#course_status_id').select2();
            });

$(function(){
 $('#formdelete').submit(function(response){
                    $.post($('#formdelete').attr('action'), $('#formdelete').serialize(),function(json){
                        if(json.st == 0){
                            $('#MsgBad').text('Delete Failed').fadeIn();
                        }else{
                            getTable();getModal();;
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                            $('#MsgGood').text('Data Deleted').fadeIn().delay(4000).fadeOut("slow");
                        }
                    }, 'json');
                    return false;
                });
            });
			

$(function(){
 $('#search').submit(function(response){

                    $.post($('#search').attr('action'), $('#search').serialize(),function(json){
                        var url = $.url();
                        var uri = url.segment(3);
                        var get = uri.substring(7);
                        if(get.length<1){
                            get = 'course';
                        }

                        function getTable2() 
                        {
                            $('#tabel').load(json.base_url+'auth/get_'+get+'/'+json.id+'/'+json.title);
                        }
                        if(json.st == 0){
                            $('#MsgGood').text('Search Failed').fadeIn();
                        }else{
                            getTable2();
                        }
                    }, 'json');
                    return false;
                });

 $('#search_org_class').on("submit",function(response){
        $.post($('#search_org_class').attr('action'), $('#search_org_class').serialize(),function(json){
            var url = $.url();
            var uri = url.segment(2);
           
            
            function getTable2() 
            {
                $('#tabel').load(json.base_url+'organization_class/get_table/fn:'+json.title);
            }

            if(json.st == 0){
                $('#MsgGood').text('Search Failed').fadeIn();
            }else{
                getTable2();
            }
        }, 'json');
        return false;
    });

 $('#search_pos_group').on("submit",function(response){
        $.post($('#search_pos_group').attr('action'), $('#search_pos_group').serialize(),function(json){
            var url = $.url();
            var uri = url.segment(2);
           
            function getTable2() 
            {
                $('#tabel').load(json.base_url+'position_group/get_table/fn:'+json.title);
            }

            if(json.st == 0){
                $('#MsgGood').text('Search Failed').fadeIn();
            }else{
                getTable2();
            }
        }, 'json');
        return false;
    });
	
$('#search_position').on("submit",function(response){
        $.post($('#search_position').attr('action'), $('#search_position').serialize(),function(json){
            var url = $.url();
            var uri = url.segment(2);
           
            function getTable2() 
            {
                $('#tabel').load(json.base_url+'position/get_table/fn:'+json.title);
            }

            if(json.st == 0){
                $('#MsgGood').text('Search Failed').fadeIn();
            }else{
                getTable2();
            }
        }, 'json');
        return false;
    });

 $('#parent_id').select2();

 $('#position_id_detail').on("change",function(response){
    var pos_id = $(this).val();
    var url_pos_group = $('#pos_group_url').val();
    $.ajax({
        type: "GET",
        url: url_pos_group+'/'+pos_id,             
        dataType: "json",               
        success: function(response){
            $('#position_group_id').val(response.position_group_id);
            $('#organization_id').val(response.organization_id);
        }
    });
    return false;
 });

  $('#search_library').on("submit",function(response){
        $.post($('#search_library').attr('action'), $('#search_library').serialize(),function(json){
            var url = $.url();
            var uri = url.segment(2);
           
            function getTable2() 
            {
                $('#tabel').load(json.base_url+'library/get_table/fn:'+json.title);
            }

            if(json.st == 0){
                $('#MsgGood').text('Search Failed').fadeIn();
            }else{
                getTable2();
            }
        }, 'json');
        return false;
    });
});

/*custom web-HRIS 
$(document).ready(function() {      
    $('#login-form').validate({
        focusInvalid: false, 
        ignore: "",
        rules: {
            identity: {
                minlength: 4,
                required: true
            },
            password: {
                required: true,
            }
        }
    }); 
})*/