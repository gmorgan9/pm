document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Group data by Control Section
            const groupedControls = {};

            data.forEach((control) => {
                const controlSection = control.control_section;

                if (!groupedControls[controlSection]) {
                    groupedControls[controlSection] = [];
                }

                groupedControls[controlSection].push(control);
            });

            // Get the HTML element where you want to display the data
            const auditControlsList = document.getElementById('audit-controls-list');

            // Iterate through grouped controls and display them
            for (const controlSection in groupedControls) {
                if (groupedControls.hasOwnProperty(controlSection)) {
                    const controlsInSection = groupedControls[controlSection];

                    // Create a container for controls in this section
                    const sectionContainer = document.createElement('div');
                    sectionContainer.classList.add('control-section');

                    // Create a header for the section
                    const sectionHeader = document.createElement('h2');
                    sectionHeader.textContent = `Control Section ${controlSection}`;
                    sectionContainer.appendChild(sectionHeader);

                    // Create a div for each control in the section
                    controlsInSection.forEach((control) => {
                        const auditControlDiv = document.createElement('div');
                        auditControlDiv.innerHTML = `
                            <strong>Scope Category:</strong> ${control.scope_category}<br>
                            <strong>Control Section:</strong> ${control.control_section}<br>
                            <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                            <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                        `;
                        sectionContainer.appendChild(auditControlDiv);
                    });

                    // Append the section container to the list
                    auditControlsList.appendChild(sectionContainer);
                }
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
