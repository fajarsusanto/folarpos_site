/*Jsgrid Init*/
$(function() {
	"use strict";
	
    $("#jsgrid_type").jsGrid({
        height: "450px",
        width: "100%",
 
        filtering: true,
        editing: true,
        sorting: true,
        paging: true,
        autoload: true,
 
        pageSize: 10,
        pageButtonCount: 5,
 
        deleteConfirm: "Do you really want to delete the type?",
 
        controller: db,
 
        fields: [
            { name: "Type", type: "text", width: 150 },
            { type: "control" }
        ]
    });
 
});