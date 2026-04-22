// API Base URL
const API_BASE = '/api';

// Set today's date as default
document.getElementById('date').valueAsDate = new Date();

// Calculate total price
document.getElementById('quantity').addEventListener('input', calculateTotal);
document.getElementById('unitPrice').addEventListener('input', calculateTotal);

function calculateTotal() {
  const quantity = parseFloat(document.getElementById('quantity').value) || 0;
  const unitPrice = parseFloat(document.getElementById('unitPrice').value) || 0;
  const total = (quantity * unitPrice).toFixed(2);
  document.getElementById('totalDisplay').textContent = total;
}

// Load fruits on page load
loadFruits();

// Form submission
document.getElementById('transactionForm').addEventListener('submit', async (e) => {
  e.preventDefault();

  const formData = {
    date: document.getElementById('date').value,
    type: document.getElementById('type').value,
    fruit: document.getElementById('fruit').value,
    quantity: parseFloat(document.getElementById('quantity').value),
    unit_price: parseFloat(document.getElementById('unitPrice').value)
  };

  try {
    const response = await fetch(`${API_BASE}/transactions`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formData)
    });

    if (response.ok) {
      showNotification('تمت إضافة العملية بنجاح! ✅', 'success');
      document.getElementById('transactionForm').reset();
      document.getElementById('date').valueAsDate = new Date();
      document.getElementById('totalDisplay').textContent = '0.00';
      loadTransactions();
      loadSummary();
    } else {
      showNotification('حدث خطأ في إضافة العملية ❌', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('خطأ في الاتصال بالخادم ❌', 'error');
  }
});

// Load fruits dynamically
async function loadFruits() {
  try {
    const response = await fetch(`${API_BASE}/fruits`);
    const fruits = await response.json();

    // Update fruit select options
    const fruitSelect = document.getElementById('fruit');
    const currentValue = fruitSelect.value;
    fruitSelect.innerHTML = '<option value="">اختر صنف</option>';

    fruits.forEach(fruit => {
      const option = document.createElement('option');
      option.value = fruit;
      option.textContent = fruit;
      fruitSelect.appendChild(option);
    });

    fruitSelect.value = currentValue;

    // Display fruits list
    displayFruitsList(fruits);
  } catch (error) {
    console.error('Error loading fruits:', error);
  }
}

// Display fruits as badges
function displayFruitsList(fruits) {
  const fruitsList = document.getElementById('fruitsList');

  if (fruits.length === 0) {
    fruitsList.innerHTML = '<p style="color: #999;">لم تضف أي أصناف حتى الآن</p>';
    return;
  }

  fruitsList.innerHTML = fruits.map(fruit => `
    <div class="fruit-badge">
      <span>${fruit}</span>
      <button type="button" onclick="deleteFruit('${fruit}')">✕</button>
    </div>
  `).join('');
}

// Add new fruit
async function addNewFruit() {
  const input = document.getElementById('newFruitInput');
  const name = input.value.trim();

  if (!name) {
    showNotification('أدخل اسم الصنف 📝', 'error');
    return;
  }

  try {
    console.log('Adding fruit:', name);
    const response = await fetch(`${API_BASE}/fruits`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name })
    });

    console.log('Response status:', response.status);
    const data = await response.json();
    console.log('Response data:', data);

    if (response.ok) {
      showNotification(`تم إضافة "${name}" بنجاح! ✅`, 'success');
      input.value = '';
      loadFruits();
    } else {
      showNotification(data.error || 'خطأ في إضافة الصنف ❌', 'error');
    }
  } catch (error) {
    console.error('Error adding fruit:', error);
    showNotification('خطأ في الاتصال بالخادم ❌', 'error');
  }
}

// Delete fruit
async function deleteFruit(fruitName) {
  if (!confirm(`هل تريد حذف صنف "${fruitName}"؟`)) {
    return;
  }

  try {
    const response = await fetch(`${API_BASE}/fruits/${encodeURIComponent(fruitName)}`, {
      method: 'DELETE'
    });

    if (response.ok) {
      showNotification(`تم حذف "${fruitName}" ✅`, 'success');
      loadFruits();
    } else {
      showNotification('خطأ في حذف الصنف ❌', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('خطأ في الاتصال بالخادم ❌', 'error');
  }
}

// Load transactions
async function loadTransactions() {
  try {
    const response = await fetch(`${API_BASE}/transactions`);
    const transactions = await response.json();
    const tbody = document.getElementById('transactionsBody');

    if (transactions.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="7" class="empty-state">
            لا توجد عمليات حتى الآن
          </td>
        </tr>
      `;
      return;
    }

    tbody.innerHTML = transactions.map(t => `
      <tr>
        <td>${t.date}</td>
        <td>
          <span class="type-${t.type === 'شراء' ? 'buy' : 'sell'}">
            ${t.type === 'شراء' ? '🛒' : '💰'} ${t.type}
          </span>
        </td>
        <td>${t.fruit}</td>
        <td>${parseFloat(t.quantity).toFixed(2)}</td>
        <td>${parseFloat(t.unit_price).toFixed(2)}</td>
        <td><strong>${parseFloat(t.total_price).toFixed(2)}</strong></td>
        <td>
          <button class="btn btn-danger" onclick="deleteTransaction(${t.id})">
            حذف
          </button>
        </td>
      </tr>
    `).join('');
  } catch (error) {
    console.error('Error loading transactions:', error);
  }
}

// Load daily summary
async function loadSummary() {
  try {
    const response = await fetch(`${API_BASE}/daily-summary`);
    const summaries = await response.json();
    const tbody = document.getElementById('summaryBody');

    if (summaries.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="4" class="empty-state">
            لا توجد بيانات يومية حتى الآن
          </td>
        </tr>
      `;
      return;
    }

    tbody.innerHTML = summaries.map(s => `
      <tr>
        <td>${s.date}</td>
        <td>${parseFloat(s.total_purchase || 0).toFixed(2)}</td>
        <td>${parseFloat(s.total_sales || 0).toFixed(2)}</td>
        <td class="${parseFloat(s.profit || 0) >= 0 ? 'profit' : 'loss'}">
          ${parseFloat(s.profit || 0).toFixed(2)}
        </td>
      </tr>
    `).join('');
  } catch (error) {
    console.error('Error loading summary:', error);
  }
}

// Delete transaction
async function deleteTransaction(id) {
  if (!confirm('هل أنت متأكد من حذف هذه العملية؟')) {
    return;
  }

  try {
    const response = await fetch(`${API_BASE}/transactions/${id}`, {
      method: 'DELETE'
    });

    if (response.ok) {
      showNotification('تم حذف العملية بنجاح ✅', 'success');
      loadTransactions();
      loadSummary();
    } else {
      showNotification('خطأ في حذف العملية ❌', 'error');
    }
  } catch (error) {
    console.error('Error:', error);
    showNotification('خطأ في الاتصال بالخادم ❌', 'error');
  }
}

// Notification system
function showNotification(message, type) {
  const notification = document.createElement('div');
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 25px;
    background: ${type === 'success' ? '#28a745' : '#ff6b6b'};
    color: white;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    animation: slideIn 0.3s ease;
    font-weight: 600;
    max-width: 300px;
  `;
  notification.textContent = message;
  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.animation = 'slideOut 0.3s ease';
    setTimeout(() => notification.remove(), 300);
  }, 3000);
}

// Add CSS animation for notification
const style = document.createElement('style');
style.textContent = `
  @keyframes slideIn {
    from {
      transform: translateX(400px);
      opacity: 0;
    }
    to {
      transform: translateX(0);
      opacity: 1;
    }
  }

  @keyframes slideOut {
    from {
      transform: translateX(0);
      opacity: 1;
    }
    to {
      transform: translateX(400px);
      opacity: 0;
    }
  }
`;
document.head.appendChild(style);

// Tab switching
document.querySelectorAll('.tab-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const tabName = btn.getAttribute('data-tab');

    // Remove active class from all buttons and contents
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

    // Add active class to clicked button and corresponding content
    btn.classList.add('active');
    document.getElementById(tabName).classList.add('active');
  });
});

// Load data on page load
loadTransactions();
loadSummary();
loadOverallSummary();
loadFruitSummary();

// Refresh data every 30 seconds
setInterval(() => {
  loadTransactions();
  loadSummary();
  loadOverallSummary();
  loadFruitSummary();
}, 30000);

// Load overall summary (total profit/loss)
async function loadOverallSummary() {
  try {
    const response = await fetch(`${API_BASE}/overall-summary`);
    const data = await response.json();

    document.getElementById('overallPurchase').textContent = parseFloat(data.total_purchase).toFixed(2);
    document.getElementById('overallSales').textContent = parseFloat(data.total_sales).toFixed(2);

    const profitElement = document.getElementById('overallProfit');
    profitElement.textContent = parseFloat(data.total_profit).toFixed(2);

    // Update card color based on profit/loss
    const profitCard = profitElement.closest('.profit-card');
    if (data.total_profit < 0) {
      profitCard.classList.add('loss-card');
    } else {
      profitCard.classList.remove('loss-card');
    }
  } catch (error) {
    console.error('Error loading overall summary:', error);
  }
}

// Load summary by fruit type
async function loadFruitSummary() {
  try {
    const response = await fetch(`${API_BASE}/summary-by-fruit`);
    const summaries = await response.json();
    const tbody = document.getElementById('fruitSummaryBody');

    if (summaries.length === 0) {
      tbody.innerHTML = `
        <tr>
          <td colspan="6" class="empty-state">
            لا توجد بيانات حتى الآن
          </td>
        </tr>
      `;
      return;
    }

    tbody.innerHTML = summaries.map(s => `
      <tr>
        <td><strong>${s.fruit}</strong></td>
        <td>${parseFloat(s.quantity_bought || 0).toFixed(2)}</td>
        <td>${parseFloat(s.quantity_sold || 0).toFixed(2)}</td>
        <td>${parseFloat(s.total_purchase_cost || 0).toFixed(2)}</td>
        <td>${parseFloat(s.total_sales_revenue || 0).toFixed(2)}</td>
        <td class="${parseFloat(s.profit || 0) >= 0 ? 'profit' : 'loss'}">
          <strong>${parseFloat(s.profit || 0).toFixed(2)}</strong>
        </td>
      </tr>
    `).join('');
  } catch (error) {
    console.error('Error loading fruit summary:', error);
  }
}

// Allow Enter key to add fruit
document.getElementById('newFruitInput').addEventListener('keypress', (e) => {
  if (e.key === 'Enter') {
    addNewFruit();
  }
});
