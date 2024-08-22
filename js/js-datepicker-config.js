const $fromDate = datepicker('.fromDate', {
id: 1, 
customDays: ['日', '月', '火', '水', '木', '金', '土'], 
customMonths: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'], 
formatter: (input, date, instance) => {
    input.value = date.toLocaleDateString()
  }
})
const $toDate = datepicker('.toDate', {
id: 1, 
customDays: ['日', '月', '火', '水', '木', '金', '土'], 
customMonths: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'], 
formatter: (input, date, instance) => {
    input.value = date.toLocaleDateString()
  }
})
