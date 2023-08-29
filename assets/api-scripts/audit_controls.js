document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Get the HTML elements where you want to display the data
            const cc1ControlsList = document.getElementById('cc1-controls-list');
            const cc2ControlsList = document.getElementById('cc2-controls-list');

            // Function to display controls for a given section
            function displayControls(sectionData, controlsList, sectionName) {
                if (sectionData) {
                    // Process and display controls for the section
                    sectionData.forEach((control) => {
                        // Create a new element for each audit control
                        const auditControlDiv = document.createElement('div');
                        auditControlDiv.innerHTML = `
                        <table class="control-table">
                        <tr>
                            <td><strong>Control Section:</strong></td>
                            <td>${control.control_section}</td>
                        </tr>
                        <tr>
                            <td><strong>Point of Focus:</strong></td>
                            <td>${control.point_of_focus}</td>
                        </tr>
                        <tr>
                            <td><strong>Control Activity:</strong></td>
                            <td>${control.control_activity}</td>
                        </tr>
                    </table>
                        `;

                        // Append the control element to the section's controls list
                        controlsList.appendChild(auditControlDiv);
                    });
                } else {
                    // Section controls not found
                    const noControlsDiv = document.createElement('div');
                    noControlsDiv.textContent = `No controls found for Section ${sectionName}.`;
                    controlsList.appendChild(noControlsDiv);
                }
            }

            // Display controls for 'CC1' section
            displayControls(data['CC1'], cc1ControlsList, 'CC1');

            // Display controls for 'CC2' section
            displayControls(data['CC2'], cc2ControlsList, 'CC2');
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
