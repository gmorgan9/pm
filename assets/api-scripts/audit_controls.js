document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then((data) => {
            // Iterate through the data and group controls by control section
            const groupedControls = {};
            data.forEach((control) => {
                const controlSection = control.control_section;
                if (!groupedControls[controlSection]) {
                    groupedControls[controlSection] = [];
                }
                groupedControls[controlSection].push(control);
            });
            
            // Iterate through the grouped controls and populate HTML sections
            for (const section in groupedControls) {
                if (groupedControls.hasOwnProperty(section)) {
                    // Get the HTML element for the control section
                    const controlSectionDiv = document.getElementById(section);
                    
                    // Create a new element for each audit control in the section
                    groupedControls[section].forEach((control) => {
                        const auditControlDiv = document.createElement('div');
                        auditControlDiv.innerHTML = `
                            <strong>Scope Category:</strong> ${control.scope_category}<br>
                            <strong>Control Section:</strong> ${control.control_section}<br>
                            <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                            <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                        `;
                        
                        // Append the control element to the control section
                        controlSectionDiv.appendChild(auditControlDiv);
                    });
                }
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});


// <strong>Section Number:</strong> ${control.section_number}<br>
// <strong>Control Number:</strong> ${control.control_number}<br>