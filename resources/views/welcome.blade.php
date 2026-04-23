<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج إدارة معاملات الفواكه</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Segoe UI Arabic', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            direction: rtl;
            text-align: right;
        }

        .main-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 1000px;
            padding: 40px;
            margin-top: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .section-header {
            color: #667eea;
            font-size: 18px;
            font-weight: 600;
            margin-top: 30px;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-section label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }

        .form-section input,
        .form-section select,
        .form-section textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
            text-align: right;
        }

        .form-section input:focus,
        .form-section select:focus,
        .form-section textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.2);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-row-three {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-direction: row-reverse;
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            flex: 1;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-reset {
            background: #f0f0f0;
            color: #333;
            flex: 1;
        }

        .btn-reset:hover {
            background: #e0e0e0;
        }

        .btn-add {
            background: #28a745;
            color: white;
            flex: 1;
        }

        .btn-add:hover {
            background: #218838;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none;
        }

        .fruits-management {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .fruits-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 10px;
            margin-bottom: 15px;
        }

        .fruit-item {
            background: white;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
            direction: rtl;
        }

        .fruit-item span {
            font-weight: 500;
        }

        .tabs {
            display: flex;
            flex-direction: row-reverse;
            gap: 0;
            margin-top: 30px;
            border-bottom: 2px solid #ddd;
        }

        .tab-button {
            padding: 12px 20px;
            background: #f0f0f0;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: #333;
            transition: all 0.3s;
            border-radius: 0;
            border-bottom: 3px solid transparent;
        }

        .tab-button.active {
            background: white;
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab-button:hover {
            background: #e0e0e0;
        }

        .tab-content {
            display: none;
            margin-top: 20px;
        }

        .tab-content.active {
            display: block;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .summary-table th,
        .summary-table td {
            padding: 12px;
            text-align: right;
            border-bottom: 1px solid #ddd;
        }

        .summary-table th {
            background: #667eea;
            color: white;
            font-weight: 600;
        }

        .summary-table tr:hover {
            background: #f8f9fa;
        }

        .total-display {
            background: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .fruit-input-group {
            display: flex;
            gap: 10px;
            flex-direction: row-reverse;
        }

        .fruit-input-group input {
            flex: 1;
        }

        .fruit-input-group button {
            padding: 10px 15px;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .form-row,
            .form-row-three {
                grid-template-columns: 1fr;
            }

            .fruits-list {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            }

            .tabs {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>🍎 نموذج إدارة معاملات الفواكه</h1>
        <p class="subtitle">تسجيل معاملات شراء وبيع الفواكه مع الملخصات</p>

        <div class="success-message" id="successMessage">
            ✓ تم تسجيل المعاملة بنجاح!
        </div>

        <!-- Fruit Management Section -->
        <div class="fruits-management">
            <h3 class="section-header">🌾 إدارة الفواكه</h3>

            <div class="fruit-input-group">
                <button type="button" class="btn-add" onclick="addFruit()">إضافة فاكهة</button>
                <input type="text" id="fruitInput" placeholder="اسم الفاكهة الجديدة..." />
            </div>

            <div class="fruits-list" id="fruitsList">
                <!-- Fruits will be added here -->
            </div>
        </div>

        <!-- Transaction Form -->
        <div>
            <h3 class="section-header">📝 نموذج المعاملة الموحدة</h3>

            <form id="transactionForm" method="POST">
                @csrf

                <!-- Date and Operation Type -->
                <div class="form-row">
                    <div class="form-section">
                        <label for="transactionDate">التاريخ *</label>
                        <input type="date" id="transactionDate" name="transaction_date" required>
                    </div>

                    <div class="form-section">
                        <label for="operationType">نوع العملية *</label>
                        <select id="operationType" name="operation_type" required>
                            <option value="">-- اختر --</option>
                            <option value="purchase">شراء</option>
                            <option value="sale">بيع</option>
                        </select>
                    </div>
                </div>

                <!-- Fruit Selection -->
                <div class="form-row">
                    <div class="form-section">
                        <label for="fruitType">نوع الفاكهة *</label>
                        <select id="fruitType" name="fruit_type" required>
                            <option value="">-- اختر الفاكهة --</option>
                        </select>
                    </div>

                    <div class="form-section">
                        <label for="quantity">الكمية (كغ) *</label>
                        <input type="number" id="quantity" name="quantity" step="0.01" min="0" required>
                    </div>
                </div>

                <!-- Unit Price and Total -->
                <div class="form-row">
                    <div class="form-section">
                        <label for="unitPrice">سعر الوحدة (لكل كغ) *</label>
                        <input type="number" id="unitPrice" name="unit_price" step="0.01" min="0" required>
                    </div>

                    <div class="form-section">
                        <label for="totalAmount">الإجمالي</label>
                        <input type="number" id="totalAmount" name="total_amount" step="0.01" min="0" readonly>
                    </div>
                </div>

                <!-- Vendor Information -->
                <div class="form-section">
                    <label for="vendorName">اسم البائع/المشتري *</label>
                    <input type="text" id="vendorName" name="vendor_name" required>
                </div>

                <!-- Notes -->
                <div class="form-section">
                    <label for="notes">ملاحظات</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="معلومات إضافية..."></textarea>
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="reset" class="btn-reset">مسح النموذج</button>
                    <button type="submit" class="btn-submit">تسجيل المعاملة</button>
                </div>
            </form>
        </div>

        <!-- Tabs Section -->
        <div>
            <div class="tabs">
                <button class="tab-button active" onclick="showTab('transactions-list')">قائمة المعاملات</button>
                <button class="tab-button" onclick="showTab('daily-summary')">الملخص اليومي</button>
                <button class="tab-button" onclick="showTab('overall-summary')">الملخص الكامل</button>
                <button class="tab-button" onclick="showTab('fruit-summary')">ملخص حسب الفاكهة</button>
            </div>

            <!-- Transactions List Tab -->
            <div id="transactions-list" class="tab-content active">
                <h3 class="section-header">📋 قائمة المعاملات</h3>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>التاريخ</th>
                            <th>النوع</th>
                            <th>الفاكهة</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>الإجمالي</th>
                            <th>البائع</th>
                        </tr>
                    </thead>
                    <tbody id="transactionsTableBody">
                        <tr>
                            <td colspan="8" style="text-align: center; color: #999;">لا توجد معاملات حتى الآن</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Daily Summary Tab -->
            <div id="daily-summary" class="tab-content">
                <h3 class="section-header">📅 الملخص اليومي</h3>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>الشراء (كغ)</th>
                            <th>البيع (كغ)</th>
                            <th>إجمالي الشراء</th>
                            <th>إجمالي البيع</th>
                            <th>الصافي</th>
                        </tr>
                    </thead>
                    <tbody id="dailySummaryBody">
                        <tr>
                            <td colspan="6" style="text-align: center; color: #999;">لا توجد بيانات</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Overall Summary Tab -->
            <div id="overall-summary" class="tab-content">
                <h3 class="section-header">📊 الملخص الكامل</h3>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>النوع</th>
                            <th>إجمالي الكمية (كغ)</th>
                            <th>الإجمالي المالي</th>
                            <th>العدد</th>
                        </tr>
                    </thead>
                    <tbody id="overallSummaryBody">
                        <tr>
                            <td colspan="4" style="text-align: center; color: #999;">لا توجد بيانات</td>
                        </tr>
                    </tbody>
                </table>
                <div class="total-display" id="grandTotal">
                    الإجمالي العام: 0 ريال
                </div>
            </div>

            <!-- Summary by Fruit Tab -->
            <div id="fruit-summary" class="tab-content">
                <h3 class="section-header">🍎 ملخص حسب الفاكهة</h3>
                <table class="summary-table">
                    <thead>
                        <tr>
                            <th>نوع الفاكهة</th>
                            <th>إجمالي الكمية (كغ)</th>
                            <th>إجمالي الشراء</th>
                            <th>إجمالي البيع</th>
                            <th>عدد المعاملات</th>
                        </tr>
                    </thead>
                    <tbody id="fruitSummaryBody">
                        <tr>
                            <td colspan="5" style="text-align: center; color: #999;">لا توجد بيانات</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Initialize data
        let transactions = [];
        let fruits = ['تفاح', 'موز', 'برتقال', 'مانجو', 'فراولة', 'عنب'];

        // Initialize page
        window.addEventListener('DOMContentLoaded', function() {
            loadFruits();
            setTodayDate();
        });

        // Set today's date
        function setTodayDate() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('transactionDate').value = today;
        }

        // Load fruits list
        function loadFruits() {
            updateFruitsList();
            updateFruitSelect();
        }

        // Update fruits list display
        function updateFruitsList() {
            const fruitsList = document.getElementById('fruitsList');
            fruitsList.innerHTML = fruits.map((fruit, index) => `
                <div class="fruit-item">
                    <button type="button" class="btn-delete" onclick="removeFruit(${index})">حذف</button>
                    <span>${fruit}</span>
                </div>
            `).join('');
        }

        // Update fruit select options
        function updateFruitSelect() {
            const select = document.getElementById('fruitType');
            const currentValue = select.value;
            select.innerHTML = '<option value="">-- اختر الفاكهة --</option>';
            fruits.forEach(fruit => {
                select.innerHTML += `<option value="${fruit}">${fruit}</option>`;
            });
            select.value = currentValue;
        }

        // Add fruit
        function addFruit() {
            const input = document.getElementById('fruitInput');
            const fruitName = input.value.trim();

            if (fruitName && !fruits.includes(fruitName)) {
                fruits.push(fruitName);
                input.value = '';
                loadFruits();
            }
        }

        // Remove fruit
        function removeFruit(index) {
            fruits.splice(index, 1);
            loadFruits();
        }

        // Auto-calculate total
        document.getElementById('quantity').addEventListener('input', calculateTotal);
        document.getElementById('unitPrice').addEventListener('input', calculateTotal);

        function calculateTotal() {
            const quantity = parseFloat(document.getElementById('quantity').value) || 0;
            const unitPrice = parseFloat(document.getElementById('unitPrice').value) || 0;
            const total = (quantity * unitPrice).toFixed(2);
            document.getElementById('totalAmount').value = total;
        }

        // Form submission
        document.getElementById('transactionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const transaction = {
                date: document.getElementById('transactionDate').value,
                type: document.getElementById('operationType').value,
                fruit: document.getElementById('fruitType').value,
                quantity: parseFloat(document.getElementById('quantity').value),
                unitPrice: parseFloat(document.getElementById('unitPrice').value),
                total: parseFloat(document.getElementById('totalAmount').value),
                vendor: document.getElementById('vendorName').value,
                notes: document.getElementById('notes').value
            };

            if (transaction.fruit && transaction.vendor) {
                transactions.push(transaction);
                updateAllTabs();

                // Show success message
                const msg = document.getElementById('successMessage');
                msg.style.display = 'block';
                setTimeout(() => msg.style.display = 'none', 3000);

                // Reset form
                this.reset();
                setTodayDate();
            }
        });

        // Update all tabs
        function updateAllTabs() {
            updateTransactionsList();
            updateDailySummary();
            updateOverallSummary();
            updateFruitSummary();
        }

        // Update transactions list
        function updateTransactionsList() {
            const tbody = document.getElementById('transactionsTableBody');
            if (transactions.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align: center; color: #999;">لا توجد معاملات</td></tr>';
                return;
            }

            tbody.innerHTML = transactions.map((t, i) => `
                <tr>
                    <td>${i + 1}</td>
                    <td>${t.date}</td>
                    <td>${t.type === 'purchase' ? 'شراء' : 'بيع'}</td>
                    <td>${t.fruit}</td>
                    <td>${t.quantity.toFixed(2)}</td>
                    <td>${t.unitPrice.toFixed(2)}</td>
                    <td>${t.total.toFixed(2)}</td>
                    <td>${t.vendor}</td>
                </tr>
            `).join('');
        }

        // Update daily summary
        function updateDailySummary() {
            const dailyData = {};

            transactions.forEach(t => {
                if (!dailyData[t.date]) {
                    dailyData[t.date] = {
                        buyQty: 0,
                        sellQty: 0,
                        buyTotal: 0,
                        sellTotal: 0
                    };
                }

                if (t.type === 'purchase') {
                    dailyData[t.date].buyQty += t.quantity;
                    dailyData[t.date].buyTotal += t.total;
                } else {
                    dailyData[t.date].sellQty += t.quantity;
                    dailyData[t.date].sellTotal += t.total;
                }
            });

            const tbody = document.getElementById('dailySummaryBody');
            const rows = Object.entries(dailyData).map(([date, data]) => `
                <tr>
                    <td>${date}</td>
                    <td>${data.buyQty.toFixed(2)}</td>
                    <td>${data.sellQty.toFixed(2)}</td>
                    <td>${data.buyTotal.toFixed(2)}</td>
                    <td>${data.sellTotal.toFixed(2)}</td>
                    <td>${(data.sellTotal - data.buyTotal).toFixed(2)}</td>
                </tr>
            `).join('');

            tbody.innerHTML = rows || '<tr><td colspan="6" style="text-align: center; color: #999;">لا توجد بيانات</td></tr>';
        }

        // Update overall summary
        function updateOverallSummary() {
            const buyData = { qty: 0, total: 0, count: 0 };
            const sellData = { qty: 0, total: 0, count: 0 };

            transactions.forEach(t => {
                if (t.type === 'purchase') {
                    buyData.qty += t.quantity;
                    buyData.total += t.total;
                    buyData.count++;
                } else {
                    sellData.qty += t.quantity;
                    sellData.total += t.total;
                    sellData.count++;
                }
            });

            const tbody = document.getElementById('overallSummaryBody');
            let html = '';

            if (buyData.count > 0) {
                html += `<tr><td>شراء</td><td>${buyData.qty.toFixed(2)}</td><td>${buyData.total.toFixed(2)}</td><td>${buyData.count}</td></tr>`;
            }

            if (sellData.count > 0) {
                html += `<tr><td>بيع</td><td>${sellData.qty.toFixed(2)}</td><td>${sellData.total.toFixed(2)}</td><td>${sellData.count}</td></tr>`;
            }

            tbody.innerHTML = html || '<tr><td colspan="4" style="text-align: center; color: #999;">لا توجد بيانات</td></tr>';

            const grandTotal = sellData.total - buyData.total;
            document.getElementById('grandTotal').innerHTML = `الإجمالي العام: ${grandTotal.toFixed(2)} ريال`;
        }

        // Update fruit summary
        function updateFruitSummary() {
            const fruitData = {};

            transactions.forEach(t => {
                if (!fruitData[t.fruit]) {
                    fruitData[t.fruit] = {
                        qty: 0,
                        buyTotal: 0,
                        sellTotal: 0,
                        count: 0
                    };
                }

                fruitData[t.fruit].qty += t.quantity;
                fruitData[t.fruit].count++;

                if (t.type === 'purchase') {
                    fruitData[t.fruit].buyTotal += t.total;
                } else {
                    fruitData[t.fruit].sellTotal += t.total;
                }
            });

            const tbody = document.getElementById('fruitSummaryBody');
            const rows = Object.entries(fruitData).map(([fruit, data]) => `
                <tr>
                    <td>${fruit}</td>
                    <td>${data.qty.toFixed(2)}</td>
                    <td>${data.buyTotal.toFixed(2)}</td>
                    <td>${data.sellTotal.toFixed(2)}</td>
                    <td>${data.count}</td>
                </tr>
            `).join('');
            tbody.innerHTML = rows || '<tr><td colspan="5" style="text-align: center; color: #999;">لا توجد بيانات</td></tr>';
        }

        // Show tab content
        function showTab(tabId) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(el => el.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabId).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</body>
</html>
