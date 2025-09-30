// Menu Search Functionality
document.addEventListener('DOMContentLoaded', function () {
    const menuData = [
        {
            title: 'Kategori Barang',
            url: '/barang-kategori',
            icon: 'fas fa-fw fa-tags',
            category: 'Barang'
        },
        {
            title: 'Barang',
            url: '/barang',
            icon: 'fas fa-fw fa-box',
            category: 'Barang'
        },
        {
            title: 'Barang Stok',
            url: '/barang-stok',
            icon: 'fas fa-fw fa-clipboard-list',
            category: 'Barang'
        },
        {
            title: 'Barang Non Stok',
            url: '/barang-non-stok',
            icon: 'fas fa-fw fa-box-open',
            category: 'Barang'
        },
        {
            title: 'Barang Masuk',
            url: '/transaksi/barang-masuk',
            icon: 'fas fa-fw fa-arrow-down',
            category: 'Transaksi Barang'
        },
        {
            title: 'Barang Keluar',
            url: '/transaksi/barang-keluar',
            icon: 'fas fa-fw fa-arrow-up',
            category: 'Transaksi Barang'
        },
        {
            title: 'Barang Passed',
            url: '/transaksi/barang-passed',
            icon: 'fas fa-fw fa-check',
            category: 'Transaksi Barang'
        },
        {
            title: 'Barang Reject',
            url: '/transaksi/barang-reject',
            icon: 'fas fa-fw fa-times ',
            category: 'Transaksi Barang'
        },
        {
            title: 'Stock Card',
            url: '/transaksi/stock-card',
            icon: 'fas fa-fw fa-book',
            category: 'Transaksi Barang'
        },
        {
            title: 'Laporan Stok',
            url: '/transaksi/laporan-stok',
            icon: 'fas fa-fw fa-clipboard-list',
            category: 'Transaksi Barang'
        },
        {
            title: 'Work Order',
            url: '/finish-goods/work-order',
            icon: 'fas fa-fw fa-tasks',
            category: 'Finish Goods'
        },
        {
            title: 'Component List',
            url: '/finish-goods/component-list',
            icon: 'fas fa-fw fa-th-list',
            category: 'Finish Goods'
        },
        {
            title: 'Stok FGS',
            url: '/finish-goods/stok-accumulation',
            icon: 'fas fa-fw fa-th-list',
            category: 'Finish Goods'
        },
        {
            title: 'Barang Masuk FGS',
            url: '/finish-goods/barang-masuk-fgs',
            icon: 'fas fa-fw fa-file-alt',
            category: 'Finish Goods'
        },
        {
            title: 'Laporan Stok FGS',
            url: '/finish-goods/laporan-stok-fgs',
            icon: 'fas fa-fw fa-clipboard-list',
            category: 'Finish Goods'
        },
        {
            title: 'LBMB',
            url: '/delivery/lbmb',
            icon: 'fas fa-fw fa-file-alt',
            category: 'Delivery'
        },
        {
            title: 'Surat Jalan',
            url: '/delivery/surat-jalan',
            icon: 'fas fa-fw fa-file-signature',
            category: 'Delivery'
        },
        {
            title: 'Departemen',
            url: '/master/departemen',
            icon: 'fas fa-fw fa-building',
            category: 'Master'
        },
        {
            title: 'Bagian',
            url: '/master/bagian',
            icon: 'fas fa-fw fa-city',
            category: 'Master'
        },
        {
            title: 'Supir',
            url: '/master/supir',
            icon: 'fas fa-fw fa-user-tie',
            category: 'Master'
        },
        {
            title: 'Nomor Kendaraan',
            url: '/master/nomor-kendaraan',
            icon: 'fas fa-fw fa-truck-pickup',
            category: 'Master'
        },
    ];

    // Elements
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const topbarSearchInput = document.querySelector('.navbar-search input[type="text"]');
    const searchForm = document.getElementById('searchForm');

    let topbarSelectedIndex = -1;

    // Search function
    function performSearch(query) {
        if (!query || query.length < 2) {
            searchResults.innerHTML = '';
            return;
        }

        const filteredResults = menuData.filter(item =>
            item.title.toLowerCase().includes(query.toLowerCase()) ||
            item.category.toLowerCase().includes(query.toLowerCase())
        );

        displayResults(filteredResults, query);
    }

    // Display search results (for regular searchInput, not topbar)
    function displayResults(results, query) {
        if (results.length === 0) {
            searchResults.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-search text-muted"></i>
                    <p class="mb-0 mt-2">Tidak ada menu yang ditemukan untuk "${query}"</p>
                </div>
            `;
            return;
        }

        const resultsHTML = results.map(item => {
            const highlightedTitle = highlightText(item.title, query);
            return `
                <div class="search-result-item" data-url="${item.url}">
                    <div class="d-flex align-items-center">
                        <i class="${item.icon} text-primary mr-2"></i>
                        <div>
                            <div class="font-weight-bold">${highlightedTitle}</div>
                            <small class="text-muted">${item.category}</small>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        searchResults.innerHTML = resultsHTML;

        searchResults.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', function () {
                const url = this.dataset.url;
                window.location.href = url;
            });
        });
    }

    // Highlight matching text
    function highlightText(text, query) {
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<span class="search-highlight">$1</span>');
    }

    // Event listeners
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.trim();
            performSearch(query);
        });

        if (searchForm) {
            searchForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query) {
                    performSearch(query);
                }
            });
        }
    }

    // Topbar search functionality (for desktop)
    if (topbarSearchInput) {
        let searchTimeout;

        topbarSearchInput.addEventListener('input', function () {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            searchTimeout = setTimeout(() => {
                if (query.length >= 2) {
                    showTopbarResults(query);
                } else {
                    hideTopbarResults();
                }
            }, 300);
        });

        const topbarForm = topbarSearchInput.closest('form');
        if (topbarForm) {
            topbarForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const query = topbarSearchInput.value.trim();
                if (query) {
                    showTopbarResults(query);
                }
            });
        }
    }

    // Show topbar search results
    function showTopbarResults(query) {
        const filteredResults = menuData.filter(item =>
            item.title.toLowerCase().includes(query.toLowerCase()) ||
            item.category.toLowerCase().includes(query.toLowerCase())
        );

        let resultsDropdown = document.getElementById('topbarSearchResults');
        if (!resultsDropdown) {
            resultsDropdown = document.createElement('div');
            resultsDropdown.id = 'topbarSearchResults';
            resultsDropdown.className = 'dropdown-menu show shadow';
            resultsDropdown.style.cssText = `
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                z-index: 1050;
                max-height: 300px;
                overflow-y: auto;
                border-radius: 0.35rem;
            `;
            topbarSearchInput.closest('.input-group').style.position = 'relative';
            topbarSearchInput.closest('.input-group').appendChild(resultsDropdown);
        }

        if (filteredResults.length === 0) {
            resultsDropdown.innerHTML = `
                <div class="px-3 py-2 text-center text-muted">
                    <i class="fas fa-search"></i>
                    <div class="mt-1">Tidak ada menu yang ditemukan</div>
                </div>
            `;
        } else {
            const resultsHTML = filteredResults.map(item => {
                const highlightedTitle = highlightText(item.title, query);
                return `
                    <a class="dropdown-item py-2" href="${item.url}">
                        <div class="d-flex align-items-center">
                            <i class="${item.icon} text-primary mr-2" style="width: 16px;"></i>
                            <div>
                                <div>${highlightedTitle}</div>
                                <small class="text-muted">${item.category}</small>
                            </div>
                        </div>
                    </a>
                `;
            }).join('');
            resultsDropdown.innerHTML = resultsHTML;
        }

        // Setup keyboard selection
        topbarSelectedIndex = -1;
        const resultItems = resultsDropdown.querySelectorAll('.dropdown-item');

        topbarSearchInput.onkeydown = function (e) {
            if (resultItems.length === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                topbarSelectedIndex = (topbarSelectedIndex + 1) % resultItems.length;
                updateActiveResult(resultItems);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                topbarSelectedIndex = (topbarSelectedIndex - 1 + resultItems.length) % resultItems.length;
                updateActiveResult(resultItems);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (topbarSelectedIndex >= 0 && topbarSelectedIndex < resultItems.length) {
                    resultItems[topbarSelectedIndex].click();
                }
            }
        };
    }

    function updateActiveResult(items) {
        items.forEach((item, index) => {
            if (index === topbarSelectedIndex) {
                item.classList.add('active');
                item.scrollIntoView({ block: 'nearest' });
            } else {
                item.classList.remove('active');
            }
        });
    }

    // Hide topbar search results
    function hideTopbarResults() {
        const resultsDropdown = document.getElementById('topbarSearchResults');
        if (resultsDropdown) {
            resultsDropdown.remove();
        }
        topbarSelectedIndex = -1;
    }

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.navbar-search')) {
            hideTopbarResults();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            hideTopbarResults();
            searchResults.innerHTML = '';
            if (searchInput) searchInput.value = '';
            if (topbarSearchInput) topbarSearchInput.value = '';
        }
    });
});

// Update menu data dynamically if needed
function updateMenuData(newMenuData) {
    menuData.length = 0;
    menuData.push(...newMenuData);
}
