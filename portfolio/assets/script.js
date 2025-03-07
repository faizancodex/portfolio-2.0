document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.querySelector('.hamburger');
    const mobile_navmenu = document.querySelector('.mobile_navmenu');
    const navLinks = document.querySelectorAll('.navLinks');

    hamburger.addEventListener('click', function () {
        hamburger.classList.toggle('active');
        mobile_navmenu.classList.toggle('active');

        if (mobile_navmenu.classList.contains('active')) {
            document.body.style.overflow = 'hidden'; // Disable scrolling
        } else {
            document.body.style.overflow = ''; // Enable scrolling
        }
    });

    // Add a click event listener to all anchor elements inside the menu
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            hamburger.classList.remove('active'); // Remove 'active' class from the hamburger icon
            mobile_navmenu.classList.remove('active'); // Remove 'active' class from the mobile navigation menu
            document.body.style.overflow = ''; // Enable scrolling
        });
    });
});

var tabLinks = document.getElementsByClassName('tab-links');
var tabContents = document.getElementsByClassName('tab-contents');

function openTab(tabName) {
    for (tabLink of tabLinks) {
        tabLink.classList.remove('active-link');
    }
    for (tabContent of tabContents) {
        tabContent.classList.remove('active-tab');
    }
    event.currentTarget.classList.add('active-link');
    document.getElementById(tabName).classList.add('active-tab');
}

// for load more btn

let btn1 = document.querySelector('#more1');
let btn2 = document.querySelector('#more2');
let currentItemWork = 3;
let currentItemService = 3;


btn1.onclick = () => {
    let serviceItems = document.querySelectorAll('.service-item');
    
    // Display the next three service items
    for (let i = currentItemService; i < currentItemService + 3 && i < serviceItems.length; i++) {
        serviceItems[i].style.display = 'inline-block';
    }
    
    currentItemService += 3;
};

btn2.onclick = () => {
    let workItems = document.querySelectorAll('.work');
    
    // Display the next three work items
    for (let i = currentItemWork; i < currentItemWork + 4 && i < workItems.length; i++) {
        workItems[i].style.display = 'inline-block';
    }
    
    currentItemWork += 3;
};


// auto focus fullname Inputfield
function redirectToContactForm(event) {
    event.preventDefault(); // Prevents the default behavior of the anchor link
    var contactForm = document.getElementById("contact");
    contactForm.scrollIntoView(); // Scrolls to the contact form
    var fullnameInput = document.getElementById("fullname");
    fullnameInput.focus(); // Focuses on the fullname input field
}


