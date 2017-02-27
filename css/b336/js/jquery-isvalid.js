// Campos obrigratórios: Checkbox, Radio, Text, etc...
jQuery.fn.isRequired = function(){

    var hasError = Boolean(true);
    var checked_count = 0;

    switch ($(this).attr('type'))
    {
        case 'checkbox':
            checked_count = 0;
            $('input[name="' + $(this).attr('name') + '"]').each(function() {
                if ($(this).is(':checked')) {
                    checked_count++;
                }
            });
            if (checked_count < 1) {
                return Boolean(false);
            }
            break;
        case 'radio':
            checked_count = 0;
            $('input[name="' + $(this).attr('name') + '"]').each(function() {
                if ($(this).is(':checked')) {
                    checked_count++;
                }
            });
            if (checked_count != 1) {
                hasError = Boolean(false);
            }
            break;
        case 'text':
            if ($(this).val().length == 0)
                hasError = Boolean(false);
            break;

        default:
            if ($(this).val() == '') {
                hasError = Boolean(false);
            }
            break;
    }

    return hasError;

}

// Exemplo: Letras e Espaços "SEM ACENTUAÇÃO"
jQuery.fn.isLetras = function(){
    if ($(this).isRequired()){
        if (!/^[A-Za-z]+(\s[A-Za-z]+)*$/.test($(this).val())){
            return false;
        } else {
            return true;
        }
    } else {
            return false;
        }
}

//Exemplo: 1234567890
jQuery.fn.isNumeros = function(){
    if ($(this).isRequired()){
        if (!/^[0-9]*$/.test($(this).val())) {
            return false;
        } else {
            return true;
        }
    } else {
            return false;
        }
}

// Exemplo: xxx@xxx.com
jQuery.fn.isEmail = function(){
    if (!/^[a-zA-Z0-9]{1}([\._a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+){1,3}$/.test($(this).val())) {
        return false;
    } else {
        return true;
    }
}

// Exemplo: XXX.XXX.XXX-XX
jQuery.fn.isFormatCPF = function(){
    if (!/^([0-9]{3}\.){2}[0-9]{3}-[0-9]{2}$/.test($(this).val())){
        return false;
    } else {
        return true;
    }
}

// Exemplo: XX.XXX.XXX/XXXX-XX
jQuery.fn.isFormatCNPJ = function(){
    if (!/^\d{2,3}[.]\d{3}[.]\d{3}[\/]\d{4}[-]\d{2}$/.test($(this).val())){
        return false;
    } else {
        return true;
    }
}

// {1,5} 1 MIN / 5 MAX
jQuery.fn.isMinMaxLenght = function(_min,_max){
	eval('var expReg = /^[a-zA-Z0-9]{'+ _min +','+ _max +'}$/');
	if(!expReg.test($(this).val())){
        return false;
    } else {
        return true;
    }
}

// Exemplo: 2.000,00
jQuery.fn.isMoney = function(){
    if (!/^\d{1,3}(\.\d{3})*\,\d{2}$/.test($(this).val())){
        return false;
    } else {
        return true;
    }
}

//Exemplo: 09/09/1999
jQuery.fn.isDate = function(){
    if (!/^((0?[1-9]|[12]\d)\/(0?[1-9]|1[0-2])|30\/(0?[13-9]|1[0-2])|31\/(0?[13578]|1[02]))\/(19|20)?\d{2}$/.test($(this).val())) {
        return false;
    } else {
        return true;
    }
}

//Exemplo: 12,34
jQuery.fn.isFloat = function(){
    if (!/^(\+?((([0-9]+(\,)?)|([0-9]*\,[0-9]+))([eE][+-]?[0-9]+)?))$/.test($(this).val())){
        return false;
    } else {
        return true;
    }
}