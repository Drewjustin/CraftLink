function validate(formObj) {
  
  if (formObj.firstNames.value === '') {
    alert('Please enter a first name');
    formObj.firstNames.focus();
    return false;
  }
  
  if (formObj.lastName.value === '') {
    alert('Please enter a last name');
    formObj.lastName.focus();
    return false;
  }
  
  if (formObj.dob.value === '') {
    alert('Please enter a date of birth');
    formObj.dob.focus();
    return false;
  }
    
  return true;
}



// here is a jQuery $(document).ready function to get you started if 
// you choose to use jQuery.
$(document).ready(function() {
  
  // focus the name field on first load of the page
  $('#firstNames').focus();
     
});