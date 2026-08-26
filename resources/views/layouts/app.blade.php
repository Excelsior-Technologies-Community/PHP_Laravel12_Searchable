<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Search Dashboard</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #09090b;
            color: #f4f4f5;
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: #111111;
            border-bottom: 1px solid #27272a;
            padding: 18px 0;
        }

        .navbar-brand {
            color: #ffffff !important;
            font-size: 28px;
            font-weight: 700;
        }

        .container-wrapper {
            padding: 40px 0;
        }

        /* Live Search Dropdown Styles */
        #live-search-container {
            position: relative;
            width: 100%;
            max-width: 560px;
            margin: 0 auto;
        }

        #live-search-input {
            width: 100%;
            background: #09090b;
            border: 1px solid #3f3f46;
            color: #f4f4f5;
            border-radius: 30px;
            padding: 12px 20px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        #live-search-input:focus {
            border-color: #a855f7;
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.15);
        }

        #live-search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1050;
            background: #111111;
            border: 1px solid #27272a;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            max-height: 360px;
            overflow-y: auto;
            display: none;
        }

        #live-search-results.show {
            display: block;
        }

        .live-search-item {
            padding: 12px 18px;
            cursor: pointer;
            border-bottom: 1px solid #27272a;
            transition: background 0.15s;
        }

        .live-search-item:hover {
            background: #1e1e26;
        }

        .live-search-item:last-child {
            border-bottom: none;
        }

        .live-search-title {
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
        }

        .live-search-snippet {
            color: #a1a1aa;
            font-size: 12px;
            margin-top: 4px;
        }

        .live-search-footer {
            padding: 10px 18px;
            text-align: center;
            color: #71717a;
            font-size: 12px;
            background: #09090b;
            border-radius: 0 0 16px 16px;
            cursor: pointer;
        }

        .spinner-border-sm {
            width: 14px;
            height: 14px;
        }
    </style>

</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar">
        <div class="container">

            <a class="navbar-brand" href="/">Laravel Posts</a>

            {{-- Live Search --}}
            <div id="live-search-container">

                <div class="input-group">

                    <input
                        type="text"
                        id="live-search-input"
                        placeholder="Search posts..."
                        autocomplete="off">

                    <span class="input-group-text bg-transparent border-0 text-secondary">
                        <i class="bi bi-search"></i>
                    </span>

                </div>

                {{-- Results Dropdown --}}
                <div id="live-search-results">

                    <div id="live-search-loading" class="text-center py-3" style="display: none;">

                        <span class="spinner-border spinner-border-sm text-primary"></span>

                    </div>

                    <div id="live-search-list"></div>

                    <div id="live-search-footer" class="live-search-footer" style="display: none;">
                        View all results
                    </div>

                </div>

            </div>

            {{-- Create Post --}}
            <a
                href="/posts/create"
                class="btn btn-sm btn-primary ms-3 px-3">
                + Create Post
            </a>

        </div>
    </nav>

    {{-- IMPORTANT: THIS FIXES YOUR BLANK PAGE --}}
    <div class="container container-wrapper">

        @yield('content')

    </div>

    {{-- Alpine.js + Live Search Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('live-search-input');
            const resultsDiv = document.getElementById('live-search-results');
            const listDiv = document.getElementById('live-search-list');
            const footerDiv = document.getElementById('live-search-footer');
            const loadingDiv = document.getElementById('live-search-loading');

            let debounceTimer;
            let currentQuery = '';

            function hideResults() {
                resultsDiv.classList.remove('show');
                setTimeout(() => {
                    if (!resultsDiv.classList.contains('show')) {
                        listDiv.innerHTML = '';
                        footerDiv.style.display = 'none';
                    }
                }, 200);
            }

            function fetchResults(query) {
                if (!query) {
                    listDiv.innerHTML = '';
                    footerDiv.style.display = 'none';
                    resultsDiv.classList.remove('show');
                    return;
                }

                loadingDiv.style.display = 'block';
                listDiv.innerHTML = '';
                resultsDiv.classList.add('show');

                fetch(`/api/search?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        loadingDiv.style.display = 'none';

                        listDiv.innerHTML = '';

                        if (data.results && data.results.length > 0) {
                            data.results.forEach(item => {
                                const itemDiv = document.createElement('div');
                                itemDiv.className = 'live-search-item';
                                itemDiv.innerHTML =
                                    '<div class="live-search-title">' + escapeHtml(item.title) + '</div>' +
                                    '<div class="live-search-snippet">' + escapeHtml(item.content) + '</div>';
                                itemDiv.addEventListener('click', function () {
                                    window.location.href = item.url;
                                });
                                listDiv.appendChild(itemDiv);
                            });

                            footerDiv.style.display = 'block';
                            footerDiv.onclick = function () {
                                window.location.href = '/?search=' + encodeURIComponent(query);
                            };
                        } else {
                            listDiv.innerHTML =
                                '<div class="p-3 text-center text-secondary" style="font-size: 13px;">No results found</div>';
                            footerDiv.style.display = 'none';
                        }
                    })
                    .catch(() => {
                        loadingDiv.style.display = 'none';
                    });
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            input.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                currentQuery = this.value.trim();

                if (currentQuery.length < 2) {
                    listDiv.innerHTML = '';
                    footerDiv.style.display = 'none';
                    resultsDiv.classList.remove('show');
                    return;
                }

                debounceTimer = setTimeout(() => {
                    fetchResults(currentQuery);
                }, 300);
            });

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    clearTimeout(debounceTimer);
                    window.location.href = '/?search=' + encodeURIComponent(currentQuery);
                }
                if (e.key === 'Escape') {
                    hideResults();
                    input.value = '';
                }
            });

            document.addEventListener('click', function (e) {
                if (!resultsDiv.contains(e.target) && e.target !== input) {
                    hideResults();
                }
            });
        });
    </script>

</body>

</html>
