function setSessionCookie(cookieName, cookieValue) {
    document.cookie = cookieName + "=" + cookieValue + ";path=/";
}

function toggleVisibility(span) {
    if (span.textContent.trim() === 'visibility') {
        span.textContent = 'visibility_off';
    } else {
        span.textContent = 'visibility';
    }
}

function display(button) {
    const buttons = document.querySelectorAll('.button');
    const rightPanel = document.querySelector('.right-panel');
    buttons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            rightPanel.style.display = 'flex';
            event.stopPropagation();
        });
    });
    document.addEventListener('click', function (event) {
        if (!rightPanel.contains(event.target)) {

            rightPanel.style.display = 'none';
        }
    });
    document.addEventListener('DOMContentLoaded', function () {
            let selectedOffer = null;


            const offers = document.querySelectorAll('.offer');


            offers.forEach(function (offer) {

                offer.addEventListener('click', function (event) {

                    if (selectedOffer !== null) {
                        selectedOffer.style.backgroundColor = '#191c24';
                    }


                    offer.style.backgroundColor = '#2c2f37';


                    selectedOffer = offer;


                    event.stopPropagation();
                });


                document.addEventListener('click', function (event) {

                    if (!offer.contains(event.target)) {

                        offer.style.backgroundColor = '#191c24';

                        selectedOffer = null;
                    }
                });
            });
        });




        document.addEventListener('DOMContentLoaded', function () {
            let selectedOffer = null;


            const offers = document.querySelectorAll('.offer');


            offers.forEach(function (offer) {

                offer.addEventListener('click', function (event) {

                    if (selectedOffer !== null) {
                        selectedOffer.style.backgroundColor = '#191c24';
                    }


                    offer.style.backgroundColor = '#2c2f37';


                    selectedOffer = offer;


                    event.stopPropagation();
                });


                document.addEventListener('click', function (event) {

                    if (!offer.contains(event.target)) {

                        offer.style.backgroundColor = '#191c24';

                        selectedOffer = null;
                    }
                });
            });
        });










    var targetInput = button.closest('div').querySelector('input[name="tel"]');
    var targetValue = targetInput.value;

    setSessionCookie("tel", targetValue);

    // Send AJAX request to the server
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "ajax.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var responseData = JSON.parse(xhr.responseText);
            document.getElementById("prenom").textContent = responseData.prenom;
            document.getElementById("nom").textContent = responseData.nom;
            document.getElementById("tel").textContent = responseData.tel;
            document.getElementById("role").textContent = responseData.role;
            document.getElementById("image").src = responseData.image;
        }        
    };
    xhr.send();
}
