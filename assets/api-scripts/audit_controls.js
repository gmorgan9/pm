document.addEventListener("DOMContentLoaded", function () {
    // Get all accordion items
    const accordionItems = document.querySelectorAll('.accordion-item');

    // Function to fetch and display controls for a specific section
    function displayControls(section) {
        // Fetch data from your Flask API for the specified section
        fetch(`https://app-aarc-api.morganserver.com/api/audit-controls?section=${section}`)
            .then((response) => response.json())
            .then((data) => {
                // Get the HTML element where you want to display the data
                const controlsList = document.getElementById(`${section.toLowerCase()}-controls`);
                
                // Clear the existing content
                controlsList.innerHTML = '';

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
                    controlsList.appendChild(auditControlDiv);
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    // Add click event listeners to accordion items
    accordionItems.forEach((item) => {
        const section = item.getAttribute('data-section');
        item.querySelector('.accordion-header').addEventListener('click', () => {
            // Toggle the display of controls when an accordion item is clicked
            const controlsList = item.querySelector('.accordion-content');
            if (controlsList.style.display === 'block') {
                controlsList.style.display = 'none';
            } else {
                controlsList.style.display = 'block';
                // Fetch and display controls for the clicked section
                displayControls(section);
            }
        });
    });
});
