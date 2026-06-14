function showSection(sectionId) {
  const section = document.getElementById(sectionId);

  if (!section) {
    return;
  }

  document.querySelectorAll('.section').forEach(function(sec) {
    sec.classList.add('d-none');
  });

  section.classList.remove('d-none');

  document.querySelectorAll('.sidebar-link').forEach(function(link) {
    link.classList.toggle('active', link.getAttribute('data-section') === sectionId);
  });
}

document.querySelectorAll('[data-section]').forEach(function(link) {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    showSection(this.getAttribute('data-section'));
  });
});

document.querySelectorAll('[data-user-edit]').forEach(function(button) {
  button.addEventListener('click', function() {
    const fields = {
      '[data-edit-user-id]': 'id',
      '[data-edit-user-nom]': 'nom',
      '[data-edit-user-prenom]': 'prenom',
      '[data-edit-user-email]': 'email',
      '[data-edit-user-telephone]': 'telephone',
      '[data-edit-user-adresse]': 'adresse',
      '[data-edit-user-role]': 'role'
    };

    Object.keys(fields).forEach(function(selector) {
      const input = document.querySelector(selector);
      if (input) {
        input.value = button.dataset[fields[selector]] || '';
      }
    });

    const activeInput = document.querySelector('[data-edit-user-active]');
    if (activeInput) {
      activeInput.checked = button.dataset.active === '1';
    }

    showSection('modifier-utilisateur');
  });
});

document.querySelectorAll('[data-user-delete]').forEach(function(button) {
  button.addEventListener('click', function() {
    const idInput = document.querySelector('[data-delete-user-id]');
    const nameTarget = document.querySelector('[data-delete-user-name]');

    if (idInput) {
      idInput.value = button.dataset.id || '';
    }

    if (nameTarget) {
      nameTarget.textContent = button.dataset.name || 'cet utilisateur';
    }
  });
});

const userSearchInput = document.querySelector('[data-user-search]');
const userRoleFilter = document.querySelector('[data-user-role-filter]');

function filterUsersTable() {
  const search = (userSearchInput?.value || '').trim().toLowerCase();
  const filter = userRoleFilter?.value || '';
  const table = document.querySelector('[data-user-row]')?.closest('table');

  document.querySelectorAll('[data-user-row]').forEach(function(row) {
    const matchesSearch = !search || row.dataset.userSearchValue.includes(search);
    const matchesFilter = !filter ||
      row.dataset.userRoleValue === filter ||
      (filter === 'suspendu' && row.dataset.userStatusValue === 'suspendu');

    row.dataset.filterHidden = (!matchesSearch || !matchesFilter) ? 'true' : 'false';
  });

  window.GreenMarketTables?.refresh(table);
}

if (userSearchInput) {
  userSearchInput.addEventListener('input', filterUsersTable);
}

if (userRoleFilter) {
  userRoleFilter.addEventListener('change', filterUsersTable);
}

document.querySelectorAll('[data-product-edit]').forEach(function(button) {
  button.addEventListener('click', function() {
    const fields = {
      '[data-edit-product-id]': 'id',
      '[data-edit-product-name]': 'name',
      '[data-edit-product-price]': 'price',
      '[data-edit-product-stock]': 'stock',
      '[data-edit-product-image]': 'image',
      '[data-edit-product-category]': 'category',
      '[data-edit-product-shop]': 'shop',
      '[data-edit-product-description]': 'description'
    };

    Object.keys(fields).forEach(function(selector) {
      const input = document.querySelector(selector);
      if (input) {
        input.value = button.dataset[fields[selector]] || '';
      }
    });

    const activeInput = document.querySelector('[data-edit-product-active]');
    if (activeInput) {
      activeInput.checked = button.dataset.active === '1';
    }

    showSection('modifier-produit');
  });
});

document.querySelectorAll('[data-product-delete]').forEach(function(button) {
  button.addEventListener('click', function() {
    const idInput = document.querySelector('[data-delete-product-id]');
    const nameTarget = document.querySelector('[data-delete-product-name]');

    if (idInput) {
      idInput.value = button.dataset.id || '';
    }

    if (nameTarget) {
      nameTarget.textContent = button.dataset.name || 'ce produit';
    }
  });
});

document.querySelectorAll('[data-stock-edit]').forEach(function(button) {
  button.addEventListener('click', function() {
    const idInput = document.querySelector('[data-stock-product-id]');
    const nameTarget = document.querySelector('[data-stock-product-name]');
    const stockInput = document.querySelector('[data-stock-product-value]');

    if (idInput) {
      idInput.value = button.dataset.id || '';
    }

    if (nameTarget) {
      nameTarget.textContent = button.dataset.name || 'ce produit';
    }

    if (stockInput) {
      stockInput.value = button.dataset.stock || '0';
    }
  });
});

const productSearchInput = document.querySelector('[data-product-search]');
const productCategoryFilter = document.querySelector('[data-product-category-filter]');

function filterProductsTable() {
  const search = (productSearchInput?.value || '').trim().toLowerCase();
  const category = productCategoryFilter?.value || '';
  const table = document.querySelector('[data-product-row]')?.closest('table');

  document.querySelectorAll('[data-product-row]').forEach(function(row) {
    const matchesSearch = !search || row.dataset.productSearchValue.includes(search);
    const matchesCategory = !category || row.dataset.productCategoryValue === category;

    row.dataset.filterHidden = (!matchesSearch || !matchesCategory) ? 'true' : 'false';
  });

  window.GreenMarketTables?.refresh(table);
}

if (productSearchInput) {
  productSearchInput.addEventListener('input', filterProductsTable);
}

if (productCategoryFilter) {
  productCategoryFilter.addEventListener('change', filterProductsTable);
}

const stockSearchInput = document.querySelector('[data-stock-search]');
const stockStatusFilter = document.querySelector('[data-stock-status-filter]');

function filterStockTable() {
  const search = (stockSearchInput?.value || '').trim().toLowerCase();
  const status = stockStatusFilter?.value || '';
  const table = document.querySelector('[data-stock-row]')?.closest('table');

  document.querySelectorAll('[data-stock-row]').forEach(function(row) {
    const matchesSearch = !search || row.dataset.stockSearchValue.includes(search);
    const matchesStatus = !status || row.dataset.stockStatusValue === status;

    row.dataset.filterHidden = (!matchesSearch || !matchesStatus) ? 'true' : 'false';
  });

  window.GreenMarketTables?.refresh(table);
}

if (stockSearchInput) {
  stockSearchInput.addEventListener('input', filterStockTable);
}

if (stockStatusFilter) {
  stockStatusFilter.addEventListener('change', filterStockTable);
}

document.querySelectorAll('[data-order-status-edit]').forEach(function(button) {
  button.addEventListener('click', function() {
    const idInput = document.querySelector('[data-order-status-id]');
    const statusInput = document.querySelector('[data-order-status-value]');

    if (idInput) {
      idInput.value = button.dataset.id || '';
    }

    if (statusInput) {
      statusInput.value = button.dataset.status || 'en attente';
    }
  });
});

document.querySelectorAll('[data-order-cancel]').forEach(function(button) {
  button.addEventListener('click', function() {
    const idInput = document.querySelector('[data-cancel-order-id]');

    if (idInput) {
      idInput.value = button.dataset.id || '';
    }
  });
});

const orderSearchInput = document.querySelector('[data-order-search]');
const orderStatusFilter = document.querySelector('[data-order-status-filter]');

function filterOrdersTable() {
  const search = (orderSearchInput?.value || '').trim().toLowerCase();
  const status = orderStatusFilter?.value || '';
  const table = document.querySelector('[data-order-row]')?.closest('table');

  document.querySelectorAll('[data-order-row]').forEach(function(row) {
    const matchesSearch = !search || row.dataset.orderSearchValue.includes(search);
    const matchesStatus = !status ||
      row.dataset.orderStatusValue === status ||
      row.dataset.orderPaidValue === status;

    row.dataset.filterHidden = (!matchesSearch || !matchesStatus) ? 'true' : 'false';
  });

  window.GreenMarketTables?.refresh(table);
}

if (orderSearchInput) {
  orderSearchInput.addEventListener('input', filterOrdersTable);
}

if (orderStatusFilter) {
  orderStatusFilter.addEventListener('change', filterOrdersTable);
}

document.querySelectorAll('[data-payment-delete]').forEach(function(button) {
  button.addEventListener('click', function() {
    const idInput = document.querySelector('[data-delete-payment-id]');

    if (idInput) {
      idInput.value = button.dataset.id || '';
    }
  });
});

const paymentSearchInput = document.querySelector('[data-payment-search]');
const paymentMethodFilter = document.querySelector('[data-payment-method-filter]');

function filterPaymentsTable() {
  const search = (paymentSearchInput?.value || '').trim().toLowerCase();
  const method = paymentMethodFilter?.value || '';
  const table = document.querySelector('[data-payment-row]')?.closest('table');

  document.querySelectorAll('[data-payment-row]').forEach(function(row) {
    const matchesSearch = !search || row.dataset.paymentSearchValue.includes(search);
    const matchesMethod = !method || row.dataset.paymentMethodValue.includes(method);

    row.dataset.filterHidden = (!matchesSearch || !matchesMethod) ? 'true' : 'false';
  });

  window.GreenMarketTables?.refresh(table);
}

if (paymentSearchInput) {
  paymentSearchInput.addEventListener('input', filterPaymentsTable);
}

if (paymentMethodFilter) {
  paymentMethodFilter.addEventListener('change', filterPaymentsTable);
}
