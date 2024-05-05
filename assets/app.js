import './styles/app.css';
import './bootstrap';
import './lib/confetti'

document.addEventListener('chartjs:init', function (event) {
    const Chart = event.detail.Chart;
});
