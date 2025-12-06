document.addEventListener('DOMContentLoaded', function() {
    const createProjectBtn = document.getElementById('createProjectBtn');
    const modal = document.getElementById('createProjectModal');
    const closeBtn = modal.querySelector('.close');

    if (createProjectBtn) {
        createProjectBtn.addEventListener('click', () => {
            modal.classList.add('open');
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            modal.classList.remove('open');
        });
    }

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.classList.remove('open');
        }
    });
});
