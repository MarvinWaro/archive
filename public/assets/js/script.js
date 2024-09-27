$(document).ready(function() {
    // start: Sidebar
    $('.sidebar-dropdown-menu').slideUp('fast')

    $('.sidebar-menu-item.has-dropdown > a, .sidebar-dropdown-menu-item.has-dropdown > a').click(function(e) {
        e.preventDefault()

        if(!($(this).parent().hasClass('focused'))) {
            $(this).parent().parent().find('.sidebar-dropdown-menu').slideUp('fast')
            $(this).parent().parent().find('.has-dropdown').removeClass('focused')
        }

        $(this).next().slideToggle('fast')
        $(this).parent().toggleClass('focused')
    })

    $('.sidebar-toggle').click(function() {
        $('.sidebar').toggleClass('collapsed')

        $('.sidebar.collapsed').mouseleave(function() {
            $('.sidebar-dropdown-menu').slideUp('fast')
            $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused')
        })
    })

    $('.sidebar-overlay').click(function() {
        $('.sidebar').addClass('collapsed')

        $('.sidebar-dropdown-menu').slideUp('fast')
        $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused')
    })

    if(window.innerWidth < 768) {
        $('.sidebar').addClass('collapsed')
    }
})

// For Fade out Alert

// Function to close alert with fade effect
function closeAlertWithFade(alertId) {
    var alert = document.getElementById(alertId);
    if (alert) {
        // Add fade-out class
        alert.classList.add('fade-out');

        // Wait for the fade-out animation to complete before closing
        setTimeout(function () {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 500); // Adjust to match your fade duration
    }
}

// Close success alert after 3 seconds
setTimeout(function () {
    closeAlertWithFade('success');
}, 3000);

// Close danger alert after 3 seconds
setTimeout(function () {
    closeAlertWithFade('danger');
}, 3000);


// dropdown year and month create


document.addEventListener('DOMContentLoaded', function () {
    const yearSelect = document.getElementById('yearSelect');
    const monthSelect = document.getElementById('monthSelect');
    const subYearSelect = document.getElementById('submission_year_select');
    const subMonthSelect = document.getElementById('submission_month_select');

    function updateSubmissionYearOptions() {
        const selectedYear = parseInt(yearSelect.value);

        for (let option of subYearSelect.options) {
            option.disabled = false;
            option.hidden = false;
        }

        for (let option of subYearSelect.options) {
            const year = parseInt(option.value);
            if (year < selectedYear) {
                option.disabled = true;
                option.hidden = true;
            }
        }
    }

    function updateSubmissionMonthOptions() {
        const selectedYear = parseInt(yearSelect.value);
        const selectedMonth = parseInt(monthSelect.value);
        const selectedSubYear = parseInt(subYearSelect.value);

        for (let option of subMonthSelect.options) {
            option.disabled = false;
            option.hidden = false;
        }

        // If submission year is the same as folder year, restrict based on the selected folder month
        if (selectedSubYear === selectedYear) {
            for (let option of subMonthSelect.options) {
                const month = parseInt(option.value);
                if (month < selectedMonth) {
                    option.disabled = true;
                    option.hidden = true;
                }
            }
        }
    }

    // Update submission month when submission year or folder year/month changes
    yearSelect.addEventListener('change', () => {
        updateSubmissionYearOptions();
        updateSubmissionMonthOptions();
    });

    monthSelect.addEventListener('change', updateSubmissionMonthOptions);
    subYearSelect.addEventListener('change', updateSubmissionMonthOptions);

    // Initial run
    updateSubmissionYearOptions();
    updateSubmissionMonthOptions();
});






