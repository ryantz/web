const createNav = () => {
    let nav = document.querySelector('.navbar');

    nav.innerHTML = `
    <div class="nav">
        <a href="index.php" class="logo"><span class="brand-logo">Does IT All</span>
        <span class="circ-pink"></span></a>
        <div class="nav-items">
            <div class="search">
                <input type="text" class="search-box" placeholder="search brand, product">
                <button class="search-btn">search</button>
            </div>
            <a href="login.php"><img src="img/user.png"></a>
            <a href="cart.php"><img src="img/cart.png">
            <div class="cart_items"></div></a>
        </div>
    </div>
    <ul class="links-container">
        <li class="link-item"><a href="#" class="link">Electronic Deives</a></li>
        <li class="link-item"><a href="#" class="link">Electronic Accessories</a></li>
        <li class="link-item"><a href="#" class="link">Home Appliances</a></li>
    </ul>
    `;
}

createNav();