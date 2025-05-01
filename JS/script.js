const body = document.querySelector("body"),
      modeToggle = body.querySelector(".switch-mode");

let getMode = localStorage.getItem("mode"); 
if(getMode && getMode === "dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status"); 
if(getStatus && getStatus === "close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "ligth");
    }   
});

const toggleDropdown = (dropdown, menu, isOpen) => {
    dropdown.classList.toggle("open", isOpen);
    menu.style.height = isOpen ? `${menu.scrollHeight}px` : "0";
  };
  // Close all open dropdowns
  const closeAllDropdowns = () => {
    document.querySelectorAll(".dropdown-container.open").forEach((openDropdown) => {
      toggleDropdown(openDropdown, openDropdown.querySelector(".dropdown-menu"), false);
    });
  };
  // Attach click event to all dropdown toggles
  document.querySelectorAll(".dropdown-toggle").forEach((dropdownToggle) => {
    dropdownToggle.addEventListener("click", (e) => {
      e.preventDefault();
      const dropdown = dropdownToggle.closest(".dropdown-container");
      const menu = dropdown.querySelector(".dropdown-menu");
      const isOpen = dropdown.classList.contains("open");
      closeAllDropdowns(); // Close all open dropdowns
      toggleDropdown(dropdown, menu, !isOpen); // Toggle current dropdown visibility
    });
  });
  // Attach click event to sidebar toggle buttons
  document.querySelectorAll(".sidebar-toggler, .sidebar-menu-button").forEach((button) => {
    button.addEventListener("click", () => {
      closeAllDropdowns(); // Close all open dropdowns
      document.querySelector(".sidebar").classList.toggle("collapsed"); // Toggle collapsed class on sidebar
    });
  });
  
  // Collapse sidebar by default on small screens
  if (window.innerWidth <= 1024) document.querySelector(".sidebar").classList.add("collapsed");

document.getElementById("patient-form").addEventListener("submit", function (event) {
    event.preventDefault(); // Empêche l'envoi classique

    let toast = document.createElement("div");
    toast.classList.add("custom-toast");
    toast.innerHTML = `
        <i class="uil uil-check-circle"></i> Patient enregistré avec succès !
    `;
    
    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add("show");
    }, 100); 

    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 500);
    }, 4000);

    this.reset(); // Réinitialise le formulaire
});

document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".form-group input, .form-group select");

    // Ajoute l'effet de label flottant
    inputs.forEach(input => {
        input.addEventListener("focus", () => {
            input.parentElement.classList.add("active");
        });

        input.addEventListener("blur", () => {
            if (input.value === "") {
                input.parentElement.classList.remove("active");
            }
        });
    });

    document.getElementById("patient-form").addEventListener("submit", function (event) {
        event.preventDefault();
        let isValid = true;
        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.style.borderColor = "red";
            } else {
                input.style.borderColor = "#ccc";
            }
        });

        if (!isValid) {
            showToast("Veuillez remplir tous les champs.", "error");
            return;
        }

        setTimeout(() => {
            showToast("Patient enregistré avec succès !", "success");
            document.getElementById("patient-form").reset();
        }, 500);
    });

    // Fonction pour afficher le toast
    function showToast(message, type) {
        const toast = document.createElement("div");
        toast.classList.add("toast", type);
        toast.innerText = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = "1";
        }, 100);
        
        setTimeout(() => {
            toast.style.opacity = "0";
            setTimeout(() => {
                toast.remove();
            }, 500);
        }, 3000);
    }
});
function generateQRCode() {
    let qrData = document.getElementById('qr-data').value;
    let qrCodeDiv = document.getElementById('qr-code');
    
    if (qrData.trim() !== '') {
        qrCodeDiv.innerHTML = '';
        let qrImg = document.createElement('img');
        qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(qrData)}`;
        qrCodeDiv.appendChild(qrImg);
    } else {
        alert("Veuillez entrer des informations pour générer le QR Code.");
    }
}

