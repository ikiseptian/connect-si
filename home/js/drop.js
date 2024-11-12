 // JavaScript to handle hover effect for dropdown
 document.querySelector('.nav-links div').addEventListener('mouseenter', function() {
    this.querySelector('div').style.display = 'block';
});
document.querySelector('.nav-links div').addEventListener('mouseleave', function() {
    this.querySelector('div').style.display = 'none';
});