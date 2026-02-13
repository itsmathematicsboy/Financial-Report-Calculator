# 📊 Financial Report Calculator

A simple **Financial Ratio Calculator** built using **PHP** and **Bootstrap**.  
This project was created for learning and practice purposes.

---

## 🚀 Features

### 📈 Profitability Ratios
- Gross Profit Margin
- Net Profit Margin
- Return on Assets (ROA)
- Return on Equity (ROE)

### 💧 Liquidity Ratios
- Current Ratio
- Quick Ratio

### 🏦 Leverage Ratios
- Debt to Equity Ratio
- Debt to Asset Ratio

---

## 🛠️ Tech Stack

- PHP (Native)
- Bootstrap (via npm)
- HTML5
- Git

---

## 📥 Input Required

Users must input:

- Revenue  
- COGS  
- Net Income  
- Total Assets  
- Total Equity  
- Current Assets  
- Current Liabilities  
- Inventory  
- Total Debt  

---

## 🧮 Example Formula

```php
function gross_profit_margin($revenue, $cogs){
    return ($revenue - $cogs) / $revenue;
}
