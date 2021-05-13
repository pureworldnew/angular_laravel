Vue.directive('selected', {
    bind: function () {

    },
    update: function (newValue, oldValue) {
        if(newValue==0)
        {
            this.el.selected = true;
        }
        return "";
    },
    unbind: function () {

    }
});