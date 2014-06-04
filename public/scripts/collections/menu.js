/*global Demo, Backbone*/

App.Collections = App.Collections || {};

(function () {
    'use strict';

    App.Collections.Restaurants = Backbone.Collection.extend({

		url: '/index/restaurants',
        model: App.Models.Restaurant
    });

})();
