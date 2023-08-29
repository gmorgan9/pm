// document.addEventListener("DOMContentLoaded", function () {
//     // Fetch data from your Flask API
//     fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
//         .then((response) => response.json())
//         .then((data) => {
//             // Get the HTML elements where you want to display the data
//             const cc1ControlsList = document.getElementById('cc1-controls-list');
//             const cc2ControlsList = document.getElementById('cc2-controls-list');

//             // Function to display controls for a given section
//             function displayControls(sectionData, controlsList, sectionName) {
//                 if (sectionData) {
//                     // Process and display controls for the section
//                     sectionData.forEach((control) => {
//                         // Create a new element for each audit control
//                         const auditControlDiv = document.createElement('div');
//                         auditControlDiv.innerHTML = `
//                             <div class="table-responsive">
//                                 <table class="table">
//                                     <thead>
//                                         <tr>
//                                             <th scope="col" style="width: 15%;">Control Key</th> 
//                                             <th scope="col">Point of Focus</th>
//                                             <th scope="col">Illustrative Control</th>
//                                         </tr>
//                                     </thead>
//                                     <tbody>
//                                         <tr>
//                                             <td style="width: 8%;">${control.control_section}</td>
//                                             <td style="width: 45%;">${control.point_of_focus}</td>
//                                             <td style="width: 45%;">${control.control_activity}</td>
//                                         </tr>
//                                     </tbody>
//                                 </table>
//                             </div>
//                         `;


//                         // Append the control element to the section's controls list
//                         controlsList.appendChild(auditControlDiv);
//                     });
//                 } else {
//                     // Section controls not found
//                     const noControlsDiv = document.createElement('div');
//                     noControlsDiv.textContent = `No controls found for Section ${sectionName}.`;
//                     controlsList.appendChild(noControlsDiv);
//                 }
//             }

//             // Display controls for 'CC1' section
//             displayControls(data['CC1'], cc1ControlsList, 'CC1');

//             // Display controls for 'CC2' section
//             displayControls(data['CC2'], cc2ControlsList, 'CC2');
//         })
//         .catch((error) => {
//             console.error('Error:', error);
//         });
// });







document.addEventListener("DOMContentLoaded", function () {
    // Fetch data from your Flask API
    fetch('https://app-aarc-api.morganserver.com/api/audit-controls')
        .then((response) => response.json())
        .then((data) => {
            // Get the HTML element where you want to display the data
            const cc1ControlsList = document.querySelector('#cc1-controls-list tbody');
            const cc2ControlsList = document.querySelector('#cc2-controls-list tbody');
            const cc3ControlsList = document.querySelector('#cc3-controls-list tbody');
            const cc4ControlsList = document.querySelector('#cc4-controls-list tbody');
            const cc5ControlsList = document.querySelector('#cc5-controls-list tbody');
            const cc6ControlsList = document.querySelector('#cc6-controls-list tbody');
            const cc7ControlsList = document.querySelector('#cc7-controls-list tbody');
            const cc8ControlsList = document.querySelector('#cc8-controls-list tbody');
            const cc9ControlsList = document.querySelector('#cc9-controls-list tbody');

            // Function to display controls for a given section
            function displayControls(sectionData, controlsList, sectionName) {
                if (sectionData) {
                    // Process and display controls for the section
                    sectionData.forEach((control) => {
                        // Create a new row for each audit control with an anchor link
                        const auditControlRow = document.createElement('tr');
                        auditControlRow.innerHTML = `
                            <td style="width: 8%;">${control.control_section}</td>
                            <td style="width: 45%;">${control.point_of_focus}</td>
                            <td style="width: 45%;">${control.control_activity}</td>
                        `;
            
                        // Create an anchor link around the entire row
                        const link = document.createElement('a');
                        link.href = '#'; // Set the href attribute to your desired link destination
                        link.classList.add('btn-link'); // Add any necessary classes
            
                        // Append the row to the anchor link
                        link.appendChild(auditControlRow);
            
                        // Append the anchor link to the section's controls list
                        controlsList.appendChild(link);
                    });
                } else {
                    // Section controls not found
                    const noControlsRow = document.createElement('tr');
                    noControlsRow.innerHTML = `
                        <td colspan="3">No controls found for Section ${sectionName}.</td>
                    `;
            
                    // Create an anchor link around the "No controls" row
                    const link = document.createElement('a');
                    link.href = '#'; // Set the href attribute to your desired link destination
                    link.classList.add('btn-link'); // Add any necessary classes
            
                    // Append the "No controls" row to the anchor link
                    link.appendChild(noControlsRow);
            
                    // Append the anchor link to the section's controls list
                    controlsList.appendChild(link);
                }
            }

            // Display controls for 'CC1' section
            displayControls(data['CC1'], cc1ControlsList, 'CC1');
            displayControls(data['CC2'], cc2ControlsList, 'CC2');
            displayControls(data['CC3'], cc3ControlsList, 'CC3');
            displayControls(data['CC4'], cc4ControlsList, 'CC4');
            displayControls(data['CC5'], cc5ControlsList, 'CC5');
            displayControls(data['CC6'], cc6ControlsList, 'CC6');
            displayControls(data['CC7'], cc7ControlsList, 'CC7');
            displayControls(data['CC8'], cc8ControlsList, 'CC8');
            displayControls(data['CC9'], cc9ControlsList, 'CC9');
        })
        .catch((error) => {
            console.error('Error:', error);
        });
});
