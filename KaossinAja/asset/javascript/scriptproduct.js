document.addEventListener("DOMContentLoaded", () => {
  const quantityInput = document.getElementById("quantity");
  const increaseBtn = document.getElementById("increase");
  const decreaseBtn = document.getElementById("decrease");

  increaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
  });

  decreaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  });

  const sizeButtons = document.querySelectorAll(".size");
  sizeButtons.forEach((button) => {
    button.addEventListener("click", () => {
      sizeButtons.forEach((btn) => btn.classList.remove("selected"));
      button.classList.add("selected");
    });
  });
});

// popup pembayaran
const buyNowButton = document.getElementById("buy-now");
const popupPayment = document.getElementById("popupPayment");
const overlay = document.getElementById("overlay");
const closePopupPayment = document.getElementById("close-popup-payment");

buyNowButton.addEventListener("click", () => {
  popupPayment.style.display = "block";
  overlay.style.display = "block";
});

closePopupPayment.addEventListener("click", () => {
  popupPayment.style.display = "none";
  overlay.style.display = "none";
});

overlay.addEventListener("click", () => {
  popupPayment.style.display = "none";
  overlay.style.display = "none";
});

// ukuran
function ukuran() {
  const sizeButtons = document.querySelectorAll(".size");
  sizeButtons.forEach((button) => {
    button.addEventListener("click", function () {
      sizeButtons.forEach((btn) => btn.classList.remove("size selected"));
      this.classList.add("size selected");

      const selectedSize = this.id;
      console.log(`Ukuran dipilih: ${selectedSize}`);

      metodepembayaran(selectedSize);
    });
  });
}

function metodepembayaran(paymentMethod) {
  const itemName = document.getElementById("item-name").innerText;
  const itemPrice = parseFloat(
    document.getElementById("item-price").innerText.replace(/,/g, "")
  );
  const quantity = parseInt(document.getElementById("quantity").value);
  const selectedSize = document.querySelector(".size.selected").id;
  const totalPrice = itemPrice * quantity;

  const printContent = `
      <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9;">
  <h2 style="text-align: center; color: #333;">Struk Pembayaran</h2>
  <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <tr>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Metode Pembayaran</td>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">${paymentMethod}</td>
    </tr>
    <tr>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Nama Barang</td>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">${itemName}</td>
    </tr>
    <tr>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Ukuran</td>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">${selectedSize}</td>
    </tr>
    <tr>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Jumlah</td>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">${quantity}</td>
    </tr>
    <tr>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Harga Satuan</td>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Rp ${itemPrice.toLocaleString()}.000</td>
    </tr>
    <tr>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Total Harga</td>
      <td style="padding: 10px; border-bottom: 2px solid #ddd;">Rp ${totalPrice.toLocaleString()}.000</td>
    </tr>
  </table>
  
  <p style="text-align: center; margin: 20px 0;">Terima kasih atas pembelian Anda! <br> Silahkan tunjukan struk ini ke kasir untuk mengambil barang anda</p>
</div>

    `;

  const newWindow = window.open("", "", "height=600,width=800");
  newWindow.document.write(`
      <html>
        <head><title>Cetak Struk</title></head>
        <body>${printContent}</body>
      </html>
    `);
  newWindow.document.close();
  newWindow.print();
}

ukuran();
