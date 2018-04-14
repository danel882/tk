function newline(option, number, axis){
    option[axis]['axisLabel']={
        interval: 0,
        formatter: function(values){
            var newParamsName = "";
            var paramsNameNumber = values.length;
            var provideNumber = number;
            var rowNumber = Math.ceil(paramsNameNumber / provideNumber);
            if (paramsNameNumber > provideNumber) {
                for (var p = 0; p < rowNumber; p++) {
                    var tempStr = "";
                    var start = p * provideNumber;
                    var end = start + provideNumber;
                    if (p == rowNumber - 1) {
                        tempStr = values.substring(start, paramsNameNumber);
                    } else {
                        tempStr = values.substring(start, end) + "\n";
                    }
                    newParamsName += tempStr;
                }
            } else {
                newParamsName = values;
            }
            return newParamsName
        }
    }
    return option;
}