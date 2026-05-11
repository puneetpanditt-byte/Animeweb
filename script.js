const canvas = document.getElementById("hero-canvas");
const context = canvas.getContext("2d");
const loader = document.getElementById("loader");
const bar = document.getElementById("bar");
const percentText = document.getElementById("percent");
const cards = document.querySelectorAll(".glass-card");

const frameCount = 210;
const currentFrame = index => (
  `frames/ezgif-frame-${index.toString().padStart(3, '0')}.jpg`
);

const images = [];
const animeSequence = {
  frame: 0
};

// Preload images
let loadedCount = 0;
for (let i = 1; i <= frameCount; i++) {
  const img = new Image();
  img.src = currentFrame(i);
  img.onload = () => {
    loadedCount++;
    const progress = Math.round((loadedCount / frameCount) * 100);
    bar.style.width = `${progress}%`;
    percentText.innerText = `${progress}%`;
    
    if (loadedCount === frameCount) {
      init();
    }
  };
  images.push(img);
}

function init() {
  // Hide loader
  loader.style.opacity = '0';
  setTimeout(() => loader.style.display = 'none', 500);

  // Set canvas size
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  // Handle resizing
  window.addEventListener("resize", () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    render();
  });

  // Initial render
  render();
}

function render() {
  const scrollFraction = window.scrollY / (document.body.scrollHeight - window.innerHeight);
  const frameIndex = Math.min(
    frameCount - 1,
    Math.floor(scrollFraction * frameCount)
  );

  const img = images[frameIndex];
  if (!img) return;

  // Draw image with "cover" effect
  const canvasRatio = canvas.width / canvas.height;
  const imgRatio = img.width / img.height;
  let drawWidth, drawHeight, offsetX, offsetY;

  if (canvasRatio > imgRatio) {
    drawWidth = canvas.width;
    drawHeight = canvas.width / imgRatio;
    offsetX = 0;
    offsetY = (canvas.height - drawHeight) / 2;
  } else {
    drawWidth = canvas.height * imgRatio;
    drawHeight = canvas.height;
    offsetX = (canvas.width - drawWidth) / 2;
    offsetY = 0;
  }

  context.clearRect(0, 0, canvas.width, canvas.height);
  context.drawImage(img, offsetX, offsetY, drawWidth, drawHeight);

  // Animate cards
  cards.forEach((card, index) => {
    const cardTop = card.parentElement.offsetTop;
    const distance = Math.abs(window.scrollY - cardTop);
    if (distance < window.innerHeight / 2) {
      card.classList.add("visible");
    } else {
      card.classList.remove("visible");
    }
  });

  // Hide scroll indicator after some scrolling
  const indicator = document.getElementById("indicator");
  if (window.scrollY > 100) {
    indicator.style.opacity = "0";
  } else {
    indicator.style.opacity = "1";
  }
}

window.addEventListener("scroll", () => {
  requestAnimationFrame(render);
});
