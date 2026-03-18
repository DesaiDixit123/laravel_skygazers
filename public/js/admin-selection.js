document.addEventListener('DOMContentLoaded', function() {
    function initSelection() {
        const selectAll = document.getElementById('select-all-checkbox');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const excelBtn = document.getElementById('export-excel');
        const pdfBtn = document.getElementById('export-pdf');

        if (!selectAll || !excelBtn || !pdfBtn) return;

        function updateExportUrls() {
            const selectedIds = Array.from(document.querySelectorAll('.row-checkbox:checked'))
                .map(cb => cb.value);
            
            const btns = [excelBtn, pdfBtn];
            btns.forEach(btn => {
                if (!btn) return;
                const url = new URL(btn.href);
                if (selectedIds.length > 0) {
                    url.searchParams.set('selected_ids', selectedIds.join(','));
                } else {
                    url.searchParams.delete('selected_ids');
                }
                btn.href = url.toString();
            });
        }

        selectAll.addEventListener('change', function() {
            document.querySelectorAll('.row-checkbox').forEach(cb => {
                cb.checked = selectAll.checked;
            });
            updateExportUrls();
        });

        // Delegate listener for row checkboxes (handles dynamic content)
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('row-checkbox')) {
                const all = document.querySelectorAll('.row-checkbox');
                const checked = document.querySelectorAll('.row-checkbox:checked');
                selectAll.checked = all.length === checked.length && all.length > 0;
                updateExportUrls();
            }
        });

        // Re-check select-all state and update URLs on dynamic content load
        const observer = new MutationObserver(() => {
            const all = document.querySelectorAll('.row-checkbox');
            const checked = document.querySelectorAll('.row-checkbox:checked');
            if (selectAll) {
                selectAll.checked = all.length === checked.length && all.length > 0;
            }
            updateExportUrls();
        });

        const tableBody = document.querySelector('tbody');
        if (tableBody) {
            observer.observe(tableBody, { childList: true });
        }
    }

    initSelection();
});
