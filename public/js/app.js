$(document).ready(function() {
  // Override Archive Page Sidebar
  // const segments = window.location.pathname.toLowerCase().split('/');
  // if (segments[2] === 'archive' || segments[2] === 'dashboard' || segments[2] === 'archive-report') {
  //   if (window.innerWidth <= 768) {
  //     $('body').removeClass('toggle-sidebar');
  //   } else {
  //     $('body').addClass('toggle-sidebar');
  //   }
  // }

  // Active Nav-link
  var currentPath = window.location.pathname;
  $('.nav-link').each(function() {
    var linkPath = $(this).attr('href');
    if (linkPath === currentPath) {
      $(this).removeClass('collapsed').addClass('active');
    }
  });
});
