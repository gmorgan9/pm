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

                // Append the control element to the list
                auditControlsList.appendChild(auditControlDiv);

                // Group controls by section number
                if (!groupedControls[sectionNumber]) {
                    groupedControls[sectionNumber] = [];
                }
                groupedControls[sectionNumber].push(control);
            });

            // Attach a click event listener to each section number
            for (const sectionNumber in groupedControls) {
                if (groupedControls.hasOwnProperty(sectionNumber)) {
                    const sectionElement = document.getElementById(`section-${sectionNumber}`);
                    if (sectionElement) {
                        sectionElement.addEventListener('click', () => {
                            // Handle the click event, e.g., display controls for this section.
                            displaySectionControls(sectionNumber, groupedControls[sectionNumber]);
                        });
                    }
                }
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});

function displaySectionControls(sectionNumber, controls) {
    // Clear the existing content
    const sectionControlsList = document.getElementById('section-controls-list');
    sectionControlsList.innerHTML = '';

    // Display controls for the selected section
    controls.forEach((control) => {
        // Create a new element for each audit control
        const auditControlDiv = document.createElement('div');
        auditControlDiv.innerHTML = `
            <strong>Scope Category:</strong> ${control.scope_category}<br>
            <strong>Section Number:</strong> ${control.section_number}<br>
            <strong>Control Number:</strong> ${control.control_number}<br>
            <strong>Control Section:</strong> ${control.section_number}.${control.control_number}<br>
            <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
            <strong>Control Activity:</strong> ${control.control_activity}<br><br>
        `;

        // Append the control element to the list
        sectionControlsList.appendChild(auditControlDiv);
    });

    // You can also update the UI to highlight the selected section, if desired.
}
