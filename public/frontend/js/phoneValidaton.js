function isNumberKey(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    var length = evt.target.value.length;
    if ((charCode > 31 && (charCode < 48 || charCode > 57)) || length > 10)
        return false;

    return true;
}
