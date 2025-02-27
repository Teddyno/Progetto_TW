<!DOCTYPE html>
<html>
<head>
    <title>Pagamento con Stripe</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Pagamento con Stripe</h1>
    <form method="post" id="payment-form">
      <div class="form-row">
        <label for="fullname">
          Nome Completo
        </label>
        <input type="text" id="fullname" name="fullname" value="">
        <label for="importo">
          Importo
        </label>
        <input type="number" id="importo" name="importo" value="">
      </div>
      <div class="form-row">
        <label for="card-element">
          Credit or debit card
        </label>
        <div id="card-element">
          <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button id="submit-button">Submit Payment</button>
    </form>

    <script>
        const stripe = Stripe('pk_test_51Qx9iLADMdufFUoyCNSNoPAb8u4cSNMnAUDaclfYkPPujS9lp2TQuUaGKY1o5zPHkevSbvfGS2XJE1aqnPvzrtAR004N3ToiSJ'); // Sostituisci con la tua Public Key

        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');
        const cardErrors = document.getElementById("card-errors");

        const form = document.getElementById('payment-form');


        cardElement.on('change', (event) => {
            if (event.error) {
                cardErrors.textContent = event.error.message;
            } else {
                cardErrors.textContent = '';
            }
        });


        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Disabilitiamo il bottone di invio per evitare sottomissioni multiple
            document.getElementById('submit-button').disabled = true;

            // Recuperiamo l'importo ed altri dati dal form
            const amount = parseInt(form.importo.value)*100; // L'importo deve essere in centesimi

           
            // Step 1: Creare PaymentIntent sul server
            createPaymentIntent(amount, async (response) => {
                response = JSON.parse(response);
                if (response.error) {
                    // Handle server-side error during PaymentIntent creation
                    console.error('Error creating PaymentIntent:', response.error);
                    cardErrors.textContent = 'Errore durante la creazione del pagamento.';
                    document.getElementById('submit-button').disabled = false;
                    return;
                }

                const clientSecret = response.clientSecret;

                // Step 2: Confermiamo il pagamento lato client
                const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: form.fullname.value, // Nome del proprietario della carta
                        },
                    },
                });

                if (error) {
                    // Gestione degli Stripe error durante la conferma di pagamento
                    console.error('Error confirming payment:', error.message);
                    cardErrors.textContent = `Errore durante il pagamento: ${error.message}`;
                    document.getElementById('submit-button').disabled = false;
                } else if (paymentIntent && paymentIntent.status === 'succeeded') {
                    // Payment succeeded
                    alert('Pagamento completato con successo!');
                } else {
                    // Unexpected error
                    console.error('Unexpected error during payment confirmation.');
                    cardErrors.textContent = 'Errore sconosciuto, riprova.';
                    document.getElementById('submit-button').disabled = false;
                }
            });
        });

        // Creiamo un PaymentIntent usando AJAX
        function createPaymentIntent(amount, callback) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'payment.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            const response = xhr.response;
                            console.log(response);
                            callback(response);
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            callback({ error: 'Invalid server response' });
                        }
                    } else {
                        console.error('Error with AJAX request:', xhr.statusText);
                        callback({ error: xhr.statusText });
                    }
                }
            };
            //const formData = new FormData(amount);
            // Send the amount as JSON
            xhr.send('importo='+amount);
        }


    </script>
</body>
</html>
