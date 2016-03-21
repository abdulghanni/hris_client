$(document).ready(function() {
    $(".select2").select2();

    $("#bu").change(function() {
        var id = $(this).val();
        getOrg(id);
    })
    .change();

     $("#org").change(function() {
        var id = $(this).val();
        getChild(id);
    })
    .change();

    $("#org_2").change(function() {
        var id = $(this).val();
        getChild2(id);
    })
    .change();

    $("#org_3").change(function() {
        var id = $(this).val();
        getChild3(id);
    })
    .change();

    $("#org_4").change(function() {
        var id = $(this).val();
        getChild4(id);
    })
    .change();


    function getOrg(id)
    {
    	$.ajax({
    		type: 'POST',
            url: 'position/get_org',
            data: {id : id},
            success: function(data) {
                $('#org').html(data);
            }
    	});
    }

    function getChild(id)
    {
        $.ajax({
            type: 'POST',
            url: 'position/get_child_org',
            data: {id : id},
            success: function(data) {
                var url = 'position/get_pos/'+id;
                var obj = JSON.parse(data);
                if(obj.st == 1){
                    $(document).find("select.select2").select2();
                    $('#org_2').show();
                    $('#org_2').html(obj.s);
                    console.log(obj.st);
                }else{
                    $('#table').load(url);
                    //console.log(obj.st);
                }
            }
        });
    }

    function getChild2(id)
    {
        $.ajax({
            type: 'POST',
            url: 'position/get_child_org',
            data: {id : id},
            success: function(data) {
                var obj = JSON.parse(data);
                var url = 'position/get_pos/'+id;
                if(obj.st == 1){
                    $(document).find("select.select2").select2();
                    $('#org_child3').show();
                    $('#org_3').html(obj.s);
                    console.log(obj.st);
                }else{
                    $('#table').load(url);
                }
            }
        });
    }

    function getChild3(id)
    {
        $.ajax({
            type: 'POST',
            url: 'position/get_child_org',
            data: {id : id},
            success: function(data) {
                var obj = JSON.parse(data);
                var url = 'position/get_pos/'+id;
                if(obj.st == 1){
                    $(document).find("select.select2").select2();
                    $('#org_child4').show();
                    $('#org_4').html(obj.s);
                    console.log(obj.st);
                }else{
                    $('#table').load(url);
                }
            }
        });
    }

    function getChild4(id)
    {
        $.ajax({
            type: 'POST',
            url: 'position/get_child_org',
            data: {id : id},
            success: function(data) {
                var obj = JSON.parse(data);
                var url = 'position/get_pos/'+id;
                if(obj.st == 1){
                    $(document).find("select.select2").select2();
                    $('#org_child5').show();
                    $('#org_5').html(obj.s);
                    console.log(obj.st);
                }else{
                    $('#table').load(url);
                }
            }
        });
    }
});