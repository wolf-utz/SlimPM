import './styles/app.css';
import './bootstrap';

document.addEventListener('chartjs:init', function (event) {
    const Chart = event.detail.Chart;
});