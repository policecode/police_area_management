// route
function RouteApi() {
    this.setHeader = function () {
        return {
            "Content-Type": "application/json",
        };
    };

    this.processResponse = async function (response) {
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
                return { result: 0, message: res };
            }
        } else {
            let res = await response.text();
            return { result: 0, message: res };
        }
    };

    this.post = function (url, data, header = "json") {
        if (header == "form") {
            return fetch(url, {
                method: "POST",
                body: data,
            })
                .then((response) => {
                    return this.processResponse(response);
                })
                .then((jsonData) => {
                    return jsonData;
                });
        }
        if (header == "json") {
            return fetch(url, {
                method: "post",
                headers: this.setHeader(),
                body: JSON.stringify(data),
            })
                .then((response) => {
                    return this.processResponse(response);
                })
                .then((jsonData) => {
                    return jsonData;
                });
        }
    };

    this.put = function (url, data, header = "json") {
        if (header == "form") {
            return fetch(url, {
                method: "put",
                body: data,
            })
                .then((response) => {
                    return this.processResponse(response);
                })
                .then((jsonData) => {
                    return jsonData;
                });
        }
        if (header == "json") {
            return fetch(url, {
                method: "put",
                headers: this.setHeader(),
                body: JSON.stringify(data),
            })
                .then((response) => {
                    return this.processResponse(response);
                })
                .then((jsonData) => {
                    return jsonData;
                });
        }
    };

    this.delete = function (url, data) {
        return fetch(url, {
            method: "delete",
            headers: this.setHeader(),
            body: JSON.stringify(data),
        })
            .then((response) => {
                return this.processResponse(response);
            })
            .then((jsonData) => {
                return jsonData;
            });
    };

    this.get = function (url, data) {
        if (data) {
            let urlParams = [];
            for (let i in data) {
                urlParams.push(i + "=" + data[i]);
            }
            if (url.includes("?")) {
                url += "&" + urlParams.join("&");
            } else {
                url += "?" + urlParams.join("&");
            }
        }
        return fetch(url, {
            method: "get",
            headers: this.setHeader(),
        })
            .then((response) => {
                return this.processResponse(response);
            })
            .then((jsonData) => {
                return jsonData;
            });
    };
}
