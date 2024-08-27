<div id="chartMont"></div>
<script>
    $(document).ready(function() {
        let cat = [
            '<?php echo lang('Text.jan'); ?>',
            '<?php echo lang('Text.feb'); ?>',
            '<?php echo lang('Text.mar'); ?>',
            '<?php echo lang('Text.apr'); ?>',
            '<?php echo lang('Text.may'); ?>',
            '<?php echo lang('Text.jun'); ?>',
            '<?php echo lang('Text.jul'); ?>',
            '<?php echo lang('Text.aug'); ?>',
            '<?php echo lang('Text.sep'); ?>',
            '<?php echo lang('Text.oct'); ?>',
            '<?php echo lang('Text.nov'); ?>',
            '<?php echo lang('Text.dec'); ?>'
        ];
        let data = [
            <?php echo $chartMont[1]; ?>,
            <?php echo $chartMont[2]; ?>,
            <?php echo $chartMont[3]; ?>,
            <?php echo $chartMont[4]; ?>,
            <?php echo $chartMont[5]; ?>,
            <?php echo $chartMont[6]; ?>,
            <?php echo $chartMont[7]; ?>,
            <?php echo $chartMont[8]; ?>,
            <?php echo $chartMont[9]; ?>,
            <?php echo $chartMont[10]; ?>,
            <?php echo $chartMont[11]; ?>,
            <?php echo $chartMont[12]; ?>
        ];

        let total = '<?php echo $chartMont['total']; ?>';

        let option = {
            series: [{
                name: '',
                data: data,
            }],
            annotations: {
                points: [{
                    x: '',
                    seriesIndex: 0,
                    label: {
                        borderColor: '#775DD0',
                        offsetY: 0,
                        style: {
                            color: '#fff',
                            background: '#775DD0',
                        },
                        text: '',
                    }
                }]
            },
            chart: {
                fontFamily: 'inherit',
                type: 'bar',
                height: 300,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['50%'],
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false,
                formatter: (value) => {
                    return '<?php echo $config[0]->currency; ?> ' + value.toFixed(2);
                },
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            grid: {
                row: {
                    colors: ['#fff', '#f2f2f2']
                }
            },
            xaxis: {
                categories: cat,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: true,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                title: {
                    text: '',
                },
                labels: {
                    formatter: (value) => {
                        return '<?php echo $config[0]->currency; ?> ' + value.toFixed(2);
                    },
                    style: {
                        fontSize: '12px'
                    },
                    show: true
                },
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            legend: {
                show: true,
                onItemHover: {
                    highlightDataSeries: true
                },
            },
            grid: {
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };
        let chart = new ApexCharts(document.querySelector("#chartMont"), option);
        chart.render();


    });
</script>