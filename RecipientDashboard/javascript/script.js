const toggler = document.querySelector(".btn");
toggler.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("collapsed");
    document.querySelector(".main").classList.toggle("collapsed");
});

// Profile section scripts
document.getElementById('editPersonalBtn').addEventListener('click', function() {
    toggleEditSection('viewPersonalInfo', 'editPersonalForm', 'editPersonalBtn', 'cancelPersonalBtn');
});
document.getElementById('cancelPersonalBtn').addEventListener('click', function() {
    toggleEditSection('viewPersonalInfo', 'editPersonalForm', 'editPersonalBtn', 'cancelPersonalBtn', true);
});
document.getElementById('savePersonalBtn').addEventListener('click', function(event) {
    event.preventDefault();
    savePersonalInfo();
    toggleEditSection('viewPersonalInfo', 'editPersonalForm', 'editPersonalBtn', 'cancelPersonalBtn', true);
    showNotification('personalNotification');
});

// Health Information toggle
document.getElementById('editHealthBtn').addEventListener('click', function() {
    toggleEditSection('viewHealthInfo', 'editHealthForm', 'editHealthBtn', 'cancelHealthBtn');
});
document.getElementById('cancelHealthBtn').addEventListener('click', function() {
    toggleEditSection('viewHealthInfo', 'editHealthForm', 'editHealthBtn', 'cancelHealthBtn', true);
});
document.getElementById('saveHealthBtn').addEventListener('click', function(event) {
    event.preventDefault();
    saveHealthInfo();
    toggleEditSection('viewHealthInfo', 'editHealthForm', 'editHealthBtn', 'cancelHealthBtn', true);
    showNotification('healthNotification');
});

function toggleEditSection(viewId, formId, editBtnId, cancelBtnId, cancel = false) {
    const viewSection = document.getElementById(viewId);
    const editForm = document.getElementById(formId);
    const editBtn = document.getElementById(editBtnId);
    const cancelBtn = document.getElementById(cancelBtnId);

    if (cancel) {
        editForm.style.display = 'none';
        viewSection.style.display = 'block';
        editBtn.style.display = 'inline';
        cancelBtn.style.display = 'none';
    } else {
        editForm.style.display = 'block';
        viewSection.style.display = 'none';
        editBtn.style.display = 'none';
        cancelBtn.style.display = 'inline';
    }
}

function savePersonalInfo() {
    document.getElementById('viewFullName').textContent = document.getElementById('fullName').value;
    document.getElementById('viewEmail').textContent = document.getElementById('userEmail').value;
    document.getElementById('viewPhoneNumber').textContent = document.getElementById('phoneNumber').value;
}

function saveHealthInfo() {
    document.getElementById('viewBloodGroup').textContent = document.getElementById('bloodGroup').value;
}

function showNotification(notificationId) {
    const notification = document.getElementById(notificationId);
    notification.style.display = 'block';
    setTimeout(() => {
        notification.style.display = 'none';
    }, 3000); // Hide notification after 3 seconds
}
