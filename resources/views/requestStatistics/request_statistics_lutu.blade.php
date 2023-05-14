<!-- 图表容器 -->
<div id="chart-container-lutu" style="width: 100%;min-height: 300px;margin-right: 20%;"></div>

<script>

    Dcat.ready(function () {

        // 基于准备好的 DOM，初始化 echarts 实例
        let chart = echarts.init(document.getElementById('chart-container-lutu'), {
            width: '100%',
            height: '600px'
        });

        const option = {
            xAxis: {},
            yAxis: {},
            tooltip: {
                trigger: 'item',
                formatter: function (params) {

                    const data = params.data;
                    let tooltipText = '';
                    for (const key in data) {
                        tooltipText += key + ': ' + data[key] + '<br>';
                    }
                    return tooltipText;
                }
            },
            grid: {
                top: '10%',
                bottom: '15%',
                left: '5%',
                right: '5%',
                height: 'auto',
                width: 'auto'

            },
            dataZoom: [
                {
                    type: 'inside',
                    start: 0,
                    end: 100
                },
                {
                    'type': 'slider',
                    start: 0,
                    end: 100
                }
            ],
            dataset: {
                // 用 dimensions 指定了维度的顺序。直角坐标系中，如果 X 轴 type 为 category，
                // 默认把第一个维度映射到 X 轴上，后面维度映射到 Y 轴上。
                // 如果不指定 dimensions，也可以通过指定 series.encode
                // 完成映射，参见后文。
                dimensions: ['issue', 'bet_amount', 'bet_total_amount', 'bet_code', 'lottery_code', 'bet_code_transform_value', 'win_lose','x','y','color'],
                source: {!! $data['requestLogs'] !!},
            },
            series: [
                {
                    symbolSize: 20,
                    type: 'scatter',
                    itemStyle: {
                        color: function (params) {
                            return params.value.color;
                        }
                    },
                    encode: {
                        x: 'x',
                        y: 'y'
                    },
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表
        chart.setOption(option);
    });
</script>
