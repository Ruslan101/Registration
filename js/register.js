$("#registrationForm").submit(function(e) {
        e.preventDefault();

        const name = $("#firstName")[0].value;
        const secondName = $("#secondName")[0].value;
        const email = $("#email")[0].value;
        const password = $("#password")[0].value;
        const phone = $("#phone")[0].value;
        const checkbox = $("#defaultRegisterFormNewsletter")[0].checked;

        $.ajax({
		url: "http://mycompany/php/register.php",
		method: 'POST',
		data: {
                        name: name,
                        secondName: secondName,
                        email: email,
                        password: password,
                        phone: phone,
                        checkbox: checkbox
                },
		error: function (jqXHR, textStatus, errorThrown) {
                        console.error(jqXHR, textStatus, errorThrown);
                },
                success: registrationStatus
	});
        
        function registrationStatus (data) {
                if(data.State)
                        $("#message").css("display", "flex");
                else
                        console.log(data);
        }
});