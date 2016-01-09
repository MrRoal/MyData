$(document).ready(function(){
    $("#btn-save").click(function() {
        if($( "#vTitle" ).val() ==''){
            $(".modal-body").html( "<p>Please enter special title.</p>" );
            $("#myalert").modal('show');
            return false;
        }
        
        if($( "#dAddedDate" ).val() ==''){
                $(".modal-body").html( "<p>Please select date.</p>" );
                $("#myalert").modal('show');
                return false;
        }
        
        if($( "#eStatus" ).val() ==''){
            $(".modal-body").html( "<p>Please select status.</p>" );
            $("#myalert").modal('show');
            return false;
        }
    });

    $(function() {
        $('#datetimepicker').datetimepicker({
            language: 'pt-BR'
        });
    });
    
});


function returnme(){
	window.location.href = base_url+'flipbooks';
}

function CheckValidFile(val,name)
{
    var a = val.substring(val.lastIndexOf('.') + 1).toLowerCase();  
    if(a == 'pdf' || a == 'PDF' || a == 'doc'  ||a == 'DOC' ||a == 'txt' ||a == 'TXT' ){
        var size = document.getElementById('vFile').files[0].size;
        if(size >= 100380334)
        {
            $(".modal-body").html( "<p>Please Upload the Image Having Size Upto 5MB!</p>" );
            $("#myalert").modal('show');  
            document.getElementById(name).value = "";
            return false; 
        }
        $("#vFile").val(val);
        return true;
    }
    else{
        $(".modal-body").html( "<p>Extenstion Is Not Valid. Please Upload Only (pdf,doc,txt) Files!!!</p>" );
        $("#myalert").modal('show');  
        document.getElementById(name).value = "";
        return false;     
    }
    
}
function CheckValidImageFile(val,name)
{
    var a = val.substring(val.lastIndexOf('.') + 1).toLowerCase();  
    if(a == 'png' || a == 'PNG' || a == 'jpg'  ||a == 'JPG' ||a == 'jpeg' ||a == 'JPEG' ){
        var size = document.getElementById('vFile').files[0].size;
        if(size >= 100380334)
        {
            $(".modal-body").html( "<p>Please Upload the Image Having Size Upto 5MB!</p>" );
            $("#myalert").modal('show');  
            document.getElementById(name).value = "";
            return false; 
        }
        $("#vFile").val(val);
        return true;
    }
    else{
        $(".modal-body").html( "<p>Extenstion Is Not Valid. Please Upload Only (png,jpg,jpeg) Files!!!</p>" );
        $("#myalert").modal('show');  
        document.getElementById(name).value = "";
        return false;     
    }
    
}

function returnme(){
    window.location.href = base_url+'flipbooks';
}


var editor; // use a global for the submit and return data rendering in the examples
 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        "ajaxUrl": base_url+"flipbooks/get_category_listing",
        "domTable": "#flipID",
        "fields": [ {
                "label": "User type:",
                "name": "flipID",
                "type": "checkbox"
            },
            {
                "label": "Title:",
                "name": "Title"
            }, 
            {
                "label": "File:",
                "name": "File"
            }, 
            {
                "label": "Add Date:",
                "name": "AddDate"
            }, 
            {
                "label": "Status:",
                "name": "Status"
            }, 
            {
                "label": "Edit:",
                "name": "editlink"
            }
        ]
    } );
 
    $('#flipID').dataTable( {
        "iDisplayLength":25,
        "sAjaxSource": base_url+"flipbooks/get_category_listing",
	"aaSorting": [[6,'desc']],
        "aoColumns": [
            { "mData": "flipID","bSortable": false},
            { "mData": "File" },
            { "mData": "Title" },
            { "mData": "AddDate" },            
            { "mData": "Status" },
            { "mData": "editlink","bSortable": false }            
        ],
        "oTableTools": {
            "sRowSelect": "multi",
            "aButtons": [
                { "sExtends": "editor_create", "editor": editor },
                { "sExtends": "editor_edit",   "editor": editor },
                { "sExtends": "editor_remove", "editor": editor }
            ]
        }
    } );
} );


 
