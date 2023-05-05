<!-- 图表容器 -->
<div id="chart-container" style="width: 100%;min-height: 1000px;margin-right: 20%;"></div>

<!-- 引入 ECharts 文件 -->
{{--<script src="{{ asset('echarts/echarts.js')}}"></script>--}}


<script>


    Dcat.ready(function () {

        // 基于准备好的 DOM，初始化 echarts 实例
        let chart = echarts.init(document.getElementById('chart-container'), {
            width: '100%',
            height: '600px'
        });


        console.log({!! $data['requestLogs'] !!})

        let option = {
            legend: {},
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    const data = params[0].data;
                    let tooltipText = '';
                    for (const key in data) {
                        tooltipText += key + ': ' + data[key] + '<br>';
                    }
                    return tooltipText;
                }
            },
            toolbox: {
                feature: {
                    dataView: { show: true, readOnly: false },
                    magicType: { show: true, type: [ 'bar','stack','candlestick'] },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
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
                dimensions: ['issue', 'bet_amount', 'bet_total_amount', 'bet_code', 'lottery_code', 'bet_code_transform_value', 'win_lose'],
                source: {!! $data['requestLogs'] !!},
            },
            xAxis: [
                {type: 'category'},
            ],
            yAxis: [
                {type: 'value'},

            ],
            visualMap: {
                show: false,
                seriesIndex: 5,
                dimension: 2,
                pieces: [
                    {
                        value: 1,
                        color: 'red'
                    },
                    {
                        value: -1,
                        color: 'blue'
                    }
                ]
            },
            grid: [
                {
                    top: '10%',
                    bottom: '15%',
                    left: '5%',
                    right: '5%',
                    height: 'auto',
                    width: 'auto'

                }
            ],
            series: [
                {
                    name: '投注金额',
                    type: 'line',
                    // encode: {
                    //     x: 'issue',
                    //     y: 'bet_total_amount'
                    // },
                    connectNulls: true,
                },
                {
                    name: '投注总金额',
                    type: 'line',
                    // encode: {
                    //     x: 'issue',
                    //     y: 'bet_total_amount'
                    // },
                    connectNulls: true,
                }
            ]
        };


        // 使用刚指定的配置项和数据显示图表
        chart.setOption(option);

        {{--fetch("/admin/request_statistics/getData/{{$id}}")--}}
        {{--    .then(response => response.json())--}}
        {{--    .then(data => {--}}

        {{--        console.log(data);--}}

        {{--        // 更新图表数据--}}
        {{--        chart.setOption({--}}
        {{--            dataset: {--}}
        {{--                source: data.data--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
    });
</script>
