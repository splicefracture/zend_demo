/*global Demo, $*/

_.mixin(_.str.exports());

window.App = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},
    init: function () {
        'use strict';

        var restaurants = new App.Collections.Restaurants();
 
        restaurants.fetch();

        new App.Views.Search({
            collection : restaurants
        });
    }
};

$(document).ready(function () {
    'use strict';
    App.init();
});
