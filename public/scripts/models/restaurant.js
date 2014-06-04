/*global Demo, Backbone*/

App.Models = App.Models || {};

(function () {
    'use strict';

    App.Models.Restaurant = Backbone.Model.extend({

        initialize: function() {
            var dom_id = "menu_view_"+this.get("id");
            this.set("dom_id", dom_id );
        },

        defaults: {
            visible : false
        },

        validate: function(attrs, options) {
        },

        parse: function(response, options)  {
            return response;
        },

        match: function(target){

            if (_.isEmpty(target)){
                this.set("visible",false);
                return;
            }

            var tlow = target.toLowerCase();
            var name    = this.get('name').toLowerCase();
            var cuisine = this.get('cuisine').toLowerCase();

            var show  = _(name).startsWith(tlow) || _(cuisine).startsWith(tlow);
            this.set("visible",show);
        }

    });

})();
