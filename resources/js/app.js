import './bootstrap';

const showToast = (message, type = 'success') => {
    const toast = document.querySelector('[data-toast]');
    if (!toast) return;
    toast.querySelector('[data-toast-message]').textContent = message;
    toast.dataset.type = type;
    toast.classList.add('visible');
    window.setTimeout(() => toast.classList.remove('visible'), 3200);
};

const filterTable = (input) => {
    const table = document.querySelector(input.dataset.filterTable);
    if (!table) return;
    const value = input.value.trim().toLowerCase();
    table.querySelectorAll('tbody tr[data-search]').forEach((row) => {
        row.hidden = value !== '' && !row.dataset.search.toLowerCase().includes(value);
    });
};

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('[data-sidebar]');
    const overlay = document.querySelector('[data-overlay]');
    const toggleSidebar = () => {
        sidebar?.classList.toggle('open');
        overlay?.classList.toggle('visible');
    };
    document.querySelector('[data-menu-toggle]')?.addEventListener('click', toggleSidebar);
    overlay?.addEventListener('click', toggleSidebar);

    document.querySelectorAll('[data-filter-table]').forEach((input) => {
        input.addEventListener('input', () => filterTable(input));
    });

    document.querySelectorAll('[data-demo-form]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            showToast(form.dataset.success || 'Démonstration enregistrée avec succès.');
        });
    });

    document.querySelectorAll('[data-demo-action]').forEach((button) => {
        button.addEventListener('click', () => showToast(button.dataset.demoAction));
    });

    const fileInput = document.querySelector('[data-file-input]');
    const filePreview = document.querySelector('[data-file-preview]');
    const fileName = document.querySelector('[data-file-name]');
    const fileSize = document.querySelector('[data-file-size]');
    const dropzone = document.querySelector('[data-dropzone]');
    const renderFile = (file) => {
        if (!file) return;
        if (file.type !== 'application/pdf') {
            showToast('Veuillez sélectionner un fichier PDF.', 'error');
            return;
        }
        fileName.textContent = file.name;
        fileSize.textContent = `${(file.size / 1024 / 1024).toFixed(2)} Mo`;
        filePreview?.classList.remove('hidden');
    };
    fileInput?.addEventListener('change', () => renderFile(fileInput.files[0]));
    dropzone?.addEventListener('dragover', (event) => { event.preventDefault(); dropzone.classList.add('dragover'); });
    dropzone?.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));
    dropzone?.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.classList.remove('dragover');
        renderFile(event.dataTransfer.files[0]);
    });
    document.querySelector('[data-remove-file]')?.addEventListener('click', () => {
        fileInput.value = '';
        filePreview?.classList.add('hidden');
    });
});
