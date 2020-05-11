$( document ).ready(function() {

    let url = 'http://localhost/gebruikersprofiel.php'

    $(".wijzigingenbevestigen").hide();

    $(".accountwijzigen").click(function() {
        verander_gegevens(this.gebruikersnaam);
    });

    $(".wijzigingenbevestigen").click(function() {
        bevesting_veranderingen(this.gebruikersnaam);
    });


    function verander_gegevens(gebruikersnaam) {
        let persoonlijkeData = $('.persoonlijke-data').children('.bewerkbaar');
        $.each(persoonlijkeData, function() {
            $(this).prop('input', true);
        });


        $('.accountwijzigen').hide();
        $('.wijzigingenbevestigen').show();

    }

    function bevesting_veranderingen(gebruikersnaam) {

        let persoonlijkeData = $('.persoonlijke-data').children('.bewerkbaar');



        $.ajax({
            type: "PUT",
            url: url,
            dataType: "json",
            success: function(data) {
                alert("test1");
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });

        $.each(persoonlijkeData, function() {
            $(this).prop('input', false);
        });

        alert("gegevens gewijzigd!");

        $(".wijzigingenbevestigen").hide();
        $(".accountwijzigen").show();
    }

});
