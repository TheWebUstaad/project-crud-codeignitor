function checkPasswordStrength(password) {
    let strength = 0;
    const feedback = {
        strength: 0,
        message: '',
        color: '',
        suggestions: []
    };

    // Length check
    if (password.length < 8) {
        feedback.suggestions.push('Make it at least 8 characters');
    } else {
        strength += 1;
    }

    // Contains number
    if (password.match(/([0-9])/)) {
        strength += 1;
    } else {
        feedback.suggestions.push('Add numbers');
    }

    // Contains lowercase
    if (password.match(/([a-z])/)) {
        strength += 1;
    } else {
        feedback.suggestions.push('Add lowercase letters');
    }

    // Contains uppercase
    if (password.match(/([A-Z])/)) {
        strength += 1;
    } else {
        feedback.suggestions.push('Add uppercase letters');
    }

    // Contains special character
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
        strength += 1;
    } else {
        feedback.suggestions.push('Add special characters');
    }

    // Set strength message and color
    if (strength < 2) {
        feedback.message = 'Very Weak';
        feedback.color = '#dc3545'; // red
    } else if (strength === 2) {
        feedback.message = 'Weak';
        feedback.color = '#ffc107'; // yellow
    } else if (strength === 3) {
        feedback.message = 'Medium';
        feedback.color = '#fd7e14'; // orange
    } else if (strength === 4) {
        feedback.message = 'Strong';
        feedback.color = '#20c997'; // teal
    } else if (strength === 5) {
        feedback.message = 'Very Strong';
        feedback.color = '#28a745'; // green
    }

    feedback.strength = strength;
    return feedback;
} 