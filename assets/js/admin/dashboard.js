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

  document.querySelectorAll('[data-user-row]').forEach(function(row) {
    const matchesSearch = !search || row.dataset.userSearchValue.includes(search);
    const matchesFilter = !filter ||
      row.dataset.userRoleValue === filter ||
      (filter === 'suspendu' && row.dataset.userStatusValue === 'suspendu');

    row.classList.toggle('d-none', !matchesSearch || !matchesFilter);
  });
}

if (userSearchInput) {
  userSearchInput.addEventListener('input', filterUsersTable);
}

if (userRoleFilter) {
  userRoleFilter.addEventListener('change', filterUsersTable);
}
