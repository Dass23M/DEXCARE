document.getElementById('submitBtn').addEventListener('click', function(event) {
    event.preventDefault(); 
    const form = document.getElementById('prescriptionForm');
    const formData = new FormData(form);

    
    const requiredFields = ['picture', 'name', 'address', 'phone', 'email', 'branch'];
    let isFormValid = true;

    
    requiredFields.forEach(field => {
        if (!formData.get(field)) {
            alert(`${field.charAt(0).toUpperCase() + field.slice(1)} is required.`);
            isFormValid = false;
        }
    });

    if (isFormValid) {
        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit_prescription.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert('Data added successfully!');
                form.reset(); 
            } else {
                alert('Error adding data.');
            }
        };

        xhr.send(formData);
    }
});
