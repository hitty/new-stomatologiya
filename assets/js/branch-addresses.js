document.addEventListener("DOMContentLoaded", function () {
  const addressesContainer = document.querySelector('.branch-addresses__addresses');
  const mapContainer = document.querySelector('.branch-addresses__map');
  const buttons = document.querySelectorAll('.branch-addresses__button');
  const branchSection = document.querySelector('.branch-addresses');

  const branchesData = {
    moscow: {
      addresses: ['г. Москва, Долгопрудненское шоссе, 6а'],
      mapSrc: 'https://yandex.ru/map-widget/v1/?um=constructor%3A4a14d2535fd3d5f2299fda640dd88f4686270be1baab20c8f08769646176f7fc&amp;source=constructor'
    },
    khimki: {
      addresses: [
        'г. Химки, ул. Совхозная, 2',
        'г. Химки, ул. Совхозная, 9',
        'г. Химки, ул. Германа Титова, 10',
        'г. Химки, ул. 9 мая, 8а',
        'г. Химки, ул. Молодёжная, 7к1'
      ],
      mapSrc: 'https://yandex.ru/map-widget/v1/?um=constructor%3A7c45bcdfda7b1556a1426fba37ddc52792a970da05fd478aca9998156b83a456&amp;source=constructor'
    },
    podrezkovo: {
      addresses: ['г. Химки, мкрн. Подрезково, ул.Центральная, 4к1'],
      mapSrc: 'https://yandex.ru/map-widget/v1/?um=constructor%3A6a2c4ed44bc465e88a3132f0b7ef9efa4efd000bcacaebdb73071bb471340da9&amp;source=constructor'
    },
    krasnogorsk: {
      addresses: ['г. Красногорск, ул. Авангардная, 3'],
      mapSrc: 'https://yandex.ru/map-widget/v1/?um=constructor%3Ac10f9ef093c08d6718397fc35e7c87d4c7740b2b5284764e588ae644c214036b&amp;source=constructor'
    },
    putilkovo: {
      addresses: ['д. Путилково, ул. Новотушинская, 3 г.о. Красногорск, Московская область'],
      mapSrc: 'https://yandex.ru/map-widget/v1/?um=constructor%3A5c4d6a6d7f2b58e699c792f28d01204fec2725fba6b19979362d873000620f57&amp;source=constructor'
    }
  };

  function clearContainers() {
    addressesContainer.innerHTML = '';
    mapContainer.innerHTML = '';
    addressesContainer.classList.remove('khimki-layout');
    mapContainer.classList.remove('khimki-layout');
    branchSection.classList.remove('khimki-active');
  }

  function createAppointmentButton(isKhimki = false) {
    const btn = document.createElement('button');
    btn.classList.add('branch-appointment-button');
    if (isKhimki) btn.classList.add('khimki-button');
    btn.textContent = 'Записаться в клинику';
    btn.type = 'button';
    btn.onclick = () => window.location.href = '#form';
    return btn;
  }

  function createKhimkiCard(addresses) {
    const card = document.createElement('div');
    card.classList.add('branch-address-card');

    const addressLabel = document.createElement('p');
    addressLabel.classList.add('branch-address-label');
    addressLabel.textContent = '[ Адрес ]';
    card.appendChild(addressLabel);

    addresses.forEach((addr, idx) => {
      const p = document.createElement('p');
      p.classList.add('branch-address-text');
      p.textContent = addr;
      if (idx < addresses.length - 1) p.style.marginBottom = '10px';
      card.appendChild(p);
    });

    const scheduleLabel = document.createElement('p');
    scheduleLabel.classList.add('branch-schedule-label');
    scheduleLabel.textContent = '[ График работы ]';
    card.appendChild(scheduleLabel);

    const schedule1 = document.createElement('p');
    schedule1.classList.add('branch-schedule-text');
    schedule1.innerHTML = '<strong>Пн-Сб:</strong> 8:00 - 21:00';
    card.appendChild(schedule1);

    const schedule2 = document.createElement('p');
    schedule2.classList.add('branch-schedule-text1');
    schedule2.innerHTML = '<strong>Вс:</strong> 9:00 - 21:00';
    card.appendChild(schedule2);

    const hotlineLabel = document.createElement('p');
    hotlineLabel.classList.add('branch-hotline-label');
    hotlineLabel.textContent = '[ Горячая линия ]';
    card.appendChild(hotlineLabel);

    const hotline = document.createElement('p');
    hotline.classList.add('branch-hotline-text');
    hotline.textContent = '+7 (495) 190 03 03';
    card.appendChild(hotline);

    const btn = createAppointmentButton(true);
    card.appendChild(btn);

    return card;
  }

  function createDefaultCard(addr) {
    const card = document.createElement('div');
    card.classList.add('branch-address-card');

    const label = document.createElement('p');
    label.classList.add('branch-address-label');
    label.textContent = '[ Адрес ]';
    card.appendChild(label);

    const text = document.createElement('p');
    text.classList.add('branch-address-text');
    text.textContent = addr;
    card.appendChild(text);

    const scheduleLabel = document.createElement('p');
    scheduleLabel.classList.add('branch-schedule-label');
    scheduleLabel.textContent = '[ График работы ]';
    card.appendChild(scheduleLabel);

    const schedule1 = document.createElement('p');
    schedule1.classList.add('branch-schedule-text');
    schedule1.innerHTML = '<strong>Пн-Сб:</strong> 8:00 - 21:00';
    card.appendChild(schedule1);

    const schedule2 = document.createElement('p');
    schedule2.classList.add('branch-schedule-text1');
    schedule2.innerHTML = '<strong>Вс:</strong> 9:00 - 21:00';
    card.appendChild(schedule2);

    const hotlineLabel = document.createElement('p');
    hotlineLabel.classList.add('branch-hotline-label');
    hotlineLabel.textContent = '[ Горячая линия ]';
    card.appendChild(hotlineLabel);

    const hotline = document.createElement('p');
    hotline.classList.add('branch-hotline-text');
    hotline.textContent = '+7 (495) 190 03 03';
    card.appendChild(hotline);

    const btn = createAppointmentButton();
    card.appendChild(btn);

    return card;
  }

  function updateBranch(branchName) {
    if (!branchesData[branchName]) return;

    clearContainers();
    buttons.forEach(btn => btn.classList.toggle('active', btn.dataset.branch === branchName));

    if (branchName === 'khimki') {
      branchSection.classList.add('khimki-active');
      addressesContainer.classList.add('khimki-layout');
      mapContainer.classList.add('khimki-layout');
      const card = createKhimkiCard(branchesData[branchName].addresses);
      addressesContainer.appendChild(card);
    } else {
      const data = branchesData[branchName];
      data.addresses.forEach((addr, idx) => {
        const card = createDefaultCard(addr);
        if (idx < data.addresses.length - 1) card.style.marginBottom = '10px';
        addressesContainer.appendChild(card);
      });
    }

    const iframe = document.createElement('iframe');
    iframe.src = branchesData[branchName].mapSrc;
    iframe.loading = 'lazy';
    iframe.referrerPolicy = 'no-referrer-when-downgrade';
    mapContainer.appendChild(iframe);
  }

  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      updateBranch(btn.dataset.branch);
    });
  });

  updateBranch('moscow');
});