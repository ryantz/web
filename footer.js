const createFooter = () => {
    let footer = document.querySelector('footer');

    footer.innerHTML = `
    <div class="flex-row-container">
        <div class="flex-row-item1">
            <h3>About Us</h3>
            <br />
            <span>Does IT All&copy; is the leading online shopping platform for IT products in Singapore. 
            We are always striving to keep up with what consumers want and need. We are making 
            every effort to achieve maximum customer satisfaction through seamless transactions 
            and competitive product pricing. We are updating and improving our product selections 
            at the best prices to delight our customers along with great deals and flash sales.
            </span>
        </div>
        <div class="flex-row-item2">
            <h3>Customer Service</h3>
            <br />
            Tel: +65 8888 8888<br/><br/>
            Email: <a href="mailto:cakeshop4717@f34.com">doesitall@gmail.com</a
            ><br/><br/>
            Order-tracking: <a href="order.php">doesitall@gmail.com</a
            ><br/><br/>
        </div>
        <div class="flex-row-item3">
            <h3>Download Our App</h3>
            <br/>
            <p>Downlaod App for Android and ios mobile phone.</p>
            <img src="assets/footer/play-store.png">
            <img src="assets/footer/app-store.png">
            <br/><br/>
            Copyright &copy; 2021 Does It All
        </div>
    </div>
    <div class="footer-social-container">
        <div>
            <a href="#" class="social-link">terms & services</a>
            <a href="#" class="social-link">privacy page</a>
        </div>
        <div>
            <a href="#" class="social-link">instagram</a>
            <a href="#" class="social-link">facebook</a>
            <a href="#" class="social-link">twitter</a>
        </div>
    </div>
    <p class="footer-credit">Does IT All, Best IT online store</p>
    `;
}

createFooter();