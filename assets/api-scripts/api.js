// // Function to check if a user is logged in and retrieve session data
// function checkLoginStatus() {
//     fetch('https://app-aarc-api.morganserver.com/api/check_login')
//         .then(response => response.json())
//         .then(data => {
//             if (data.loggedIn) {
//                 // User is logged in, retrieve additional session data if needed
//                 fetch('https://app-aarc-api.morganserver.com/api/profile')
//                     .then(response => response.text())
//                     .then(profileText => {
//                         // Display the user's profile information on the frontend
//                         document.getElementById('profile').textContent = profileText;
//                     });
//             } else {
//                 // User is not logged in, display a message or redirect to the login page
//                 document.getElementById('profile').textContent = "You are not logged in.";
//             }
//         });
// }

// // Call the checkLoginStatus function when your page loads or when needed
// checkLoginStatus();

