const phrases = [
    "Your secret place",
    "Encrypted. Private. Yours.",
    "Talk without traces",
    "Welcome to Hiddn",
    "Your space. Secured."
  ];

let textElement = document.getElementById("welcome-text")
let index = 0;

setInterval(() => {
    textElement.classList.remove("fade-in");
    textElement.classList.add("fade-out");

    setTimeout(() => {
      index = (index + 1) % phrases.length;
      textElement.textContent = phrases[index];
      textElement.classList.remove("fade-out");
      textElement.classList.add("fade-in");
    }, 500); // wait for fade-out to complete
  }, 3000);

const cursor = document.querySelector('.custom-cursor');

document.addEventListener('mousemove', (e) => {
  cursor.style.top = `${e.clientY}px`;
  cursor.style.left = `${e.clientX}px`;
});


tsParticles.load("tsparticles", {
  particles: {
    number: {
      value: 80,
      density: {
        enable: true,
        area: 800
      }
    },
    color: {
      value: "#00ffcc"
    },
    shape: {
      type: "triangle"
    },
    opacity: {
      value: 0.5
    },
    size: {
      value: 10,
      random: true
    },
    move: {
      enable: true,
      speed: 2,
      direction: "none",
      outModes: {
        default: "bounce"
      }
    },
    links: {
      enable: true,
      distance: 150,
      color: "#00ffcc",
      opacity: 0.4,
      width: 1
    }
  },
  interactivity: {
    events: {
      onHover: {
        enable: true,
        mode: "repulse"
      },
      resize: true
    },
    modes: {
      repulse: {
        distance: 100,
        duration: 0.4
      }
    }
  },
  detectRetina: true
});