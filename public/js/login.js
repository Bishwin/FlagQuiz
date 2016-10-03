$(document).ready(function() {
    
    // Selects all text when text input is clicked
    $(':text').click(function() {
        current_input_val = $(this).val();
        $(this).select();
    }).focusout(function() {
        // if input is empty reenter string
        if ($(this).val() == "") {
            $(this).val(current_input_val);
        }
    });
    
    // when clicked remove placeholder text
    $(':password').focusin(function() {
        if($(this).attr('placeholder') !== undefined) {
            $(this).removeAttr('placeholder');
        }
    });
    
    //if input is empty readd placeholder set to "Password"
    $(':password.password').focusout(function() {
        $(this).attr('placeholder', 'Password');
    });
});