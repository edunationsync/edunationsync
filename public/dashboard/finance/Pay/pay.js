const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'pk_test_d5dd8351c325a90f60034965b96c781f6420d22f', // Replace with your public key
    email: document.getElementById('email').value,
    amount: document.getElementById("amount").value * 100,
    ref: 'DCS'+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      //let message = 'Payment complete! Reference: ' + response.reference;
      //alert(message);

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
               alert("Failed: "+response.reference);
           }
               
       });
      
    }
  });
  handler.openIframe();
}