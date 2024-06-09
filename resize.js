let video = document.getElementById('video');
        let canvas = document.getElementById('canvas');
        let startBtn = document.getElementById('start-btn');
        let stopBtn = document.getElementById('stop-btn');
        let captureBtn = document.getElementById('capture-btn');
        let uploadBtn = document.getElementById('upload-btn');
        let downloadLink = document.getElementById('download-link');
        let photoDataInput = document.getElementById('photo-data');
        let filterSelect = document.getElementById('filter-select');
        let currentStream = null;

        function startWebcam() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                    currentStream = stream;
                    video.srcObject = stream;
                    video.play();
                    startBtn.style.display = 'none';
                    stopBtn.style.display = 'inline-block';
                    captureBtn.style.display = 'inline-block';
                });
            }
        }

        function stopWebcam() {
            if (currentStream) {
                currentStream.getTracks().forEach(track => track.stop());
                video.srcObject = null;
                startBtn.style.display = 'inline-block';
                stopBtn.style.display = 'none';
                captureBtn.style.display = 'none';
                uploadBtn.style.display = 'none';
                downloadLink.style.display = 'none';
            }
        }

        function captureImage() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            let context = canvas.getContext('2d');
            context.filter = filterSelect.value;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            let dataURL = canvas.toDataURL('image/png');
            photoDataInput.value = dataURL;
            downloadLink.href = dataURL;
            uploadBtn.style.display = 'inline-block';
            downloadLink.style.display = 'inline-block';
        }

        function applyFilter() {
            video.style.filter = filterSelect.value;
        }