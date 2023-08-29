document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Get the HTML element where you want to display the data
            const auditControlsList = document.getElementById('audit-controls-list');
            
            // Create an object to store controls grouped by section_number
            const sectionControls = {};

            // Process the received data and group controls by section_number
            data.forEach((control) => {
                const sectionNumber = control.section_number;

                // Create a container for the section if it doesn't exist
                if (!sectionControls[sectionNumber]) {
                    sectionControls[sectionNumber] = [];
                }

                // Add the control to the respective section container
                sectionControls[sectionNumber].push(control);
            });

            // Iterate through sectionControls and create containers for each section
            for (const sectionNumber in sectionControls) {
                if (sectionControls.hasOwnProperty(sectionNumber)) {
                    const sectionContainer = document.createElement('div');
                    sectionContainer.className = 'section-container'; // You can style this container as needed
                    
                    // Create a heading for the section
                    const sectionHeading = document.createElement('h2');
                    sectionHeading.textContent = `Section Number: ${sectionNumber}`;
                    sectionContainer.appendChild(sectionHeading);

                    // Iterate through controls in the section and display them
                    sectionControls[sectionNumber].forEach((control) => {
                        // Create a new element for each audit control
                        const auditControlDiv = document.createElement('div');
                        auditControlDiv.innerHTML = `
                            <strong>Scope Category:</strong> ${control.scope_category}<br>
                            <strong>Control Section:</strong> ${control.control_section}<br>
                            <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                            <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                        `;
                        
                        // Append the control element to the section container
                        sectionContainer.appendChild(auditControlDiv);
                    });

                    // Append the section container to the main auditControlsList
                    auditControlsList.appendChild(sectionContainer);
                }
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
