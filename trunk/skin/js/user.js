// Author: Thomas Davis <thomasalwyndavis@gmail.com>
// Filename: user.js

// Require.js allows us to configure shortcut alias
require.config({
  paths: {
    jquery: '/skin/libs/jquery/jquery-min',
    underscore: '/skin/libs/underscore/underscore-min',
    backbone: '/skin/libs/backbone/backbone-optamd3-min',
    text: '/skin/libs/require/text'
  }

});

require(['views/app'], function(AppView){
  var app_view = new AppView;
});
