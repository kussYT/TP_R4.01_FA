function getRandomNumber(min, max) {
    return Math.random() * (max - min) + min;
}

function generateBubbles() {
    const bubbleContainer = document.getElementById('bubble-container');

    const numBubbles = 20;

    for (let i = 0; i < numBubbles; i++) {
        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        const left = getRandomNumber(0, 97);
        const bottom = 0;
        const color1 = getRandomNumber(0, 255);
        const color2 = getRandomNumber(0, 255);
        const color3 = getRandomNumber(0, 255);

        bubble.style.backgroundColor = `rgba(${color1}, ${color2}, ${color3}, 0.5)`;
        bubble.style.left = `${left}%`;
        bubble.style.bottom = `${bottom}px`;

        const delay = getRandomNumber(0, 20);
        bubble.style.animationDelay = `${delay}s`;

        bubbleContainer.appendChild(bubble);
    }
}

const radioButtons = document.querySelectorAll('.radio-button input[type="radio"]');

radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
        const radioGroup = this.name;
        const radioButtonsInGroup = document.querySelectorAll(`input[name="${radioGroup}"]`);

        radioButtonsInGroup.forEach(function(btn) {
            const parent = btn.closest('.radio-button');
            if (btn.checked) {
                parent.classList.add('selected');
                parent.classList.remove('not-selected');
            } else {
                parent.classList.add('not-selected');
                parent.classList.remove('selected');
            }
        });
    });
});

window.addEventListener('load', function () {
    generateBubbles();
});