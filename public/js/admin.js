document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("product-form");
    const productIdInput = document.getElementById("product-id");
    const submitButton = document.getElementById("submit-button");
    const formTitle = document.getElementById("form-title");

    // Load categories into <select>
    fetch("php/get_categories.php")
        .then(response => response.json())
        .then(categories => {
            const select = document.getElementById("category-select");
            categories.forEach(cat => {
                const option = document.createElement("option");
                option.value = cat.id;
                option.textContent = cat.name;
                select.appendChild(option);
            });
            updateCategoryList(categories);
        })
        .catch(error => console.error("Failed to load categories:", error));

    // Load brands into <select>
    fetch("php/get_brands.php")
        .then(response => response.json())
        .then(brands => {
            const select = document.getElementById("brand-select");
            brands.forEach(brand => {
                const option = document.createElement("option");
                option.value = brand.id;
                option.textContent = brand.name;
                select.appendChild(option);
            });
            updateBrandList(brands);
        })
        .catch(error => console.error("Failed to load brands:", error));

    // Submit (Add or Edit) product
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch("php/add_product.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.text()) // First get the raw text
            .then(text => {
                try {
                    const result = JSON.parse(text); // Try to parse it
                    alert(result.message);
                    if (result.success) {
                        form.reset();
                        productIdInput.value = "";
                        formTitle.textContent = "Add Product";
                        submitButton.textContent = "Add Product";
                        loadProducts();
                    }
                } catch (e) {
                    console.error("Invalid JSON response:", text); // Log raw text here
                    alert("Invalid server response. Check console for details.");
                }
            })
            .catch(error => {
                console.error("Error submitting form:", error);
                alert("Something went wrong.");
            })
    });

    // Prefill form for edit
    window.prefillForm = function (product) {
        productIdInput.value = product.id;
        form.name.value = product.name;
        form.description.value = product.description;
        form.price.value = product.price;
        form.image.value = product.image;
        form.category_id.value = product.category_id;
        form.brand_id.value = product.brand_id;

        formTitle.textContent = "Edit Product";
        submitButton.textContent = "Update Product";
    };

    // Load products initially
    loadProducts();

    // Handle add category
    $('#category-form').submit(function (e) {
        e.preventDefault();
        const name = $('#new-category').val().trim();
        if (!name) return;
        $.post('php/add_category.php', { name }, function () {
            $('#new-category').val('');
            location.reload();
        });
    });

    // Handle add brand
    $('#brand-form').submit(function (e) {
        e.preventDefault();
        const name = $('#new-brand').val().trim();
        if (!name) return;
        $.post('php/add_brand.php', { name }, function () {
            $('#new-brand').val('');
            location.reload();
        });
    });

    // Load category & brand lists
    updateList('category', 'category-list');
    updateList('brand', 'brand-list');

    const newProductBtn = document.getElementById("new-product-btn");
    const productForm = document.getElementById("product-form");

    newProductBtn.addEventListener("click", function () {
        // Reset form
        productForm.reset();

        // Clear hidden id to switch to 'Add' mode
        document.getElementById("product-id").value = "";

        // Reset titles
        formTitle.textContent = "Add Product";
        submitButton.textContent = "Add Product";
        submitButton.classList.remove("btn-warning");
        submitButton.classList.add("btn-primary");
    });

});

// Product loading with pagination
let currentPage = 1;
let limit = 5;

function htmlspecialchars(str) {
    return str.replace(/[&<>"']/g, function (match) {
        switch (match) {
            case '&': return '&amp;';
            case '<': return '&lt;';
            case '>': return '&gt;';
            case '"': return '&quot;';
            case "'": return '&#039;';
        }
    });
}

function loadProducts(search = "") {
    fetch(`php/get_products.php?search=${encodeURIComponent(search)}&page=${currentPage}&limit=${limit}`)
        .then(res => res.json())
        .then(data => {
            const tableBody = document.querySelector("#product-table tbody");
            tableBody.innerHTML = "";
            data.products.forEach(product => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.price}</td>
                    <td><img src="${product.image}" width="50"></td>
                    <td>${product.category_name}</td>
                    <td>${product.brand_name}</td>
                    <td>
                        <button onclick='prefillForm(${JSON.stringify(product)})'>Edit</button>
                        <button onclick='deleteProduct(${product.id})'>Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
            renderPagination(data.total);
        });
}

function renderPagination(totalItems) {
    const paginationDiv = document.getElementById("pagination");
    const totalPages = Math.ceil(totalItems / limit);
    paginationDiv.innerHTML = "";

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.disabled = (i === currentPage);
        btn.onclick = () => {
            currentPage = i;
            loadProducts(document.getElementById("search-box").value);
        };
        paginationDiv.appendChild(btn);
    }
}

// Live search
document.getElementById("search-box").addEventListener("input", function () {
    currentPage = 1;
    loadProducts(this.value);
});

// Delete a product
function deleteProduct(id) {
    if (confirm("Are you sure you want to delete this product?")) {
        fetch(`php/delete_product.php?id=${id}`, {
            method: "GET"
        })
            .then(response => response.json())
            .then(result => {
                alert(result.message);
                if (result.success) {
                    loadProducts();
                }
            })
            .catch(error => {
                console.error("Delete failed:", error);
                alert("Error deleting product.");
            });
    }
}

// Update category or brand list
function updateList(type, listId) {
    $.post('php/manage_data.php', { type, action: 'get' }, function (data) {
        try {
            const items = JSON.parse(data);
            const list = $(`#${listId}`);
            list.html('');
            items.forEach(item => {
                list.append(`<li class="list-group-item d-flex justify-content-between align-items-center">
                    ${item}
                    <button class="btn btn-sm btn-danger" onclick="removeItem('${type}', '${item}', '${listId}')">Remove</button>
                </li>`);
            });
        } catch (e) {
            console.error("Failed to parse list data:", e);
        }
    }).fail(function (xhr) {
        console.error("AJAX error", xhr.responseText);
    });
}

function removeItem(type, name, listId) {
    $.post('php/manage_data.php', { type, name, action: 'delete' }, () => updateList(type, listId));
}

// Helpers for rendering lists
function updateCategoryList(categories) {
    $('#category-list').html('');
    categories.forEach(c => {
        $('#category-list').append(`<li class="list-group-item d-flex justify-content-between">
            ${c.name}
            <button class="btn btn-sm btn-danger" onclick="deleteCategory(${c.id})">Remove</button>
        </li>`);
    });
}

function updateBrandList(brands) {
    $('#brand-list').html('');
    brands.forEach(b => {
        $('#brand-list').append(`<li class="list-group-item d-flex justify-content-between">
            ${b.name}
            <button class="btn btn-sm btn-danger" onclick="deleteBrand(${b.id})">Remove</button>
        </li>`);
    });
}

function deleteCategory(id) {
    $.post('php/delete_category.php', { id }, () => location.reload());
}

function deleteBrand(id) {
    $.post('php/delete_brand.php', { id }, () => location.reload());
}
