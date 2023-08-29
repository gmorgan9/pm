document.getElementById('loading-spinner').style.display = 'block';

    // Hide the loading spinner when the page has finished loading
    window.addEventListener('load', function () {
        document.getElementById('loading-spinner').style.display = 'none';
    });