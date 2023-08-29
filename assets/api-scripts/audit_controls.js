document.addEventListener("DOMContentLoaded", function () {
    const sectionSelector = document.getElementById('section-selector'); // Add an HTML element for section selection
    const auditControlsList = document.getElementById('audit-controls-list');

    // Fetch data from your Flask API when a section is selected
    sectionSelector.addEventListener('change', () => {
        const selectedSection = sectionSelector.value;

        // Fetch data for the selected section from the Flask API
        fetch(`https://app-aarc-api.morganserver.com/api/audit-controls?section=${selectedSection}`)
            .then((response) => response.json())
            .then((data) => {
                // Clear the existing content
                auditControlsList.innerHTML = '';

                // Process the received data and update the HTML
                data.forEach((control) => {
                    // Create a new element for each audit control
                    const auditControlDiv = document.createElement('div');
                    auditControlDiv.innerHTML = `
                        <strong>Scope Category:</strong> ${control.scope_category}<br>
                        <strong>Control Section:</strong> ${control.control_section}<br>
                        <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                        <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                    `;
                    
                    // Append the control element to the list
                    auditControlsList.appendChild(auditControlDiv);
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
});
