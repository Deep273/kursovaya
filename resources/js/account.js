document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("createProjectModal");
    const btn = document.getElementById("createProjectBtn");
    const closeBtn = document.querySelector(".close");

    // открытие модалки
    if (btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // защита от всплытия
            modal.style.display = "flex";
        });
    }

    // закрытие модалки
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = "none";
        });
    }

    // закрытие при клике вне модалки
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    // защита форм избранного фото от случайного открытия модалки
    document.querySelectorAll('.fav-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.stopPropagation();
        });
    });
});
