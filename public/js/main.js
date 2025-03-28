
$(document).ready(function() {
  // Toggle sidebar
  $('.toggleSidebar').on('click', function() {
    const sidebar = $('#sidebar');
    if (sidebar.hasClass('lg:flex')) {
        sidebar.removeClass('lg:flex').addClass('hidden');
    } else {
        sidebar.addClass('lg:flex').removeClass('hidden');
    }
  });

  // Toggle password visibility
  $('.togglePassword').on('click', function () {
    const passwordInput = $('#password');
    const eyeOpen = $('#eyeOpen');
    const eyeClosed = $('#eyeClosed');

    if (passwordInput.attr('type') === 'password') {
      passwordInput.attr('type', 'text');
      eyeOpen.addClass('hidden');
      eyeClosed.removeClass('hidden');
    } else {
      passwordInput.attr('type', 'password');
      eyeOpen.removeClass('hidden');
      eyeClosed.addClass('hidden');
    }
  });

  // Toggle password visibility
  $('.toggleConfirmPassword').on('click', function () {
    const passwordInput = $('#confirm-password');
    const eyeOpen = $('#eyeOpen2');
    const eyeClosed = $('#eyeClosed2');

    if (passwordInput.attr('type') === 'password') {
      passwordInput.attr('type', 'text');
      eyeOpen.addClass('hidden');
      eyeClosed.removeClass('hidden');
    } else {
      passwordInput.attr('type', 'password');
      eyeOpen.removeClass('hidden');
      eyeClosed.addClass('hidden');
    }
  });

  // notification dropdown code
  const $notificationDropdown = $('#notificationDropdown');

  // Toggle dropdown visibility on button click
  $('#notificationButton, #notificationClose').on('click', function () {
      $notificationDropdown.toggleClass('hidden');
  });

  // modal close btn
  $(".modal").on("click", ".close-modal", function () {
    $(this).closest(".modal").addClass("hidden");
  });
});

function changeLanguage(id='color_mode') {
  const isArabic = document.getElementById(id).checked;

  // Redirect to the appropriate language URL
  const newLang = isArabic ? 'ar' : 'en';
  window.location.href = `/lang/${newLang}`;
}

function previewImage(event) {
  const file = event.target.files[0];
  const preview = document.getElementById("imagePreview");
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    preview.src = "/images/profile-placeholder.jpg"; // Placeholder image if no image selected
  }
}
