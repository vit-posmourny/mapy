<html>


    <body id="b-crop-body">

        <div id="crop-flex">

            <div id="crop-controls" class="crop_controls">

                <input id="i-for-cropping" type="file" class="button_main" accept="image/*">
                <button id="crop-result" class="button_main">Crop & Download</button>

            </div>

            <p id="p-crop-warn-msg" style="font-size: larger; color:rgb(212, 168, 110); margin:0"></p>

            <div id="crop-container"></div>

            <form action="/croppie" method="post" enctype="multipart/form-data" class="crop_controls">

                    <input id="fileToUpload" type="file" name="fileToUpload" class="button_main">
                    <button type="submit" name="submit" class="button_main">Odeslat na server</button>
                    
            </form>
            
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () 
            {
                // 1. Initialize Croppie
                const el = document.getElementById('crop-container');
                const croppieInstance = new Croppie(el, {
                    viewport: { width: 200, height: 200, type: 'square' }, // Options: square or circle
                    boundary: { width: 750, height: 800 },
                    enableOrientation: true,
                    enableZoom: true,
                });
        
                // 2. Handle image upload
                document.getElementById('i-for-cropping').addEventListener('change', function (event) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        croppieInstance.bind({
                            url: e.target.result
                        });
                    };
                    reader.readAsDataURL(event.target.files[0]);
                });
        
                // 3. Handle the Crop button
                document.getElementById('crop-result').addEventListener('click', function () {
                    croppieInstance.result({
                        type: 'base64',
                        size: 'viewport'
                    }).then(function (croppedImage) {
                            // Download or use the cropped image
                            downloadImage(croppedImage, 'cropped-image.png');
                    });
                });
            });

             // Helper function to download the cropped image
            function downloadImage(dataUrl, filename) {
                const a = document.createElement('a');
                a.href = dataUrl;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            }

        </script>

        <script src="{{ Vite::asset('resources/js/croppie.js') }}"></script>
    </body>

</html>