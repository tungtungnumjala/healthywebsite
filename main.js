
function showForm(formId) {
    document.querySelectorAll('.input-form').forEach(form => form.classList.remove('active'));
    document.getElementById(formId).classList.add('active');
}


