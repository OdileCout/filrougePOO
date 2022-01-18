function sendEmail() {
    var name = $('#name');
    var email = $('#email');
    var phone = $('#phone');
    var message = $('#message');

    if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(phone) && isNotEmpty(message)) {
        $.ajax({
            url: 'sendEmail.php',
            method: 'POST',
            dataType: 'json',
            data: {
                name: name.val(),
                email: email.val(),
                phone: phone.val(),
                message: message.val()
            },
            success: function(response) {
                //On appel l'id de mon formulaire
                $('#contact_form')[0].reset();
                $('.retour').text('Messange envoyé');
            }
        });
    }
}

function isNotEmpty(caller) {
    if (caller.val() == '') {
        caller.css('border', '1px solid red');
        return false;
    } else {
        caller.css('border', '');
        return true;
    }
}