<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Project | Crowdfund </title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="{{ secure_asset('fontawesome-free-6.6.0-web/css/all.min.css') }}" rel='stylesheet'>
    <!-- Custom CSS -->
     <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/z0tjfyc19bx62zx1blg9yjkkrg6p35w0cwf30qgxhrv4tf8e/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar, .footer {
            background-color: #f8f9fa; /* Off-white background */
        }
        .navbar-brand, .nav-link, .footer .footer-brand, .footer .footer-links a {
            color: #343a40; /* Darker shade of black */
        }
        .navbar-brand:hover, .nav-link:hover, .footer .footer-links a:hover, .footer .social-icons a:hover {
            color: #212529; /* Even darker on hover */
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%2852, 58, 64, 0.7%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .dropdown-menu {
            background-color: #e9ecef; /* Light gray dropdown */
            border: none;
        }
        .dropdown-item {
            color: #343a40;
            transition: background-color 0.3s ease;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .form-inline .form-control {
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            border: 1px solid #343a40;
        }
        .form-inline .btn {
            border-radius: 50px;
            background-color: #343a40;
            color: white;
            border: none;
        }
        .form-inline .btn:hover {
            background-color: #212529;
        }
        .user-profile img {
            border-radius: 50%;
            border: 2px solid #adb5bd;
            padding: 2px;
        }
        .footer .footer-brand {
            font-weight: bold;
            font-size: 1.5rem;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
        .footer .footer-links {
            list-style: none;
            padding: 0;
        }
        .footer .footer-links li {
            margin-bottom: 10px;
        }
        .footer .footer-links a {
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .footer .social-icons a {
            margin-right: 15px;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        .footer .copyright {
            margin-top: 20px;
            font-size: 0.9rem;
            color: #6c757d; /* Muted text */
        }
        @media (max-width: 768px) {
            .footer .footer-brand, .footer .social-icons {
                text-align: center;
            }
        }
        .modal-dialog {
            max-width: 100%;
        }

        /* Image preview styles */
        .image-preview {
            width: 100%;
            max-width: 200px;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light py-4 position-fixed fixed-top shadow-sm">
        <div class="container">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('home') }}">CROWDFUND</a>
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#createCrowdfundModal">Create Project</a>
                        </li>
                    @endauth
                </ul>
                <!-- Search Bar -->
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn my-2 my-sm-0" type="submit">Search</button>
                </form>
                <!-- User Profile Dropdown -->
                @auth
                    <ul class="navbar-nav ml-lg-4 user-profile">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="https://via.placeholder.com/30" alt="User"> {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                @endauth

                @guest
                    <ul class="navbar-nav ml-lg-4 user-profile">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Login</a>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>
    </nav>

    <main id="app">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer py-5 shadow-sm">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-md-4">
                    <div class="footer-brand">MyBrand</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent volutpat nisl nec dolor suscipit, in laoreet felis pharetra.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <!-- Social Media -->
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <div class="copyright">
                        &copy; 2024 CROWDFUND. All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Crowdfund Creation Modal -->
    @auth
    <div class="modal fade" id="createCrowdfundModal" tabindex="-1" role="dialog" aria-labelledby="createCrowdfundModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCrowdfundModalLabel">Create Crowdfund</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ secure_route('crowdfund.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Crowdfund Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="datetime-local" id="duration" name="duration" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="goal">Goal</label>
                            <input type="number" id="goal" name="goal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" class="form-control" required onchange="previewImage(event)">
                            <img id="imagePreview" class="image-preview" src="#" alt="Image Preview" style="display:none;">
                        </div>
                        <div class="form-group">
                            <label for="short_story">Short Story</label>
                            <textarea id="short_story" name="short_story" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="story">Story</label>
                            <textarea id="story" name="story" class="form-control" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Crowdfund</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endauth

    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // TinyMCE Initialization
        tinymce.init({
            selector: '#short_story, #story',
            menubar: false,
            plugins: 'anchor autolink code charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();  // Syncs the content back to the textarea
                });
            }
        });

        // Image preview function
        function previewImage(event) {
            const image = document.getElementById('imagePreview');
            image.style.display = 'block';
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>
</html>
