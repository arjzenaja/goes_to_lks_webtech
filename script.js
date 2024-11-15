document.getElementById("imageInput").addEventListener("change", handleImageUpload);
document.getElementById("logoInput").addEventListener("change", handleLogoUpload);
document.getElementById("process").addEventListener("click", drawWatermarkedImage);

let mainImage = null;
let logoImage = null;

function handleImageUpload(event) {
const reader = new FileReader();
reader.onload = function(e) {
    mainImage = new Image();
    mainImage.onload = drawWatermarkedImage;
    mainImage.src = e.target.result;
};
reader.readAsDataURL(event.target.files[0]);
}

function handleLogoUpload(event) {
    const reader = new FileReader();
    reader.onload = function(e) {
    logoImage = new Image();
    logoImage.onload = drawWatermarkedImage;
    logoImage.src = e.target.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function drawWatermarkedImage() {
    if (!mainImage || !logoImage) return;

    const canvas = document.getElementById("outputCanvas");
    const ctx = canvas.getContext("2d");

    canvas.width = mainImage.width;
    canvas.height = mainImage.height;
    ctx.drawImage(mainImage, 0, 0);
    
    const logoWidth = mainImage.width * 0.2;
    const logoHeight = (logoImage.height / logoImage.width) * logoWidth;
    const logoX = mainImage.width - logoWidth - 10;
    const logoY = 10;

    ctx.drawImage(logoImage, logoX, logoY, logoWidth, logoHeight);
}