const menuInput = document.getElementById('menu-search');
const box = document.getElementById('menu-search-result');

function renderMenuResults(query = '') {
    const menu = window.APP_MENUS;
    let results = query.length < 1
        ? menu
        : menu.filter(item => {
            const label = (item.label || "").toLowerCase();
            const keywords = (item.keywords || "").toLowerCase();
            return label.includes(query) || keywords.includes(query);
        });

    if (results.length === 0) results = menu;

    box.innerHTML = results.map(item => {
        const path = item.path || item.url;
        return `
            <a href="${item.url}" class="search-item">
                <div class="fw-semibold">${item.label}</div>
                <div class="search-route">${path}</div>
            </a>
        `;
    }).join('');

    box.classList.add('active');
}

menuInput.addEventListener('input', function (e) {
    renderMenuResults(e.target.value.toLowerCase());
});

menuInput.addEventListener('focus', function () {
    renderMenuResults('');
});

document.addEventListener('click', e => {
    if (!e.target.closest('#menu-search') && !e.target.closest('#menu-search-result')) {
        box.classList.remove('active');
    }
});
