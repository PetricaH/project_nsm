document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // remove active class from all tabs
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));

        // add active class to the clicked tab
        this.classList.add('active');
    });
});