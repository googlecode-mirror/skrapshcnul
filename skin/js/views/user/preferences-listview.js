window.PreferencesListView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Preferences List View');
        this.template = _.template(tpl.get('user/preferences-listview'));
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