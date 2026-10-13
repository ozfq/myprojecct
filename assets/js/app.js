document.addEventListener('DOMContentLoaded', () => {
  const countdown = document.querySelector('[data-countdown]');
  if (countdown) {
    const target = new Date(countdown.dataset.countdown).getTime();
    const update = () => {
      let diff = Math.max(0, target - Date.now());
      const days = Math.floor(diff / 86400000); diff %= 86400000;
      const hours = Math.floor(diff / 3600000); diff %= 3600000;
      const minutes = Math.floor(diff / 60000); diff %= 60000;
      const seconds = Math.floor(diff / 1000);
      const set = (key, value) => { const el = countdown.querySelector(`[data-d="${key}"]`); if (el) el.textContent = String(value).padStart(2,'0'); };
      set('days', days); set('hours', hours); set('minutes', minutes); set('seconds', seconds);
    };
    update(); setInterval(update, 1000);
  }

  const form = document.getElementById('registerForm');
  if (form) {
    form.addEventListener('submit', e => {
      if (!form.checkValidity()) { e.preventDefault(); form.classList.add('was-validated'); }
    });
  }
});

function copyTicket(ticket) {
  if (navigator.clipboard) navigator.clipboard.writeText(ticket);
  const btn = event?.currentTarget;
  if (btn) { const old = btn.innerHTML; btn.innerHTML = 'تم النسخ ✓'; setTimeout(() => btn.innerHTML = old, 1600); }
}

function celebrate() {
  for (let i = 0; i < 36; i++) {
    const el = document.createElement('span'); el.className = 'confetti';
    el.style.left = (45 + Math.random() * 10) + 'vw';
    el.style.top = '35vh'; el.style.setProperty('--x', ((Math.random() - .5) * 500) + 'px');
    el.style.setProperty('--r', (Math.random() * 720 - 360) + 'deg');
    document.body.appendChild(el); setTimeout(() => el.remove(), 1500);
  }
}
