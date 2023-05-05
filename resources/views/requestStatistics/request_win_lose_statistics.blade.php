<!-- 图表容器 -->
<div id="chart-container-total-count" style="width: 100%;height: 500px"></div>

<!-- 引入 ECharts 文件 -->
{{--<script src="{{ asset('echarts/echarts.js')}}"></script>--}}

<script>

    Dcat.ready(function () {

        // 基于准备好的 DOM，初始化 echarts 实例
        let chart = echarts.init(document.getElementById('chart-container-total-count'));

        console.log({!! $data['request'] !!})

        let option = {
            legend: {},
            tooltip: {
                trigger: 'axis',
            },
            toolbox: {
                feature: {
                    dataView: { show: true, readOnly: false },
                    magicType: { show: true, type: ['line', 'bar'] },
                    restore: { show: true },
                    saveAsImage: { show: true }
                }
            },
            dataset: {
                // 用 dimensions 指定了维度的顺序。直角坐标系中，如果 X 轴 type 为 category，
                // 默认把第一个维度映射到 X 轴上，后面维度映射到 Y 轴上。
                // 如果不指定 dimensions，也可以通过指定 series.encode
                // 完成映射，参见后文。
                dimensions: ['issue', 'bet_amount', 'bet_total_amount', 'bet_code', 'lottery_code', 'bet_code_transform_value', 'win_lose'],
                source: {!! $data['request'] !!},
            },
            xAxis: [
                {type: 'category', gridIndex: 0},
            ],
            yAxis: [
                {type: 'value', gridIndex: 0},
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
                    left: '10%',
                    right: '10%',
                    height: 'auto',
                    width: 'auto'
                },
            ],
            series: [
                {
                    name: 'win lose',
                    type: 'pie',
                    radius: '50%',
                    gridIndex:0,
                    data: [
                            {{--{ value: {{$data['request']->bet_count}}, name: 'bet count' },--}}
                        { value: {{$data['request']->win_count}}, name: 'win' },
                        { value: {{$data['request']->lose_count}}, name: 'lose' },
                    ],
                    label: {
                        formatter: '{b}: {c} ({d}%)', // 设置标签格式
                        show: true, // 设置是否显示标签
                        color: '#000', // 设置标签字体颜色
                    },
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };

        // 使用刚指定的配置项和数据显示图表
        chart.setOption(option);
    });
</script>
