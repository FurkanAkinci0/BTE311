const canvas = document.getElementById('myCanvas');
const ctx = canvas.getContext('2d');

const canvasSize = Math.min(canvas.width, canvas.height);

const cols = 10; 
const rows = 10; 
const totalPadding = 10;
const availableSpace = canvasSize - totalPadding * (cols + 1);
const circleRadius = availableSpace / (cols * 2);
const padding = totalPadding;

const startColor = [0, 0, 128]; 
const endColor = [173, 216, 230];

for (let row = 0; row < rows; row++) {
  for (let col = 0; col < cols; col++) {
    const x = padding + circleRadius + col * (circleRadius * 2 + padding); 
    const y = padding + circleRadius + row * (circleRadius * 2 + padding);

    const progress = ((col + 1) + (rows - row - 1)) / (cols + rows - 2); 
    const red = Math.floor(startColor[0] + (endColor[0] - startColor[0]) * progress);
    const green = Math.floor(startColor[1] + (endColor[1] - startColor[1]) * progress);
    const blue = Math.floor(startColor[2] + (endColor[2] - startColor[2]) * progress);
    const color = `rgb(${red}, ${green}, ${blue})`;

    ctx.strokeStyle = color;
    ctx.beginPath();
    ctx.arc(x, y, circleRadius, 0, Math.PI * 2);
    ctx.stroke();
  }
}
