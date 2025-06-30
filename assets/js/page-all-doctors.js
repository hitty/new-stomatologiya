document.addEventListener('DOMContentLoaded', function () {
  if (!document.querySelector('.all-doctors-page')) return;

  const form = document.getElementById('allDoctorFilterForm');
  const categoryInput = document.getElementById('allDocCategoryInput');
  const clinicInput = document.getElementById('allClinicAddressInput');
  const filterWrappers = document.querySelectorAll('.all-filter-wrapper');

  filterWrappers.forEach(wrapper => {
    const button = wrapper.querySelector('.all-filter-button');
    const dropdown = wrapper.querySelector('.all-filter-dropdown');
    const label = button.querySelector('.all-filter-label');
    const defaultLabel = label.getAttribute('data-default');
    const activeLabel = label.getAttribute('data-active');
    let selectedText = null;
    let selectedValue = null;

    button.addEventListener('click', function (e) {
      e.stopPropagation();

      // Закрываем другие
      filterWrappers.forEach(w => {
        if (w !== wrapper) {
          w.classList.remove('active');
          w.querySelector('.all-filter-dropdown').style.display = 'none';
        }
      });

      const isActive = wrapper.classList.toggle('active');
      dropdown.style.display = isActive ? 'block' : 'none';

      // Только если нет выбора — показываем "Выберите..."
      if (isActive) {
  if (selectedText) {
    label.innerText = selectedText;
  } else {
    label.innerText = activeLabel;
  }
} else {
  if (selectedText) {
    label.innerText = selectedText;
  } else {
    label.innerText = defaultLabel;
  }
}
    });

    const options = dropdown.querySelectorAll('.all-filter-option');
    options.forEach(option => {
      option.addEventListener('click', function () {
        const clickedValue = option.getAttribute('data-value');
        const clickedText = option.innerText.trim();

        // Если выбрана та же опция — сброс
        if (clickedValue === selectedValue) {
          selectedText = null;
          selectedValue = null;
          label.innerText = defaultLabel;

          const field = wrapper.getAttribute('data-filter');
          if (field === 'doc_category') categoryInput.value = '';
          if (field === 'clinic_address') clinicInput.value = '';

          options.forEach(o => o.classList.remove('selected'));
          wrapper.removeAttribute('data-selected');
        } else {
          selectedText = clickedText;
          selectedValue = clickedValue;
          label.innerText = selectedText;

          const field = wrapper.getAttribute('data-filter');
          if (field === 'doc_category') categoryInput.value = clickedValue;
          if (field === 'clinic_address') clinicInput.value = clickedValue;

          // Подсветка выбранной опции
          options.forEach(o => o.classList.remove('selected'));
          option.classList.add('selected');

          wrapper.setAttribute('data-selected', 'true');
        }

        wrapper.classList.remove('active');
        dropdown.style.display = 'none';
      });
    });
  });

  // Закрытие по клику вне
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.all-filter-wrapper')) {
      filterWrappers.forEach(wrapper => {
        wrapper.classList.remove('active');
        wrapper.querySelector('.all-filter-dropdown').style.display = 'none';

        const label = wrapper.querySelector('.all-filter-label');
        const defaultLabel = label.getAttribute('data-default');
        const selected = wrapper.getAttribute('data-selected');

        if (selected) {
          // оставляем выбранный текст
        } else {
          label.innerText = defaultLabel;
        }
      });
    }
  });

  // Фильтрация
  document.querySelector('.all-find-doctor-button').addEventListener('click', function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const params = new URLSearchParams();

    if (formData.get('doc_category')) params.append('doc_category', formData.get('doc_category'));
    if (formData.get('clinic_address')) params.append('clinic_address', formData.get('clinic_address'));

    params.append('nonce', doctors_filter_params.nonce);
    params.append('action', 'filter_doctors');

    fetch(doctors_filter_params.ajax_url + '?' + params.toString())
      .then(response => response.text())
      .then(html => {
        document.querySelector('.all-doctors-cards-track').innerHTML = html;
      })
      .catch(error => {
        console.error('Ошибка фильтрации:', error);
      });
  });
});