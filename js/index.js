const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// show sidebar
menuBtn.addEventListener("click", () => {
  sideMenu.style.display = "block";
});

// close sidebar
closeBtn.addEventListener("click", () => {
  sideMenu.style.display = "none";
});

// change theme
themeToggler.addEventListener("click", () => {
  document.body.classList.toggle("dark-theme-variables");

  themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
  themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
});

jQuery(function ($) {
  $("table tr:lt(11)").addClass("active");

  $("a.load_more").on("click", function (e) {
    e.preventDefault();
    var $rows = $("table tr");

    var lastActiveIndex = $rows.index($rows.filter(".active").last());

    $rows.filter(":lt(" + (lastActiveIndex + 13) + ")").addClass("active");

    // hide the button when all elements visible
    $(this).toggle($rows.filter(":hidden").length !== 0);
  });
});
