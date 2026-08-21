document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('live-search-input');
    const searchDropdown = document.getElementById('search-dropdown');
    
    if(!searchInput) return;

    let debounceTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 2) {
            searchDropdown.classList.add('d-none');
            return;
        }

        debounceTimer = setTimeout(() => {
            fetch(`/api/search?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    renderSearchResults(data, query);
                })
                .catch(error => console.error('Error fetching search results:', error));
        }, 300); // 300ms debounce
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchDropdown.contains(e.target)) {
            searchDropdown.classList.add('d-none');
        }
    });

    function renderSearchResults(results, query) {
        if (results.length === 0) {
            searchDropdown.innerHTML = `
                <div class="p-3 text-center text-muted small">
                    No plants found matching "${query}"
                </div>
            `;
        } else {
            let html = '<div class="list-group list-group-flush">';
            results.forEach(item => {
                html += `
                    <a href="${item.url}" class="list-group-item list-group-item-action bg-transparent border-secondary border-opacity-25 d-flex align-items-center gap-3 py-2 transition-hover">
                        <img src="${item.image}" alt="${item.name}" class="rounded-2 object-fit-cover border border-secondary border-opacity-25" width="40" height="40">
                        <div class="flex-grow-1">
                            <div class="text-white fw-semibold small">${item.name}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">${item.category}</div>
                        </div>
                        <div class="text-gold fw-bold small">${item.price}</div>
                    </a>
                `;
            });
            
            // Add a "View all results" link
            html += `
                <a href="/shop?q=${encodeURIComponent(query)}" class="list-group-item list-group-item-action bg-dark text-center text-warning small fw-bold py-2">
                    View all results <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            `;
            html += '</div>';
            searchDropdown.innerHTML = html;
        }
        
        searchDropdown.classList.remove('d-none');
    }
});
