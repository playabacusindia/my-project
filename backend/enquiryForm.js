document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('enquiryForm');
    const submitBtn = document.getElementById('modalSendBtn');
    const spinner = submitBtn.querySelector('.spinner-border');
    const toastEl = document.getElementById('enquiryToast');
    const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
    const modalEl = document.getElementById('enquiryModal');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Show loading state
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');

        const formData = new FormData(form);
        formData.append('page_url', window.location.href);

        fetch('backend/send_enquiry.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                const toastBody = toastEl.querySelector('.toast-body');
                if (data.success) {
                    toastEl.classList.remove('bg-danger');
                    toastEl.classList.add('bg-success');
                    toastBody.textContent = 'Thx for the Enquiry Now soon our ipa team will contact you asps';
                    // Close modal, reset form, show toast
                    bootstrap.Modal.getInstance(modalEl).hide();
                    form.reset();
                    toast.show();
                } else {
                    toastEl.classList.remove('bg-success');
                    toastEl.classList.add('bg-danger');
                    toastBody.textContent = data.message || 'There was an error sending your enquiry.';
                    toast.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const toastBody = toastEl.querySelector('.toast-body');
                toastEl.classList.remove('bg-success');
                toastEl.classList.add('bg-danger');
                toastBody.textContent = 'There was a network error. Please try again.';
                toast.show();
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
            });
    });
});