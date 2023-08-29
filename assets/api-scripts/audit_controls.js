document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Get the HTML element where you want to display the data
            const auditControlsList = document.getElementById('audit-controls-list');

            // Create an object to store controls by section_number
            const controlsBySection = {};

            // Process the received data and group controls by section_number
            data.forEach((control) => {
                const sectionNumber = control.section_number;

                // Initialize the array for the section if it doesn't exist
                if (!controlsBySection[sectionNumber]) {
                    controlsBySection[sectionNumber] = [];
                }

                // Add the control to the section's array
                controlsBySection[sectionNumber].push(control);
            });

            // Grab controls with section_number 'CC1'
            const cc1Controls = controlsBySection['CC1'];

            // Check if there are 'CC1' controls
            if (cc1Controls) {
                // Create a new section container for 'CC1'
                const cc1Container = document.createElement('div');
                cc1Container.className = 'section-container'; // Add a class for styling

                // Append the section header for 'CC1'
                const cc1Header = document.createElement('h2');
                cc1Header.textContent = 'Section CC1';
                cc1Container.appendChild(cc1Header);

                // Append each 'CC1' control within the section
                cc1Controls.forEach((control) => {
                    const auditControlDiv = document.createElement('div');
                    auditControlDiv.innerHTML = `
                        <strong>Scope Category:</strong> ${control.scope_category}<br>
                        <strong>Control Section:</strong> ${control.control_section}<br>
                        <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                        <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                    `;
                    cc1Container.appendChild(auditControlDiv);
                });

                // Append the 'CC1' section container to the main list
                auditControlsList.appendChild(cc1Container);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
