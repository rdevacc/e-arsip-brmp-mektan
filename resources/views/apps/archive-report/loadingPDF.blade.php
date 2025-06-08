<!-- resources/views/apps/archive-report/loadingPDF.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export PDF - Arsip</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        #loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: sans-serif;
            font-size: 1.5rem;
            color: #555;
        }

        iframe {
            width: 100vw;
            height: 100vh;
            border: none;
            display: none;
        }
    </style>
</head>
<body>
    <div id="loading">Loading PDF...</div>
    <iframe id="pdfFrame"></iframe>

    <script>
        const pdfUrl = @json(route('archive-report.generate.pdf', request()->query()));

        const iframe = document.getElementById('pdfFrame');
        iframe.src = pdfUrl;

        iframe.onload = function () {
            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';
                iframe.style.display = 'block';
            }, 500);
        };
    </script>
</body>
</html>
