function getRandomNumber(min, max) {
    return Math.random() * (max - min) + min;
}

function generateBubbles() {
    const bubbleContainer = document.getElementById('bubble-container');

    const numBubbles = 100;

    for (let i = 0; i < numBubbles; i++) {
        const bubble = document.createElement('div');
        bubble.className = 'bubble';

        const left = getRandomNumber(0, 97);
        const bottom = -40;
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

function hideBubblesOnFormScroll() {
    const bubbleContainer = document.getElementById('bubble-container');
    const form = document.querySelector('form');

    window.addEventListener('scroll', function () {
        const formBottom = form.getBoundingClientRect().bottom;

        const bubbles = bubbleContainer.getElementsByClassName('bubble');
        for (let i = 0; i < bubbles.length; i++) {
            const bubble = bubbles[i];
            const bubbleBottom = bubble.getBoundingClientRect().bottom;

            if (bubbleBottom < formBottom) {
                bubble.classList.add('hide-bubble');
            } else {
                bubble.classList.remove('hide-bubble');
            }
        }
    });
}

window.addEventListener('load', function () {
    generateBubbles();
    hideBubblesOnFormScroll();
});