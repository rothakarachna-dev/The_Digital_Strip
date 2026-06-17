<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Stickers</title>

    <style>
        :root {
            --primary-pink: #e91e63;
            --soft-pink: #fce4ec;
            --bg-pink: #fdf0f5;
            --white: #ffffff;
            --text-gray: #777;
            --text-dark: #333;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: var(--bg-pink);
            margin: 0;
            display: flex;
        }

        .main-content {
            flex-grow: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .content-wrapper {
            width: 100%;
            max-width: 800px;
        }

        .page-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .page-header h1 {
            color: var(--text-dark);
            margin: 0;
        }

        .content-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(233, 30, 99, 0.08);
            padding: 30px;
            margin-bottom: 30px;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
        }

        /* Upload Zone */
        .upload-container {
            border: 2px dashed var(--primary-pink);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            background-color: var(--bg-pink);
            position: relative;
            cursor: pointer;
        }

        .upload-container input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        #preview-img {
            max-width: 120px;
            margin-top: 15px;
            border-radius: 10px;
            display: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .submit-btn {
            width: 100%;
            background-color: var(--primary-pink);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        /* Sticker Grid */
        .sticker-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .sticker-item {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            transition: 0.3s;
        }

        .sticker-item:hover {
            transform: translateY(-3px);
        }

        .sticker-item img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-bottom: 8px;
        }

        .delete-link {
            display: block;
            color: #ff4d4d;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            background: none;
            border: none;
            cursor: pointer;
        }

        .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    @include('admin.sidebar')

    <div class="main-content">
        <div class="content-wrapper">

            <div class="page-header">
                <h1>Manage Sticker Inventory</h1>
            </div>

            <div class="content-card">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.stickers.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="upload-container">
                        <span style="font-size:40px;">🖼️</span>
                        <p id="upload-text">Select a sticker to upload</p>

                        <input
                            type="file"
                            name="sticker_image"
                            id="sticker_image"
                            accept="image/*"
                            required
                        >

                        <img id="preview-img" src="#" alt="Preview">
                    </div>

                    <button type="submit" class="submit-btn">
                        Upload to Booth
                    </button>
                </form>

            </div>

            <div class="content-card">
                <h3 style="margin-top:0;color:var(--primary-pink);">
                    Current Stickers ({{ $stickers->count() }})
                </h3>

                <div class="sticker-grid">

                    @forelse($stickers as $sticker)
                        <div class="sticker-item">

                            <img
                                src="{{ asset($sticker->image_path) }}"
                                alt="Sticker"
                            >

                            <form action="{{ route('admin.stickers.destroy', $sticker->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this sticker permanently?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-link">
                                    Delete
                                </button>
                            </form>

                        </div>
                    @empty
                        <p style="color:#999;font-size:14px;">
                            No stickers in the booth yet.
                        </p>
                    @endforelse

                </div>
            </div>

        </div>
    </div>

    <script>
        const imageInput = document.getElementById('sticker_image');
        const previewImg = document.getElementById('preview-img');
        const uploadText = document.getElementById('upload-text');

        imageInput.onchange = () => {
            const [file] = imageInput.files;

            if (file) {
                previewImg.src = URL.createObjectURL(file);
                previewImg.style.display = 'inline-block';
                uploadText.innerText = "Selected: " + file.name;
            }
        };
    </script>

</body>
</html>