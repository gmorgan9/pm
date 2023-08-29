document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Get the HTML element where you want to display the data for 'CC1'
            const cc1ControlsList = document.getElementById('cc1-controls-list');

            // Check if 'CC1' controls exist
            if (data['CC1']) {
                // Process and display 'CC1' controls
                data['CC1'].forEach((control) => {
                    // Create a new element for each audit control
                    const auditControlDiv = document.createElement('div');
                    auditControlDiv.innerHTML = `
                        <strong>Scope Category:</strong> ${control.scope_category}<br>
                        <strong>Control Section:</strong> ${control.control_section}<br>
                        <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                        <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                    `;

                    // Append the control element to the 'CC1' controls list
                    cc1ControlsList.appendChild(auditControlDiv);
                });
            } else if (data['CC2']) {
                // Process and display 'CC1' controls
                data['CC1'].forEach((control) => {
                    // Create a new element for each audit control
                    const auditControlDiv = document.createElement('div');
                    auditControlDiv.innerHTML = `
                        <strong>Scope Category:</strong> ${control.scope_category}<br>
                        <strong>Control Section:</strong> ${control.control_section}<br>
                        <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                        <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                    `;

                    // Append the control element to the 'CC1' controls list
                    cc1ControlsList.appendChild(auditControlDiv);
                });
            } else {
                // 'CC1' controls not found
                const noCC1ControlsDiv = document.createElement('div');
                noCC1ControlsDiv.textContent = 'No controls found for Section CC1.';
                cc1ControlsList.appendChild(noCC1ControlsDiv);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});