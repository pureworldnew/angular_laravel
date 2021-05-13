var dateUtil = (function () {

    /*var privateVar = "Ben Cherry",
        publicVar = "Hey there!";*/

    function getDateTimeString(startDate, startTime) {

        var prodStartDateObj = new Date(startDate);

        var prodStartDateTime = addTimeToDate(prodStartDateObj, startTime);

        return formatDate(prodStartDateTime);
    }

    function addHoursToTimeString(startTime, hoursToAdd)
    {
        var timesplit = startTime.split(':');

        var newHours = parseInt(timesplit[0], 10) + hoursToAdd;

        return newHours+":"+timesplit[1];
    }

    function addTimeToDate (startDateTime, startTime)
    {
        var timesplit = startTime.split(':');

        startDateTime.setHours(timesplit[0]);
        startDateTime.setMinutes(timesplit[1]);

        return startDateTime;
    }

    function formatDate (date) {

        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = '' + d.getFullYear(),
            hour = '' + d.getHours(),
            mins = '' + d.getMinutes(),
            secs = '' + d.getSeconds();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        if (hour.length < 2) hour = '0' + hour;
        if (mins.length < 2) mins = '0' + mins;
        if (secs.length < 2) secs = '0' + secs;

        return [year, month, day].join('-') + " " + [hour, mins, secs].join(':');
    }

    function getEndDate (startDateTime, startTime, timeType, durationHours, durationDays) {

        var endDateTime = new Date(startDateTime.getTime());

        if ( parseInt(timeType,10) === 2 && durationDays != "")
        {
            endDateTime.setDate(startDateTime.getDate() + parseInt(durationDays, 10));
        }
        /*else if (timeType == "2")
         {
         endDateTime.setDate(startDateTime.getDate() + parseInt(durationDays / 2, 10));
         }
         */
        else if (parseInt(timeType,10) === 1 && durationHours != "")
        {
            endDateTime.setTime(startDateTime.getTime() + (parseInt(durationHours, 10)*60*60*1000));
        }

        return endDateTime;

    }

    function getEndDateTimeString (startDate, startTime, productTimeType, durationHours, durationDays)
    {
        var dateSplit = startDate.split('-');
        var timeSplit = startTime.split(':');

        var prodStartDateObj = new Date(dateSplit[0], dateSplit[1] - 1, dateSplit[2], timeSplit[0], timeSplit[1]);

        var prodEndDateObj = getEndDate(prodStartDateObj, startTime, productTimeType, durationHours, durationDays);

        return formatDate(prodEndDateObj);
    }
    // Reveal public pointers to
    // private functions and properties

    return {
        getDateTimeString   : getDateTimeString,
        addHoursToTimeString: addHoursToTimeString,
        getEndDate : getEndDate,
        getEndDateTimeString : getEndDateTimeString
    };

})();



    new Vue({
        el: '#vueApp',
        config: {
            debug: true
        },
        events: {
            "addToProductToBooking": function (productId, resultId, productAvailable, availMessage) {
                this.addToBooking(productId, resultId, productAvailable, availMessage);
            }
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
            startDate: (new Date().getFullYear()) + '-' + (('0' +new Date().getMonth()).slice(-2) + '-' + ('0' + new Date().getDate()).slice(-2)),
            startDateTime: undefined,
            startDateObj: undefined,
            timeType: undefined,
            results: [],
            //endDate: $('#startDate').datepicker( 'getDate' ).getMonth(),
            shoppingCart: [],
            products: [],
            availabilityMessage: "",
            pendingBookings: [],
            bookingMade: false,
            bookingId: 0,
            showResults: false,
            noResults: false,
           // showYouChosen: false,
            continueButtonActive: false,
            deleteSureMessage: "",
            totalPrice: 0,
            hasPriceAvailCriteria : false,
            afterInitialLoad : false,
            testFunc : (function () {
                return "testfunc";
            }),
            testFunc2 : this.totalPriceCalc,
            loadingCartFromServer : false,
            klarnaPaymentWidgetLoaded : false,
            productIdArray : []

        },

        created: function() {

            //Nation
            if ($("#bookingId").html() != "" && $("#bookingToken").html() != "")
            {
                this.bookingMade = true;
                this.bookingId = $("#bookingId").html();
                this.bookingToken = $("#bookingToken").html();
                this.loadShoppingCart(this.bookingId);
            }

            var that = this;
            var today = new Date();

            $( "#startDate" ).datepicker({
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                defaultDate: new Date(),

                onSelect: function(date) {

                    that.startDate = date;
                    that.startDateTimeObj = $(this).datepicker('getDate');
                    that.hideResults();
                    //that.$dispatch('pricingCriteriaChange');


                }

            });

            var todayString = (today.getFullYear()) + '-' + ('0' +(parseInt(today.getMonth(), 10) + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
            $( "#startDate" ).val(todayString);

            that.startDate = todayString;
            that.startDateTimeObj = today;

            this.afterInitialLoad = true;

            this.deleteSureMessage = $('#deleteSureMessage').html();
            this.availabilityMessage = $("#notEnough").html();
        },

        methods: {

            totalPriceCalc: function () {

                setTimeout(this.loadKlarnaPaymentWidget, 2000);

                this.totalPrice = this.shoppingCart.reduce(function(total, cartItem){

                    console.log(total, cartItem);
                    return total + parseFloat(cartItem.price);
                    //return total + (parseFloat(cartItem.price) * parseInt(cartItem.quantity));

                }, 0);


            },
            loadKlarnaPaymentWidget: function()
            {
                if(!this.klarnaPaymentWidgetLoaded)
                {
                    var script = document.createElement('script');
                    script.src = "https://cdn.klarna.com/1.0/code/client/all.js";
                    document.body.appendChild(script);

                    this.klarnaPaymentWidgetLoaded = true;
                }

            },
           /* getEndDateTimeString: function(resultId)
            {
                var dateSplit = this.startDate.split('-');
                var timeSplit = this.results[resultId].startTime.split(':');


                var prodStartDateObj = new Date(dateSplit[0], dateSplit[1] - 1, dateSplit[2], timeSplit[0], timeSplit[1]);
                //var prodStartDateTime = this.addTimeToDate(prodStartDateObj, result.startTime);
                var prodEndDateObj = dateUtil.getEndDate(
                    prodStartDateObj,
                    this.results[resultId].startTime,
                    this.results[resultId].productTimeType,
                    this.results[resultId].durationHours,
                    this.results[resultId].durationDays);

                return this.formatDate(prodEndDateObj);
            },*/

            getStartDateTimeString: function(resultId)
            {
                var prodStartDateObj = new Date(this.startDate);

                var prodStartDateTime = this.addTimeToDate(prodStartDateObj, this.results[resultId].startTime);

                return this.formatDate(prodStartDateTime);
            },

            getPriceAvail: function(resultId, result)
            {
                var that = this;
                var quantity = parseInt(result.quantity, 10);

                if(parseInt(result.per_type_id, 10) === 3 && quantity != 0)
                {
                    var startDateString = dateUtil.getDateTimeString(this.startDate, this.results[resultId].startTime);
                    var endDateString = dateUtil.getDateTimeString(this.startDate, dateUtil.addHoursToTimeString(this.results[resultId].startTime, 1));

                    this.getPrice(result.id, startDateString, endDateString, quantity, resultId, result.per_type_id);
                }
                else if(parseInt(result.per_type_id, 10) === 1 && quantity != 0 && (
                    !(result.durationDays === undefined || result.durationDays == 0) ||
                    !(result.durationHours === undefined || result.durationHours == 0))
                )
                {
                    this.getPrice(result.id, dateUtil.getDateTimeString(
                                        this.startDate, this.results[resultId].startTime),
                        dateUtil.getEndDateTimeString(this.startDate, this.results[resultId].startTime, this.results[resultId].productTimeType,
                            this.results[resultId].durationHours,
                            this.results[resultId].durationDays),
                            quantity, resultId, result.per_type_id);
                }
                else
                {
                    alert('Invalid time type id');
                }

                return false;
            },
            
            loadShoppingCart: function (bookingId)
            {
                var that = this;
                this.loadingCartFromServer = true;

                $.ajax({
                    type: "POST",
                    //url: "api/booking/products/"+bookingId,
                    url: "/api/fetchcart",
                    data: {
                        'bookingId': bookingId,
                        "bookingToken": this.bookingToken
                    },
                    success: function (response) {
                        response.products.forEach(that.addToShoppingCart);

                        that.totalPriceCalc();
                        that.loadingCartFromServer = false;


                    },
                    error: function (error) {
                        debugger
                    },
                    dataType: "json"
                });

            },

            getPrice: function(productId, startDateTime, endDateTime, quantity, resultId, perTypeId) {

                var that = this;

                $.ajax({
                    type: "GET",
                    url: "api/getPrice",
                    data: {
                        'productId': productId,
                        'startDateTime': startDateTime,
                        'endDateTime': endDateTime,
                        'quantity': quantity,
                        'perTypeId': perTypeId
                    },
                    success: function (response) {

                        var result = Object.assign({}, that.results[resultId], {
                            price: response.data.price,
                            priceMessage: response.message
                        });

                        that.results.$set(resultId, result);

                        return false;
                    },
                    error: function (error) {
                        debugger
                    },
                    dataType: "json"
                });
            },

            getProductAvailability: function (result, resultId, startDateTime, endDateTime, quantity) {

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
                        var isAvailable = false;

                        if(response.data.length > 0)
                        {
                            //if(parseInt(response.data[0].quantity, 10) - parseInt(response.data[0].bookings.length, 10) >= parseInt(quantity, 10))
                            if(parseInt(response.quantityAvailabile,10) > 0)
                            {

                                if(that.addToProductIdArray(result)) {
                                    isAvailable = true;
                                }
                                else
                                {
                                    $('#addToBookingButton'+result.id+ " span").removeClass('spinning');
                                    alert($('#sameProductDateTimeError').html());
                                }

                            }
                        }
                        else {
                            availMessage = that.availabilityMessage;

                        }

                        that.$dispatch('addToProductToBooking', productId, resultId, isAvailable, availMessage);

                        $('#addToBookingButton'+resultId+ " span").removeClass('spinning');


                    },
                    error: function(error) {

                        debugger
                    },
                    dataType: "json"
                });

            },


            searchSubmit: function (evt) {

                evt.preventDefault();
                this.hideResults();

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

            /*getEndDate: function(startDateTime, startTime, timeType, durationHours, durationDays) {

                var endDateTime = new Date(startDateTime.getTime());

                if ( parseInt(timeType,10) === 2 && durationDays != "")
                {
                    endDateTime.setDate(startDateTime.getDate() + parseInt(durationDays, 10));
                }
                /!*else if (timeType == "2")
                 {
                 endDateTime.setDate(startDateTime.getDate() + parseInt(durationDays / 2, 10));
                 }
                 *!/
                else if (parseInt(timeType,10) === 1 && durationHours != "")
                {
                    endDateTime.setTime(startDateTime.getTime() + (parseInt(durationHours, 10)*60*60*1000));
                }

                return endDateTime;

            },*/

            addTimeToDate : function (startDateTime, startTime)
            {
                var timesplit = startTime.split(':');

                startDateTime.setHours(timesplit[0]);
                startDateTime.setMinutes(timesplit[1]);

                return startDateTime;
            },

            showSearchResult: function(responseData, key) {

                var result = responseData[key];

                if (result.per_type_id == 1)
                {
                    result = Object.assign({}, result, {
                        startTime: result.start_times[0].start_time,
                        productTimeType: result.per_type_times_local[0].id,
                        timeTypeValue: result.per_type_times_local[0].type_time_value,
                        timeType: result.per_type_times_local[0].id,
                        durationDays: "",
                        quantity: "",
                        hasPriceAvailCriteria: false
                    });
                }
                else if(result.per_type_id == 2)
                {
                   /* result = Object.assign({}, result, {
                        startTime: result.start_times[0].start_time,
                        productTimeType: result.per_type_times[0].id,
                        timeTypeValue: result.per_type_times[0].type_time_value,
                        timeType: result.per_type_times[0].id,
                        durationDays: "",
                        quantity: "",
                        hasPriceAvailCriteria: false
                    });*/
                }
                else if(result.per_type_id == 3)
                {
                    if(result.start_times.length === 0)
                    {
                        alert(result.name + " doesn't have any open start times");
                    }
                    else
                    {
                        result = Object.assign({}, result, {
                            startTime: result.start_times[0].start_time,
                            quantity: "",
                            hasPriceAvailCriteria: false
                        });
                    }


                }

                responseData.$set(key, result);
            },


            displaySearchResults: function(response) {

                var responseData = response.data;
                var that = this;

                responseData.forEach(function(result, key){

                    that.showSearchResult(responseData, key);

                });

                this.results = responseData;

                if(response.data.length > 0)
                {
                    this.noResults = false;
                   // setTimeout(this.setFirstSelect, 1000);

                    this.showResults = true;

                }
                else
                {
                    this.noResults = true;
                }

            },

            /*setFirstSelect: function() {
                $(".selectBox").each(function(){
                    $(this).val($(this).find("option:first").val());
                });
            },*/

            parentClick: function (event) {
                //   this.primaryCategoryId =

                this.hideResults();

                this.removeSelecteds("");   //.subCategory

                this.showSearchCriteria = true;

                if(event.target.nodeName == "IMG")
                {
                    element = event.target.parentElement;
                }
                else {
                    element = event.target;
                }

                this.addSelected(element);

                this.primaryCategoryId = this.getPrimaryCategoryId(element);

                this.shouldShowSubCategories(this.primaryCategoryId);

                this.hideAllSubCategories();
                this.childCategoryId = 0;
                this.showThisPrimarySubCategories(this.primaryCategoryId);


            },

            removeCartItem: function(bookingLocationId, price)
            {
                //jpf
                if (confirm(this.deleteSureMessage))
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
                                //that.totalPrice = parseFloat(that.totalPrice, 10) - price;
                                that.totalPriceCalc();
                            }
                            else
                            {
                                alert('there was an error removing booking locationid '+bookingLocationId);
                            }

                        },
                        dataType: "text"
                    });
                }
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
                   
                    this.results.$set(resultId, Object.assign({}, this.results[resultId], {
                        priceMessage: "{{trans('booking/index.addToCartSuccess')}}"
                    }));

                    $('#addToBookingButton'+resultId+ " span").removeClass('spinning');

                    var that = this;

                    this.results.forEach(function (resultItem) {

                        if(resultItem.id == productId)
                        {
                            that.addToShoppingCart(resultItem, false);
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
                    alert(this.availabilityMessage);
                }

                //this.showYouChosen = true;
            },

            calcCartItemPrice: function(cartItem)
            {
                //console.log("calcCartItemPrice > " + cartItem.price);
                if(typeof cartItem.price === "undefined")
                {
                    $price =  0;
                }
                else
                {
                    $price = cartItem.price;
                }

                if(!this.loadingCartFromServer)
                {
                    $returnPrice = $price * cartItem.quantity;
                }
                else
                {
                    $returnPrice =  $price;

                }

                console.log("calcCartItemPrice > " + $returnPrice);

                return $returnPrice;

            },

            addToShoppingCart: function(resultItem)
            {
                var imageUrl = "";

                if (resultItem.product_images !== undefined && resultItem.product_images.length > 0)
                {
                    imageUrl = resultItem.product_images[0].image;
                }
                else
                {
                    if(resultItem.image != "")
                    {
                        imageUrl = resultItem.image;
                    }
                }

                this.shoppingCart.push(
                    {
                        productId: resultItem.id,
                        name: resultItem.name,
                        description: resultItem.description,
                        category_id: resultItem.category_id,
                        category_name: (resultItem.category !== undefined) ? resultItem.category.name : resultItem.category_name,
                        image: imageUrl,
                        productTimeType: resultItem.productTimeType,
                        timeTypeValue: resultItem.timeTypeValue,
                        timeType: resultItem.timeType,
                        added: true,
                        quantity: resultItem.quantity,
                        durationHours: resultItem.durationHours,
                        durationDays: resultItem.durationDays,
                        startDate:  this.startDate,
                        startDateTime: resultItem.startDateTime,
                        endDateTime: resultItem.endDateTime,
                        startDateTimeObj: this.startDateTimeObj,
                        startTime: resultItem.startTime,
                        price: this.calcCartItemPrice(resultItem),
                        bookingLocationId: resultItem.bookingLocationId
                    });

                this.addToProductIdArray(resultItem);

                if(this.pendingBookings[resultItem.id] === undefined)
                {
                    this.pendingBookings[resultItem.id] = parseInt(resultItem.quantity, 10);
                }
                else
                {
                    this.pendingBookings[resultItem.id] = parseInt(this.pendingBookings[resultItem.id], 10) + parseInt(resultItem.quantity, 10);
                }

            },

            addToProductIdArray: function (resultItem) {

                var productUniqueId = resultItem.id+"-"+resultItem.startDateTime+"-"+resultItem.endDateTime;

                if($.inArray(productUniqueId, this.productIdArray) == -1)
                {
                    this.productIdArray.push(productUniqueId);

                    return true;
                }
                else
                {

                    return false;
                }
            },

            addToCart: function (resultId, result) {

                if(parseInt(result.quantity, 10) > 0)
                {
                    $('#addToBookingButton'+resultId+ " span").addClass('spinning');

                    if(parseInt(result.per_type_id, 10) === 3 && parseInt(result.quantity, 10) != 0)
                    {
                        var startDateString = dateUtil.getDateTimeString(this.startDate, result.startTime);
                        var endDateString = dateUtil.getDateTimeString(this.startDate, dateUtil.addHoursToTimeString(result.startTime, 1));
                    }
                    else {
                        var startDateString = dateUtil.getDateTimeString(this.startDate, result.startTime);
                        var endDateString = dateUtil.getEndDateTimeString(this.startDate, result.startTime, result.productTimeType,
                            result.durationHours,
                            result.durationDays);
                    }
                    //blockparty
                    result.startDateTime = startDateString;
                    result.endDateTime = endDateString;

                    this.getProductAvailability(result, resultId, startDateString, endDateString, result.quantity);


                }
                else
                {
                    alert($("#noZeroQuantity").html());
                }
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
                       // that.totalPrice = parseFloat(that.totalPrice,10) + parseFloat(bookSplit[2], 10);

                        var cartItem = Object.assign({}, that.shoppingCart[0], { bookingLocationId: bookSplit[1], price: bookSplit[2] })
                        that.shoppingCart.$set(0, cartItem);

                        that.totalPriceCalc();

                        //greenButton - activate here
                        $('#continueButton').prop('disabled', false);
                        $(".alert-success").show();
                        setTimeout(function() {
                            $(".alert-success").fadeOut(500);
                        }, 4000);
                    },
                    error: function (error) {
                        console.log("Error in get price. Error is" + error);
                    }
                });
            },

            hideResults: function()
            {
                this.results = [];
                this.noResults = false;
                this.showResults = false;
            },

            addItemToBooking: function (bookingId, shoppingCartItem, cartIndex) {

                shoppingCartItem.bookingId = bookingId;

                /*var startDateTimeObj = this.addTimeToDate(this.startDateTimeObj, shoppingCartItem.startTime);

                var endDateTimeObj = dateUtil.getEndDate(startDateTimeObj, shoppingCartItem.startTime, shoppingCartItem.productTimeType, shoppingCartItem.durationHours, shoppingCartItem.durationDays);

                var formattedStartDateTime = this.formatDate(startDateTimeObj);
                var formattedEndDateTime = this.formatDate(endDateTimeObj);

                shoppingCartItem.startDateTime = formattedStartDateTime;
                shoppingCartItem.endDateTime = formattedEndDateTime;*/

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

                        var cartItem = Object.assign({}, that.shoppingCart[cartIndex], {
                            bookingLocationId: bookSplit[0],
                            price: bookSplit[1]
                        });

                        that.shoppingCart.$set(cartIndex, cartItem);

                        //that.totalPrice = parseFloat(that.totalPrice,10) + parseFloat(bookSplit[1], 10);
                        that.totalPriceCalc();
                        $(".alert-success").show();
                        setTimeout(function() {
                            $(".alert-success").fadeOut(500);
                        }, 4000);
                       
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

          /*  updateShoppingCartItemFromProductListForm: function(shoppingCartItem, index)
            {

                shoppingCartItem.quantity = this.results[index].quantity;
                /!*shoppingCartItem.startDate = this.results[index].startDate;
                 shoppingCartItem.startDateObj = this.results[index].startDateObj;*!/
                shoppingCartItem.startDate = this.startDate;
                shoppingCartItem.startDateObj = this.startDateObj;
                shoppingCartItem.startTime = this.results[index].startTime;
                shoppingCartItem.productTimeType = this.results[index].productTimeType;
                shoppingCartItem.timeTypeValue = this.results[index].timeTypeValue;
                shoppingCartItem.timeType = this.results[index].timeType;
                shoppingCartItem.durationHours = this.results[index].durationHours;
                shoppingCartItem.durationDays = this.results[index].durationDays;

                return shoppingCartItem;

            },
*/
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

               // booking.shoppingCart.forEach(function (shoppingCartItem, index) {

                    //shoppingCartItem = that.updateShoppingCartItemFromProductListForm(shoppingCartItem, index);

                    /*if (shoppingCartItem.startDate === undefined)
                    {
                        shoppingCartItem.startDate = booking.startDateTime;
                    }*/

                    /*var startDateTimeObj = that.addTimeToDate(shoppingCartItem.startDateTimeObj, shoppingCartItem.startTime);

                    var endDateTimeObj = dateUtil.getEndDate(startDateTimeObj, shoppingCartItem.startTime, shoppingCartItem.productTimeType, shoppingCartItem.durationHours, shoppingCartItem.durationDays);

                    var formattedStartDateTime = that.formatDate(startDateTimeObj);
                    var formattedEndDateTime = that.formatDate(endDateTimeObj);

                    shoppingCartItem.startDateTime = formattedStartDateTime;
                    shoppingCartItem.endDateTime = formattedEndDateTime;*/

                //});

                this.booking = booking;

                this.sendBooking(booking);

                return false;

            }
        }
    });


