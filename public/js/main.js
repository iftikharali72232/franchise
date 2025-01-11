
$(document).ready(function() {
  $('.toggleSidebar').on('click', function() {
    const sidebar = $('#sidebar');
    if (sidebar.hasClass('md:flex')) {
        sidebar.removeClass('md:flex').addClass('hidden');
    } else {
        sidebar.addClass('md:flex').removeClass('hidden');
    }
  });

  $('.togglePassword').on('click', function () {
    const passwordInput = $('#password');
    const eyeOpen = $('#eyeOpen');
    const eyeClosed = $('#eyeClosed');

    // Toggle password visibility
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

  $('.toggleConfirmPassword').on('click', function () {
    const passwordInput = $('#confirm-password');
    const eyeOpen = $('#eyeOpen2');
    const eyeClosed = $('#eyeClosed2');

    // Toggle password visibility
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
});

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