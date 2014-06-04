
App.Views = App.Views || {};

(function () {
    'use strict';

    App.Views.Search = Backbone.View.extend({

        el: $('#search_box'), 

        initialize: function () {

            var self = this;

            this.menu = new App.Views.Menu({
                collection : this.collection
            });

            this.$el.on("keyup", 
                function(e){
                    self.menu.update(e.target.value);
                }
            );
        }
    });

})();
