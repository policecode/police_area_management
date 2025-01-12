var XHR = (function () {

    function getDataValues(enableInputs) {
        var dataValues = Array.from(enableInputs).reduce(function (
            values,
            input
        ) {
            if (!input.value) return values;
            switch (input.type) {
                case "radio":
                    var radioChecked = input.parentElement.querySelector(
                        `input[name="${input.name}"]:checked`
                    );
                    if (radioChecked !== null) {
                        values[input.name] = radioChecked.value;
                    } else {
                        values[input.name] = "";
                    }
                    break;
                case "checkbox":
                    if (input.matches(":checked")) {
                        if (!Array.isArray(values[input.name])) {
                            values[input.name] = [];
                        }
                        values[input.name].push(input.value);
                    } else if (values[input.name] === undefined) {
                        values[input.name] = "";
                    }
                    break;
                case "file":
                    if (input.name.indexOf("[]") > -1) {
                        if (!Array.isArray(values[input.name])) {
                            values[input.name] = [];
                        }
                        values[input.name].push(...input.files);
                    } else {
                        if (input.files.length > 0) {
                            values[input.name] = input.files[0];
                        } else {
                            values[input.name] = "";
                        }
                    }
                    break;
                case "select-multiple":
                    const selectOptions =
                        input.querySelectorAll("option:checked");
                    selectOptions.forEach(function (optionEl) {
                        if (!Array.isArray(values[input.name])) {
                            values[input.name] = [];
                        }
                        values[input.name].push(optionEl.value);
                    });
                    break;
                default:
                    if (input.name.indexOf("[]") > -1) {
                        if (!Array.isArray(values[input.name])) {
                            values[input.name] = [];
                        }
                        values[input.name].push(input.value);
                    } else {
                        values[input.name] = input.value;
                    }
                    break;
            }
            return values;
        },
        {});

        return dataValues;
    }

    function buildFormData(dataValues, token = []) {
        const formData = new FormData();

        for (const [key, value] of Object.entries(dataValues)) {
            if (key.indexOf("[]") > -1) {
                value.forEach(function (val) {
                    formData.append(key, val);
                });
            } else {
                formData.append(key, value);
            }
        }

        if (token.length > 0) {
            formData.append(token[0], token[1]);
        }

        return formData;
    }

    function buttonStyle(button) {
        const buttonRect = button.getBoundingClientRect();
        Object.assign(button.style, {
            width: `${buttonRect.width}px`,
            height: `${buttonRect.height}px`,
            position: `relative`,
        });
        button.setAttribute("content-old", button.innerHTML);
        button.disabled = true;
        button.innerHTML = `<div class="r-s-loader"></div><style>.r-s-loader{position:absolute;left:50%;top:50%;border:5px solid #f3f3f3;border-radius:50%;border-top:5px solid #fff;border-bottom:5px solid #fff;border-left:5px solid transparent;border-right:5px solid transparent;width:${
            buttonRect.height - 16
        }px;height:${
            buttonRect.height - 16
        }px;-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}@-webkit-keyframes spin{0%{-webkit-transform:translate(-50%,-50%) rotate(0)}100%{-webkit-transform:translate(-50%,-50%) rotate(360deg)}}@keyframes spin{0%{transform:translate(-50%,-50%) rotate(0)}100%{transform:translate(-50%,-50%) rotate(360deg)}}</style>`;
    }

    function buttonDone(options) {
        if (options.isForm || options.button) {
            var button;
            if (options.isForm) {
                button = options.form.querySelector('button[type="submit"]');
            } else {
                button = options.button;
            }
            button.disabled = false;
            button.innerHTML = button.getAttribute("content-old");
        }
    }

    function isJson(item) {
        item = typeof item !== "string" ? JSON.stringify(item) : item;

        try {
            item = JSON.parse(item);
        } catch (e) {
            return false;
        }

        if (typeof item === "object" && item !== null) {
            return true;
        }

        return false;
    }

    function callFunction(func, options = []) {
        var arrayFunc = func.split(".");
        var method;
        if (arrayFunc.length === 1) {
            method = arrayFunc[0];
            return (
                null != window[method] &&
                typeof window[method] === "function" &&
                window[method](...options)
            );
        } else if (arrayFunc.length === 2) {
            var obj = arrayFunc[0];
            method = arrayFunc[1];
            return (
                window[obj] != null &&
                typeof window[obj] === "object" &&
                null != window[obj][method] &&
                typeof window[obj][method] === "function" &&
                window[obj][method](...options)
            );
        }
    }
    return {
        createFormData: function (data) {
            return buildFormData(data);
        },
        buildData: function (data) {
            return getDataValues(data);
        },
        send: function (data) {
            return _send(data);
        },
    };
})();
