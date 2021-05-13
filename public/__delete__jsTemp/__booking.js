Vue.directive('datepicker', {

    //acceptStatement: true,

    bind: function () {
        var vm = this.vm;
        var key = this.expression;
        // key = key.replace("$index", this.attributes.index.nodeValue);

        $(this.el).datepicker({
            dateFormat: "yyyy-mm-dd",
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

new Vue({
    el: '#vueApp',
    config: {
        debug: true
    },
    events: {
        /* "dateSelected": function (resultId) {
         this.checkProductAvailAllDay(resultId);
         },*/
        "addToBookingEvent": function (productId, resultId, productAvailable, availMessage) {
            this.addToBooking(productId, resultId, productAvailable, availMessage);
        },
    },

    data: {
        priceType: undefined,
        durationHours: undefined,
        durationDays: undefined,
        message: 'hello',
        primaryCategoryId: 0,
        childCategoryId: 0,
        showSubCategories: false,
        showSearchCriteria: false,
        quantity: "",
        startDate: "",
        startDateTime: undefined,
        startDateObj: undefined,
        timeType: undefined,
        results: [],
        //endDate: $('#startDate').datepicker( 'getDate' ).getMonth(),
        shoppingCart: [],
        products: [],
        availabilityMessage: "There is not enough of the product available",
        pendingBookings: [],
        bookingMade: false,
        bookingId: 0,
        showResults: false,
        noResults: false,
        showYouChosen: false

    },

    created: function() {
        $.getJSON('api/products/1', function (products) {
            this.products = products;
        });

        var that = this;

        $( "#startDate" ).datepicker({

            onSelect: function(date) {

                that.startDate = date;
                that.startDateTimeObj = $(this).datepicker('getDate');

            }

        });

    },

    methods: {

        checkProductAvail: function (productId, resultId) {


            //RemoveDateFromResults - var prodStartDateObj = this.addTimeToDate(this.products[resultId].startDateTimeObj, this.products[resultId].startTime);
            var prodStartDateObj = this.addTimeToDate(this.startDateTimeObj, this.products[resultId].startTime);

            var prodEndDateObj = this.getEndDate(
                prodStartDateObj,
                this.products[resultId].startTime,
                this.products[resultId].productTimeType,
                this.products[resultId].durationHours,
                this.products[resultId].durationDays);

            var prodStartDateTime = this.addTimeToDate(prodStartDateObj, this.products[resultId].startTime);

            var formattedProdStartDateTime = this.formatDate(prodStartDateTime);
            var formattedProdEndDateTime = this.formatDate(prodEndDateObj);

            this.getProductAvailability(resultId, formattedProdStartDateTime, formattedProdEndDateTime, this.products[resultId].quantity, true, this.products[resultId].productTimeType, this.products[resultId].durationHours, this.products[resultId].durationDays);

        },

        /* checkProductAvailAllDay: function (resultId) {

         var startDateObj = this.products[resultId].startDateTime;
         var endDateObj = new Date(startDateObj.getTime());
         //endDateObj.setDate(startDateObj.getDate() + 1);

         var startDateTime = this.addTimeToDate(startDateObj, '06:00');
         var endDateTime = this.addTimeToDate(endDateObj, '23:00');

         var formattedProdStartDateTime = this.formatDate(startDateTime);
         var formattedProdEndDateTime = this.formatDate(endDateTime);

         this.getProductAvailability(resultId, formattedProdStartDateTime, formattedProdEndDateTime, this.products[resultId].startDateTime, false);
         },*/

        getProductAvailability: function (resultId, startDateTime, endDateTime, quantity, triggerAddToBooking, productTimeType, durationHours, durationDays) {

            var that = this;
            var productId = that.results[resultId].id;

            $.ajax({
                type: "GET",
                url: "api/productAvail",
                data: {
                    'productId' : that.results[resultId].id,
                    'startDateTime' : startDateTime,
                    'endDateTime' : endDateTime,
                    'quantity' : quantity
                },
                success: function(response) {

                    var availMessage = "";

                    if(response.data.length > 0)
                    {
                        that.results[resultId].numberOfProductsBooked = response.data[0].numberOfProductsBooked;
                        that.results[resultId].productTimeType = response.data[0].productTimeType;
                        that.results[resultId].durationHours = response.data[0].durationHours;
                        that.results[resultId].durationDays = response.data[0].durationDays;

                        var thereIsEnough = false;

                        if ((parseInt(response.data[0].numberOfProductsBooked,10) + parseInt(quantity, 10) ) <= parseInt(response.data[0].quantity, 10))
                        {
                            thereIsEnough = true;
                        }

                        if(triggerAddToBooking && thereIsEnough)
                        {
                            var productAvailable = false;

                            if (response.data.length > 0)
                            {
                                if(parseInt(response.data[0].quantity, 10) - parseInt(response.data[0].numberOfProductsBooked, 10) > 0)
                                {
                                    /* if(that.pendingBookings[productId] === undefined || parseInt(response.data[0].quantity, 10) - parseInt(that.pendingBookings[productId], 10) > 0)
                                     {
                                     */
                                    productAvailable = true;
                                    /*}
                                     else
                                     {
                                     productAvailable = false;
                                     availMessage = "There is availabilty, but with your pending bookings there is no availability.";
                                     }
                                     */
                                }

                            }
                            else
                            {
                                availMessage = that.availabilityMessage;
                            }


                            that.$dispatch('addToBookingEvent', productId, resultId, productAvailable, availMessage);
                            //positonic raise even with productAvailable and some error message with avail
                        }
                    }
                    else {
                        alert ('There is no stock available for that product for that date and time');
                    }

                    $('#addToBookingButton'+resultId+ " span").removeClass('spinning');


                },
                dataType: "json"
            });

        },

        searchSubmit: function () {

            if (this.quantity == "")
            {
                this.quantity = "1";
            }

            if (this.quantity !== "" && this.primaryCategoryId !== 0 && this.startDate !== "")
            {

                //this.startDateTimeObj = this.addTimeToDate(this.startDateTimeObj, this.startTime);

                //this.endDateTimeObj = this.getEndDate(this.startDateTimeObj, this.startTime, this.timeType, this.durationHours, this.durationDays);

                this.formattedStartDateTime = this.formatDate(this.startDateTimeObj);
               // this.formattedEndDateTime = this.formatDate(this.endDateTimeObj);

                var that = this;
                //var results = this.results;
                $.ajax({
                    type: "GET",
                    url: "api/search",
                    data: {
                        quantity: this.quantity,
                        primaryCategoryId: this.primaryCategoryId,
                        childCategoryId: this.childCategoryId,
                        startDate: this.formattedStartDateTime/*,
                        endDate: this.formattedEndDateTime,
                        durationHours: this.durationHours,
                        durationDays: this.durationDays,
                        timeType: this.timeType*/
                    },
                    success: that.displaySearchResults,
                    dataType: "json"
                });
            }
            else
            {
                alert("can't submit");
            }

        },

        formatDate: function (date) {

            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear(),
                hour = d.getHours(),
                mins = d.getMinutes(),
                secs = d.getSeconds();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;
            if (hour.length < 2) hour = '0' + hour;
            if (mins.length < 2) mins = '0' + mins;
            if (secs.length < 2) secs = '0' + secs;

            return [year, month, day].join('-') + " " + [hour, mins, secs].join(':');
        },

        getEndDate: function(startDateTime, startTime, timeType, durationHours, durationDays) {

            var endDateTime = new Date(startDateTime.getTime());

            if ( timeType === "perDay" && durationDays != "")
            {
                endDateTime.setDate(startDateTime.getDate() + parseInt(durationDays, 10));
            }
            /*else if (timeType == "2")
            {
                endDateTime.setDate(startDateTime.getDate() + parseInt(durationDays / 2, 10));
            }
            */
            else if (timeType == "perHour" && durationHours != "")
            {
                endDateTime.setTime(startDateTime.getTime() + (parseInt(durationHours, 10)*60*60*1000));
            }

            return endDateTime;

        },

        addTimeToDate : function (startDateTime, startTime)
        {
            var timesplit = startTime.split(':');

            startDateTime.setHours(timesplit[0]);
            startDateTime.setMinutes(timesplit[1]);

            return startDateTime;
        },

        displaySearchResults: function(response) {
            this.results = response.data;

            if(response.data.length > 0)
            {
                this.noResults = false;
                this.showResults = true;
            }
            else
            {
                this.noResults = true;
            }

        },

        parentClick: function (event) {
            //   this.primaryCategoryId =
            this.removeSelecteds("");   //.subCategory

            this.showSearchCriteria = true;
            
            this.addSelected(event.target);

            this.primaryCategoryId = this.getPrimaryCategoryId(event.target);

            this.shouldShowSubCategories(this.primaryCategoryId);

            this.hideAllSubCategories();

            this.showThisPrimarySubCategories(this.primaryCategoryId);


        },

        removeCartItem: function(bookingLocationId)
        {
            var that = this;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "api/booking/removeCartItem",
                data: {
                    bookingLocationId
                },
                success: function (success) {

                    if (parseInt(success, 10) === 1)
                    {
                        alert('Item successfully deleted');
                        that.removeCartItemFromCart(bookingLocationId);
                    }
                    else
                    {
                        alert('there was an error removing booking locationid '+bookingLocationId);
                    }

                },
                dataType: "text"
            });

        },

        removeCartItemFromCart: function(bookingLocationId)
        {
            for(var i = 0; i< this.shoppingCart.length; i++){

                if (parseInt(this.shoppingCart[i].bookingLocationId, 10) === parseInt(bookingLocationId, 10))
                {
                    this.shoppingCart.splice(i, 1);
                }
            }


        },

        addToBooking: function (productId, resultId, productAvailable, availMessage) {

            if(productAvailable) {

                $('#addToBookingButton'+resultId+ " span").removeClass('spinning');

                var that = this;

                this.products.forEach(function (product, productIndex) {

                    product.added = false;

                    if (productIndex == resultId) {
                        product.added = true;

                        that.results.forEach(function (resultItem, resultIndex) {

                            if (resultItem.id == productId) {

                                if (parseInt(resultItem.quantity, 10) - parseInt(resultItem.numberOfProductsBooked, 10) >= parseInt(product.quantity)) {


                                    //var usePrice =  product.productTimeType

                                   /* var usePrice =  resultItem.prices(function(index){
//jpfjpf
                                    });*/

                                    var imageUrl = "";
                                    
                                    if (resultItem.product_images.length > 0)
                                    {
                                        imageUrl = resultItem.product_images[0].image;
                                    }

                                    that.shoppingCart.push(
                                        {
                                            productId: productId,
                                            name: resultItem.name,
                                            description: resultItem.description,
                                            category_id: resultItem.category_id,
                                            category_name: resultItem.category.name,
                                            image: imageUrl,
                                            productTimeType: product.productTimeType,
                                            added: true,
                                            quantity: product.quantity,
                                            durationHours: product.durationHours,
                                            durationDays: product.durationDays,
                                            //startDate: product.startDate,
                                            startDate:  that.startDate,
                                            startDateTime: product.startDateTime,
                                            //startDateTimeObj: product.startDateTimeObj,
                                            startDateTimeObj: that.startDateTimeObj,
                                            test: "test",
                                            startTime: product.startTime,
                                            timeType: product.productTimeType
                                        });

                                    if(that.pendingBookings[productId] === undefined)
                                    {
                                        that.pendingBookings[productId] = parseInt(product.quantity, 10);
                                    }
                                    else
                                    {
                                        that.pendingBookings[productId] = parseInt(that.pendingBookings[productId], 10) + parseInt(product.quantity, 10);
                                    }


                                    /*that.shoppingCart.$set(productIndex,
                                     {
                                     name: resultItem.name,
                                     description: resultItem.description,
                                     category_id: resultItem.category_id,
                                     productTimeType: product.productTimeType,
                                     added: true,
                                     quantity: product.quantity,
                                     durationHours: product.durationHours,
                                     durationDays: product.durationDays,
                                     id: resultItem.id,
                                     startDate: product.startDate,
                                     test: "test",
                                     startTime: product.startTime
                                     });*/


                                    /*
                                    var numberOfBookings = parseInt(resultItem.numberOfProductsBooked, 10) + parseInt(product.quantity, 10)/* + parseInt(that.pendingBookings[productId], 10);

                                    resultItem = Object.assign({}, resultItem, {
                                        numberOfProductsBooked: numberOfBookings,
                                    });
                                    that.results.$set(resultIndex, resultItem);

                                */
/*
                                    that.results.$set(resultIndex, {
                                        numberOfProductsBooked: numberOfBookings,
                                        name: resultItem.name,
                                        quantity: resultItem.quantity,
                                        id: resultItem.id,
                                        category_id: resultItem.category_id,
                                        description: resultItem.description,
                                        image: resultItem.image,
                                        created_at: resultItem.created_at,
                                        updated_at: resultItem.updated_at
                                    });*/

                                    console.log("quanttity - " + parseInt(resultItem.quantity, 10));
                                    console.log("no bookings" + parseInt(resultItem.numberOfProductsBooked, 10));
                                    console.log("avail > " + (parseInt(resultItem.quantity, 10) - parseInt(resultItem.numberOfProductsBooked, 10)));

                                }
                                else {
                                    alert("You have requested " + product.quantity + " items.  There are only " + (parseInt(resultItem.quantity, 10) - parseInt(resultItem.numberOfProductsBooked, 10)) + " available.");
                                }

                                /*this.shoppingCart.$set(i, { description:  this.results[j].description });*/
                                //that.shoppingCart.$set(productIndex, {category_id: resultIndex.category_id});

                            }
                        });
                    }
                });

                if(!this.bookingMade)
                {
                    this.makeBooking();
                    this.bookingMade = true;
                }
                else
                {
                    this.addItemToBooking(this.bookingId, that.shoppingCart[that.shoppingCart.length - 1], that.shoppingCart.length - 1);
                }


            }
            else
            {
                alert(availMessage);
            }

            this.showYouChosen = true;
        },

        addToCart: function (productId, resultId) {

            this.bookingButtonActive = false;
            $('#addToBookingButton'+resultId+ " span").addClass('spinning');

            this.checkProductAvail(productId, resultId);

            return false;

        },

        sendBooking : function (booking) {

            var that = this;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "api/book",
                dataType: 'text',
                data: {
                    booking
                },
                success: function (bookingDetails) {

                    var bookSplit = bookingDetails.split("|");
                    console.log(bookSplit[0]);
                    that.bookingId = bookSplit[0];
                    /*that.shoppingCart[0].bookingLocationId = bookSplit[1];
                    that.shoppingCart[0].bookingProductPrice = bookSplit[2]; //jpfjpf*/

                    /* {};
                    cartItem.bookingLocationId = bookSplit[1];
                    cartItem.bookingProductPrice = bookSplit[2];*/

                    var cartItem = Object.assign({}, that.shoppingCart[0], { bookingLocationId: bookSplit[1], bookingProductPrice: bookSplit[2] })
                    that.shoppingCart.$set(0, cartItem);

                   /* that.shoppingCart.$set(0, {
                        bookingLocationId: bookSplit[1],
                        bookingProductPrice: bookSplit[2],

                        productId: cartItem.productId,
                        name: cartItem.name,
                        description: cartItem.description,
                        category_id: cartItem.category_id,
                        category_name: cartItem.category_name,
                        productTimeType: cartItem.productTimeType,
                        added: cartItem.added,
                        quantity: cartItem.quantity,
                        durationHours: cartItem.durationHours,
                        durationDays: cartItem.durationDays,
                        startDate: cartItem.startDate,
                        startDateTime: cartItem.startDateTime,
                        startDateTimeObj: cartItem.startDateTimeObj,
                        startTime: cartItem.startTime,
                        timeType: cartItem.productTimeType
                    });*/

                    this.bookingButtonActive = true;
                    //alert('Successfully added to cart. Booking Id is '+that.bookingId+". BL id is "+ that.shoppingCart[0].bookingLocationId+". Price is " + that.shoppingCart[0].bookingProductPrice);
                    //alert('Successfully added to cart. Booking Id is '+that.bookingId+".");
                },
                error: function (error) {
                    debugger
                    console.log(error);
                }
            });
        },



        addItemToBooking: function (bookingId, shoppingCartItem, cartIndex) {

            shoppingCartItem.bookingId = bookingId;

            //RemoveDateFromResults var startDateTimeObj = this.addTimeToDate(shoppingCartItem.startDateTimeObj, shoppingCartItem.startTime);
            var startDateTimeObj = this.addTimeToDate(this.startDateTimeObj, shoppingCartItem.startTime);

            var endDateTimeObj = this.getEndDate(startDateTimeObj, shoppingCartItem.startTime, shoppingCartItem.productTimeType, shoppingCartItem.durationHours, shoppingCartItem.durationDays);

            var formattedStartDateTime = this.formatDate(startDateTimeObj);
            var formattedEndDateTime = this.formatDate(endDateTimeObj);

            shoppingCartItem.startDateTime = formattedStartDateTime;
            shoppingCartItem.endDateTime = formattedEndDateTime;

            var that = this;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "api/book/product",
                data: {
                    shoppingCartItem
                },
                success: function (response) {

                    var bookSplit = response.split("|");

                    /*shoppingCartItem.bookingLocationId = response[0];
                    shoppingCartItem.bookingProductPrice = response[1];*/

                    var cartItem = Object.assign({}, that.shoppingCart[cartIndex], {
                        bookingLocationId: bookSplit[0],
                        bookingProductPrice: bookSplit[1]
                    });

                    that.shoppingCart.$set(cartIndex, cartItem);

                    /*that.shoppingCart.$set(cartIndex, {
                        bookingLocationId: response[0],
                        bookingProductPrice: response[1]
                    });*/
                    this.bookingButtonActive = true;
                    alert('Add to cart successfull!');

                },
                error: function (e) {
                    debugger
                },
                dataType: "text"
            });
        },

        addSelected: function (element) {

            $(element).addClass('selected');

        },

        childClick: function (event) {
            this.removeSelecteds(".subCategory");   //.subCategory
            this.childCategoryId = this.getSecondaryCategoryId(event.target);
            this.addSelected(event.target);
        },

        getPrimaryCategoryId: function (clickedElement) {
            var parentIdClassString = $.grep(clickedElement.className.split(" "), function(v, i){
                return v.indexOf('parentId') === 0;
            }).join();

            return parentIdClassString.substring(parentIdClassString.indexOf('parentId') + 8);


        },

        getSecondaryCategoryId: function(clickedElement) {
            var childIdClassString = $.grep(clickedElement.className.split(" "), function(v, i){
                return v.indexOf('categoryId') === 0;
            }).join();
            return childIdClassString.substring(childIdClassString.indexOf('categoryId') + 10);

        },

        showThisPrimarySubCategories: function(parentId) {
            $(".childOf"+parentId).each(function(){

                $(this).show();

            });
        },

        hideAllSubCategories: function() {
            $(".subCategory").hide();
        },

        removeSelecteds: function(parentBlock)
        {
            $(parentBlock+'.selected').each(function(){
                $(this).removeClass('selected');
            });
        },

        shouldShowSubCategories: function(primaryCategoryId) {

            if (primaryCategoryId != 0 && this.categoryHasChildren(primaryCategoryId))
            {
                this.showSubCategories = true;
            }
            else
            {
                this.showSubCategories =  false;
            }
        },

        categoryHasChildren: function(primaryCategoryId) {

            if($('.childOf'+primaryCategoryId).length > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        },

        updateShoppingCartItemFromProductListForm: function(shoppingCartItem, index)
        {

            shoppingCartItem.quantity = this.products[index].quantity;
            /*shoppingCartItem.startDate = this.products[index].startDate;
            shoppingCartItem.startDateObj = this.products[index].startDateObj;*/
            shoppingCartItem.startDate = this.startDate;
            shoppingCartItem.startDateObj = this.startDateObj;
            shoppingCartItem.startTime = this.products[index].startTime;
            shoppingCartItem.productTimeType = this.products[index].productTimeType;
            shoppingCartItem.durationHours = this.products[index].durationHours;
            shoppingCartItem.durationDays = this.products[index].durationDays;

            return shoppingCartItem;

        },

        makeBooking: function(event) {
            //"[{"name":"Best Canoe1","description":"This is the best Canoe we have seen","category_id":"3","added":true,"quantity":"2","id":1}]"
            if (event !== undefined)
            {
                event.preventDefault();
            }

            var that = this;

            var booking = {};

            booking.shoppingCart = this.shoppingCart;
            booking.startDateTime = this.formattedStartDateTime;
            booking.endDateTime = this.formattedEndDateTime;
            booking.shoppingCart.forEach(function (shoppingCartItem, index) {

                shoppingCartItem = that.updateShoppingCartItemFromProductListForm(shoppingCartItem, index);

                if (shoppingCartItem.startDate === undefined)
                {
                    shoppingCartItem.startDate = booking.startDateTime;
                }
               /* else
                {*/
                    var startDateTimeObj = that.addTimeToDate(shoppingCartItem.startDateTimeObj, shoppingCartItem.startTime);

                    var endDateTimeObj = that.getEndDate(startDateTimeObj, shoppingCartItem.startTime, shoppingCartItem.productTimeType, shoppingCartItem.durationHours, shoppingCartItem.durationDays);

                    var formattedStartDateTime = that.formatDate(startDateTimeObj);
                    var formattedEndDateTime = that.formatDate(endDateTimeObj);

                    shoppingCartItem.startDateTime = formattedStartDateTime;
                    shoppingCartItem.endDateTime = formattedEndDateTime;
               // }
            });

            this.booking = booking;

            this.sendBooking(booking);

            return false;

        }
    }
});

//Vue.config.debug = true;
/*$(document).ready(function() {

 var category = [];

 $('.bookingOption').click(function() {
 if ($(this).hasClass('selected'))
 {
 $(this).removeClass('selected');
 }
 else
 {
 //$(this).parent().siblings().children().hasClass("selected");
 if($(this).hasClass('primaryCategory'))
 {
 category = [];

 $('.selected').each(function(){
 $(this).removeClass('selected');
 });

 var parentIdClassString = $.grep(this.className.split(" "), function(v, i){
 return v.indexOf('parentId') === 0;
 }).join();

 var parentId = parentIdClassString.substring(parentIdClassString.indexOf('parentId') + 8);

 category.push(parentId);

 $(".subCategory").hide();

 $(".childOf"+parentId).each(function(){

 $(this).show();

 });
 }
 else
 {
 var childIdClassString = $.grep(this.className.split(" "), function(v, i){
 return v.indexOf('childOf') === 0;
 }).join();
 var childId = parentIdClassString.substring(parentIdClassString.indexOf('parentId') + 8);

 category.push(childId);
 }
 $(this).addClass('selected');


 /!*var childOfClassString = $.grep(this.className.split(" "), function(v, i){
 return v.indexOf('childOf') === 0;
 }).join();
 *!/

 }
 });


 });*/
/*         addToCartOld: function (resultId, cartId) {

 var that = this;

 for (var i = 0; i < this.shoppingCart.length; i++) {
 this.shoppingCart[i].added = false;

 if (i == cartId) {
 this.shoppingCart[i].added = true;

 for (var j = 0; j < this.results.length; j++) {

 if (this.results[j].id == resultId) {

 if (parseInt(this.results[j].quantity, 10) - parseInt(this.results[j].numberOfProductsBooked, 10) >= parseInt(this.shoppingCart[i].quantity)) {
 this.shoppingCart.$set(i,
 {
 name: this.results[j].name,
 description: this.results[j].description,
 category_id: this.results[j].category_id,
 priceType: this.shoppingCart[i].priceType,
 added: true,
 quantity: this.shoppingCart[i].quantity,
 durationHours: this.shoppingCart[i].durationHours,
 durationDays: this.shoppingCart[i].durationDays,
 id: this.results[j].id,
 startDate: this.results[j].startDate
 });

 var numberOfBookings = (parseInt(this.results[j].numberOfProductsBooked, 10) + 1);

 //this.results.$set(j, { numberOfProductsBooked: numberOfBookings })
 }
 else {
 alert("You have requested " + this.shoppingCart[i].quantity + " items.  There are only " + (parseInt(this.results[j].quantity, 10) - parseInt(this.results[j].numberOfProductsBooked, 10)) + " available.");
 }

 /!*this.shoppingCart.$set(i, { description:  this.results[j].description });*!/
 this.shoppingCart.$set(i, {category_id: this.results[j].category_id});

 }
 }
 }

 }

 this.showYouChosen = true;

 },*/
