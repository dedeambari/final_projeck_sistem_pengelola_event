// payment.js
function validatePayment(form) {
  if (!form.amount.value || form.amount.value <= 0) {
      alert('Amount is required and must be greater than 0.');
      return false;
  }
  return true;
}
