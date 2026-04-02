document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname;
    document.querySelectorAll(".sidebar .nav-link").forEach(link => {
        const href = link.getAttribute("href");
        if (href && currentPath.includes(href.replace(window.location.origin, ""))) {
            link.classList.add("active");
        }
    });
});

function confirmDelete() {
    return confirm("Bạn có chắc muốn xóa bản ghi này không?");
}