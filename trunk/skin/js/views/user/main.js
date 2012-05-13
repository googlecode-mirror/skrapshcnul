var AppRouter = Backbone.Router.extend({

    routes:{
        "":"activity",
        "activity":"activity",
        "ideas":"ideas",
        "lunches":"lunches",
        "people": "people",
        "preferences":"preferences",
        "projects":"projects"
    },

    initialize:function () {
        // this.headerView = new HeaderView();
        //$('.header').html(this.headerView.render().el);
        
        this.profileHeaderView = new ProfileHeaderView();
        $('#profile_header').html(this.profileHeaderView.render().el);
        
        // Close the search dropdown on click anywhere in the UI
        $('body').click(function () {
            $('.dropdown').removeClass("open");
        });
    },

    activity:function () {
        // Since the home view never changes, we instantiate it and render it only once
        if (!this.activitiesListView) {
            this.activitiesListView = new ActivitiesListView();
            this.activitiesListView.render();
        }
        $('#content').html(this.activitiesListView.el);
    },
	
    ideas:function (id) {
        if (!this.ideasListView) {
            this.ideasListView = new IdeasListView();
            this.ideasListView.render();
        }
        $('#content').html(this.ideasListView.el);
    },
    
	
    lunches:function (id) {
        if (!this.lunchesListView) {
            this.lunchesListView = new LunchesListView();
            this.lunchesListView.render();
        }
        $('#content').html(this.lunchesListView.el);
    },
	
    people:function (id) {
        if (!this.usersIconView) {
            this.usersIconView = new UsersIconView();
            this.usersIconView.render();
        }
        $('#content').html(this.usersIconView.el);
    },

    preferences:function () {
        if (!this.preferencesListView) {
            this.preferencesListView = new PreferencesListView();
            this.preferencesListView.render();
        }
        $('#content').html(this.preferencesListView.el);
    },
	
    projects:function (id) {
        if (!this.projectsGridView) {
            this.projectsGridView = new ProjectsGridView();
            this.projectsGridView.render();
        }
        $('#content').html(this.projectsGridView.el);
    },
    
    contacts:function (id) {
        var employee = new Employee({id:id});
        employee.fetch({
            success:function (data) {
                // Note that we could also 'recycle' the same instance of EmployeeFullView
                // instead of creating new instances
                $('#content').html(new EmployeeFullView({model:data}).render().el);
            }
        });
    }

});

tpl.loadTemplates(templates_array,
    function () {
        app = new AppRouter();
        Backbone.history.start();
    });