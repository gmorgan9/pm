document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Get the HTML element where you want to display the data
            const auditControlsList = document.getElementById('audit-controls-list');

            // Organize the data into groups based on control section
            const groupedControls = {};
            data.forEach((control) => {
                if (!groupedControls[control.control_section]) {
                    groupedControls[control.control_section] = [];
                }
                groupedControls[control.control_section].push(control);
            });

            // Iterate through the groups and create a section for each
            for (const section in groupedControls) {
                const sectionDiv = document.createElement('div');
                sectionDiv.innerHTML = `<h2>${section}</h2>`;

                // Create a new element for each audit control within the group
                groupedControls[section].forEach((control) => {
                    const auditControlDiv = document.createElement('div');
                    auditControlDiv.innerHTML = `
                        <strong>Scope Category:</strong> ${control.scope_category}<br>
                        <strong>Control Section:</strong> ${control.control_section}<br>
                        <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                        <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                    `;

                    sectionDiv.appendChild(auditControlDiv);
                });

                // Append the section to the list
                auditControlsList.appendChild(sectionDiv);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
