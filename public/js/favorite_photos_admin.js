// favorite_photos_admin.js

const modal = document.getElementById('photoDetailsModal');
const modalPhoto = document.getElementById('modalPhoto');
const modalUser = document.getElementById('modalUser');
const modalEmail = document.getElementById('modalEmail');
const modalDate = document.getElementById('modalDate');
const closeBtn = document.getElementById('closeModalBtn');

document.querySelectorAll('.details-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        modalPhoto.src = btn.dataset.photo;
        modalUser.textContent = btn.dataset.user;
        modalEmail.textContent = btn.dataset.email;
        modalDate.textContent = btn.dataset.date;
        modal.classList.add('show');
    });
});

closeBtn.addEventListener('click', () => modal.classList.remove('show'));

window.addEventListener('click', e => {
    if (e.target === modal) modal.classList.remove('show');
});
