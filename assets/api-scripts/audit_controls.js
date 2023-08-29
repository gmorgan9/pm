document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Get the HTML element where you want to display the data
            const auditControlsList = document.getElementById('audit-controls-list');

            // Create an object to group controls by section number
            const groupedControls = {};

            // Process the received data and update the HTML
            data.forEach((control) => {
                // Combine section and control numbers
                const sectionNumber = control.section_number;
                const controlNumber = control.control_number;
                const sectionControl = `${sectionNumber}.${controlNumber}`;

                // Create a new element for each audit control
                const auditControlDiv = document.createElement('div');
                auditControlDiv.innerHTML = `
                    <strong>Scope Category:</strong> ${control.scope_category}<br>
                    <strong>Section Number:</strong> ${sectionNumber}<br>
                    <strong>Control Number:</strong> ${controlNumber}<br>
                    <strong>Control Section:</strong> ${sectionControl}<br>
                    <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                    <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                `;

                // Create a container for each section if it doesn't exist
                if (!groupedControls[sectionNumber]) {
                    groupedControls[sectionNumber] = document.createElement('div');
                }

                // Append the control element to the section container
                groupedControls[sectionNumber].appendChild(auditControlDiv);
            });

            // Append section containers to the main list
            Object.keys(groupedControls).forEach((sectionNumber) => {
                const sectionContainer = groupedControls[sectionNumber];
                auditControlsList.appendChild(sectionContainer);
            });
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
