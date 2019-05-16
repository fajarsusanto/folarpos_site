(function() {

    var db = {

        loadData: function(filter) {
            return $.grep(this.type, function(client) {
                return (!filter.Type || client.Type.indexOf(filter.Type) > -1);
            });
        },

        insertItem: function(insertingClient) {
            this.type.push(insertingClient);
        },

        updateItem: function(updatingClient) { 
        $.ajax({
            url: $("#forms").attr('action'),
            data: $("#forms").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
               alert(json.msg);
            }
        });
        },

        deleteItem: function(deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.type);
            this.type.splice(clientIndex, 1);
        }

    };

    window.db = db;

    db.type = [
        {
            "Type": "Otto Clay",
           
           
        },
        {
            "Type": "Connor Johnston",
           
           
        },
        
    ];

   

}());