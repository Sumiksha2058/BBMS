
        const toggleBtns = document.querySelectorAll('.toggle-btn');
        const formSections = document.querySelectorAll('.form-section');

        toggleBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const sectionId = btn.getAttribute('data-section');
                toggleFormSection(sectionId);
            });
        });

        function toggleFormSection(sectionId) {
            formSections.forEach(section => {
                section.classList.remove('active');
            });

            const section = document.getElementById(sectionId);
            section.classList.add('active');
        }

        document.addEventListener("DOMContentLoaded", function() {
        var donorButton = document.getElementById("donorButton");
        var recipientButton = document.getElementById("recipientButton");
        var line = document.getElementById("line")

        donorButton.addEventListener("click", function() {

            donorButton.style.backgroundColor = "blue";
            donorButton.style.color = "#fff";
            recipientButton.style.backgroundColor = "transparent";
            recipientButton.style.color = "#000";
        });

        recipientButton.addEventListener("click", function() {
            recipientButton.style.backgroundColor = "blue";
            recipientButton.style.color = "#fff";
            donorButton.style.backgroundColor = "transparent";
            donorButton.style.color = "#000";
        });

        line.addEventListener("click", function(){
            recipientButton.style.backgroundColor = "green";
            line.style.height = "12px";
            donorButton.style.backgroundColor = "transparent";
         
        });
    });
       
