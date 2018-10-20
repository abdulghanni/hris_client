var save_method; //for save method string
var table;
var form = $("#form_name").val();
var is_admin = $("#is_admin").val();
var bfliter = false; 
var base_url = $("#base_url").val();

$(document).ready(function() {
   

    table = $('#table').DataTable({ 
            oLanguage: {
                //sProcessing: "<img src='assets/images/loading_spinner.gif'>"
                sProcessing: "Memuat data ... ",
                sSearch: "NIK : ",
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            //"bFilter": false,
            //"retrieve": true,

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": base_url+"competency/kinerja_supporting/ajax_list/",
                "type": "POST"
            },

        }); 

    

   
    
    
});


   

    function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}