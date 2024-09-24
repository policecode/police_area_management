var x = null;
var y = null;
function jtrigger_error(message,style){
	if(style !='' ||  style !== undefined){
		//style = 'position:fixed;top:'+(y-20)+'px;left:'+x+'px;';
		style = 'position:fixed;bottom:30px;left:30px;background:black;color:white;padding:10px;font-weight:bold;';
	}
	var html = jQuery('<span class="error-message-alert" style="'+style+'">'+message+'</span>');
	jQuery('body').append(html);    	
	setTimeout(function(){
		jQuery('.error-message-alert').fadeOut('slow');
	},3000);
}
//show modal pop-up
(function ($) {
	
    /**
     * Confirm a link or a button
     * @param [options] {{title, text, confirm, cancel, confirmButton, cancelButton, post, confirmButtonClass}}
     */
    $.fn.confirmClick = function (options) {
        if (typeof options === 'undefined') {
            options = {};
        }

        this.click(function (e) {
            e.preventDefault();

            var newOptions = $.extend({
                button: $(this)
            }, options);

            $.confirm(newOptions, e);
        });

        return this;
    };
    
    $.fn.confirm = function (options) {
        if (typeof options === 'undefined') {
            options = {};
        }


        var newOptions = $.extend({
            button: $(this)
        }, options);

        $.confirm(newOptions, this);
       

        return this;
    };


    /**
     * Show a confirmation dialog
     * @param [options] {{title, text, confirm, cancel, confirmButton, cancelButton, post, confirmButtonClass}}
     * @param [e] {Event}
     */
    $.confirm = function (options, e) {
        // Do nothing when active confirm modal.
        if ($('.confirmation-modal').length > 0)
            return;

        // Parse options defined with "data-" attributes
        var dataOptions = {};
        if (options.button) {
            var dataOptionsMapping = {
                'title': 'title',
                'text': 'text',
                'confirm-button': 'confirmButton',
                'cancel-button': 'cancelButton',
                'confirm-button-class': 'confirmButtonClass',
                'cancel-button-class': 'cancelButtonClass'
            };
            $.each(dataOptionsMapping, function(attributeName, optionName) {
                var value = options.button.data(attributeName);
                if (value) {
                    dataOptions[optionName] = value;
                }
            });
        }

        // Default options
        var settings = $.extend({}, $.confirm.options, {
            confirm: function () {
                var url = e && (('string' === typeof e && e) || (e.currentTarget && e.currentTarget.attributes['href'].value));
                if (url) {
                    if (options.post) {
                        var form = $('<form method="post" class="hide" action="' + url + '"></form>');
                        $("body").append(form);
                        form.submit();
                    } else {
                        window.location = url;
                    }
                }
            },
            cancel: function (o) {
            },
            button: null
        }, dataOptions, options);

        // Modal
        var modalHeader = '';
        if (settings.title !== '') {
            modalHeader =
                '<div class=modal-header>' +
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                    '<h4 class="modal-title">' + settings.title+'</h4>' +
                '</div>';
        }
        var modalHTML =
                '<div class="confirmation-modal modal fade" tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog">' +
                        '<div class="modal-content">' +
                            modalHeader +
                            '<div class="modal-body">' + settings.text + '</div>' +
                            '<div class="modal-footer">' +
                                '<button class="confirm btn ' + settings.confirmButtonClass + '" type="button" data-dismiss="modal">' +
                                    settings.confirmButton +
                                '</button>' +
                                '<button class="cancel btn ' + settings.cancelButtonClass + '" type="button" data-dismiss="modal">' +
                                    settings.cancelButton +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';

        var modal = $(modalHTML);

        modal.on('shown.bs.modal', function () {
            modal.find(".btn-primary:first").focus();
        });
        modal.on('hidden.bs.modal', function () {
            modal.remove();
        });
        modal.find(".confirm").click(function () {
            settings.confirm(settings.button);
        });
        modal.find(".cancel").click(function () {
            settings.cancel(settings.button);
        });

        // Show the modal
        $("body").append(modal);
        modal.modal('show');
    };

    /**
     * Globally definable rules
     */
    $.confirm.options = {
        text: "Are you sure?",
        title: "",
        confirmButton: "Yes",
        cancelButton: "Cancel",
        post: false,
        confirmButtonClass: "btn-primary",
        cancelButtonClass: "btn-default"
    }
    
    /**
     * Show beauty popup
     * @param message message of popup
     * @param title title of popup
     * @param type type of popup(just have warning)
     */
    jAlert = function(message,title,type) {
    	title = title==undefined ? __('Notice') : title;
    	var html = '<div id="fvn-popup1" class="fvn-overlay" style="z-index:9999;">'+
	'<div class="fvn-popup">'+
		'<h2>'+title+'</h2>'+
		'<a class="fvn-close" href="javascript:void(0)" onclick="jQuery(\'#fvn-popup1\').remove();">&times;</a>'+
		'<div class="content">'+message+'</div>'+
	'</div>'
'</div>';
    	jQuery('body').append(html);
	}
    
    /**
     * Show a force popup - Can not be dismiss
     * @param message 
     * @param title
     * @param link (link of button)
     * @param btn_text (text of button)
     */
    jAlertFocus = function(message,title,link,btn_text) {
    	if ($('.confirmation-modal').length > 0){
    		$('.confirmation-modal').modal('hide');
    	}
    	var button_text = 'OK';
    	if (btn_text != '' || btn_text != undefined)
    		button_text = btn_text;
    		
    	if (title == 'warning')
    		title = '<span style="color:red"><i class="icon-warning"></i></span>&nbsp; Warning';
        var modalHTML =
                '<div class="confirmation-modal modal " tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog">' +
                        '<div class="modal-content">'+ 
                        	'<div class="modal-header"><b>'+title+'</b></div>'+
                            '<div class="modal-body">' + message + '</div>' +
                            '<div class="modal-footer center" style="">' +
                                '<a href="'+link+'" class="center btn-primary btn" >'+button_text+'</a>' +                                
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';
        
        if(title == undefined || title == '')
        	modalHTML =
                '<div class="confirmation-modal modal " tabindex="-1" role="dialog">' +
                    '<div class="modal-dialog">' +
                        '<div class="modal-content">'+                        	
                            '<div class="modal-body">' + message + '</div>' +
                            '<div class="modal-footer center" style="">' +
                            	'<a href="'+link+'" class="center btn-primary btn" >'+button_text+'</a>' +                               
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>';    

        var modal = $(modalHTML);

        modal.on('shown.bs.modal', function () {
            modal.find(".btn-primary:first").focus();
        });
        
       
      
        // Show the modal
        $("body").append(modal);
        modal.modal({
            backdrop: 'static',
            keyboard: false  // to prevent closing with Esc button (if you want this too)
        });
        modal.modal('show');
	}
   
    
})(jQuery);

//get input value with name is filter by "filter" value
(function ($) {
    $.fn.jbGetFilterValue = function (filter) {    	
    	var result = '';
    	result += $('input').jbGetOptionValue(filter);
    	result += $('select').jbGetOptionValue(filter);
    	return result;
    	
    };
    $.fn.jbGetOptionValue = function(filter){
    	var length = filter.length;
    	var result = '';
    	$(this).each(function(){
    		var name = $(this).attr('name');
    		if(name){
    			if(name.substring(0, length)  == filter){
    				result += '&'+name+'='+$(this).val();
        		}
    		}    		
    	});
    	return result;
    }
})(jQuery);

//check session by ajax return false if session is expired
function checkSession(){
	return jQuery.ajax({
	  	url: 'index.php?option=com_bookpro&controler=flight&task=flight.ajaxCheckSession',
	  	dataType: "html",
	  	async: !1
	 }).responseText;
	
}

function jbsetCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function jbgetCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


function format_date(date,format,timezone){
	if(!date){
		return '';
	}
	if(format===undefined){
		format='Y-m-d';
	}
	let dateObject = new Date(date);
	if(typeof date == 'string' && date.length == 10){
		dateObject = new Date(dateObject.getTime() + dateObject.getTimezoneOffset() * 60000);
	}
	if(timezone){
		dateObject = new Date(dateObject.getTime() + 7 * 3600000);
	}
	let year = dateObject.getFullYear();
	let month = dateObject.getMonth() + 1;
	let day = dateObject.getDate();
	let hour = dateObject.getHours();
	let minute = dateObject.getMinutes();
	let second = dateObject.getSeconds();

	// Pad the month, day, hour, minute, and second with zeros if they are less than 10.

	if (month < 10) {
		month = '0' + month;
	}
	if (day < 10) {
		day = '0' + day;
	}
	if (hour < 10) {
		hour = '0' + hour;
	}
	if (minute < 10) {
		minute = '0' + minute;
	}
	if (second < 10) {
		second = '0' + second;
	}

	let formattedDate = format.replace('Y', year);
	formattedDate = formattedDate.replace('m', month);
	formattedDate = formattedDate.replace('d', day);
	formattedDate = formattedDate.replace('h', hour);
	formattedDate = formattedDate.replace('i', minute);
	formattedDate = formattedDate.replace('s', second);

	return formattedDate;
}

function convertFormatDateJs(format){
	if(!format){
		format = 'Y-m-d';
	}
	format = format.replace('Y', 'yyyy');
	format = format.replace('m', 'MM');
	format = format.replace('d', 'dd');
	return format;
}

function display_processing_form(enable){
	if(enable){
		jQuery('body').append('<img id="jbform_loading"  style="position: fixed;top:50%;left: 50%;margin-left: -100px;margin-top: -100px;width:200px;height:200px;" src="'+FVN_PLUGIN_URL+'assets/images/loading.gif"/>');

	}else{
		jQuery('#jbform_loading').remove();
	}
}

(function ($) {
	 var wfslideshow = function (element, options) {
        this.$element = $(element);
        this.options = $.extend({}, $.fn.wfslideshow.defaults, options, this.$element.data());
		
		this.offset = 0;
        this.init();  
     };
	 
	 wfslideshow.prototype = {
        constructor: wfslideshow, 
        init: function () {
			
            var html = '<div class="slideshow_button slideshow_previous slideshow_transparent wf_slide_show_btn" route="pre" role="button" style="display:none;"></div><div class="slideshow_button slideshow_next slideshow_transparent" route="next" role="button"></div><div class="wf-slideshow-content">';		
           
			
			var phone_class = 'col-xs-'+Math.floor(12/this.options.itemPhone);			
			var tablet_class = 'col-md-'+Math.floor(12/this.options.itemTablet);
			var desktop_class = 'col-lg-'+Math.floor(12/this.options.itemDesktop);
			this.itemClass = phone_class+' '+tablet_class+' '+desktop_class;
			
			this.resize($(window).width());
			
			
			
			
			defaultHtml = '<div class="col-xs-12 '+this.options.classItem+'">'+'<div class="'+this.options.classAvatar+'"></div>'+'<div class="'+this.options.classTitle+'"></div>'+'<div class="'+this.options.classDesc+'"></div>'+'</div>';
			
			if(this.options.data.length ==0){
				 html += defaultHtml;
			}else{
				html += this.renderHtml(this.options.data);
			}
			html += '</div>';
            this.$element.html(html);
			
			var wfslideshow = this;
			
			
			if(this.options.data.length ==0){
				$.ajax({
					url: wfslideshow.options.url,
					data: {'limit':wfslideshow.limit,'offset':wfslideshow.offset},
					dataType: "json",
					beforeSend: function(){
						wfslideshow.$element.find('.wf-slideshow-content').css('opacity','0.5');
					},
					success: function(result){
						wfslideshow.$element.find('.wf-slideshow-content').css('opacity','1');
						html = wfslideshow.renderHtml(result);	
						wfslideshow.$element.find('.wf-slideshow-content').html(html);
						
					}
				 });
			}
				
				
			$( window ).resize(function() {
			  wfslideshow.resize($( window ).width());
			});
			
			
			if(this.options.classActive != ''){		
				this.$element.find('.'+phone_class).click(function(e){
					alert();
					e.preventdefault();
					wfslideshow.$element.find('.'+phone_class).removeClass();
					$(this).addClass(wfslideshow.options.classActive);
				});
			}
			
			this.$element.find('.slideshow_button').click(function(){	
				var role = $(this).attr('route');
				if(role == 'next'){
					wfslideshow.offset = wfslideshow.offset+wfslideshow.limit;
				}else{
					wfslideshow.offset = wfslideshow.offset - wfslideshow.limit;	
					if(wfslideshow.offset<0){
						wfslideshow.offset = 0;
					}
				}
						
				$.ajax({
					url: wfslideshow.options.url,
					data: {'limit':wfslideshow.limit,'offset':wfslideshow.offset},
					dataType: "json",
					beforeSend: function(){
						wfslideshow.$element.find('.wf-slideshow-content').css('opacity','0.5');
					},
					success: function(result){
						wfslideshow.$element.find('.wf-slideshow-content').css('opacity','1');
						html = wfslideshow.renderHtml(result);
						if(wfslideshow.offset!=0){
							wfslideshow.$element.find('.slideshow_previous').show();
						}else{
							wfslideshow.$element.find('.slideshow_previous').hide();
						}
						
						if(result.length < wfslideshow.limit){
							wfslideshow.$element.find('.slideshow_next').hide();
						}else{
							wfslideshow.$element.find('.slideshow_next').show();
						}
						wfslideshow.$element.find('.wf-slideshow-content').html(html);
						
					}
				 });
				
				 
			});
			
			
			//wfslideshow = null;
			
        },
		
		resize: function(size){
			if(size < 780){
				this.device = 'xs';
				this.limit = this.options.itemPhone;
			}else if(size < 1000){
				this.device = 'md';
				this.limit = this.options.itemTablet;
			}else{
				this.device = 'lg';
				this.limit = this.options.itemDesktop;
			}
			return this.device;
		},
		
		renderHtml: function(data){
			var options = this.options;			
			var html = '';
			var itemClass = this.itemClass;
			$.each(data, function( i,item ){
				j = i+1;
				var item_class_reponsive = itemClass;
				if(j>options.itemTablet){
					item_class_reponsive += ' '+'hidden-md';
				}
				if(j>options.itemPhone){
					item_class_reponsive += ' '+'hidden-sm';
				}
				html += '<div class="'+item_class_reponsive+'">'+
									'<div class="'+options.classItem+' '+'bg-'+options.color[i]+'" >'+
									'<div class="'+options.classAvatar+' border-'+options.classborderAvartar[i]+'"><a href="'+item.link+'" ><img src="'+item.image+'" data-image="'+item.image_max+'" class="wp-post-image"/></a></div>'+
									'<div class="'+options.classTitle+'"><a href="'+item.link+'">'+item.title+'</a></div>';
				if(options.classDesc != ''){
					html += '<div class="summary-item-news">'+item.desc+'</div>';
				}
				if(options.classMore != ''){
					html += '<div class="'+options.classMore+'"><a href="'+item.link+'">Tìm hiểu thêm &nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-play-circle"></i></a></div>';
				}
				html += '</div></div>';
			});
			
			
			if(options.onclick !== null){
				html = $(html);
				
				html.find("a").bind('click',function (e) {
					e.preventDefault();
					options.onclick($(this));
				});
				
			}
			
			return html;
		}
		
		
	};
	
	$.fn.wfslideshow = function ( option ) {
    	
        var d, args = Array.apply(null, arguments);
        args.shift();
       
        //getValue returns date as string / object (not jQuery object)
        if(option === 'getValue' && this.length && (d = this.eq(0).data('wfslideshow'))) {
          return d.getValue.apply(d, args);
        }        
        return this.each(function () {
            var $this = $(this),
            data = $this.data('wfslideshow'),            
            options = typeof option == 'object' && option;
            if (!data) {
                $this.data('wfslideshow', (data = new wfslideshow(this, options)));
            }
            if (typeof option == 'string' && typeof data[option] == 'function') {
                data[option].apply(data, args);
            }
        });
    }; 
	
	$.fn.wfslideshow.defaults = {
        url: '', 
		classItem: 'item-news',
		color: [],
		classActive: '',
		classAvatar: 'avatar-item-news',
		classborderAvartar: [],
		classTitle: 'title-item-news',
		classDesc: '',
		classMore: '',
		itemPhone: 2,
		itemDesktop: 4,
		itemTablet: 3,
		step: 0,
		onclick: null,
		data: []
    };
	
	
}(window.jQuery));


function jnotice(msg){
	if(jQuery('#jbnotice').length){
		jQuery('#jbnotice').remove();
	}
	var html = '<div id="jbnotice" style="text-align:center;font-size:20px;border: 1px solid #ccc;background: rgba(95, 186, 125, 1);color:white;position:fixed;width:300px;top:30px;left:30px;line-height:40px;padding:10px;z-index:9999">'+msg+'</div>';
	jQuery('body').append(html);
	jQuery('#jbnotice').fadeOut(3000);

}

function copyText(id){
	document.getElementById(id).select();
	document.execCommand('copy');
	jnotice('Sao chép thành công');
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function getUrlParam(parameter, defaultvalue){
    var urlparameter = defaultvalue;
    if(window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
        }
    return urlparameter;
}

function formatMoney(number, decPlaces, decSep, thouSep) {
	const formatter = new Intl.NumberFormat('vi-VN', {
		style: "currency",
		currency: 'VND'
	  });
	  return formatter.format(number);
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 0 : decPlaces,
    decSep = typeof decSep == "undefined" ? "." : decSep;
    thouSep = typeof thouSep == "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return sign +
        (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}

// route
function RouteApi(){
	this.setHeader = function(){
		return {
			'Content-Type': 'application/json',
			// 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		};
	}

	this.processResponse = async function(response){
		console.log(response.status);
		// if(![400,404,200,202,403].includes(response.status)){
		// 	return {result:0,message:response.text()};
		// }
		const contentType = response.headers.get("content-type");
		if (contentType && contentType.indexOf("application/json") !== -1) {
			try {
				return await response.json();
			} catch (error) {
				let res = await response.text();
		  		return {result:0,message:res};
			}
		  
		} else {
			let res = await response.text();
		  return {result:0,message:res};
		}
	}

	this.post = function(url,data, header = 'json'){
		if (header == 'form') {
			return fetch(url, {
				method: 'POST',
				body: data
			})
			.then((response) => {
				return this.processResponse(response);
			})
			.then((jsonData) => {
				return jsonData;
			});
		}
		if (header == 'json') {
			return fetch(url, {
				method: 'post',
				headers: this.setHeader(),
				body: JSON.stringify(data)
			})
			.then((response) => {
				return this.processResponse(response);
			})
			.then((jsonData) => {
				return jsonData;
			});
		}
	};

	this.put = function(url,data, header = 'json'){
		if (header == 'form') {
			return fetch(url, {
				method: 'put',
				body: data
			})
			.then((response) => {
				return this.processResponse(response);
			})
			.then((jsonData) => {
				return jsonData;
			});
		}
		if (header == 'json') {
			return fetch(url, {
				method: 'put',
				headers: this.setHeader(),
				body: JSON.stringify(data)
			})
			.then((response) => {
				return this.processResponse(response);
			})
			.then((jsonData) => {
				return jsonData;
			});
		}
	};

	this.delete = function(url,data){
		return fetch(url, {
			method: 'delete',
			headers: this.setHeader(),
			body: JSON.stringify(data)
		})
		.then((response) => {
			return this.processResponse(response);
		})
		.then((jsonData) => {
			return jsonData;
		});
	};

	this.get = function (url,data){
		if(data){
			let urlParams = [];
			for(let i in data){
				urlParams.push(i+'='+data[i]);
			}
			if(url.includes('?')){
				url += '&'+urlParams.join('&');
			}else{
				url += '?'+urlParams.join('&');
			}
		}
		return fetch(url, {
			method: 'get',
			headers: this.setHeader()
		})
		.then((response) => {
			return this.processResponse(response);
		})
		.then((jsonData) => {
			return jsonData;
		});
	}
}

function objectToQuery(obj){
	let res = '';
	for(i in obj){
		res += i+'='+obj[i]+'&';
	}
	return res;
}
function queryToObject(str){
	let res = str.split("&");
	let result = {};
	for(i in res){
		if(res[i].length > 0){
			let v = res[i].split('=');
			result[v[0]] = v[1]
		}
	}
	return result;
	
}
function insertUrlParam(key, value) {
    key = encodeURIComponent(key);
    value = encodeURIComponent(value);

    // kvp looks like ['key1=value1', 'key2=value2', ...]
    var kvp = document.location.search.substr(1).split('&');
    let i=0;

    for(; i<kvp.length; i++){
        if (kvp[i].startsWith(key + '=')) {
            let pair = kvp[i].split('=');
            pair[1] = value;
            kvp[i] = pair.join('=');
            break;
        }
    }

    if(i >= kvp.length){
        kvp[kvp.length] = [key,value].join('=');
    }

    // can return this or...
    let params = kvp.join('&');

    // reload page with new params
    parent.location.hash  = params;
}

function updateWidgetLanguage(params,defaultLang){
	jQuery('.header-language-dropdown ul li a').each(function(i,e){
		let href = jQuery(e).attr('href');
		let lang = jQuery(e).attr('hreflang');
		if(defaultLang && lang==defaultLang){
			lang='';
		}
		let result = siteUrl + lang + params;
		
		jQuery(e).attr('href',result);
	});
}

function __(text){
	if(typeof jsTranslates != 'undefined'){		
		let currentLang = document.documentElement.lang;
		if(jsTranslates[text] && jsTranslates[text][currentLang]){
			return jsTranslates[text][currentLang];
		}
	}
	return text;
}