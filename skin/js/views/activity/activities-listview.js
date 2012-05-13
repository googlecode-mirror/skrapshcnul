window.ActivitiesListView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Activities List View');
        this.template = _.template(tpl.get('activity/activities-listview'));
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