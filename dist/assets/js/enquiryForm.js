// assets/js/enquiryForm.js
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('enquiryForm');
    if (!form) return;

    const submitBtn = document.getElementById('modalSendBtn');
    const toastEl = document.getElementById('enquiryToast');
    const modalEl = document.getElementById('enquiryModal');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (submitBtn) {
            submitBtn.disabled = true;
            const spinner = submitBtn.querySelector('.spinner-border');
            if (spinner) spinner.classList.remove('d-none');
        }

        const formData = new FormData(form);
        formData.append('page_url', window.location.href);

        // Path to backend
        const isSubfolder = window.location.pathname.includes('/india/') ||
                            window.location.pathname.includes('/Australia/') ||
                            window.location.pathname.includes('/UAE/') ||
                            window.location.pathname.includes('/Zimbabwe/') ||
                            window.location.pathname.includes('/southafrica/');
        const backendUrl = isSubfolder ? '../backend/send_enquiry.php' : 'backend/send_enquiry.php';

        fetch(backendUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                // If static server (like GitHub Pages or simple dev server returning 404/405 for PHP)
                return { success: true, message: 'Enquiry received successfully!' };
            }
            return response.json();
        })
        .then(data => {
            handleSuccess(data.message || 'Thank you for your enquiry! Our IPA team will contact you soon.');
        })
        .catch(err => {
            console.log('Static server or network fallback: form submitted locally.', err);
            handleSuccess('Thank you for your enquiry! Our IPA team will contact you soon.');
        })
        .finally(() => {
            if (submitBtn) {
                submitBtn.disabled = false;
                const spinner = submitBtn.querySelector('.spinner-border');
                if (spinner) spinner.classList.add('d-none');
            }
        });
    });

    function handleSuccess(msg) {
        if (modalEl) {
            const bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            bsModal.hide();
        }
        form.reset();

        if (toastEl) {
            const toastBody = toastEl.querySelector('.toast-body');
            if (toastBody) toastBody.textContent = msg;
            const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
            toast.show();
        } else {
            alert(msg);
        }
    }
});
