document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form');

    const showError = (field, message) => {
        let target = field;
        if (field.parentElement.classList.contains('relative')) {
            target = field.parentElement;
        }
        
        let error = target.nextElementSibling;
        if (!error || !error.classList.contains('validation-error')) {
            error = document.createElement('small');
            error.className = 'validation-error text-red-500 text-xs mt-1 block';
            target.parentNode.insertBefore(error, target.nextSibling);
        }
        error.textContent = message;
        field.classList.add('border-red-500', 'is-invalid');
        field.classList.remove('border-gold/30', 'focus:border-transparent');
    };

    const removeError = (field) => {
        let target = field;
        if (field.parentElement.classList.contains('relative')) {
            target = field.parentElement;
        }

        const error = target.nextElementSibling;
        if (error && error.classList.contains('validation-error')) {
            error.remove();
        }
        field.classList.remove('border-red-500', 'is-invalid');
        field.classList.add('border-gold/30', 'focus:border-transparent');
    };

    const validateField = (field) => {
        // Skip validation if the field is hidden
        if (field.offsetParent === null && field.type !== 'hidden') {
            removeError(field);
            return true;
        }

        let isValid = true;
        let errorMessage = '';

        const value = field.value.trim();

        // Check if field is required
        const isRequired = field.hasAttribute('required') || 
                           field.hasAttribute('min') || 
                           field.placeholder.toLowerCase().includes('item name');

        if (isRequired && value === '') {
            isValid = false;
            errorMessage = 'This field is required.';
        }

        // Email check
        if (isValid && field.type === 'email' && value !== '') {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address.';
            }
        }

        // Tel check
        if (isValid && field.type === 'tel' && value !== '') {
            const phonePattern = /^[0-9\-\+\s]{10,15}$/;
            if (!phonePattern.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid phone number.';
            }
        }

        // Number check
        if (isValid && field.type === 'number' && value !== '') {
            const num = parseFloat(value);
            if (isNaN(num) || num <= 0) {
                isValid = false;
                errorMessage = 'Please enter a valid amount.';
            }
        }

        // Checkbox check
        if (isValid && field.type === 'checkbox' && field.hasAttribute('required') && !field.checked) {
            isValid = false;
            errorMessage = 'Please accept the terms and conditions.';
        }

        // Name check (if type is text, is required, and not item name)
        if (isValid && field.type === 'text' && field.hasAttribute('required') && value !== '') {
            const namePattern = /^[a-zA-Z\s]+$/;
            if (!namePattern.test(value)) {
                isValid = false;
                errorMessage = 'Please enter a valid name.';
            }
        }

        if (isValid) {
            removeError(field);
        } else {
            showError(field, errorMessage);
        }

        return isValid;
    };

    forms.forEach(form => {
        form.setAttribute('novalidate', 'novalidate');

        const fields = form.querySelectorAll('input, select, textarea');

        fields.forEach(field => {
            if (field.type !== 'submit' && field.type !== 'button' && field.type !== 'hidden') {
                field.addEventListener('blur', () => validateField(field));
                field.addEventListener('input', () => {
                    if (field.classList.contains('is-invalid')) {
                        validateField(field);
                    }
                });
            }
        });

        form.addEventListener('submit', function (event) {
            let formIsValid = true;
            let firstInvalidField = null;

            fields.forEach(field => {
                if (field.type !== 'submit' && field.type !== 'button' && field.type !== 'hidden') {
                    if (!validateField(field)) {
                        formIsValid = false;
                        if (!firstInvalidField) {
                            firstInvalidField = field;
                        }
                    }
                }
            });

            if (!formIsValid) {
                event.preventDefault();
                event.stopImmediatePropagation();
                if (firstInvalidField) {
                    firstInvalidField.focus();
                }
            }
        }, true);
    });
});
