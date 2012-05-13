window.UsersIconView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Users Icon View');
        this.template = _.template(tpl.get('user/users-iconview'));
    },

    events:{
        "click #showMeBtn":"showMeBtnClick"
    },

    render:function (eventName) {
        $(this.el).html(this.template());
        return this;
    },

    showMeBtnClick:function () {
        app.headerView.search();
    }

});