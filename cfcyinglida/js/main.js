
//字符串格式化
String.prototype.format = function (args) {
    var str = this;
    return str.replace(String.prototype.format.regex, function (item) {
        var intVal = parseInt(item.substring(1, item.length - 1));
        var replace;
        if (intVal >= 0) {
            replace = args[intVal];
        } else if (intVal === -1) {
            replace = "{";
        } else if (intVal === -2) {
            replace = "}";
        } else {
            replace = "";
        }
        return replace;
    });
};
String.prototype.format.regex = new RegExp("{-?[0-9]+}", "g");

//验证身份证号码
function IsIdCard(num) {
    num = num.toUpperCase();
    //身份证号码为15位或者18位，15位时全为数字，18位前17位为数字，最后一位是校验位，可能为数字或字符X。  
    if (!(/(^\d{15}$)|(^\d{17}([0-9]|X)$)/.test(num))) {
        alert('输入的身份证号长度不对，或者号码不符合规定！\n15位号码应全为数字，18位号码末位可以为数字或X。');
        return false;
    }
    //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
    //下面分别分析出生日期和校验位
    var len, re;
    len = num.length;
    if (len == 15) {
        re = new RegExp(/^(\d{6})(\d{2})(\d{2})(\d{2})(\d{3})$/);
        var arrSplit = num.match(re);

        //检查生日日期是否正确
        var dtmBirth = new Date('19' + arrSplit[2] + '/' + arrSplit[3] + '/' + arrSplit[4]);
        var bGoodDay;
        bGoodDay = (dtmBirth.getYear() == Number(arrSplit[2])) && ((dtmBirth.getMonth() + 1) == Number(arrSplit[3])) && (dtmBirth.getDate() == Number(arrSplit[4]));
        if (!bGoodDay) {
            alert('输入的身份证号里出生日期不对！');
            return false;
        }
        else {
            //将15位身份证转成18位
            //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
            var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
            var nTemp = 0, i;
            num = num.substr(0, 6) + '19' + num.substr(6, num.length - 6);
            for (i = 0; i < 17; i++) {
                nTemp += num.substr(i, 1) * arrInt[i];
            }
            num += arrCh[nTemp % 11];
            return num;
        }
    }
    if (len == 18) {
        re = new RegExp(/^(\d{6})(\d{4})(\d{2})(\d{2})(\d{3})([0-9]|X)$/);
        var arrSplit = num.match(re);

        //检查生日日期是否正确
        var dtmBirth = new Date(arrSplit[2] + "/" + arrSplit[3] + "/" + arrSplit[4]);
        var bGoodDay;
        bGoodDay = (dtmBirth.getFullYear() == Number(arrSplit[2])) && ((dtmBirth.getMonth() + 1) == Number(arrSplit[3])) && (dtmBirth.getDate() == Number(arrSplit[4]));
        if (!bGoodDay) {
            alert(dtmBirth.getYear());
            alert(arrSplit[2]);
            alert('输入的身份证号里出生日期不对！');
            return false;
        }
        else {
            //检验18位身份证的校验码是否正确。
            //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
            var valnum;
            var arrInt = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            var arrCh = new Array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
            var nTemp = 0, i;
            for (i = 0; i < 17; i++) {
                nTemp += num.substr(i, 1) * arrInt[i];
            }
            valnum = arrCh[nTemp % 11];
            if (valnum != num.substr(17, 1)) {
                alert('18位身份证的校验码不正确！应该为：' + valnum);
                return false;
            }
            return num;
        }
    }
    return false;
}

//验证是否年份
function IsYear(year) {
    if (isNaN(year) || Number(year) > 9999 || Number(year) < 1600) {
        return false;
    }
    return true;
}
//验证是否IP
function IsIP(s) //by zergling  
{
    var patrn = /^[0-9.]{1,20}$/;
    if (!patrn.exec(s)) return false
    return true
}
//验证是否整数
function IsInteger(s)
{
    var patrn = /^-?\d+$/;
    if (!patrn.exec(s)) return false
    return true
}
//验证是否非负整数
function IsNonnegativeInteger(s)
{
    var patrn = /^\d+$/;
    if (!patrn.exec(s)) return false
    return true
}
//验证是否非正整数
function IsNonInteger(s)
{
    var patrn = /^((-\d+)|(0+))$/;
    if (!patrn.exec(s)) return false
    return true
}
//验证是否正整数
function IsPositiveInteger(s)
{
    return /^\+?[1-9][0-9]*$/.test(s);
}
//验证是否数值
function IsNumber(s)
{
    return /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(s);
}
/*
//回车转换为Tab及 按钮提交
$(document).ready(function () {
    //$(':input:text:first').focus();
    $(':input:enabled').addClass('enterIndex');
    // get only input tags with class data-entry
    textboxes = $('.enterIndex');
    // now we check to see which browser is being used
    if ($.browser.mozilla) {
        $(textboxes).bind('keypress', CheckForEnter);
    } else {
        $(textboxes).bind('keydown', CheckForEnter);
    }
});
function CheckForEnter(event) {
    var theEvent = window.event || event;
    var key = theEvent.keyCode || theEvent.which;
    if (key == 13 && $(this).attr('type') != 'button' && $(this).attr('type') != 'submit' && $(this).attr('type') != 'textarea' && $(this).attr('type') != 'reset') {
        var i = $('.enterIndex').index($(this));
        var n = $('.enterIndex').length;
        if (i < n - 1) {
            if ($(this).attr('type') != 'radio') {
                NextDOM($('.enterIndex'), i);
            }
            else {
                var last_radio = $('.enterIndex').index($('.enterIndex[type=radio][name=' + $(this).attr('name') + ']:last'));
                NextDOM($('.enterIndex'), last_radio);
            }
        }
        return false;
    }
}
function NextDOM(myjQueryObjects, counter) {
    if (myjQueryObjects.eq(counter + 1)[0].disabled) {
        NextDOM(myjQueryObjects, counter + 1);
    }
    else {
        myjQueryObjects.eq(counter + 1).trigger('focus');
    }
}

// 置顶浮动框
jQuery.fn.anchorGoWhere = function (options) {
    var obj = jQuery(this);
    var defaults = { target: 0, timer: 1000 };
    var o = jQuery.extend(defaults, options);
    obj.each(function (i) {
        jQuery(obj[i]).click(function () {
            var _rel = jQuery(this).attr("href").substr(1);
            switch (o.target) {
                case 1:
                    var _targetTop = jQuery("#" + _rel).offset().top;
                    jQuery("html,body").animate({ scrollTop: _targetTop }, o.timer);
                    break;
                case 2:
                    var _targetLeft = jQuery("#" + _rel).offset().left;
                    jQuery("html,body").animate({ scrollLeft: _targetLeft }, o.timer);
                    break;
            }
            return false;
        });
    });
};
function InitTopBox() {
    var screenwidth, screenheight, mytop, getPosLeft, getPosTop;
    screenwidth = $(window).width();
    screenheight = $(window).height();
    mytop = $(document).scrollTop();
    getPosLeft = screenwidth - 60;
    getPosTop = screenheight - 60;
    if (mytop > 0) {
        $("#topBox").show();
        $("#topBox").css({ "left": getPosLeft, "top": getPosTop + mytop });
    }
    else {
        $("#topBox").hide();
    }
}
function ResetTopBox() {
    var screenwidth, screenheight, mytop, getPosLeft, getPosTop;
    screenwidth = $(window).width();
    screenheight = $(window).height();
    mytop = $(document).scrollTop();
    getPosLeft = screenwidth - 50;
    getPosTop = screenheight - 50;
    if (mytop > 0) {
        $("#topBox").show();
        $("#topBox").css({ "left": getPosLeft, "top": getPosTop + mytop });
    }
    else {
        $("#topBox").hide();
    }
}
//提交按钮 再次确认提醒
$(document).ready(function () {
    $("input:submit").bind("click", function () {
        if (confirm("是否提交保存？")) {
            $("input:submit").attr("disabled", true);
            $("form").submit();
            return false;
            //            //如果提供了事件对象，则这是一个非IE浏览器 
            //            if (event && event.preventDefault) {
            //阻止默认浏览器动作(W3C) 
            //event.preventDefault();
            //因此它支持W3C的stopPropagation()方法
            //event.stopPropagation();
            //            }
            //            else {
            //                //IE中阻止函数器默认动作的方式 
            //                window.event.returnValue = false;
            //            }
        }
        return false;
    });
    $("input:submit").attr("disabled", false);
});
*/