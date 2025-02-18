<style>
    .nav-header #login {
    float: right;
}
.custom-account-link {
        background-color:rgb(15, 34, 177); /* Light Blue */
        border: 1px solid #bce8f1; /* Slightly darker blue border */
        color:rgb(231, 234, 235); /* Text color */
        padding: 8px 15px; /* Padding */
        display: inline-block; /* Ensure it's properly displayed */
        text-decoration: none; /* Remove underline */
        border-radius: 20px; /* Rounded edges */
        margin-bottom: 10px;
    }

    .custom-account-link:hover {
        background-color: #bce8f1; /* Slightly darker on hover */
        border-color: #a6e1ec;
        color:rgb(69, 64, 232);
    }
</style>
<div class="container-fluid">
    <div class="row nav-body">
        <div class="col-sm-8 nav-header">
            <img src="https://www.oscaportal.com/logo/logo.png" alt="Office of Senior Citizen Affairs Malasiqui" title="Office of Senior Citizen Affairs Malasiqui" class="nav-logo">         
            <a class="navbar-brand" href="index.php">Office of Senior Citizen Affairs <br>Malasiqui</a>
        </div>
<<<<<<< HEAD
        <div class="col-sm-4 nav-header spacingmobile ">
   
        <a href="././my-account/index.php" id="login"  class="btn btn-info custom-account-link">
            My Account
        </a>
       
     
        <input type="text" id="searchInput" class="form-control" placeholder="Search" onkeyup="searchMenu()">
      
        <ul id="searchResults" class="dropdown-menu" style="display: none; position: absolute; width: 100%;"></ul>
        <script>
function searchMenu() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let menuLinks = document.querySelectorAll(".navmenu a");
    let resultsDropdown = document.getElementById("searchResults");

    resultsDropdown.innerHTML = "";
    resultsDropdown.style.display = "none"; // Hide dropdown initially

    if (input.trim() === "") return; // Do nothing if input is empty

    let resultsFound = 0;
    menuLinks.forEach(link => {
        let text = link.innerText.toLowerCase();
        if (text.includes(input)) {
            let listItem = document.createElement("li");
            listItem.innerHTML = `<a href="${link.href}" class="dropdown-item">${link.innerText}</a>`;
            resultsDropdown.appendChild(listItem);
            resultsFound++;
        }
    });

    if (resultsFound > 0) {
        resultsDropdown.style.display = "block"; // Show dropdown if results exist
    }
}

// Hide dropdown when clicking outside
document.addEventListener("click", function(event) {
    if (!document.getElementById("searchInput").contains(event.target)) {
        document.getElementById("searchResults").style.display = "none";
    }
});
</script>
=======
        <div class="col-sm-4 nav-header spacingmobile">
            <input type="text" class="form-control "placeholder="Search">
>>>>>>> 8eccebdcf9e512e252379c259a47eaee57446794
        </div>
    </div>
</div>

<div class="navmenu">
    <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="benefits.php">Benefits</a></li>
        <li><a href="activities.php">Activities</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Analytics <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="Status.php">Status</a></li>
                <li><a href="bloodtype.php">Blood Type</a></li>
                <li><a href="Class.php">Classification</a></li>
                <li><a href="religion.php">Religion</a></li>
                <li><a href="sex.php">Sex</a></li>
                <li><a href="educational.php">Educational Attainment</a></li>
                <li><a href="civilstatus.php">Civil Status</a></li>
                <li><a href="employment.php">Employment Status</a></li>
            </ul>
        </li>
        <li><a href="register.php">Register</a></li>
    </ul>
</div>
