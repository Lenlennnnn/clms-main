function alertTopEnd(message, icon) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-right",
    iconColor: "white",
    customClass: {
      popup: "colored-toast",
    },
    showCloseButton: true,
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
  });

  Toast.fire({
    icon: icon,
    title: message,
  });
}

function alertCenterTimer(message, icon, title) {
  Swal.fire({
    title: title,
    icon: icon,
    text: message,
    timer: 1500,
    timerProgressBar: true,
    allowOutsideClick: true,
    didOpen: () => {
      Swal.showLoading();
      const b = Swal.getHtmlContainer().querySelector("b");
      timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft();
      }, 100);
    },
    willClose: () => {
      clearInterval(timerInterval);
    },
  });
}

function alertCenter(message, icon, title) {
  Swal.fire({
    title: title,
    icon: icon,
    html: message,
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    showCancelButton: false,
    confirmButtonText: "Okay",
  });
}
