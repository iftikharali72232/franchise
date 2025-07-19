
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

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('global_search');
        const tableBody = document.getElementById('branch_list_data');
        const rows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();

            rows.forEach(row => {
                const branchName = row.cells[0]?.innerText.toLowerCase() || '';
                const branchNo   = row.cells[1]?.innerText.toLowerCase() || '';

                if (branchName.includes(query) || branchNo.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

     document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('global_search');
        const tableBody = document.getElementById('latter_list_data');
        const rows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();

            rows.forEach(row => {
                const branchName = row.cells[0]?.innerText.toLowerCase() || '';
                const branchNo   = row.cells[1]?.innerText.toLowerCase() || '';

                if (branchName.includes(query) || branchNo.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('global_search');
        const tableBody = document.getElementById('member_list_data');
        const rows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();

            rows.forEach(row => {
                const cell1 = row.cells[0]?.innerText.toLowerCase() || '';
                const cell2   = row.cells[1]?.innerText.toLowerCase() || '';
                const cell3 = row.cells[2]?.innerText.toLowerCase() || '';
                const cell4   = row.cells[3]?.innerText.toLowerCase() || '';

                if (cell1.includes(query) || cell2.includes(query) || cell3.includes(query) || cell4.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('global_search');
        const tableBody = document.getElementById('service_list_data');
        const rows = tableBody.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();

            rows.forEach(row => {
                const cell1 = row.cells[0]?.innerText.toLowerCase() || '';
                // const cell2   = row.cells[1]?.innerText.toLowerCase() || '';
                // const cell3 = row.cells[0]?.innerText.toLowerCase() || '';
                // const cell4   = row.cells[1]?.innerText.toLowerCase() || '';

                if (cell1.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('global_search');
        const cards = document.querySelectorAll('.report-card');

        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();

            cards.forEach(card => {
                // You can add more fields here as needed
                const branchName = card.querySelector('p.branch-name')?.innerText.toLowerCase() || '';
                const auditorName = card.querySelector('p.auditor-name')?.innerText.toLowerCase() || '';
                const sectionName = card.querySelector('p.section-name')?.innerText.toLowerCase() || '';
                const date = card.querySelector('p.date')?.innerText.toLowerCase() || '';
                if (branchName.includes(query) || auditorName.includes(query) || sectionName.includes(query) || date.includes(query)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

