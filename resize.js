let videoStream;

function startWebcam() {
    const video = document.getElementById('video');
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            videoStream = stream;
            video.srcObject = stream;
            document.getElementById('start-btn').classList.add('hidden');
            document.getElementById('stop-btn').classList.remove('hidden');
            document.getElementById('capture-btn').classList.remove('hidden');
            document.getElementById('filter-select').classList.remove('hidden');
        })
        .catch(err => {
            console.error("Error accessing the camera: ", err);
        });
}

function stopWebcam() {
    videoStream.getTracks().forEach(track => track.stop());
    document.getElementById('start-btn').classList.remove('hidden');
    document.getElementById('stop-btn').classList.add('hidden');
    document.getElementById('capture-btn').classList.add('hidden');
    document.getElementById('filter-select').classList.add('hidden');
}

function applyFilter() {
    const video = document.getElementById('video');
    const filter = document.getElementById('filter-select').value;
    video.style.filter = filter;
}

function captureImage() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const width = video.videoWidth;
    const height = video.videoHeight;

    canvas.width = width;
    canvas.height = height;
    context.filter = video.style.filter;
    context.drawImage(video, 0, 0, width, height);

    // Menghentikan tampilan video
    video.pause();
    video.srcObject = null;

    // Mengubah visibilitas video dan tombol
    video.classList.add('hidden');
    document.getElementById('start-btn').classList.add('hidden');
    document.getElementById('stop-btn').classList.add('hidden');
    document.getElementById('capture-btn').classList.add('hidden');
    document.getElementById('filter-select').classList.add('hidden');

    const dataUrl = canvas.toDataURL('image/png');
    document.getElementById('photo-data').value = dataUrl;

    // Menampilkan gambar yang diambil
    const img = document.createElement('img');
    img.src = dataUrl;
    document.getElementById('webcam-container').appendChild(img);

    // Menampilkan tombol untuk mengunggah foto dan tombol unduh
    document.getElementById('upload-form').classList.remove('hidden');
    document.getElementById('upload-btn').classList.remove('hidden');
    document.getElementById('download-link').classList.remove('hidden');
    document.getElementById('download-link').href = dataUrl;
}
