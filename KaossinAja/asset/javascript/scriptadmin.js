function openModal(modalId) {
    document.getElementById(modalId).style.display = 'flex';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function openEditModal(id, name, category, price, stock) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-name').value = name;
    document.getElementById('edit-category').value = category;
    document.getElementById('edit-price').value = price;
    document.getElementById('edit-originalprice').value = original_price;
    document.getElementById('edit-stock').value = stock;
    openModal('editModal');
}

function openDeleteModal(id) {
    document.getElementById('delete-id').value = id;
    openModal('deleteModal');
}
