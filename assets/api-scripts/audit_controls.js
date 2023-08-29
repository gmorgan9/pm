document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Filter the data to include only controls in section CC1
            const cc1Controls = data.filter((control) => control.section_number === 'CC1');
            
            // Get the HTML element where you want to display the data
            const auditControlsList = document.getElementById('audit-controls-list');
            
            // Process the received data and update the HTML
            cc1Controls.forEach((control) => {
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


// <strong>Section Number:</strong> ${control.section_number}<br>
// <strong>Control Number:</strong> ${control.control_number}<br>