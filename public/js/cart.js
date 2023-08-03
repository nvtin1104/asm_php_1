
// Lắng nghe sự kiện khi nút "Update" được nhấn
const updateButtons = document.querySelectorAll('.btn-update');
updateButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        const tr = event.target.closest('tr');
        const productId = button.getAttribute('data-product-id');
        const quantityInput = tr.querySelector('input[name="quantity"]');
        const newQuantity = quantityInput.value;
        const cartId = button.getAttribute('data-cart-id');
        // Gửi yêu cầu AJAX để cập nhật số lượng sản phẩm
        updateProductQuantity(cartId, newQuantity, productId);
    });
});

// Hàm gửi yêu cầu AJAX
// JavaScript
// Hàm gửi yêu cầu AJAX
function updateProductQuantity(cartId, quantity, productId) {
    const xhr = new XMLHttpRequest();
    const url = './controller/cart/update.php'; // Thay đổi đường dẫn tới file xử lý AJAX
    const params = 'cart_id=' + encodeURIComponent(cartId) + '&quantity=' + encodeURIComponent(quantity) + '&product_id=' + encodeURIComponent(productId);
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    let icon = response.icon;
                    let message = response.message;
                    launch_toast(icon, message);
                } else if (response.status === 'error') {
                    let icon = response.icon;
                    let message = response.message;
                    launch_toast(icon, message);
                }
            } else {
                // Lỗi trong quá trình gửi yêu cầu AJAX
                console.log('Lỗi: ' + xhr.statusText);
            }
        }
    };
    xhr.send(params);
}

function launch_toast(icon, message) {
    var x = document.getElementById("toast")
    x.className = "show";
    const imgDiv = document.getElementById("img");
    imgDiv.innerHTML = icon; // Thay đổi thành nội dung mới
    // Để thay đổi nội dung của div có id="desc"
    const descDiv = document.getElementById("desc");
    descDiv.innerText = message;
    setTimeout(function () {
        x.className = x.className.replace("show", "");
        window.location.reload();
    }, 2000);

}
const deleteButtons = document.querySelectorAll('.btn-delete');
deleteButtons.forEach((button) => {
    button.addEventListener('click', () => {
        const cartId = button.getAttribute('data-cart-id'); // Gửi yêu cầu AJAX để xóa sản phẩm
        deleteProductFromCart(cartId);
    });
});

function deleteProductFromCart(cartId) {
    const xhr = new XMLHttpRequest();
    const url = './controller/cart/delete.php';
    const params = 'cart_id=' + encodeURIComponent(cartId);

    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                // Phản hồi thành công
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    let icon = response.icon;
                    let message = response.message;
                    launch_toast(icon, message);
                    // Perform any additional actions if the deletion was successful
                    // For example, you may want to reload the cart or update the UI.
                } else if (response.status === 'error') {
                    let icon = response.icon;
                    let message = response.message;
                    launch_toast(icon, message);
                    // Handle the error appropriately, if needed
                }
            } else {
                // Lỗi trong quá trình gửi yêu cầu AJAX
                console.log('Lỗi: ' + xhr.statusText);
            }
        }
    };

    xhr.send(params);
}