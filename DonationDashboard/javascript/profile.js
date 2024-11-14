const updateProfile = async () => {
    const data = {
        fullName: document.getElementById('fullName').value,
        userEmail: document.getElementById('email').value,
        phoneNumber: document.getElementById('contact').value,
        bloodGroup: document.getElementById('blood_group').value
    };

    try {
        const response = await fetch('path/to/update_profile.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        if (result.status === 'success') {
            alert(result.message);
            // Update the profile information on the page
            document.getElementById('viewFullName').textContent = result.fullName;
            document.getElementById('viewEmail').textContent = result.userEmail;
            document.getElementById('viewPhoneNumber').textContent = result.phoneNumber;
            document.getElementById('viewBloodGroup').textContent = result.bloodGroup;
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while updating the profile.');
    }
};
