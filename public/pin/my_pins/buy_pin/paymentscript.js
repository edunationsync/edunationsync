/*
function payWithPaystack(regno,session,term,_class,phone,email,amount) {

    amount=amount*100;
    var handler = PaystackPop.setup({ 
        key: 'pk_live_3e4a884065a8cbb6517e3cc9afa56df319a414b1', //put your public key here
        email: email, //put your customer's email here
        amount: amount, //amount the customer is supposed to pay
        metadata: {
            custom_fields: [
                {
                    display_name: "Mobile Number",
                    variable_name: "mobile_number",
                    value: phone //customer's mobile number
                }
            ]
        },
        callback: function (response) {
            //after the transaction have been completed
            //make post call  to the server with to verify payment 
            //using transaction reference as post data
            $.post("verify.php", {reference:response.reference}, function(status){
                if(status == "success"){
                    //successful transaction
                    alert('Transaction was successful');

                }
                    
                else{
                    //transaction failed
                    alert(response);
                }
                    
            });
        },
        onClose: function () {
            //when the user close the payment modal
            alert('Transaction cancelled');
        }
    });
    handler.openIframe(); //open the paystack's payment modal
}
*/

function payChargeWithPaystack(regno,session,term,_class,phone,email,amount) {
    amount=amount*100;
    var handler = PaystackPop.setup({ 
        key: 'pk_live_3e4a884065a8cbb6517e3cc9afa56df319a414b1', //put your public key here
        email: email, //put your customer's email here
        amount: amount, //amount the customer is supposed to pay
        metadata: {
            custom_fields: [
                {
                    display_name: "Mobile Number",
                    variable_name: "mobile_number",
                    value: phone //customer's mobile number
                }
            ]
        },
        callback: function (response) {
            //after the transaction have been completed
            //make post call  to the server with to verify payment 
            //using transaction reference as post data
            $.post("verify.php", {reference:response.reference}, function(status){
                if(status == "success"){
                    //successful transaction
                    alert('Transaction was successful');

                }
                    
                else{
                    //transaction failed
                    alert(response);
                }
                    
            });
        },
        onClose: function () {
            //when the user close the payment modal
            alert('Transaction cancelled');
        }
    });
    handler.openIframe(); //open the paystack's payment modal
}
