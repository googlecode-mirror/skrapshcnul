window.IdeasListView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Lunches List View');
        this.template = _.template(tpl.get('idea/ideas-listview'));
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