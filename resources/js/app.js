import './bootstrap';
import 'flowbite';
import './theme-manager';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


//popover for notes
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))



//script for charts
document.addEventListener('DOMContentLoaded', (event) => {
  fetch('/dashboard/chart-data')
    .then(response => response.json())
    .then(data => {


      const getChartOptions = () => {
        return {
          series: [data.b2b, data.b2c],
          colors: ["#1C64F2", "#16BDCA"],
          chart: {
            height: 420,
            width: "100%",
            type: "pie",
          },
          stroke: {
            colors: ["white"],
            lineCap: "",
          },
          plotOptions: {
            pie: {
              labels: {
                show: true,
              },
              size: "100%",
              dataLabels: {
                offset: -25
              }
            },
          },
          labels: ["B2B", "B2C"],
          dataLabels: {
            enabled: true,
            style: {
              fontFamily: "Inter, sans-serif",
            },
          },
          legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
          },
          yaxis: {
            labels: {
              formatter: function (value) {
                return value
              },
            },
          },
          xaxis: {
            labels: {
              formatter: function (value) {
                return value + "%"
              },
            },
            axisTicks: {
              show: false,
            },
            axisBorder: {
              show: false,
            },
          },
        }
      }

      if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
        chart.render();
      }


      //to do donuts chart

      const getToDoChartOptions = () => {
        return {
          series: [data.doneRatio, data.importantRatio, data.urgentRatio],
          colors: ["#1C64F2", "#16BDCA", "#FDBA8C"],
          chart: {
            height: "380px",
            width: "100%",
            type: "radialBar",
            sparkline: {
              enabled: true,
            },
          },
          plotOptions: {
            radialBar: {
              track: {
                background: '#E5E7EB',
              },
              dataLabels: {
                show: false,
              },
              hollow: {
                margin: 0,
                size: "32%",
              }
            },
          },
          grid: {
            show: false,
            strokeDashArray: 4,
            padding: {
              left: 2,
              right: 2,
              top: -23,
              bottom: -20,
            },
          },
          labels: ["Fatte", "Importanti", "Urgenti"],
          legend: {
            show: false,
            position: "bottom",
            fontFamily: "Inter, sans-serif",
          },
          tooltip: {
            enabled: true,
            x: {
              show: false,
            },
          },
          yaxis: {
            show: false,
            labels: {
              formatter: function (value) {
                return value + '%';
              }
            }
          }
        }
      }
      
      if (document.getElementById("radial-chart") && typeof ApexCharts !== 'undefined') {
        const chart = new ApexCharts(document.querySelector("#radial-chart"), getToDoChartOptions());
        chart.render();
      }





    })
    .catch(error => console.error('Errore nel caricamento dei dati:', error));

});




