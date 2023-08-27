// document.getElementById('logout-link').addEventListener('click', function (event) {
//     event.preventDefault(); // Prevent the default behavior of following the link

//     // Make a POST request to the logout endpoint
//     fetch('https://api.morganserver.com/api/logout', {
//     method: 'POST',
//     headers: {
//         'Content-Type': 'application/json',
//     },
// })
// .then((response) => {
//     if (response.ok) {
//         // Handle successful logout, e.g., redirect to a login page
//         window.location.href = 'https://app-aarc.morganserver.com/';
//     } else {
//         // Handle logout error, e.g., display an error message
//         console.error('Logout request failed - client');
//         // You can also log the response status and response text for more details
//         console.log('Response Status:', response.status);
//         response.text().then((text) => console.log('Response Text:', text));
//     }
// })
// .catch((error) => {
//     console.error('An error occurred during logout', error);
// });

// });
