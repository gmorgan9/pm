document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Create separate arrays for each section number
            const sectionCC1 = [];
            const sectionCC2 = [];
            // Add more arrays for other section numbers as needed

            // Process the received data and update the arrays
            data.forEach((control) => {
                // Determine the section number from the control
                const sectionNumber = control.section_number;

                // Add the control to the corresponding section array
                if (sectionNumber === 'CC1') {
                    sectionCC1.push(control);
                } else if (sectionNumber === 'CC2') {
                    sectionCC2.push(control);
                }
                // Add more conditions for other section numbers as needed
            });

            // Display the data for each section in the HTML
            displaySection(sectionCC1, 'audit-controls-cc1');
            displaySection(sectionCC2, 'audit-controls-cc2');
            // Display other sections as needed
            

        })
        .catch((error) => {
            console.error('Error:', error);
        });

    // Function to display the data for a section in the HTML
    function displaySection(sectionData, elementId) {
        const auditControlsList = document.getElementById(elementId);

        // Process and display the data for the section
        sectionData.forEach((control) => {
            const auditControlDiv = document.createElement('div');
            auditControlDiv.innerHTML = `
                <strong>Scope Category:</strong> ${control.scope_category}<br>
                <strong>Control Section:</strong> ${control.control_section}<br>
                <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                <strong>Control Activity:</strong> ${control.control_activity}<br><br>
            `;

            auditControlsList.appendChild(auditControlDiv);
        });
        console.log('auditControlsList:', auditControlsList);
    }
});
