Vue.directive('datepicker', {

    //acceptStatement: true,

    bind: function () {
        var vm = this.vm;
        var key = this.expression;
        // key = key.replace("$index", this.attributes.index.nodeValue);

        $(this.el).datepicker({
            dateFormat: "yy-mm-dd",
            firstDay: 1,
            onSelect: function (date) {
                var resultsId = this.attributes.getNamedItem('index').value;
                key = key.replace("$index", resultsId);
                vm.$set(key, date);
                var dateTimeKey = key.replace('startDate', 'startDateTimeObj');
                vm.$set(dateTimeKey, $(this).datepicker('getDate'));
                // shouldn't be necessary anymore vm.$dispatch('dateSelected', resultsId);
            }
        });
    },
    update: function (val) {
        $(this.el).datepicker('setDate', val);
    }

});