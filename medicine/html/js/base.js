/**
 * Created by weizhao on 2016/7/20.
 */
var JK = {
    check: {
        isEmpty: function (obj) {
            if (obj == null || obj == undefined || ("" + obj) == "") {
                return true;
            }
            return false;
        },
        isPhone: function (str) {
            var regu = /^(((\(\d{2,3}\))|(\d{3}\-))?1[0-9]\d{9})?$/;
            return regu.test(str);
        },
        isInteger: function (str) {
            var regu = /^[0-9]*[1-9][0-9]*$/;
            return regu.test(str);
        },
        isNumber: function (str) {
            var regu = /^[0-9][0-9]*$/;
            return regu.test(str);
        },
        isMoney: function (str) {
            var regu = /^[0-9]*(\.[0-9]{1,2})?$/;
            return regu.test(str);
        },
        isMobile: function (str) {
            var regu = /^(13[4-9]|15[0-2]|15[7-9]|18(7|8|2|3|4)|147)\d{8}$/;
            return regu.test(str);
        },
        isMobilePrefix: function (str) {
            var regu = /^(13[4-9]|15[0-2]|15[7-9]|18(7|8|2|3|4)|147)/;
            return regu.test(str);
        },
        isTelecom: function (str) {
            var regu = /^(133|153|180|181|189)\d{8}$/;
            return regu.test(str);
        },
        isTelecomPrefix: function (str) {
            var regu = /^(133|153|180|181|189)/;
            return regu.test(str);
        },
        isUnicom: function (str) {
            var regu = /^(13[0-2]|15(5|6)|185|186|145)\d{8}$/;
            return regu.test(str);
        },
        isUnicomPrefix: function (str) {
            var regu = /^(13[0-2]|15(5|6)|185|186|145)/;
            return regu.test(str);
        },
        isChineseName: function (str) {
            var temp = JK.convert.trim(str);
            //如果是中文，且名称是2~4位，则为正式的名称
            if (("" + temp).length > 1 && ("" + temp).length < 5 && JK.check.isChinese(temp)) {
                return true;
            }
            return false;
        },
        isChinese: function (str) {
            var temp = JK.convert.trim(str);
            if (JK.check.isEmpty(temp)) return false;
            for (var i = 0; i < temp.length; i++) {
                var tempChar = temp[i];
                if (escape(tempChar).indexOf("%u") < 0) return false;
            }
            return true;
        },
        isIdNum: function (card) {
            // 身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X
            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
            return reg.test(card);
        },
        isPC: function () {
            var sUserAgent = navigator.userAgent.toLowerCase();
            var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
            var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
            var bIsMidp = sUserAgent.match(/midp/i) == "midp";
            var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
            var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
            var bIsAndroid = sUserAgent.match(/android/i) == "android";
            var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
            var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
            if (!(bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM)) {
                return true;
            } else {
                return false;
            }
        },
        isEmail: function (str) {
            var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
            return myreg.test(str);
        }
    },
    arrayToString: function (array) {
        var str = array[0][1] + "";
        for (var i = 1; i < array.length; i++) {
            str += "," + array[i][1];
        }
        return str;
    },
    ajax: function (data, callback, errorback) {
        console.log("发送给后台的数据是：" + JSON.stringify(data));
        if (JK.check.isEmpty(data.url_ajax)) {
            alert("请求url不能为空！");
            return false;
        }
        var errback = errorback || function (XMLHttpRequest, textStatus, errorThrown, responseText) {
                JK.dom.hideLoading();
                var str = JK.check.isEmpty(XMLHttpRequest.responseText) ? "服务器异常，请稍后重试！" : XMLHttpRequest.responseText;
                alert(str);
                return false;
            }
        JK.dom.showLoading();
        $.ajax({
            type: JK.check.isEmpty(data.type_ajax) ? "POST" : data.type_ajax,
            url: data.url_ajax,
            data: JK.json.formAjaxData(data),
            dataType: 'json',
            success: function (data) {
                JK.dom.hideLoading();
                (JK.check.isEmpty(callback)) ? commCallback(data) : callback(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown, responseText) {
                JK.dom.hideLoading();
                errback(XMLHttpRequest, textStatus, errorThrown, responseText);
            }
        });
        var customCallback = function (data) {
            JK.dom.hideLoading();
            (JK.check.isEmpty(callback)) ? commCallback(data) : callback(data);
        };
        var commCallback = function (data) {
            if (data.errCode = "0000") {
            } else {
                alert(data);
            }
        };
    },
    json: {
        formAjaxData: function (data) {
            delete data["type_ajax"];
            delete data["url_ajax"];
            return data;
        }
    },
    dom: {
        $loading: $("<div class='loading'><div class='ball-clip-rotate-multiple'><div></div><div></div></div></div>"),
        showLoading: function () {
            $("article").append(JK.dom.$loading);
        },
        hideLoading: function () {
            $("div.loading").remove();
        }
    }
};