<?php
session_start();

if (isset($_GET['to']) && !empty($_GET['to'])) {
    if (file_exists('links.csv') && ($handle = fopen('links.csv', "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
            if (isset($data[0]) && $data[0] == $_GET['to']) {
                header("Location: " . $data[0]);
                exit;
            }
        }
        fclose($handle);
    }
}

$csvFile = 'links.csv';
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$baseUrl = $protocol . $host . $basePath . '/';

function readLinks($file) { $links = []; if (file_exists($file) && ($handle = fopen($file, "r")) !== FALSE) { flock($handle, LOCK_SH); while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) { if (isset($data[0])) { $links[] = $data[0]; } } flock($handle, LOCK_UN); fclose($handle); } return $links; }
function writeLinks($file, $links) { $handle = fopen($file, 'w'); flock($handle, LOCK_EX); foreach ($links as $link) { fputcsv($handle, [$link]); } flock($handle, LOCK_UN); fclose($handle); }
function generateLinksHtml($links, $baseUrl, $currentPage) { if (empty($links)) { return '<p id="no-links-message" class="text-gray-500 dark:text-gray-400 text-center py-4">Tidak ada link untuk ditampilkan.</p>'; } $html = ''; foreach ($links as $link) { $encodedLink = urlencode($link); $clickableRedirectUrl = htmlspecialchars($baseUrl . "?to=" . $encodedLink); $copyableRedirectUrl = htmlspecialchars($baseUrl . "?to=" . $link); $deleteUrl = htmlspecialchars($baseUrl . "?delete=" . $encodedLink); $html .= '<div class="link-item flex flex-col md:flex-row items-center justify-between p-4 border dark:border-gray-700 rounded-lg hover:bg-blue-50/50 dark:hover:bg-gray-700/50 transition duration-300"><div class="w-full md:w-auto flex-grow mb-4 md:mb-0 md:mr-4 overflow-hidden" data-url="' . htmlspecialchars($link) . '"><a href="' . $clickableRedirectUrl . '" target="_blank" class="font-semibold text-blue-600 dark:text-blue-400 hover:underline break-all text-sm">' . htmlspecialchars(rtrim(str_replace(['https://', 'http://'], '', $baseUrl), '/')) . "/?to=" . (strlen($link) > 40 ? substr(htmlspecialchars($link), 0, 40) . '...' : htmlspecialchars($link)) . '</a><p class="text-sm text-gray-500 dark:text-gray-400 truncate"><i class="fas fa-long-arrow-alt-right mr-2"></i>' . htmlspecialchars($link) . '</p></div><div class="flex-shrink-0 flex gap-2"><button class="copy-btn bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 py-2 px-3 rounded-lg" data-copy-link="' . $copyableRedirectUrl . '" title="Copy Link (Unencoded)"><i class="fas fa-copy"></i></button><button class="edit-btn bg-amber-400 hover:bg-amber-500 text-white font-semibold py-2 px-3 rounded-lg" title="Edit" data-original-url="' . htmlspecialchars($link) . '"><i class="fas fa-pencil-alt"></i></button><button class="delete-btn bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-3 rounded-lg" title="Hapus" data-delete-url="' . $deleteUrl . '"><i class="fas fa-trash-alt"></i></button></div></div>'; } return $html; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') { $newUrl = trim($_POST['url']); if (filter_var($newUrl, FILTER_VALIDATE_URL)) { if (!preg_match("~^(?:f|ht)tps?://~i", $newUrl)) { $newUrl = "http://" . $newUrl; } $allLinks = readLinks($csvFile); if (!empty($_POST['original_url'])) { $originalUrl = $_POST['original_url']; if (($key = array_search($originalUrl, $allLinks)) !== false) { if ($newUrl !== $originalUrl && in_array($newUrl, $allLinks)) { $_SESSION['message'] = ['type' => 'error', 'text' => 'URL tujuan tersebut sudah ada.']; } else { $allLinks[$key] = $newUrl; writeLinks($csvFile, $allLinks); $_SESSION['message'] = ['type' => 'success', 'text' => 'Link berhasil diperbarui!']; } } } else { if (in_array($newUrl, $allLinks)) { $_SESSION['message'] = ['type' => 'error', 'text' => 'Link ini sudah pernah ditambahkan.']; } else { $allLinks[] = $newUrl; writeLinks($csvFile, $allLinks); $_SESSION['message'] = ['type' => 'success', 'text' => 'Link baru berhasil dibuat!']; } } } else { $_SESSION['message'] = ['type' => 'error', 'text' => 'URL yang Anda masukkan tidak valid.']; } header("Location: " . $baseUrl); exit; }

$allLinksReversed = array_reverse(readLinks($csvFile));
$itemsPerPage = 10;

if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    header('Content-Type: application/json');
    $response = [];
    if (isset($_GET['delete'])) {
        $linkToDelete = $_GET['delete'];
        $allLinks = readLinks($csvFile);
        $deleted = false;
        if (($key = array_search($linkToDelete, $allLinks)) !== false) { unset($allLinks[$key]); writeLinks($csvFile, $allLinks); $deleted = true; }
        $response = [ 'success' => $deleted, 'message' => $deleted ? 'Link berhasil dihapus!' : 'Gagal menghapus link.' ];
    } else {
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $allLinksReversed = array_reverse(readLinks($csvFile));
        $totalLinks = count($allLinksReversed);
        $totalPages = ceil($totalLinks / $itemsPerPage);
        if ($currentPage < 1) $currentPage = 1; if ($currentPage > $totalPages && $totalPages > 0) $currentPage = $totalPages;
        $offset = ($currentPage - 1) * $itemsPerPage;
        $linksForCurrentPage = array_slice($allLinksReversed, $offset, $itemsPerPage);
        $response = [ 'links_html' => generateLinksHtml($linksForCurrentPage, $baseUrl, $currentPage), 'currentPage' => $currentPage, 'totalPages' => $totalPages, ];
    }
    echo json_encode($response);
    exit;
}

$totalLinks = count($allLinksReversed);
$totalPages = ceil($totalLinks / $itemsPerPage);
$currentPage = 1;
$linksForCurrentPage = array_slice($allLinksReversed, 0, $itemsPerPage);
$message = $_SESSION['message'] ?? null; unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMJONLINK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        #toast-container { position: fixed; top: 1.5rem; right: 1.5rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.75rem; }
        .toast { padding: 1rem 1.5rem; border-radius: 0.5rem; color: white; font-weight: 600; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); transition: all 0.5s ease-in-out; opacity: 0; transform: translateX(100%); }
        .toast.show { opacity: 1; transform: translateX(0); }
        .toast-success { background-color: #22c55e; }
        .toast-error { background-color: #ef4444; }
        .modal-overlay { transition: opacity 0.3s ease-in-out; }
        .modal-box { transition: all 0.3s ease-in-out; }
        .hidden-scale { transform: scale(0.95); opacity: 0; }
        .visible-scale { transform: scale(1); opacity: 1; }
        #link-list-container.loading { opacity: 0.5; pointer-events: none; }
    </style>
</head>
<body class="bg-blue-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">
    <nav class="bg-blue-500 dark:bg-gray-800 shadow-lg sticky top-0 z-40">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="<?= htmlspecialchars($baseUrl) ?>" class="text-2xl font-bold flex items-center text-white dark:text-green-400">
                <i class="fas fa-link mr-3"></i>OMJONLINK
            </a>
            <button id="theme-toggle" type="button" class="text-white dark:text-gray-300 hover:bg-white/20 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm p-2.5">
                <i id="theme-toggle-dark-icon" class="fas fa-moon hidden"></i>
                <i id="theme-toggle-light-icon" class="fas fa-sun hidden"></i>
            </button>
        </div>
    </nav>

    <main class="container mx-auto p-4 md:p-8">
        <div class="bg-white dark:bg-gray-800 p-6 md:p-8 rounded-xl shadow-md mb-8">
            <h1 class="text-2xl font-bold mb-4 text-gray-800 dark:text-green-400">Buat Redirect Link Baru</h1>
            <form action="<?= htmlspecialchars($baseUrl) ?>" method="POST">
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="url" name="url" placeholder="https://contoh-url.com" required class="flex-grow p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-400 dark:focus:ring-green-400 focus:outline-none transition">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 dark:bg-green-500 dark:hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 flex items-center justify-center">
                        <i class="fas fa-plus-circle mr-2"></i>Buat Link
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 md:p-8 rounded-xl shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-xl font-bold text-gray-800 dark:text-green-400">Daftar Link Redirect</h2>
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="search-input" placeholder="Cari domain..." class="w-full p-2 pl-10 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:ring-2 focus:ring-blue-400 dark:focus:ring-green-400 focus:outline-none transition">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            
            <div id="link-list-container" class="space-y-4 max-h-[70vh] overflow-y-auto pr-2 transition-opacity duration-300">
                <?= generateLinksHtml($linksForCurrentPage, $baseUrl, $currentPage) ?>
            </div>
            <nav id="pagination-nav" class="flex justify-center items-center mt-8 space-x-1 sm:space-x-2"></nav>
        </div>
    </main>

    <div id="toast-container"></div>
    <div id="edit-modal" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 hidden">
        <div class="modal-box bg-white dark:bg-gray-800 w-full max-w-lg p-6 rounded-xl shadow-2xl hidden-scale">
            <h3 class="text-xl font-bold mb-4 text-gray-800 dark:text-green-400">Edit Link</h3>
            <form action="<?= htmlspecialchars($baseUrl) ?>" method="POST">
                <input type="hidden" id="edit-original-url" name="original_url">
                <div class="space-y-4">
                    <div>
                        <label for="edit-url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL Tujuan</label>
                        <input type="url" id="edit-url" name="url" required class="w-full p-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg">
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" class="modal-close-btn bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded-lg">Batal</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 dark:bg-green-500 dark:hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="delete-modal" class="modal-overlay fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 hidden">
        <div class="modal-box bg-white dark:bg-gray-800 w-full max-w-md p-6 rounded-xl shadow-2xl hidden-scale">
            <h3 class="text-xl font-bold mb-2 text-gray-800 dark:text-green-400">Konfirmasi Hapus</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-6">Yakin ingin menghapus link ini?</p>
            <div class="flex justify-end gap-3">
                <button type="button" class="modal-close-btn bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-bold py-2 px-4 rounded-lg">Batal</button>
                <button id="confirm-delete-btn" type="button" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg text-center">Ya, Hapus</button>
            </div>
        </div>
    </div>

<script>
$(document).ready(function() {
    let currentPage = <?= $currentPage ?>;
    let totalPages = <?= $totalPages ?>;

    function showToast(message, type = 'success') { const toastId = 'toast-' + Date.now(); const toast = $(`<div id="${toastId}" class="toast ${type === 'success' ? 'toast-success' : 'toast-error'}">${message}</div>`); $('#toast-container').append(toast); setTimeout(() => toast.addClass('show'), 100); setTimeout(() => { toast.removeClass('show'); setTimeout(() => toast.remove(), 500); }, 4000); }
    function showModal(modalId) { $(modalId).removeClass('hidden'); setTimeout(() => $(modalId).find('.modal-box').addClass('visible-scale').removeClass('hidden-scale'), 10); }
    function hideModal(modalId) { $(modalId).find('.modal-box').removeClass('visible-scale').addClass('hidden-scale'); setTimeout(() => $(modalId).addClass('hidden'), 300); }
    <?php if ($message): ?>showToast('<?= htmlspecialchars($message['text']) ?>', '<?= htmlspecialchars($message['type']) ?>');<?php endif; ?>

    function goToPage(page) { if (page < 1) page = 1; if (page > totalPages && totalPages > 0) page = totalPages; const listContainer = $('#link-list-container'); listContainer.addClass('loading'); $.ajax({ url: '<?= $baseUrl ?>', type: 'GET', dataType: 'json', data: { ajax: 1, page: page }, success: function(response) { listContainer.html(response.links_html); currentPage = response.currentPage; totalPages = response.totalPages; renderPagination(currentPage, totalPages); }, error: function() { showToast('Gagal memuat halaman.', 'error'); }, complete: function() { setTimeout(() => listContainer.removeClass('loading'), 100); } }); }
    function renderPagination(currentPage, totalPages) { if (totalPages <= 1) { $('#pagination-nav').empty(); return; } const nav = $('#pagination-nav'); nav.empty(); const maxVisiblePages = 4; const createPageLink = (page, text, isDisabled = false, isActive = false) => { let classes = 'px-2 sm:px-3 py-1 rounded-md transition text-sm sm:text-base '; if (isDisabled) { classes += 'text-gray-400 dark:text-gray-500 cursor-not-allowed'; } else if (isActive) { classes += 'bg-blue-500 dark:bg-green-500 text-white font-bold cursor-default'; } else { classes += 'text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 cursor-pointer'; } return `<a data-page="${page}" class="${classes}">${text}</a>`; }; nav.append(createPageLink(currentPage - 1, '<', currentPage === 1)); let startPage, endPage; if (totalPages <= maxVisiblePages) { startPage = 1; endPage = totalPages; } else { let maxPagesBeforeCurrent = Math.floor((maxVisiblePages - 1) / 2); let maxPagesAfterCurrent = Math.ceil((maxVisiblePages - 1) / 2); if (currentPage <= maxPagesBeforeCurrent) { startPage = 1; endPage = maxVisiblePages; } else if (currentPage + maxPagesAfterCurrent >= totalPages) { startPage = totalPages - maxVisiblePages + 1; endPage = totalPages; } else { startPage = currentPage - maxPagesBeforeCurrent; endPage = currentPage + maxPagesAfterCurrent; } } if (startPage > 1) { nav.append(createPageLink(1, '1')); if (startPage > 2) nav.append('<span class="px-1 sm:px-2 text-gray-500 dark:text-gray-400">...</span>'); } for (let i = startPage; i <= endPage; i++) { nav.append(createPageLink(i, i, false, i === currentPage)); } if (endPage < totalPages) { if (endPage < totalPages - 1) nav.append('<span class="px-1 sm:px-2 text-gray-500 dark:text-gray-400">...</span>'); nav.append(createPageLink(totalPages, totalPages)); } nav.append(createPageLink(currentPage + 1, '>', currentPage === totalPages)); }
    $('#pagination-nav').on('click', 'a', function(e) { e.preventDefault(); const page = $(this).data('page'); if (page && !$(this).hasClass('cursor-not-allowed') && !$(this).hasClass('cursor-default')) { goToPage(page); } });
    renderPagination(currentPage, totalPages);

    const themeToggleDarkIcon = $('#theme-toggle-dark-icon');
    const themeToggleLightIcon = $('#theme-toggle-light-icon');
    function toggleThemeIcons() { if (localStorage.getItem('theme') === 'dark') { themeToggleLightIcon.removeClass('hidden'); themeToggleDarkIcon.addClass('hidden'); } else { themeToggleLightIcon.addClass('hidden'); themeToggleDarkIcon.removeClass('hidden'); } }
    toggleThemeIcons();
    $('#theme-toggle').on('click', function() { if (localStorage.getItem('theme') === 'dark') { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); } else { document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); } toggleThemeIcons(); });

    $('#link-list-container').on('click', '.edit-btn', function() { const url = $(this).data('original-url'); $('#edit-original-url').val(url); $('#edit-url').val(url); showModal('#edit-modal'); });
    $('#link-list-container').on('click', '.delete-btn', function() { const url = $(this).data('delete-url'); $('#confirm-delete-btn').data('delete-url', url); showModal('#delete-modal'); });
    $('.modal-close-btn, .modal-overlay').on('click', function(e) { if ($(e.target).is('.modal-close-btn, .modal-overlay')) hideModal($(this).closest('.modal-overlay')); });
    
    $('#confirm-delete-btn').on('click', function() { const deleteUrl = $(this).data('delete-url'); $.ajax({ url: deleteUrl, type: 'GET', dataType: 'json', data: { ajax: 1 }, success: function(response) { hideModal('#delete-modal'); showToast(response.message, response.success ? 'success' : 'error'); if (response.success) { if ($('#link-list-container .link-item').length === 1 && currentPage > 1) { goToPage(currentPage - 1); } else { goToPage(currentPage); } } }, error: function() { showToast('Gagal menghapus.', 'error'); } }); });
    $('#link-list-container').on('click', '.copy-btn', function() { navigator.clipboard.writeText($(this).data('copy-link')).then(() => { const icon = $(this).find('i'); icon.removeClass('fa-copy').addClass('fa-check text-green-500'); setTimeout(() => icon.removeClass('fa-check text-green-500').addClass('fa-copy'), 2000); }); });
    $('#search-input').on('keyup', function() { const searchTerm = $(this).val().toLowerCase(); $('#pagination-nav').toggle(!searchTerm); let resultsFound = false; $('#link-list-container .link-item').each(function() { const linkUrl = $(this).find('[data-url]').data('url').toLowerCase(); if (linkUrl.includes(searchTerm)) { $(this).show(); resultsFound = true; } else { $(this).hide(); } }); if ($('#link-list-container #no-links-message').length === 0) { $('#no-results-message').remove(); } if (!resultsFound && searchTerm) { if ($('#no-results-message').length === 0) { $('#link-list-container').append('<p id="no-results-message" class="text-gray-500 dark:text-gray-400 text-center py-4">Tidak ada hasil yang cocok.</p>'); } } else { $('#no-results-message').remove(); } if (!searchTerm && totalPages > 0) { goToPage(1); } });
});
</script>
</body>
</html>
