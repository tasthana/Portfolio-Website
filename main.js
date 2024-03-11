const canvas = document.getElementById('glCanvas');
const gl = canvas.getContext('webgl');

if (!gl) {
    console.error('Unable to initialize WebGL. Your browser may not support it.');
}

function initShaders() {
    //  shader initialization code 
}

function initBuffers() {
    //  buffer initialization  code
}

function drawScene() {
    // drawing code 
}

function main() {
    initShaders();
    initBuffers();
    drawScene();
}

main();