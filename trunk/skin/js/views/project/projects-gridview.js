window.ProjectsGridView = Backbone.View.extend({

    initialize:function () {
        console.log('Initializing Projects Grid View');
        this.template = _.template(tpl.get('project/projects-gridview'));
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