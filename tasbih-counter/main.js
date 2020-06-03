angular.module('App', [])
  .controller('MainController', function() {
      var me = this;
      var count = 0;
      me.total_counter = count;

      me.minus = function() {
          if (me.total_counter > 0) {
            me.total_counter--;
        }
      };

      me.plus = function() {
        me.total_counter++;
      };

      me.reset = function() {
        me.total_counter = 0;
      };

      me.test = function() {
        alert("hi");
      };
  });