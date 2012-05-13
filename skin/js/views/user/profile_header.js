window.ProfileHeaderView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Profile Header View');
        this.template = _.template(tpl.get('user/profile_header'));
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