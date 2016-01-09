var editor; 
$(document).ready(function() {
    editor = new $.fn.dataTable.Editor({
        "ajaxUrl": base_url+"user/getUserListing",
        "domTable": "#userlisting",
        "fields": [ {
                "label":"iUserId:",
                "name": "id",
                "type": "checkbox"
            },
            {
                "label":"Name:",
                "name": "vName"
            },
            {
                "label": "Email",
                "name": "vEmail"
            },
            {
                "label": "Role",
                "name": "eRole"
            },
            {
                "label": "Status:",
                "name": "eStatus"
            },
            {
                "label": "Edit:",
                "name": "editlink"
            }
        ]
    });

    $('#userlisting').dataTable( {
        "sAjaxSource": base_url+"user/getUserListing",
        "aaSorting": [],
        "aoColumns": [
            { "mData": "id","bSortable": false},
            { "mData": "vName" },
            { "mData": "vEmail" },
            { "mData": "eRole" },
            { "mData": "eStatus" },
            { "mData": "editlink","bSortable": false }
        ],
        "oTableTools": {
            "sRowSelect": "multi",
            "aButtons": [
                { "sExtends": "editor_create", "editor": editor },
                { "sExtends": "editor_edit",   "editor": editor },
                { "sExtends": "editor_remove", "editor": editor }
            ]
        },
        "language": {
            "zeroRecords": "No records available"
        }
    });
}); 
