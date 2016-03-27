//选择时间
function chooseDate(dateId, isAllowNull) {
    var IsAllow;
    if (isAllowNull != undefined) {
        IsAllow = isAllowNull;
    }
    else {
        IsAllow = false;
    }
    $('#' + dateId).datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: IsAllow
    });
}
//选择时间段
function chooseDateRange(startDateId, endDateId, isStartAllowNull, isEndAllowNull) {
    var startDate = $('#' + startDateId);
    var endDate = $('#' + endDateId);
    var startAllow, endAllow;
    if (isStartAllowNull != undefined) {
        startAllow = isStartAllowNull;
    } else {
        startAllow = false;
    }
    if (isEndAllowNull != undefined) {
        endAllow = isEndAllowNull;
    } else {
        endAllow = false;
    }
    startDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: startAllow,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    endDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: endAllow,
        //maxDate: '+0d',
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    if (endDate.val() != null && endDate.val() != "") {
        var arys = new Array();
        var arys = endDate.val().split('-');
        startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
    if (startDate.val() != null && startDate.val() != "") {
        var arys = new Array();
        var arys = startDate.val().split('-');
        endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
}
//选择时间段
function chooseDateNoQingchu(startDateId, endDateId, isStartAllowNull, isEndAllowNull) {
    var startDate = $('#' + startDateId);
    var endDate = $('#' + endDateId);
    var startAllow, endAllow;
    if (isStartAllowNull != undefined) {
        startAllow = isStartAllowNull;
    } else {
        startAllow = false;
    }
    if (isEndAllowNull != undefined) {
        endAllow = isEndAllowNull;
    } else {
        endAllow = false;
    }
    startDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    endDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    if (endDate.val() != null && endDate.val() != "") {
        var arys = new Array();
        var arys = endDate.val().split('-');
        startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
    if (startDate.val() != null && startDate.val() != "") {
        var arys = new Array();
        var arys = startDate.val().split('-');
        endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
}
//选择最大日期为当前日期，也就是最大日期是今天
function chooseDateNow(startDateId, endDateId, isStartAllowNull, isEndAllowNull) {
    var startDate = $('#' + startDateId);
    var endDate = $('#' + endDateId);
    var startAllow, endAllow;
    if (isStartAllowNull != undefined) {
        startAllow = isStartAllowNull;
    } else {
        startAllow = false;
    }
    if (isEndAllowNull != undefined) {
        endAllow = isEndAllowNull;
    } else {
        endAllow = false;
    }
    startDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: startAllow,
        maxDate: '+0d',
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    endDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        maxDate: '+0d',
        showClearButton: endAllow,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    if (endDate.val() != null && endDate.val() != "") {
        var arys = new Array();
        var arys = endDate.val().split('-');
        startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
    if (startDate.val() != null && startDate.val() != "") {
        var arys = new Array();
        var arys = startDate.val().split('-');
        endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
}
//选择最大日期为今天以后
function chooseDateOld(startDateId, endDateId, isStartAllowNull, isEndAllowNull) {
    var startDate = $('#' + startDateId);
    var endDate = $('#' + endDateId);
    var startAllow, endAllow;
    if (isStartAllowNull != undefined) {
        startAllow = isStartAllowNull;
    } else {
        startAllow = false;
    }
    if (isEndAllowNull != undefined) {
        endAllow = isEndAllowNull;
    } else {
        endAllow = false;
    }
    startDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: startAllow,
        minDate: '+0d',
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    endDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        minDate: '+0d',
        showClearButton: endAllow,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    if (endDate.val() != null && endDate.val() != "") {
        var arys = new Array();
        var arys = endDate.val().split('-');
        startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
    if (startDate.val() != null && startDate.val() != "") {
        var arys = new Array();
        var arys = startDate.val().split('-');
        endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
}
//选择最大日期为当前日期，也就是最大日期是今天
function chooseDateNownian(startDateId, endDateId, isStartAllowNull, isEndAllowNull) {
    var startDate = $('#' + startDateId);
    var endDate = $('#' + endDateId);
    var startAllow, endAllow;
    if (isStartAllowNull != undefined) {
        startAllow = isStartAllowNull;
    } else {
        startAllow = false;
    }
    if (isEndAllowNull != undefined) {
        endAllow = isEndAllowNull;
    } else {
        endAllow = false;
    }
    startDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: startAllow,
        maxDate: '+0d',
        yearRange: '1900:2100',
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    endDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        maxDate: '+0d',
        yearRange: '1900:2100',
        showClearButton: endAllow,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    if (endDate.val() != null && endDate.val() != "") {
        var arys = new Array();
        var arys = endDate.val().split('-');
        startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
    if (startDate.val() != null && startDate.val() != "") {
        var arys = new Array();
        var arys = startDate.val().split('-');
        endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
}
//选择最大日期为输入时间以后
function chooseDateOlds(startDateId,zxxzrq, endDateId) {
    var startDate = $('#' + startDateId);
    var endDate = $('#' + endDateId);
    var startAllow = false;
    startDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: startAllow,
        minDate: zxxzrq,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = dateText.split('-');
            endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });

    if (startDate.val() != null && startDate.val() != "") {
        var arys = new Array();
        var arys = startDate.val().split('-');
        endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
}
//选择日期为输入时间之间
function chooseDatexzrq(startDateId,endDateId,kshrq, jshrq,jszxxzrqs) {
    var startDate = $('#' + startDateId);
    var endDate = $('#' + endDateId);
    var startAllow, endAllow;
        startAllow = false;
        endAllow = false;
    startDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: startAllow,        
        minDate: kshrq,
        maxDate: jshrq,
        onSelect: function (dateText, inst) {
            var arys = new Array();
            if(dateText>jszxxzrqs){
              var arys = dateText.split('-');
            }else{
              var arys = jszxxzrqs.split('-');
            }
            endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    endDate.datepicker({
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showMonthAfterYear: true,
        showClearButton: endAllow,         
        minDate: jszxxzrqs, 
        //maxDate: '+0d',
        onSelect: function (dateText, inst) {
            var arys = new Array();
            var arys = jshrq.split('-');
            startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
        }
    });
    if (endDate.val() != null && endDate.val() != "") {
        var arys = new Array();
        var arys = jshrq.split('-');
        startDate.datepicker('option', 'maxDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
    if (startDate.val() != null && startDate.val() != "") {
        var arys = new Array();
        
        if(startDate.val()>jszxxzrqs){
          var arys = startDate.val().split('-');
        }else{
          var arys = startDate.val().split('-');
        }
        endDate.datepicker('option', 'minDate', new Date(arys[0], arys[1] - 1, arys[2]));
    }
}