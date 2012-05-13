window.User = Backbone.Model.extend({

    urlRoot:"../api/user",

    initialize:function () {
        this.reports = new EmployeeCollection();
        this.reports.url = '../api/employees/' + this.id + '/reports';
    }

});

window.UserCollection = Backbone.Collection.extend({

    model:Employee,

    url:"../api/employees",

    findByName:function (key) {
        // TODO: Modify service to include firstName in search
        var url = (key == '') ? '../api/employees' : "../api/employees/search/" + key;
        console.log('findByName: ' + key);
        var self = this;
        $.ajax({
            url:url,
            dataType:"json",
            success:function (data) {
                console.log("search success: " + data.length);
                self.reset(data);
            }
        });
    }

});