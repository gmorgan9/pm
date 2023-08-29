// Hide the spinner and load the content after 5 seconds
setTimeout(function() {
    // Hide the spinner by setting its display property to 'none'
    document.getElementById('spinner-item-1').style.display = 'none';
    document.getElementById('spinner-item-2').style.display = 'none';
    document.getElementById('spinner-item-3').style.display = 'none';
    document.getElementById('spinner-item-4').style.display = 'none';
    document.getElementById('spinner-group').style.height = '0';
    
    // Load the page content or perform other actions
    // For example, you can show a previously hidden content div
    document.getElementById('sidebar').style.display = 'block';
    document.getElementById('content').style.display = 'block';
    
}, 1000); // 5000 milliseconds (5 seconds)