/*global Demo, Backbone, JST*/

App.Views = App.Views || {};

(function () {
    'use strict';

    App.Views.Menu = Backbone.View.extend({

        
        el : $("#menu"),
        template : _.template( $("#menu_template").html() ),

        initialize: function () {
            this.listenTo( this.collection, 'change', this.show );
            this.listenTo( this.collection, 'add',    this.render );
        },

        update : function(target){
            this.collection.each(function(item){
                item.match(target);
            });
        },

        render : function (e) {
            var templ = this.template(e.attributes);
            this.$el.append(templ);
        },

        show : function (e) {

            var obj = e.attributes;

            if (obj.visible){
                $("#"+obj.dom_id).show();
            }else{
                $("#"+obj.dom_id).hide();
            }
        }

    });

})();
