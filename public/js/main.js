document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname;
    document.querySelectorAll(".nav-item-link").forEach(link => {
        const href = link.getAttribute("href");
        if (href && currentPath === href) {
            link.classList.add("active");
        }
    });
});

function confirmDelete() {
    return confirm("Bạn có chắc muốn xóa bản ghi này không?");
}