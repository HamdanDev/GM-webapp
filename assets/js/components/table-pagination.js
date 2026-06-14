(function() {
  function getRows(table) {
    return Array.from(table.querySelectorAll('tbody tr'));
  }

  function getVisibleRows(table) {
    return getRows(table).filter(function(row) {
      return row.dataset.filterHidden !== 'true';
    });
  }

  function createButton(label, className, disabled, onClick) {
    const button = document.createElement('button');
    button.type = 'button';
    button.textContent = label;
    button.className = className;
    button.disabled = disabled;
    button.addEventListener('click', onClick);
    return button;
  }

  function removeOldPagination(table) {
    const wrapper = table.closest('.table-responsive') || table;
    const nextElement = wrapper.nextElementSibling;

    if (nextElement?.classList.contains('custom-pagination')) {
      nextElement.remove();
    }
  }

  function buildControls(table) {
    const controls = document.createElement('div');
    controls.className = 'table-pagination-wrapper';

    const sizeGroup = document.createElement('label');
    sizeGroup.className = 'table-page-size';
    sizeGroup.textContent = 'Afficher ';

    const select = document.createElement('select');
    select.className = 'form-select form-select-sm';
    select.innerHTML = '<option value="5">5</option><option value="10">10</option><option value="20">20</option>';
    select.value = table.dataset.pageSize || '5';

    const suffix = document.createElement('span');
    suffix.textContent = ' lignes';

    sizeGroup.appendChild(select);
    sizeGroup.appendChild(suffix);

    const pagination = document.createElement('div');
    pagination.className = 'custom-pagination';

    controls.appendChild(sizeGroup);
    controls.appendChild(pagination);

    table.dataset.currentPage = '1';
    table.dataset.pageSize = select.value;

    select.addEventListener('change', function() {
      table.dataset.pageSize = select.value;
      table.dataset.currentPage = '1';
      render(table);
    });

    const wrapper = table.closest('.table-responsive') || table;
    wrapper.insertAdjacentElement('afterend', controls);

    table._pagination = { controls, pagination, select };
  }

  function render(table) {
    const rows = getRows(table);
    const visibleRows = getVisibleRows(table);
    const pageSize = parseInt(table.dataset.pageSize || '5', 10);
    const pageCount = Math.max(1, Math.ceil(visibleRows.length / pageSize));
    const currentPage = Math.min(parseInt(table.dataset.currentPage || '1', 10), pageCount);
    const start = (currentPage - 1) * pageSize;
    const end = start + pageSize;

    table.dataset.currentPage = String(currentPage);

    rows.forEach(function(row) {
      row.classList.add('d-none');
    });

    visibleRows.slice(start, end).forEach(function(row) {
      row.classList.remove('d-none');
    });

    const pagination = table._pagination.pagination;
    pagination.innerHTML = '';

    table._pagination.controls.classList.remove('d-none');

    pagination.appendChild(createButton('«', 'pagination-arrow', currentPage === 1, function() {
      table.dataset.currentPage = String(currentPage - 1);
      render(table);
    }));

    for (let page = 1; page <= pageCount; page++) {
      pagination.appendChild(createButton(String(page), 'pagination-number' + (page === currentPage ? ' active' : ''), false, function() {
        table.dataset.currentPage = String(page);
        render(table);
      }));
    }

    pagination.appendChild(createButton('»', 'pagination-arrow', currentPage === pageCount, function() {
      table.dataset.currentPage = String(currentPage + 1);
      render(table);
    }));
  }

  function initTable(table) {
    if (table.dataset.paginationReady === 'true') {
      return;
    }

    if (getRows(table).length === 0) {
      return;
    }

    table.dataset.paginationReady = 'true';
    removeOldPagination(table);
    buildControls(table);
    render(table);
  }

  function initAll() {
    document.querySelectorAll('[data-table-pagination], .products-page table.product-table, .table-box table.product-table').forEach(initTable);
  }

  window.GreenMarketTables = {
    init: initAll,
    refresh: function(table) {
      if (!table) {
        return;
      }

      if (table.dataset.paginationReady !== 'true') {
        initTable(table);
        return;
      }

      table.dataset.currentPage = '1';
      render(table);
    }
  };

  document.addEventListener('DOMContentLoaded', initAll);
})();
