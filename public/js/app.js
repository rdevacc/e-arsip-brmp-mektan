$(document).ready(function() {
  // Override Archive Page Sidebar
  const segments = window.location.pathname.toLowerCase().split('/');
  if (segments[2] === 'archive') {
    $('body').addClass('toggle-sidebar');
  }

  // Active Nav-link
  var currentPath = window.location.pathname;
  $('.nav-link').each(function() {
    var linkPath = $(this).attr('href');
    if (linkPath === currentPath) {
      $(this).removeClass('collapsed').addClass('active');
    }
  });
});
