let setActiveLabInterval;
topbar.show();

// get the user role from sessionStorage (replace with your actual key)
const userRole = sessionStorage.getItem("userRole");

// select all elements with data-role="admin"
const adminElements = document.querySelectorAll('[data-role="admin"]');

// loop over the elements and hide them if the user role is not "admin"
adminElements.forEach((element) => {
  if (userRole === "Admin") {
    element.style.display = "block";
  }
});

//---------------- POPOVER --------------------//
var popoverTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="popover"]')
);
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl);
});

var fixedPluginButtonNav = document.querySelector(".fixed-plugin-button-nav");
var fixedPlugin = document.querySelector(".fixed-plugin");
var fixedPluginCloseButton = document.querySelectorAll(
  ".fixed-plugin-close-button"
);

if (fixedPluginButtonNav) {
  fixedPluginButtonNav.onclick = function () {
    if (!fixedPlugin.classList.contains("show")) {
      fixedPlugin.classList.add("show");
    } else {
      fixedPlugin.classList.remove("show");
    }
  };
}

fixedPluginCloseButton.forEach(function (el) {
  el.onclick = function () {
    fixedPlugin.classList.remove("show");
  };
});

//------------ LOGOUT BUTTON-------------//
$("#logoutbttn").click(function () {
  Swal.fire({
    title: "Confirmation",
    text: "Are you sure you want to sign out?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "api/index.php",
        dataType: "json",
        cache: false,
        data: JSON.stringify({
          mode: "logout_user",
          laboratory_id: sessionStorage.getItem("labid"),
        }),
        success: function (data) {
          if (data === "Success") {
              window.location.replace("logout.php");
              sessionStorage.clear();
          }
        },
        error: function () {
          alertCenter(somethingWentWrongContactIT, icon_error);
        },
      });
    }
  });
});

// Spinner
var spinner = function () {
  setTimeout(function () {
    if ($("#spinner").length > 0) {
      $("#spinner").removeClass("show");
    }
  }, 1);
};
spinner();

// Back to top button
$(window).scroll(function () {
  if ($(this).scrollTop() > 300) {
    $(".back-to-top").removeClass("hidden").addClass("visible");
  } else {
    $(".back-to-top").removeClass("visible").addClass("hidden");
  }
});
$(".back-to-top").click(function () {
  $("html, body").animate({ scrollTop: 0 }, 0, "swing");
  return false;
});

// Sidebar Toggler
$(".sidebar-toggler").click(function () {
  $(".sidebar, .content").toggleClass("open");
  return false;
  0;
});

// $('[data-bs-dismiss=modal]').on('click', function (e) {
//   var $t = $(this),
//       target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

// $(target)
//   .find("input,textarea,select")
//      .val('')
//      .end()
//   .find("input[type=checkbox], input[type=radio]")
//      .prop("checked", "")
//      .end();
// })
setActiveLab();
if (setActiveLabInterval === undefined) {
  setActiveLabInterval = setInterval(setActiveLab, 2000);
}


function setActiveLab(){
  $.ajax({
    type: "POST",
    url: "api/laboratory.php",
    dataType: "json",
    cache: false,
    data: JSON.stringify({
      mode: "set_active_lab",
      labid: sessionStorage.getItem("labid"),
    }),
    error: function () {
      alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}

function customFadeIn(elem, ms) {
  if (!elem) return;

  elem.style.opacity = 0;
  elem.style.filter = "alpha(opacity=0)";
  elem.style.display = "inline-block";
  elem.style.visibility = "visible";

  if (ms) {
    var opacity = 0;
    var timer = setInterval(function () {
      opacity += 50 / ms;
      if (opacity >= 1) {
        clearInterval(timer);
        opacity = 1;
      }
      elem.style.opacity = opacity;
      elem.style.filter = "alpha(opacity=" + opacity * 100 + ")";
    }, 50);
  } else {
    elem.style.opacity = 1;
    elem.style.filter = "alpha(opacity=1)";
  }
}

function customFadeOut(elem, ms) {
  if (!elem) return;

  if (ms) {
    var opacity = 1;
    var timer = setInterval(function () {
      opacity -= 50 / ms;
      if (opacity <= 0) {
        clearInterval(timer);
        opacity = 0;
        elem.style.display = "none";
        elem.style.visibility = "hidden";
      }
      elem.style.opacity = opacity;
      elem.style.filter = "alpha(opacity=" + opacity * 100 + ")";
    }, 50);
  } else {
    elem.style.opacity = 0;
    elem.style.filter = "alpha(opacity=0)";
    elem.style.display = "none";
    elem.style.visibility = "hidden";
  }
}
