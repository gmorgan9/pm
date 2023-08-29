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
                    <button class="accordion">Section ${sectionNumber}</button>
                    <div class="panel">
                        <strong>Scope Category:</strong> ${control.scope_category}<br>
                        <strong>Control Number:</strong> ${controlNumber}<br>
                        <strong>Control Section:</strong> ${sectionControl}<br>
                        <strong>Point of Focus:</strong> ${control.point_of_focus}<br>
                        <strong>Control Activity:</strong> ${control.control_activity}<br><br>
                    </div>
                `;

                // Append the control element to the list
                auditControlsList.appendChild(auditControlDiv);

                // Group controls by section number
                if (!groupedControls[sectionNumber]) {
                    groupedControls[sectionNumber] = [];
                }
                groupedControls[sectionNumber].push(control);
            });

            // Add click event listeners to the accordions
            const accordions = document.querySelectorAll('.accordion');
            accordions.forEach((accordion) => {
                accordion.addEventListener('click', function () {
                    this.classList.toggle('active');
                    const panel = this.nextElementSibling;
                    if (panel.style.display === 'block') {
                        panel.style.display = 'none';
                    } else {
                        panel.style.display = 'block';
                    }
                });
            });
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});