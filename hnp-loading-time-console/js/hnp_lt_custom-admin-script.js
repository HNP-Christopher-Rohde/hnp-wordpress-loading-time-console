jQuery(document).ready(function($) {
   function toggleSecondCheckbox(checkbox) {
      var secondCheckbox = document.getElementById('hnp_loading_time_more_checked');
      secondCheckbox.disabled = !checkbox.checked;
   }

   var firstCheckbox = document.getElementById('hnp_loading_time_checked');
   firstCheckbox.addEventListener('change', function() {
      toggleSecondCheckbox(this);
   });

   // Optional: Initialer Aufruf der Funktion beim Laden der Seite
   toggleSecondCheckbox(firstCheckbox);
});
