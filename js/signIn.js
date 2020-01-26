$("#sig_in_form").submit(function(e) {
        e.preventDefault();

        const email = $("#defaultLoginFormEmail")[0].value;
        const password = $("#defaultLoginFormPassword")[0].value;

        $.ajax({
                url: "http://mycompany/php/signIn.php",
                method: "POST",
                data: {
                        email: email,
                        password: password
                },
                error: function (jqXHR, textStatus, errorThrown) {
                        console.error(jqXHR, textStatus, errorThrown);
                },
                success: registrationStatus
        });

        function registrationStatus (data) {
                console.log(data.Message);
        }
});