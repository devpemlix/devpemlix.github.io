var tooltipTriggerList = [].slice.call(document.querySelectorAll('.btn-large'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
