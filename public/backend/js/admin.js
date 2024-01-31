// route
/**
 * new RouteApi().get(url).then(function (jsonData) {
				app.loaded = true;
				if (jsonData.result) {
					jAlert(jsonData.message);
					app.searchItem();
				} else {
					jAlert(jsonData.message)
				}
			});
 */
function RouteApi(){
	this.setHeader = function(){
		return {
			'Content-Type': 'application/json'
		};
	}
	this.executeCall = async function(method,url,data){
		let params = {
			method: method,
			headers: this.setHeader()
		};
		if(data){
			params.body = JSON.stringify(data);
		}
		const response = await fetch(url, params).catch(error => {
			jAlert(error);
			return this.processError(error)
		});
		if(response.status != 200 && response.status != 202){
			return this.processError("Response status not success")
		}
		try{
			res = await response.json();
		}catch(e){
			return this.processError(e)
		}
		
		return res;
	}
	this.processError = function(res){
		return {
			result: 0,
			message: res,
			data: []
		}
	}
	this.post = function(url,data){
		return this.executeCall('post',url,data);
	};
	this.put = function(url,data){
		return this.executeCall('put',url, data);

	};
	this.delete = function(url,data){
		return this.executeCall('delete',url, data);
	};
	this.get = function (url){
		return this.executeCall('get',url);
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


function format_date(date,convert,format){
	if(convert===undefined){
		convert='y-m-d';
	}
	//get format
	if (date == '')
		return '';
	if(date instanceof Date){
		date = date.toISOString().slice(0, 10);
	}else if(format){
		format = format.toLowerCase();
		//get id of element
		let format_array = format.split('-');		
		for(i =0; i<3; i++){
			if(format_array[i].substring(0, 1) == 'd'){
			d = i;
			}
			if(format_array[i].substring(0, 1) == 'm'){
			m = i;
			}
			if(format_array[i].substring(0, 1) == 'y'){
			y = i;
			}
		}
	}
	let i=0;
	
	let d = 0;
	let m = 0;
	let y = 0;
	
	date = date.split('-');
	let date_str = [];
	format_array = convert.split('-');
	for(i =0; i<3; i++){
		if(format_array[i].substring(0, 1) == 'd'){
			date_str.push(date[i]);
		}
		if(format_array[i].substring(0, 1) == 'm'){
			date_str.push(date[i]);
		}
		if(format_array[i].substring(0, 1) == 'y'){
			date_str.push(date[i]);
		}
	}
	date = date_str.join('-'); 
	return date;
}
