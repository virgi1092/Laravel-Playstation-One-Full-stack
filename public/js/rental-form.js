// Global variables
let rentalItemIndex = 0;
let totalGrand = 0;

// DOM Content Loaded
document.addEventListener("DOMContentLoaded", function () {
    initializeForm();
    attachEventListeners();
});

// Initialize form
function initializeForm() {
    updateReturnDate();
    updateSummary();
    validateForm();
}

// Attach event listeners
function attachEventListeners() {
    // Date change listener
    const tglSewaInput = document.getElementById("tglSewa");
    if (tglSewaInput) {
        tglSewaInput.addEventListener("change", updateReturnDate);
    }

    // File upload listener
    const fileInput = document.getElementById("fileInput");
    if (fileInput) {
        fileInput.addEventListener("change", handleFileUpload);
    }

    // PlayStation select listeners
    attachPlaystationListeners();

    // Form validation
    const form = document.getElementById("rentalForm");
    if (form) {
        form.addEventListener("input", validateForm);
        form.addEventListener("change", validateForm);
    }
}

// Update return date based on rental duration
function updateReturnDate() {
    const tglSewa = document.getElementById("tglSewa").value;
    const tglKembaliInput = document.getElementById("tglKembali");

    if (tglSewa) {
        // Get maximum duration from all rental items
        let maxDuration = 1;
        const durationInputs = document.querySelectorAll(".duration-input");
        durationInputs.forEach((input) => {
            const duration = parseInt(input.value) || 1;
            if (duration > maxDuration) {
                maxDuration = duration;
            }
        });

        const sewaDate = new Date(tglSewa);
        const kembaliDate = new Date(sewaDate);
        kembaliDate.setDate(sewaDate.getDate() + maxDuration);

        tglKembaliInput.value = kembaliDate.toISOString().split("T")[0];
    }
}

// Ganti fungsi handleFileUpload yang sudah ada
function handleFileUpload(event) {
    const file = event.target.files[0];
    const label = document.getElementById("fileUploadLabel");

    if (file) {
        // Validasi file
        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/jpg",
            "image/gif",
        ];
        const maxSize = 2048 * 1024; // 2MB

        if (!allowedTypes.includes(file.type)) {
            alert("File harus berformat JPEG, PNG, JPG, atau GIF");
            event.target.value = "";
            label.classList.remove("has-file");
            label.innerHTML =
                '<i class="fas fa-upload me-2"></i> Pilih file jaminan';
            validateForm();
            return;
        }

        if (file.size > maxSize) {
            alert("Ukuran file maksimal 2MB");
            event.target.value = "";
            label.classList.remove("has-file");
            label.innerHTML =
                '<i class="fas fa-upload me-2"></i> Pilih file jaminan';
            validateForm();
            return;
        }

        label.classList.add("has-file");
        label.innerHTML = `<i class="fas fa-check me-2"></i> ${file.name}`;
        console.log(
            "File selected:",
            file.name,
            "Size:",
            file.size,
            "Type:",
            file.type
        );
    } else {
        label.classList.remove("has-file");
        label.innerHTML =
            '<i class="fas fa-upload me-2"></i> Pilih file jaminan';
    }

    // Trigger validation after file selection
    validateForm();
}

val;

// Tambahkan event listener tambahan untuk file input
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("fileInput");
    if (fileInput) {
        // Tambahan: trigger validation saat file berubah
        fileInput.addEventListener("change", function () {
            console.log("File input changed");
            handleFileUpload(event);
        });
    }
});

// Attach PlayStation select listeners
function attachPlaystationListeners() {
    const selects = document.querySelectorAll(".playstation-select");
    selects.forEach((select) => {
        select.addEventListener("change", function () {
            const index = this.dataset.index;
            updateItemPrice(index);
            validateItemStock(index);
        });
    });

    const quantityInputs = document.querySelectorAll(".quantity-input");
    quantityInputs.forEach((input) => {
        input.addEventListener("input", function () {
            const index = this.dataset.index;
            updateItemPrice(index);
            validateItemStock(index);
        });
    });

    const durationInputs = document.querySelectorAll(".duration-input");
    durationInputs.forEach((input) => {
        input.addEventListener("input", function () {
            const index = this.dataset.index;
            updateItemPrice(index);
            updateReturnDate();
        });
    });
}

// Change quantity
function changeQuantity(index, change) {
    const quantityInput = document.querySelector(
        `input[data-index="${index}"].quantity-input`
    );
    let currentValue = parseInt(quantityInput.value) || 1;
    const newValue = Math.max(1, currentValue + change);

    quantityInput.value = newValue;
    updateItemPrice(index);
    validateItemStock(index);
}

// Update item price
function updateItemPrice(index) {
    const select = document.querySelector(`select[data-index="${index}"]`);
    const quantityInput = document.querySelector(
        `input[data-index="${index}"].quantity-input`
    );
    const durationInput = document.querySelector(
        `input[data-index="${index}"].duration-input`
    );
    const priceDisplay = document.querySelector(
        `.price-display[data-index="${index}"]`
    );
    const totalHiddenInput = document.querySelector(
        `input[data-index="${index}"].total-harga-input`
    );

    if (!select || !select.value) {
        priceDisplay.textContent = "Total: Rp 0";
        if (totalHiddenInput) totalHiddenInput.value = 0;
        updateSummary();
        return;
    }

    const selectedOption = select.options[select.selectedIndex];
    const price = parseInt(selectedOption.dataset.price) || 0;
    const quantity = parseInt(quantityInput.value) || 1;
    const duration = parseInt(durationInput.value) || 1;

    const total = price * quantity * duration;

    priceDisplay.textContent = `Total: Rp ${total.toLocaleString("id-ID")}`;
    if (totalHiddenInput) totalHiddenInput.value = total;

    updateSummary();
}

// Validate item stock
function validateItemStock(index) {
    const select = document.querySelector(`select[data-index="${index}"]`);
    const quantityInput = document.querySelector(
        `input[data-index="${index}"].quantity-input`
    );

    if (!select || !select.value) return;

    const selectedOption = select.options[select.selectedIndex];
    const availableStock = parseInt(selectedOption.dataset.stok) || 0;
    const requestedQuantity = parseInt(quantityInput.value) || 1;

    if (requestedQuantity > availableStock) {
        quantityInput.value = availableStock;
        alert(`Stok tidak mencukupi! Maksimal ${availableStock} unit.`);
        updateItemPrice(index);
    }
}

// Add rental item
function addRentalItem() {
    rentalItemIndex++;
    const container = document.getElementById("rentalItems");

    const newItem = document.createElement("div");
    newItem.className = "rental-item";
    newItem.setAttribute("data-index", rentalItemIndex);

    newItem.innerHTML = `
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h5><i class="fas fa-play-circle me-2"></i>PlayStation #${
                rentalItemIndex + 1
            }</h5>
            <button type="button" class="remove-item-btn" onclick="removeRentalItem(${rentalItemIndex})">
                <i class="fas fa-trash me-1"></i>Hapus
            </button>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <label style="font-weight: 500; margin-bottom: 0.5rem;">Pilih PlayStation</label>
                <select name="detail_penyewaans[${rentalItemIndex}][id_playstation]" class="form-select playstation-select" required data-index="${rentalItemIndex}">
                    <option value="">Pilih PlayStation</option>
                    ${getPlaystationOptions()}
                </select>
            </div>
            
            <div class="col-md-3">
                <label style="font-weight: 500; margin-bottom: 0.5rem;">Jumlah</label>
                <div class="quantity-control">
                    <button type="button" class="quantity-btn" onclick="changeQuantity(${rentalItemIndex}, -1)">-</button>
                    <input type="number" name="detail_penyewaans[${rentalItemIndex}][jumlah]" class="quantity-input" value="1" min="1" data-index="${rentalItemIndex}">
                    <button type="button" class="quantity-btn" onclick="changeQuantity(${rentalItemIndex}, 1)">+</button>
                </div>
            </div>
            
            <div class="col-md-3">
                <label style="font-weight: 500; margin-bottom: 0.5rem;">Durasi (Hari)</label>
                <input type="number" name="detail_penyewaans[${rentalItemIndex}][durasi_sewa]" class="form-control duration-input" value="1" min="1" required data-index="${rentalItemIndex}">
            </div>
        </div>
        
        <div class="price-display" data-index="${rentalItemIndex}">
            Total: Rp 0
        </div>
        
        <input type="hidden" name="detail_penyewaans[${rentalItemIndex}][total_harga]" class="total-harga-input" data-index="${rentalItemIndex}">
    `;

    container.appendChild(newItem);
    attachPlaystationListeners();
    updateRemoveButtons();
}

// Remove rental item
function removeRentalItem(index) {
    const item = document.querySelector(`.rental-item[data-index="${index}"]`);
    if (item) {
        item.remove();
        updateSummary();
        updateRemoveButtons();
        validateForm();
    }
}

// Get PlayStation options HTML
function getPlaystationOptions() {
    const firstSelect = document.querySelector(".playstation-select");
    if (!firstSelect) return "";

    let options = "";
    for (let i = 1; i < firstSelect.options.length; i++) {
        const option = firstSelect.options[i];
        options += `<option value="${option.value}" data-price="${option.dataset.price}" data-stok="${option.dataset.stok}">
            ${option.textContent}
        </option>`;
    }
    return options;
}

// Update remove buttons visibility
function updateRemoveButtons() {
    const items = document.querySelectorAll(".rental-item");
    items.forEach((item, index) => {
        const removeBtn = item.querySelector(".remove-item-btn");
        if (removeBtn) {
            removeBtn.style.display =
                items.length > 1 ? "inline-block" : "none";
        }
    });
}

// Update summary
function updateSummary() {
    const summaryContent = document.getElementById("summaryContent");
    const grandTotalElement = document.getElementById("grandTotal");

    let summaryHTML = "";
    let grandTotal = 0;

    const rentalItems = document.querySelectorAll(".rental-item");

    if (rentalItems.length === 0) {
        summaryHTML =
            '<div class="summary-item"><span>Belum ada item dipilih</span><span>Rp 0</span></div>';
    } else {
        rentalItems.forEach((item, index) => {
            const select = item.querySelector(".playstation-select");
            const quantityInput = item.querySelector(".quantity-input");
            const durationInput = item.querySelector(".duration-input");
            const totalHiddenInput = item.querySelector(".total-harga-input");

            if (select && select.value) {
                const selectedOption = select.options[select.selectedIndex];
                const psName = selectedOption.textContent.split(" - ")[0];
                const quantity = parseInt(quantityInput.value) || 1;
                const duration = parseInt(durationInput.value) || 1;
                const itemTotal = parseInt(totalHiddenInput.value) || 0;

                summaryHTML += `
                    <div class="summary-item">
                        <span>${psName} x${quantity} (${duration} hari)</span>
                        <span>Rp ${itemTotal.toLocaleString("id-ID")}</span>
                    </div>
                `;

                grandTotal += itemTotal;
            }
        });

        if (summaryHTML === "") {
            summaryHTML =
                '<div class="summary-item"><span>Belum ada item dipilih</span><span>Rp 0</span></div>';
        }
    }

    summaryContent.innerHTML = summaryHTML;
    grandTotalElement.textContent = `Rp ${grandTotal.toLocaleString("id-ID")}`;
    totalGrand = grandTotal;
}

// Fixed validate form function
function validateForm() {
    console.log("Starting form validation...");

    const checkoutBtn = document.getElementById("checkoutBtn");
    const rentalItems = document.querySelectorAll(".rental-item");

    let isValid = true;
    let hasSelectedItems = false;
    let errorMessages = [];

    // Check if user is authenticated
    const userDropdown = document.querySelector(".user-dropdown");
    if (!userDropdown) {
        isValid = false;
        errorMessages.push("Anda harus login terlebih dahulu");
        console.log("User not authenticated");
    }

    // Check required fields
    const requiredFields = [
        { name: "alamat", label: "Alamat" },
        { name: "no_telpon", label: "No. Telepon" },
        { name: "jaminan", label: "Jenis Jaminan" },
        { name: "foto_jaminan", label: "Foto Jaminan" },
        { name: "tgl_sewa", label: "Tanggal Sewa" },
        { name: "tgl_kembali", label: "Tanggal Kembali" },
    ];

    requiredFields.forEach((fieldInfo) => {
        const field = document.querySelector(`[name="${fieldInfo.name}"]`);
        if (!field) {
            console.log(`Field ${fieldInfo.name} not found`);
            return;
        }

        let fieldValue = field.value ? field.value.trim() : "";

        // Special handling for file input
        if (field.type === "file") {
            if (field.files && field.files.length > 0) {
                fieldValue = "file selected";
                console.log(`File selected: ${field.files[0].name}`);
            } else {
                fieldValue = "";
                console.log("No file selected");
            }
        }
    });

    // Validate date logic
    const tglSewaField = document.querySelector('[name="tgl_sewa"]');
    const tglKembaliField = document.querySelector('[name="tgl_kembali"]');

    if (
        tglSewaField &&
        tglKembaliField &&
        tglSewaField.value &&
        tglKembaliField.value
    ) {
        const tglSewa = new Date(tglSewaField.value);
        const tglKembali = new Date(tglKembaliField.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (tglSewa < today) {
            isValid = false;
            errorMessages.push("Tanggal sewa tidak boleh kurang dari hari ini");
        }

        if (tglKembali <= tglSewa) {
            isValid = false;
            errorMessages.push("Tanggal kembali harus setelah tanggal sewa");
        }
    }

    // Check rental items
    console.log(`Found ${rentalItems.length} rental items`);

    rentalItems.forEach((item, index) => {
        const select = item.querySelector(".playstation-select");
        const quantityInput = item.querySelector(".quantity-input");
        const durationInput = item.querySelector(".duration-input");

        if (!select || !quantityInput || !durationInput) {
            console.log(`Item ${index}: Missing input elements`);
            return;
        }

        if (select.value && select.value.trim()) {
            hasSelectedItems = true;
            console.log(
                `Item ${index}: PlayStation selected (${select.value})`
            );

            const quantity = parseInt(quantityInput.value);
            const duration = parseInt(durationInput.value);

            if (!quantityInput.value || quantity < 1) {
                isValid = false;
                errorMessages.push(`Item ${index + 1}: Jumlah harus minimal 1`);
                console.log(
                    `Item ${index}: Invalid quantity (${quantityInput.value})`
                );
            }

            if (!durationInput.value || duration < 1) {
                isValid = false;
                errorMessages.push(
                    `Item ${index + 1}: Durasi sewa harus minimal 1 hari`
                );
                console.log(
                    `Item ${index}: Invalid duration (${durationInput.value})`
                );
            }

            if (quantity >= 1 && duration >= 1) {
                console.log(
                    `Item ${index}: OK (Qty: ${quantity}, Duration: ${duration})`
                );
            }
        } else {
            console.log(`Item ${index}: No PlayStation selected`);
        }
    });

    if (!hasSelectedItems) {
        isValid = false;
        errorMessages.push("Minimal pilih satu PlayStation untuk disewa");
        console.log("No items selected");
    }

    // Update button state
    if (checkoutBtn) {
        checkoutBtn.disabled = !isValid;
    }

    // Log validation result
    console.log(`Validation result: ${isValid ? "VALID" : "INVALID"}`);
    if (!isValid && errorMessages.length > 0) {
        console.log("Error messages:", errorMessages);
    }

    // Return validation result
    return {
        isValid: isValid,
        errors: errorMessages,
    };
}

// Toggle user dropdown
function toggleDropdown() {
    const dropdown = document.getElementById("userDropdown");
    const arrow = document.getElementById("dropdownArrow");

    if (dropdown.classList.contains("show")) {
        dropdown.classList.remove("show");
        arrow.style.transform = "rotate(0deg)";
    } else {
        dropdown.classList.add("show");
        arrow.style.transform = "rotate(180deg)";
    }
}

// Close dropdown when clicking outside
document.addEventListener("click", function (event) {
    const userDropdown = document.querySelector(".user-dropdown");
    const dropdown = document.getElementById("userDropdown");

    if (userDropdown && !userDropdown.contains(event.target)) {
        dropdown.classList.remove("show");
        const arrow = document.getElementById("dropdownArrow");
        if (arrow) arrow.style.transform = "rotate(0deg)";
    }
});

// Perbaiki form submission - ganti yang sudah ada
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("rentalForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            console.log("Form submitted");

            // Always prevent default first
            e.preventDefault();

            // Extra validation untuk file upload
            const fileInput = document.getElementById("fileInput");
            if (
                !fileInput ||
                !fileInput.files ||
                fileInput.files.length === 0
            ) {
                alert("Silakan pilih file foto jaminan terlebih dahulu");
                console.log("File validation failed: No file selected");
                return false;
            }

            // Validasi file sekali lagi
            const file = fileInput.files[0];
            const allowedTypes = [
                "image/jpeg",
                "image/png",
                "image/jpg",
                "image/gif",
            ];
            const maxSize = 2048 * 1024; // 2MB

            if (!allowedTypes.includes(file.type)) {
                alert("File harus berformat JPEG, PNG, JPG, atau GIF");
                return false;
            }

            if (file.size > maxSize) {
                alert("Ukuran file maksimal 2MB");
                return false;
            }

            const validation = validateForm();

            if (!validation.isValid) {
                console.log("Validation failed");

                if (validation.errors && validation.errors.length > 0) {
                    const errorMessage = validation.errors.join("\n• ");
                    alert(
                        "Mohon perbaiki kesalahan berikut:\n• " + errorMessage
                    );
                } else {
                    alert("Mohon lengkapi semua field yang diperlukan!");
                }
                return false;
            }

            console.log("All validation passed, submitting form...");

            // Debug: Log form data sebelum submit
            const formData = new FormData(form);
            console.log("Form data being submitted:");
            for (let pair of formData.entries()) {
                if (pair[1] instanceof File) {
                    console.log(
                        `${pair[0]}: FILE - ${pair[1].name} (${pair[1].size} bytes)`
                    );
                } else {
                    console.log(`${pair[0]}: ${pair[1]}`);
                }
            }

            // Show loading state
            const submitBtn = document.getElementById("checkoutBtn");
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML =
                    '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                submitBtn.disabled = true;

                // Submit form
                setTimeout(() => {
                    // Remove event listener to prevent double submission
                    form.removeEventListener("submit", arguments.callee);
                    form.submit();
                }, 100);

                // Re-enable button after 15 seconds (fallback)
                setTimeout(() => {
                    if (submitBtn.innerHTML.includes("fa-spinner")) {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                }, 15000);
            } else {
                // If button not found, just submit
                form.submit();
            }
        });
    }
});

// Add event listeners for real-time validation
document.addEventListener("DOMContentLoaded", function () {
    // Add event listeners to form inputs for real-time validation
    const form = document.getElementById("rentalForm");
    if (form) {
        const inputs = form.querySelectorAll("input, select, textarea");
        inputs.forEach((input) => {
            input.addEventListener("change", validateForm);
            input.addEventListener("input", validateForm);
        });
    }
});

// Debug function to check form state
function debugFormState() {
    console.log("=== FORM DEBUG ===");
    const form = document.getElementById("rentalForm");
    if (!form) {
        console.log("Form not found!");
        return;
    }

    // Check authentication
    const userDropdown = document.querySelector(".user-dropdown");
    console.log("User authenticated:", !!userDropdown);

    // Check all inputs
    const inputs = form.querySelectorAll("input, select, textarea");
    console.log("Form inputs:");
    inputs.forEach((input) => {
        let value = input.value;
        if (input.type === "file") {
            value =
                input.files && input.files.length > 0
                    ? `${input.files.length} file(s)`
                    : "No file";
        }
        console.log(`  ${input.name || input.id}: "${value}"`);
    });

    // Check rental items
    const rentalItems = document.querySelectorAll(".rental-item");
    console.log(`\nRental items: ${rentalItems.length}`);
    rentalItems.forEach((item, index) => {
        const select = item.querySelector(".playstation-select");
        const quantity = item.querySelector(".quantity-input");
        const duration = item.querySelector(".duration-input");

        console.log(`  Item ${index}:`);
        console.log(`    PlayStation: ${select ? select.value : "not found"}`);
        console.log(`    Quantity: ${quantity ? quantity.value : "not found"}`);
        console.log(`    Duration: ${duration ? duration.value : "not found"}`);
    });

    // Run validation
    const validation = validateForm();
    console.log("\nValidation result:", validation);

    console.log("=== END DEBUG ===");
}
document.querySelector("form").addEventListener("submit", function (e) {
    const fileInput = document.getElementById("fileInput");
    if (!fileInput.files.length) {
        e.preventDefault();
        alert("Silakan pilih file jaminan terlebih dahulu");
        return false;
    }
});
// Untuk debugging - hapus setelah selesai
document.querySelector("form").addEventListener("submit", function (e) {
    const formData = new FormData(this);
    console.log("Form data:");
    for (let pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }
});
