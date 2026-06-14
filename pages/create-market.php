<?php require_once __DIR__ . '/../includes/session.php';
require_permission('producer.create_market'); ?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Green Market</title>
    <!-- FONT -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <!-- ICONS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    </link>
    <link href="../assets/css/base.css" rel="stylesheet" />
    <link href="../assets/css/pages/create-market.css" rel="stylesheet" />
    <link href="../assets/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <!-- ========================= -->
    <!-- NAVBAR -->
    <!-- ========================= -->
    <nav class="navbar">
        <div class="logo">
            <span>Green</span>Market
        </div>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a active="" href="#">Markets</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="about.php">À propos</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <div class="nav-buttons">
            <button class="login-btn">Login</button>
            <button class="create-btn">Create Market</button>
        </div>
        <div class="menu-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
    </nav>
    <!-- ========================= -->
    <!-- PAGE -->
    <!-- ========================= -->
    <div class="container">
        <!-- ========================= -->
        <!-- BASIC INFO -->
        <!-- ========================= -->
        <div class="card premium-info-card">
            <div class="info-top">
                <div class="info-title">
                    <div class="title-icon">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <div>
                        <h2>1. Basic Information</h2>
                        <p>Fill your market information professionallyto create a beautiful organic identity.</p>
                    </div>
                </div>
                <div class="info-status">Professional Setup</div>
            </div>
            <div class="premium-form">
                <div class="premium-input">
                    <label>Market Name</label>
                    <div class="input-box">
                        <i class="fa-solid fa-store"></i>
                        <input placeholder="Green Nature Market" type="text" />
                    </div>
                </div>
                <div class="premium-input">
                    <label>Tagline</label>
                    <div class="input-box">
                        <i class="fa-solid fa-quote-left"></i>
                        <input placeholder="Fresh &amp; Organic Everyday" type="text" />
                    </div>
                </div>
                <div class="premium-grid">
                    <div class="premium-input">
                        <label>Country</label>
                        <div class="input-box">
                            <i class="fa-solid fa-earth-africa"></i>
                            <select>
                                <option>Morocco</option>
                                <option>France</option>
                                <option>Spain</option>
                            </select>
                        </div>
                    </div>
                    <div class="premium-input">
                        <label>City</label>
                        <div class="input-box">
                            <i class="fa-solid fa-location-dot"></i>
                            <select>
                                <option>Casablanca</option>
                                <option>Rabat</option>
                                <option>Marrakech</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="premium-input">
                    <label>Description</label>
                    <div class="textarea-box">
                        <textarea placeholder="Describe your market, products, and organic identity..."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= -->
        <!-- LOGO -->
        <!-- ========================= -->
        <div class="card logo-card">
            <div class="logo-header">
                <div>
                    <h2>2. Upload Market Logo</h2>
                    <p> Add a professional logo for your market.</p>
                </div>
                <div class="logo-badge">PNG / JPG</div>
            </div>
            <div class="premium-upload" id="uploadArea">
                <input hidden="" id="logoInput" type="file" />
                <div class="upload-content">
                    <div class="upload-icon">
                        <i class="fa-solid fa-image"></i>
                    </div>
                    <h3>Drag &amp; Drop Logo</h3>
                    <p>or click to browse from your computer</p>
                    <button class="browse-btn" type="button">Browse Files</button>
                </div>
                <img id="previewLogo" src="" />
            </div>
        </div>
        <!-- ========================= -->
        <!-- MARKET IMAGES -->
        <!-- ========================= -->
        <div class="card images-card">
            <div class="images-header">
                <div>
                    <h2>3. Market Images</h2>
                    <p>These images will be used in homepage carouselto showcase your market.</p>
                </div>
                <button class="upload-more-btn" id="addImagesBtn">
                    <i class="fa-solid fa-plus"></i>
                    Add Images
                </button>
                <input id="imagesInput" multiplehidden="" type="file" />
            </div>
            <div class="images-layout">
                <!-- LEFT -->
                <div class="images-grid" id="imagesGrid">
                    <div class="market-image">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&amp;w=1000" />
                        <div class="image-actions">
                            <button class="edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="delete-btn">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="market-image">
                        <img src="https://images.unsplash.com/photo-1516594798947-e65505dbb29d?q=80&amp;w=1000" />
                        <div class="image-actions">
                            <button class="edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="delete-btn">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- RIGHT -->
                <div class="preview-card">
                    <div class="preview-top">
                        <h3>Preview</h3>
                    </div>
                    <div class="preview-image-box">
                        <img id="previewImage" src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&amp;w=1000" />
                        <button class="preview-arrow left" id="prevBtn">
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="preview-arrow right" id="nextBtn">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= -->
        <!-- CONTACT -->
        <!-- ========================= -->
        <div class="card premium-contact-card">
            <div class="contact-header">
                <div>
                    <h2>4. Contact &amp; Socials</h2>
                    <p>Connect your market with customers throughprofessional contact information and social media.</p>
                </div>
                <div class="contact-badge">Public Information</div>
            </div>
            <div class="contact-grid">
                <div class="contact-input">
                    <label>Email Address</label>
                    <div class="contact-box">
                        <i class="fa-solid fa-envelope"></i>
                        <input placeholder="hello@greenmarket.com" type="email" />
                    </div>
                </div>
                <div class="contact-input">
                    <label>Phone Number</label>
                    <div class="contact-box">
                        <i class="fa-solid fa-phone"></i>
                        <input placeholder="+212 600000000" type="text" />
                    </div>
                </div>
                <div class="contact-input">
                    <label>Instagram</label>
                    <div class="contact-box">
                        <i class="fa-brands fa-instagram"></i>
                        <input placeholder="@greenmarket" type="text" />
                    </div>
                </div>
                <div class="contact-input">
                    <label>Facebook</label>
                    <div class="contact-box">
                        <i class="fa-brands fa-facebook-f"></i>
                        <input placeholder="facebook.com/greenmarket" type="text" />
                    </div>
                </div>
                <div class="contact-input full-width">
                    <label>Website</label>
                    <div class="contact-box">
                        <i class="fa-solid fa-globe"></i>
                        <input placeholder="www.greenmarket.com" type="text" />
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= -->
        <!-- SETTINGS -->
        <!-- ========================= -->
        <div class="card premium-settings-card">
            <div class="settings-header">
                <div>
                    <h2>5. Settings</h2>
                    <p>Configure your market settings professionally.</p>
                </div>
                <div class="settings-badge">Advanced Settings</div>
            </div>
            <div class="settings-grid">
                <div class="settings-input">
                    <label>Currency</label>
                    <div class="settings-box">
                        <i class="fa-solid fa-money-bill-wave"></i>
                        <select>
                            <option>MAD - Moroccan Dirham</option>
                            <option>USD - Dollar</option>
                            <option>EUR - Euro</option>
                        </select>
                    </div>
                </div>
                <div class="settings-input">
                    <label>Timezone</label>
                    <div class="settings-box">
                        <i class="fa-solid fa-clock"></i>
                        <select>
                            <option>Africa/Casablanca</option>
                            <option>UTC</option>
                        </select>
                    </div>
                </div>
                <div class="settings-input">
                    <label>Delivery</label>
                    <div class="settings-box">
                        <i class="fa-solid fa-truck"></i>
                        <select>
                            <option>Available</option>
                            <option>Not Available</option>
                        </select>
                    </div>
                </div>
                <div class="settings-input">
                    <label>Market Status</label>
                    <div class="status-switch">
                        <span id="statusText">Active</span>
                        <button class="toggle-btn active" id="toggleStatus">
                            <div class="toggle-circle"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= -->
        <!-- RULES -->
        <!-- ========================= -->
        <div class="card rules-card">
            <h3>Market Rules &amp; Active Guidelines</h3>
            <ul>
                <li> Use high quality natural product images.</li>
                <li>Do not upload copyrighted content.</li>
                <li>Keep your branding clean and professional.</li>
                <li>Organic and eco-friendly products are preferred.</li>
                <li>Respect community and marketplace standards.</li>
            </ul>
        </div>
        <!-- ========================= -->
        <!-- BUTTONS -->
        <!-- ========================= -->
        <div class="footer-actions">
            <button class="cancel-btn">Cancel</button>
            <button class="create-market-btn">Create Market</button>
        </div>
    </div>

    <script src="../assets/js/pages/create-market.js"></script>
</body>

</html>
