document.addEventListener("DOMContentLoaded", () => {

    // --- Модалка добавления ---
    const addModal = document.getElementById('addServiceModal');
    const openAddBtn = document.getElementById('openAddModalBtn');
    const closeAddBtn = document.getElementById('closeAddModalBtn');

    if (openAddBtn) openAddBtn.addEventListener('click', () => addModal.classList.add('show'));
    if (closeAddBtn) closeAddBtn.addEventListener('click', () => addModal.classList.remove('show'));
    window.addEventListener('click', e => { if (e.target === addModal) addModal.classList.remove('show'); });

    // --- Модалка "Подробнее" ---
    const detailsModal = document.getElementById('detailsModal');
    const closeDetailsBtn = document.getElementById('closeDetailsModalBtn');

    document.querySelectorAll('.admin-details-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('details_name').textContent = btn.dataset.name;
            document.getElementById('details_category').textContent = btn.dataset.category;
            document.getElementById('details_price').textContent = btn.dataset.price;
            document.getElementById('details_image').src = btn.dataset.image;
            detailsModal.classList.add('show');
        });
    });

    if (closeDetailsBtn) closeDetailsBtn.addEventListener('click', () => detailsModal.classList.remove('show'));

    // --- Модалка редактирования ---
    const editModal = document.getElementById('editServiceModal');
    const editForm = document.getElementById('editServiceForm');
    const closeEditBtn = document.getElementById('closeEditModalBtn');

    document.querySelectorAll('.admin-edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            editForm.action = btn.dataset.route;
            document.getElementById('edit_service_id').value = btn.dataset.id;
            document.getElementById('edit_name').value = btn.dataset.name;
            document.getElementById('edit_category').value = btn.dataset.category;
            document.getElementById('edit_price').value = btn.dataset.price;
            editModal.classList.add('show');
        });
    });

    if (closeEditBtn) closeEditBtn.addEventListener('click', () => editModal.classList.remove('show'));
    window.addEventListener('click', e => { if (e.target === editModal) editModal.classList.remove('show'); });

    // --- Автооткрытие модалки добавления при ошибках ---
    if (window.OPEN_ADD_SERVICE_MODAL) addModal.classList.add('show');

});
