<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}
:root{
    --title:#fff;
    --td-color:#f6f8f9;
    --table-color:#404040;
    --btn-button:#104a8e;
    --btn-over:green;
    --label-color:#333;
    --contenair:#fff;
    --input-color:#ccc;
    --activity:#fff;
    --nav-color: #104a8e;
    --primary-color: #0E4BF1;
    --panel-color: #FFF;
    --text-color:#000;
    --color-icon:#000;
    --black-light-color:#707070;
    --border-color:#e6e5e5;
    --toggle-color: #DDD;
    --box1-color:#4DA3FF;
    --box2-color:#FFE6AC;
    --body-color:#fff;
    --box3-color:#E7D1FC;
    --title-icon-color:#fff;

    --tran-05: all 0.5s ease;
    --tran-03: all 0.3s ease;
    --tran-02: all 0.2s ease;
}
body{
    min-height: 100vh;
    background: var(--body-color);
}
body.dark{
    --title:#000;
    --td-color:#707070;
    --table-color:#ccc;
    --btn-button:green;
    --btn-over:#363;
    --label-color:#F2F2F2;
    --contenair:#333;
    --input-color:#F1F1F1;
    --activity:#ccc;
    --panel-color:  #0C0C1E;
    --nav-color:  #0C0C1E;
    --color-icon:#000;
    --white:#FFF;
    --body-color:#000;
    --text-color:#ccc;
    --black-light-color:#ccc;
    --border-color:#0C0C1E;
    --toggle-color: #fff;
    --box1-color:#3A3B3C;
    --box2-color:#3A3B3C;
    --box3-color:#3A3B3C;
    --title-icon-color:#ccc ;
}
body.dark h2{
    color: var(--title-icon-color);
}
body.dark .search-box2{
    background: var(--title-icon-color);
}
body.dark .search-box2 i{
    color: #000;
}
body.dark input{
    background: var(--title-icon-color);
}
body.dark .orders{
    background: #0C0C1E;
    color: var(--title-icon-color);
}
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 10;
    width: 220px;
    height: 100vh;
    background: var(--nav-color);
    transition: all 0.4s ease;
  }
  .sidebar.collapsed {
    width: 85px;
  }
  .sidebar .sidebar-header {
    display: flex;
    position: relative;
    padding: 5px 20px;
    align-items: center;
    justify-content: space-between;
  }
  .sidebar-header h1 {
  color: #fff;
  margin-left: 10px;
  font-weight: 600;
  }
  .sidebar-header .sidebar-toggler,
  .sidebar-menu-button {
    position: absolute;
    right: 20px;
    height: 35px;
    width: 35px;
    color: var(--title-icon-color);
    border: none;
    cursor: pointer;
    display: flex;
    background: none;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    transition: 0.4s ease;
  }
  .sidebar.collapsed .sidebar-header .sidebar-toggler {
    transform: translate(-4px, 50px);
  }
  .sidebar-header .sidebar-toggler i,
  .sidebar-menu-button i {
    color: var(--title-icon-color);
    font-size: 2rem;
    transition: 0.4s ease;
  }
  .sidebar.collapsed .sidebar-header .sidebar-toggler i {
    transform: rotate(180deg);
  }
  .sidebar-header .sidebar-toggler:hover{
    background: #4b61b1;
  }
  .sidebar-nav .nav-list {
    list-style: none;
    display: flex;
    gap: 4px;
    padding: 20px 15px;
    flex-direction: column;
    transform: translateY(15px);
    transition: 0.4s ease;
  }
  .sidebar .sidebar-nav .primary-nav {
    overflow-y: auto;
    scrollbar-width: thin;
    padding-bottom: 20px;
    height: calc(100vh - 227px);
    scrollbar-color: transparent transparent;
  }
  .sidebar .sidebar-nav .primary-nav:hover {
    scrollbar-color: #EEF2FF transparent;
  }
  .sidebar.collapsed .sidebar-nav .primary-nav {
    overflow: unset;
    transform: translateY(65px);
  }
  .sidebar-nav .nav-item .nav-link {
    color: #fff;
    display: flex;
    gap: 12px;
    white-space: nowrap;
    border-radius: 8px;
    padding: 15px 15px;
    align-items: center;
    text-decoration: none;
    transition: 0.4s ease;
  }

  .sidebar-nav .nav-item .nav-link .icon{
    font-size: 16px;
  }
  
  .sidebar-nav .nav-item:is(:hover, .open)>.nav-link:not(.dropdown-title) {
    color: #151A2D;
    background: #EEF2FF;
  }
  .sidebar .nav-link .nav-label {
    transition: opacity 0.3s ease;
    font-size: 12px;
  }
  .sidebar.collapsed .nav-link :where(.nav-label, .dropdown-icon) {
    opacity: 0;
    pointer-events: none;
    
  }
  .sidebar.collapsed .nav-link .dropdown-icon {
    transition: opacity 0.3s 0s ease;
  }
  .sidebar-nav .secondary-nav {
    position: absolute;
    bottom: 5px;
    width: 100%;
    background: var(--nav-color);
  }
  .sidebar-nav .nav-item {
    position: relative;
  }
  /* Dropdown Stylings */
  .sidebar-nav .dropdown-container .dropdown-icon {
    margin: 0 -4px 0 auto;
    transition: transform 0.4s ease, opacity 0.3s 0.2s ease;
  }
  .sidebar-nav .dropdown-container.open .dropdown-icon {
    transform: rotate(180deg);
  }
  .sidebar-nav .dropdown-menu {
    height: 0;
    overflow-y: hidden;
    list-style: none;
    padding-left: 15px;
    transition: height 0.4s ease;
  }
  .sidebar.collapsed .dropdown-menu {
    position: absolute;
    top: -10px;
    left: 100%;
    opacity: 0;
    height: auto !important;
    padding-right: 10px;
    overflow-y: unset;
    pointer-events: none;
    border-radius: 0 10px 10px 0;
    background: var(--nav-color);
    transition: 0s;
  }
  .sidebar.collapsed .dropdown-menu:has(.dropdown-link) {
    padding: 13px 10px 7px 24px;
  }
  .sidebar.collapsed .sidebar-header h1{
    margin-left: -10px;
  }
  .sidebar.sidebar.collapsed .nav-item:hover>.dropdown-menu {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(12px);
    transition: all 0.4s ease;
  }
  .sidebar.sidebar.collapsed .nav-item:hover>.dropdown-menu:has(.dropdown-link) {
    transform: translateY(10px);
  }
  .dropdown-menu .nav-item .nav-link {
    color: #F1F4FF;
    padding: 9px 15px;
    font-size: 12px;
  }
  .sidebar.collapsed .dropdown-menu .nav-link {
    padding: 7px 10px;
  }
  .dropdown-menu .nav-item .nav-link.dropdown-title {
    display: none;
    color: #fff;
    padding: 9px 15px;
    font-size: 14px;
  }
  .dropdown-menu:has(.dropdown-link) .nav-item .dropdown-title {
    font-size: 14px;
    padding: 7px 15px;
  }
  .sidebar.collapsed .dropdown-menu .nav-item .dropdown-title {
    display: block;
    font-size: 12px;
  }
  .sidebar-menu-button {
    display: none;
  }

  /* Responsive media query code for small screens */
  @media (max-width: 768px) {
    .sidebar-menu-button {
      position: fixed;
      left: 20px;
      top: 20px;
      height: 40px;
      width: 42px;
      display: flex;
      color: #F1F4FF;
      background: #151A2D;
    }
    .sidebar.collapsed .sidebar-header .sidebar-toggler i{
        display: none;
    }
    .sidebar.collapsed .sidebar-header .sidebar-toggler {
      transform: none;
    }
    .sidebar.collapsed .sidebar-nav .primary-nav {
      transform: translateY(15px);
    }
    .sidebar .sidebar-header h1{
        margin-left: -10px;
    }
    .stats {
        display: flex;
        flex-direction: column;
        gap: 35px;
    }
    .dashboard-section{
        display: flex;
        flex-direction: column;
        gap: 35px;
    }
  }
  .dashboard{
    position: relative;
    left: 220px;
    background-color: var(--panel-color);
    height: 100vh;
    width: calc(100% - 220px);
    padding: 10px   14px;
    transition: var(--tran-05);
}
.sidebar.collapsed ~ .dashboard{
    left: 73px;
    width: calc(100% - 73px);
    margin-left: 10px;
}
.dashboard .top{
    position: fixed;
    left: 220px;
    top: 0;
    display: flex;
    align-items: center;
    width: calc(100% - 220px);
    justify-content: space-between;
    padding: 7px 10px; 
    background-color: var(--panel-color);
    border-bottom: 1px solid var(--border-color);
    transition: var(--tran-05);
    z-index: 10;
}
.dashboard .top .icon_top{
    margin-left: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}
body.dark .uil{
    color: var(--title-icon-color);
}
body.dark .conteneur{
    background: #000;
}
.dashboard .top .icon_top .num{
    position: absolute;
	top: 15px;
	right: 29px;
	width: 20px;
	height: 20px;
	border-radius: 50%;
	border: 2px solid #fff;
	background: red;
	color: #fff;
	font-weight: 700;
	font-size: 12px;
	display: flex;
	justify-content: center;
	align-items: center;
    margin-right: 20px;
}
.dashboard .top .icon_top .switch-mode {
	display: block;
	min-width: 50px;
	height: 25px;
	border-radius: 25px;
	background: #fff;
    border: 1px solid grey;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	cursor: pointer;
	position: relative;
}
.dashboard .top .icon_top .switch-mode::before {
	content: '';
	position: absolute;
	top: 2px;
	left: 2px;
	bottom: 2px;
	width: calc(25px - 4px);
	background: var(--nav-color);
	border-radius: 50%;
	transition: all .3s ease;
}
body.dark .dashboard .top .icon_top .switch-mode::before {
	left: calc(100% - (25px - 4px) - 2px);
    background: green;
}

body.dark .text{
    color: var(--text-color);
}

.sidebar.collapsed ~ .dashboard .top{
    left: 90px;
    width: calc(100% - 90px);
}
.dashboard .top  .sidebar-toggle{
    font-size: 26px;
    color: var(--text-color);
    cursor: pointer;
}
.dashboard .top .search-box{
    position: relative;
    height: 45px;
    max-width: 600px;
    width: 100%;
    margin: 0 30px;
}

body.dark .text{
    color: var(--text-color);
}
h1{
    color: #0E4BF1;
    font-weight: 600;
}
h3{
    color: var(--text-color);
}



/*DEBUT BLOC D'ACCUEIL*/

.main-title{
    color: rgba(113, 99, 186, 255);
    padding-bottom: 10px;
    font-size: 15px;
}
.preview{
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}
.preview {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.preview .search-box {
    position: relative;
    height: 45px;
    max-width: 600px;
    width: 100%;
    margin: 0 0px;
}

.preview .search-box input {
    position: absolute;
    border: 2px solid var(--border-color);
    background-color: var(--panel-color);
    padding: 0 20px 0 40px;
    border-radius: 10px;
    height: 35px;
    width: 485px;
    color: var(--text-color);
    font-size: 12px;
    font-weight: 400;
    outline: none;
}

.preview .search-box i {
    position: absolute;
    left: 15px;
    font-size: 15px;
    z-index: 1;
    top: 35%;
    transform: translateY(-50%);
    color: var(--nav-color);
}


.search-box2 {
    display: flex;
    align-items: center;
    width: 100%;
    height: 45px;
    max-width: 600px;
    margin-bottom: 10px;
    background: #fff;
    padding-left: 10px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
}

.search-box2:hover {
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.search-box2 i {
    font-size: 20px;
    color: #555;
    margin-right: 10px;
}

.search-box2 input {
    flex: 1;
    border: none;
    outline: none;
    padding: 8px;
    font-size: 12px;
    border-radius: 50px;
}

.search-box2 button {
    background: var(--nav-color);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.3s;
}

.search-box2 button:hover {
    background: #005bb5;
}


/* Media Queries pour la responsivité */
@media (max-width: 768px) {
    .preview .search-box input {
        width: 70%; /* Réduit la largeur du champ de texte pour les petits écrans */
        font-size: 12px; /* Agrandit la taille de la police pour une meilleure lisibilité */
    }

    .preview .search-box i {
        font-size: 18px; /* Agrandit l'icône pour mieux correspondre à la taille du champ */
    }
    .search-box2 button{
        display: none;
    }
}

@media (max-width: 480px) {
    .preview {
        flex-direction: column;
        align-items: flex-start; /* Arrange les éléments en colonne sur les très petits écrans */
    }

    .preview .search-box {
        width: 100%; /* Donne une largeur de 100% sur les petits écrans */
    }

    .preview .search-box input {
        width: 100%; /* Le champ de texte occupe toute la largeur */
        font-size: 12px; /* Augmente légèrement la taille de la police pour un meilleur confort */
    }

    .preview .search-box i {
        left: 10px; /* Décale l'icône pour mieux correspondre au champ */
        font-size: 15px; /* Agrandit encore l'icône sur les petits écrans */
    }
    .mode .a{
        display: flex;
    }
    .mode .a .uil2{
        display: flex;
    }
    .top .uil{
        display: none;
    }
    .top h1{
        font-size: 25px;
        font-weight: 600;
    }
    
}

/*FIN BLOC D'ACCUEIL*/

/*DEBUT BLOC D'AFFICHAGE*/


.dashboard-section {
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-left: 10px;
    width: 100%;
}

.orders {
    background-color: #fff;
    padding: 20px;
    width: 100%;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex: 1;
    margin-right: 20px;
}

.orders h3 {
    margin-bottom: 20px;
}

.orders table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.orders table th{
    background: var(--nav-color);
    color: #fff;
}
tfoot{
    color: #fff;
    background-color: var(--nav-color);
    border-radius: 5px;
}

tfoot tr td{
    font-size: 12px;
    text-align: center;
}
.orders table th, 
.orders table td {
    padding: 10px;
    font-weight: 500;
    text-align: left;
    border-bottom: 1px solid #ecf0f1;
    font-size:10px;
}
body.dark table td{
    border-bottom: none;
}
body.dark table td .uil{
    color: var(--title-icon-color);
}
.orders table td .uil{
    font-size: 18px;
    color: #000;
    text-align: center;
    margin-left: 10px;
    cursor: pointer;
}
.uil{
    font-size: 24px;
    color: var(--nav-color);
}

.orders .status {
    font-weight: bold;
}

.orders .status.delivered {
    color: green;
}

.orders .status.pending {
    color: orange;
}

.orders .status.return {
    color: red;
}

.orders .status.inprogress {
    color: blue;
}
@media (max-width: 780px) {
    .dash-content .boxes .box{
        width: calc(100% / 2 - 15px);
        margin-top: 15px;

    }
    .dashboard .top h2{
        font-size: 20px;
    }
    .dashboard .top .search-box2{
        margin-left: 10px;
    }
    .dashboard .top .search-box2{
        height: 35px;
    }
    .dashboard .top .search-box2 i{
        font-size: 12px;
    }

}
@media (max-width: 560px) {
    .dash-content .boxes .box{
        width: 100%;
    }
}

@media (max-width: 500px) {
    .dashboard .top  .sidebar-toggle{
        display: none;
    }
    h3{
        font-size: 12px;
    }
    .dashboard .admin{
        display: none;
    }
    .dash-content .title .text{
        font-size: 15px;
    }
    .dashboard .top h2{
        display: none;
    }
    .dashboard .top .icon_top .num{
        display: none;
    }
}

.conteneur {
    width: 100%;
    position: relative;
    margin:     50px 0 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}


.form-container {
    margin: 0 auto;
    max-width: 600px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease-in-out;
    text-align: center;
}
body.dark .form-container{
    background: #0C0C1E;
    color: var(--title-icon-color);
}
body.dark .form-container textarea{
    background: #0C0C1E;
    color: var(--title-icon-color);
    border: 1px solid #555;
}
body.dark .form-container select{
    background: #0C0C1E;
    color: var(--title-icon-color);
    border: 1px solid #555;

}
body.dark .form-container .gender-box h3{
    color: var(--title-icon-color);
}
body.dark .form-container .input-box input{
    background: #0C0C1E;
    color: var(--title-icon-color);
    border: 1px solid #555;
}
body.dark button{
    background: linear-gradient(45deg, #0d68c8, green,#7308d7);
}
body.dark button:hover{
    background: #104a8e;
    color: var(--title-icon-color);
}
.form-title {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--primary-color);
}

.input-box {
    margin-top: 15px;
    display: flex;
    flex-direction: column;
}



.input-box input, .input-box select {
    width: 100%;
    height: 38px;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 10px;
    font-size: 13px;
    font-weight:600;
    transition: 0.3s;
    outline: none;
}

textarea{
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 10px;
    font-size: 13px;
    font-weight:600;
    resize: none;
    transition: 0.3s;
    outline: none;
}
.input-box input:focus, .input-box select:focus, textarea:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 8px rgba(24, 119, 242, 0.3);
}

.colonne {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.colonne .input-box {
    flex: 1;
}
.input-box label {
    text-align:left;
    font-size: 12px;
    font-weight:600;
}

.gender-box {
    margin-top: 20px;
}

.gender-box h3 {
    font-size: 1rem;
    text-align: left;
    color: #333;
    font-weight: 500;
}

.gender-option {
    display: flex;
    gap: 15px;
    margin-top: 10px;
}

.genre {
    display: flex;
    align-items: center;
    gap: 5px;
}

.genre input {
    accent-color: var(--nav-color);
}

.btn-submit {
    width: 100%;
    height: 40px;
    background: var(--nav-color);
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    margin-top: 20px;
    font-weight: 600;
}

.btn-QR{
    width: 100%;
    height: 35px;
    background: var(--nav-color);
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    font-weight: 600;
}

.btn-submit:hover {
    background: #151A2D;
    box-shadow: 0 4px 12px rgba(0, 91, 187, 0.3);
    transform: translateY(-2px);
}
@media (max-width: 500px) {
    .colonne {
        flex-direction: column;
    }
}
/* Animation d’apparition */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .formulaire2 {
        flex-direction: column;
    }
}

@media screen and (max-width: 500px) {
    .colonne {
        flex-direction: column;
    }
}



.custom-toast {
    position: fixed;
    top: 10px;
    right: -300px;
    background: white;
    color: green;
    padding: 12px 15px;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    font-size: 14px;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 10px;
    opacity: 0;
    transition: all 0.5s ease-in-out;
}

.custom-toast i {
    font-size: 22px;
    color: green;
}

.custom-toast.show {
    right: 20px;
    opacity: 1;
    z-index: 1000;
}

.main-content {
    flex-grow: 1;
    padding: 10px;
}

.stats {
    display: flex;
    justify-content: space-between;
}

.stat-item {
    background-color: #fff;
    padding: 20px;
    text-align: center;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex: 1;
    margin-right: 20px;
    transition: all 0.5s ease-in-out;
}
.stat-item:hover{
    transform: translateY(-5px);
    background-color: var(--nav-color);
}

body.dark .stat-item{
    background: #0C0C1E;
}
.stat-item:last-child {
    margin-right: 0;
    color: var(--title);
}

.stat-item h3 {
    font-size: 24px;
    color: #3498db;
}
.stat-item h3 i{
    font-size: 24px;
    color: #3498db;
}

.stat-item p {
    color: #7f8c8d;
    font-size: 12px;
}

.dashboard-section {
    display: flex;
    justify-content: space-between;
}

.orders {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex: 1;
    margin-right: 20px;
    margin-bottom: 10px;
}

.orders h3 {
    margin-bottom: 20px;
}

.orders table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.orders table th{
    background: var(--nav-color);
    color: #fff;
 
}
tfoot{
    color: #fff;
    background-color: var(--nav-color);
    border-radius: 5px;
}
tfoot tr td{
    font-size: 14px;
    text-align: center;
}
.orders table td {
    padding: 10px;
    text-align: left;
    font-size: 12px;
    font-weight: 600;
    border-left:1px solid #ecf0f1;
    border-right:1px solid #ecf0f1;
    border-bottom: 1px solid #ecf0f1;
    max-width: 150px;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
}
.orders table td .uil{
    font-size: 20px;
    text-align: center;
    margin-left: 10px;
    cursor: pointer;
}

.orders .status {
    font-weight: bold;
}

.orders .status.delivered {
    color: green;
}

.orders .status.pending {
    color: orange;
}

.orders .status.return {
    color: red;
}

.orders .status.inprogress {
    color: blue;
}

.orders .view-all {
    background-color: var(--nav-color);
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    float: right;
}
.orders .view-all i{
    padding: 5px 10px;
    font-size: 18px;
    color: #fff;
}

.customers {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex: 0.4;
}

.customers h3 {
    margin-bottom: 20px;
}

.customers ul {
    list-style: none;
}

.customers ul li {
    padding: 10px 0;
    border-bottom: 1px solid #ecf0f1;
    display: flex;
    justify-content: space-between;
}

.customers ul li span {
    color: #7f8c8d;
}

  .sales-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    padding: 10px;
  }
  
  .sales-box {
    position: relative;
    background-color: #fff;
    padding: 20px;
    text-align: center;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex: 1;
    
    transition: all 0.5s ease-in-out;
  }
  .sales-box:hover{
    transform: translateY(-5px);
    color: white;
    cursor: pointer;
}

body.dark .sales-box{
    background: #0C0C1E;
}
  
  .sales-box .icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #f3f3f3;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin: 0 auto 10px;
  }
  body.dark .sales-box .icon{
    color: var(--title-icon-color);
    background: #000;
  }
  .sales-box h3 {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
  }
  
  .amount {
    font-size: 20px;
    font-weight: bold;
    color: #333;
  }
  
  .time {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
  }
  
  .searchResults {
        top: 130px;
        position: absolute;
        background-color: white;
        border: 1px solid #ddd;
        width: 540px;
        max-height: 100%;
        overflow-y: auto;
        display: none;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        font-size: 15px;
        font-weight: 600;
        text-align: left;
    }

    .searchResults div {
        padding: 8px;
        cursor: pointer;
    }

    .searchResults div:hover {
        background-color: #f0f0f0;
    }
    body.dark .searchResults{
        background-color: #ccc;
        color:#000;
        border:1px solid #555;
    }
    body.dark .searchResults div:hover {
        background-color: #ddd;
        color:#000;
    }
</style>