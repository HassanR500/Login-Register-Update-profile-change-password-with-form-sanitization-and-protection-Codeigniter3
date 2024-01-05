window.onload = function() {
    document.getElementsByName('email')[0].value = '';
    document.getElementsByName('password')[0].value = '';
  };
      document.getElementById('submitForm').addEventListener('click', function(event) {
          event.preventDefault(); // Prevents the default behavior of anchor tag
          
          // Trigger submit button click
          document.getElementById('hiddenSubmit').click();
      });

    