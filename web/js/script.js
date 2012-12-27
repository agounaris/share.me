$(function () {

    var userRole = $('#role-div').text();
	
	var ua = $.browser;

    var imageContainer = $('#image-container');
    var thumbContainer = $('.thumb-container');
    var methodSelect = $('#method-select');
    var comments = $('#comments-text');
    var commentFormDiv = $('#comment-form-div');
    var submitCommentButton = $('#submit-comment-button');
    var commentTextarea = $('#comment-textarea');
    var cancelCommentButton = $('#cancel-comment-button');
    var imagePopUp = $('#image-pop-up');
    var imageListThumb = $('.image-list-thumb');
    var multiCheckBox = $('#multi-checkbox');
    var selfCanvas = $('#canvas');
    var newMessageDiv = $('#new-message-div');
    var commentsText = $("#comments-text");
    var clearCanvas = $('#clearCanvas');

    var ctx = null;
    var img = null;
    var lineColor = null;

    var clickX = new Array();
    var clickY = new Array();
    var clickDrag = new Array();
    var clickColor = new Array();
    var markPosition = new Array();

    brush1 = new Image();
    brush1.src = '/images/1.png';
    brush2 = new Image();
    brush2.src = '/images/2.png';
    brush3 = new Image();
    brush3.src = '/images/3.png';

    brushes = [brush1, brush2, brush3];

    var paint;

    var allowNewMark = true;
    var src = null;
    var id = null;
    var pointer = 0;
    var markX = 0;
    var markY = 0;
    
    var newPostCounter = 0;
    var newPost = 0;
    var firstLoad = 0;
    var isMyself = 0;

    
    thumbContainer.click(function () {
    	newPost = 0;

        pointer = 0;

        ctx = document.getElementById('canvas').getContext('2d');
   
        src = $(this).find('img').attr('src');
        id = $(this).find('img').attr('id');
        var value =  $(this).find('img').attr('value');
        var dim = value.split(" ");
        
        canvas.width = dim[0];
        canvas.height = dim[1];
        
        imageContainer.css('width', dim[0]);
        imageContainer.css('height', dim[1]);

        img = new Image();

        canvas.width = canvas.width;

        img.src = src;
        img.onload = function () {
            ctx.drawImage(img, 0, 0);
            ctx.beginPath();
            ctx.moveTo(30, 96);
            ctx.stroke();
            ctx.clip();
        }

        clickX = new Array();
        clickY = new Array();
        clickDrag = new Array();

        getImageMarks(id);
        getImageComments(id);

        /* refresh of the marks and comments */
        //polling(id);
    });

    selfCanvas.mousedown(function (e) {

        if ( allowNewMark ) {
            ctx = document.getElementById('canvas').getContext('2d');

            //var mouseX = e.pageX - this.offsetLeft;
            //var mouseY = e.pageY - this.offsetTop;

            paint = true;

            markX = e.pageX - this.offsetLeft;
            markY = e.pageY - this.offsetTop;

            addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
            redraw();
            allowNewMark = false;
            pointer += 1;
        }
    });

    selfCanvas.mousemove(function (e) {
        if (paint) {
            addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
            redraw();
        }
    });

    selfCanvas.mouseup(function (e) {
        paint = false;
    });

    selfCanvas.mouseleave(function (e) {
        paint = false;
    });

    function addClick(x, y, dragging) {
        lineColor = $('#color-input').val();

        clickX.push(x);
        clickY.push(y);
        clickDrag.push(dragging);
        clickColor.push(lineColor);

        commentFormDiv.show();
    }

    function removeClick() {
        clickX.pop();
        clickY.pop();
        clickDrag.pop();
        clickColor.pop();
    }


    function redraw() {
        canvas.width = canvas.width;

        ctx.drawImage(img, 0, 0);

        ctx.lineJoin = "round";
        ctx.lineWidth = 5;

        for (var i = 0; i < clickX.length; i++) {
            ctx.beginPath();
            if (clickDrag[i] && i) {
                ctx.moveTo(clickX[i - 1], clickY[i - 1]);
            } else {
                ctx.moveTo(clickX[i] - 1, clickY[i]);
            }

            if (methodSelect.val() == 1) {
                ctx.lineTo(clickX[i], clickY[i]);
                ctx.strokeStyle = clickColor[i];
            } else {

                if ( this.brushes[i] != null ) {
                    ctx.drawImage(this.brushes[i], clickX[i] - 20, clickY[i] - 20);
                }

            }

            ctx.closePath();
            ctx.stroke();
        }
    }

    clearCanvas.click(function() {
        ctx.drawImage(img, 0, 0);

        clickX = new Array();
        clickY = new Array();
        clickDrag = new Array();

        commentFormDiv.hide();

        allowNewMark = true;
        pointer -= 1;

    });

    function getImageMarks(id) {
        $.ajax({
            url: "/image_comment/Ajaxpoints",
            dataType: "json",
            data: { id: id },
            success: function ( responce ) {
                $.each(responce, function (key, val) {
                    pointer += 1;
                    addClick(val[1], val[2]);
                    markPosition.push(val[2]);
                });
                
                if ( userRole == 'other' ) {
                    commentFormDiv.show();
                    allowNewMark = false;
                }else{
                    commentFormDiv.hide();
                }
                redraw();
            }
        });
    }
    
    function getImageComments(id) {
    	
    	var position;
    	
        $.ajax({
            url: "/image_comment/imgshow",
            dataType: "json",
            data: { id: id },
            success: function( responce ){
                var commentHtml = '';

                $.each(responce, function (i, val) {
                	
                	if ( val[1].indexOf("point") > -1 ) {
                		position = markPosition.shift();
                		commentHtml = commentHtml + '<blockquote value="'+position+'" class="alert alert-info comment">' + val[1] + '<small>' + val[2] + ' at ' + val[3] + '</small></blockquote>';
                	}else{
                		commentHtml = commentHtml + '<blockquote class="alert alert-info comment">' + val[1] + '<small>' + val[2] + ' at ' + val[3] + '</small></blockquote>';
                	}                	
                    
                });
                comments.html(commentHtml);
            }
        });
    }

    submitCommentButton.click(function(){
    	isMyself = 1;
        if ( userRole == 'client' ) {
            $.ajax({
                url: "/image_comment/Ajaxcreate",
                type: "POST",
                data: { image_id: id, comment: 'point '+pointer+':'+commentTextarea.val(), x: markX, y: markY },
                success: function(data) {
                    getImageComments(id);
                    commentTextarea.val('');
                    commentFormDiv.hide();
                    allowNewMark = true;
                }
            });
        }else{
            $.ajax({
                url: "/image_comment/Ajaxcreate",
                type: "POST",
                data: { image_id: id, comment: commentTextarea.val() },
                success: function(data) {
                    getImageComments(id);
                    commentTextarea.val('');
                }
            });
        }
    });

    cancelCommentButton.click(function(){
        commentTextarea.val('');
        commentFormDiv.hide();
        allowNewMark = true;

        pointer -= 1;
        removeClick();
        redraw();
    });

//    function getUserRole() {
//        $.ajax({
//            url: "/image_comment/userrole",
//            type: "GET",
//            data: {},
//            success: function(data) {
//            	userRole = data;
//            }
//        });
//    }

    $('#html-view').click(function(){
        $("#canvas").hide();
        $("#testLoad").show();
    });

    $('#image-view').click(function(){
        $("#testLoad").hide();
        $("#canvas").show();
    });

    $('#image-view').click(function(){
        $("#testLoad").hide();
        $("#canvas").show();
    });

    imageListThumb.mouseenter(function(){
        var position = $(this).position();
        var source = $(this).attr('src');

        imagePopUp.css("top", position.top-50);
        imagePopUp.css("left", position.left+30);
        imagePopUp.html('<img src="'+source+'" alt="" width="300px" height="400px" >');
        imagePopUp.show();
    });

    imageListThumb.mouseleave(function(){
        imagePopUp.hide();
    });

    
    function polling( id ) {

        poll = setInterval(function(){
            $.ajax({
                url: '/image_comment/imgshow/id/' + id,
                type: "GET",
                dataType: "json",
                success: function( responce ) {
                    
                    $.each(responce, function (i, val) {
                    	newPostCounter++;
                    });

                    if ( newPost < newPostCounter && firstLoad == 1 ) {
                        newMessageDiv.show();
                        hideGently( newMessageDiv );
                    }
                    newPost = newPostCounter;
                    newPostCounter = 0;
                    firstLoad = 1;
                },
                error: function() {
                }
            });
            
        }, 5000);

    }

    function hideGently( element ) {
        setTimeout(function(){element.fadeOut(5000);},10000);
    }

    function addGlow( element ) {
        element.addClass("glow");
    }

    function removeGlow( element ) {
        element.removeClass("glow");
    }

    /* on load, simulate click on the last image of the last li */
    $("#thumbs-list:last-child li:last-child img").trigger('click'); 
       
    commentsText.on('click', 'blockquote', function() {
    	var verticalPosition =  $(this).attr('value');
    	
    	if ( ua.mozilla ) {
    		$('body,html').animate({scrollTop : verticalPosition},'slow');
    	}else{
    		$('body').animate({scrollTop : verticalPosition},'slow');
    	}   	
    	
    });

    $('#popup').popupWindow({
        height:700,
        width:1100,
        centerScreen:1
    });

    $('#image-view').addClass('glow1');
    $('#image-view').click(function(){
        $(this).addClass('glow1');
        $('#html-view').removeClass('glow1');
    });

    $('#html-view').click(function(){
        $(this).addClass('glow1');
        $('#image-view').removeClass('glow1');
    });

    $('#project_expires_at').datepicker({ dateFormat: 'yy-mm-dd' });

    $('#down-button').click(function(){
        if ( ua.mozilla ) {
            $('.presentation').animate({scrollTop : '+=250'},'slow');
        }else{
            $('.presentation').animate({scrollTop : '+=250'},'slow');
        }
    });

    $('#up-button').click(function(){
        if ( ua.mozilla ) {
            $('.presentation').animate({scrollTop : '-=250'},'slow');
        }else{
            $('.presentation').animate({scrollTop : '-=250'},'slow');
        }
    });

});