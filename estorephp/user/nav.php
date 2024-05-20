<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a href="../index.php"><img src="../images/shoplogo.png" class="logo" alt="logo image"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../allProducts.php">Products</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            </li>
        </ul>
        <form class="d-flex" method="get" action="../index.php">
            <input class="form-control me-2" type="search" name="data" placeholder="Search" aria-label="Search">
            <input type="hidden" name="action" value="searchProduct">
            <input type="submit" value="Search" class="btn btn-outline-success">
        </form>
        </div>
    </div>
</nav>