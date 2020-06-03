angular.module('App', [])
  .controller('MainController', function() {
      var me = this;
      var count = 0;
      me.total_counter = count;
      me.total_unit = 33;
      me.tmp_unit = 0;
      

      me.minus = function() {
        if (me.total_counter > 0) {
					me.total_counter--;
					me.tmp_unit--;
        }
      };

      me.plus = function() {
        me.total_counter++;
        me.tmp_unit++;
        if (me.tmp_unit > me.total_unit) {
          me.tmp_unit = 1;
        }
      };

      me.reset = function() {
        me.total_counter = 0;
        me.tmp_unit = 0;
      };

      me.change_unit = function() {
        if (me.total_unit == 33) {
          me.total_unit = 99;
        }else{
					me.total_unit = 33;
					if (me.tmp_unit > me.total_unit) {
						me.tmp_unit = me.tmp_unit - me.total_unit;
					}
        }
      };

      me.test = function() {
        alert("hi");
      };
  });