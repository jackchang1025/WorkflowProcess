<!-- 图表容器 -->
<div id="chart-container-win-lose" style="width: 100%;height: 100%;"></div>

<!-- 引入 ECharts 文件 -->
{{--<script src="{{ asset('echarts/echarts.js')}}"></script>--}}

<script>

    Dcat.ready(function () {

        // 基于准备好的 DOM，初始化 echarts 实例
        let chart = echarts.init(document.getElementById('chart-container-win-lose'), {
            width: '100%',
            height: '600px'
        });

        console.log({!! $data['request'] !!})

        let option = {
            legend: {},
            tooltip: {
                trigger: 'axis',
            },
            toolbox: {
                feature: {
                    dataView: { show: true, readOnly: false },
                    magicType: { show: true, type: ['line', 'bar','stack','tiled'] },
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
                    name: 'Total Lottery Count',
                    type: 'bar',
                    stack: 'stackedBar',
                    gridIndex: 1,
                    data: [{{$data['request']->total_lottery_count}}],
                },
                {
                    name: 'Bet Count',
                    type: 'bar',
                    stack: 'stackedBar',
                    gridIndex: 1,
                    data: [{{$data['request']->bet_count}}],
                },
                {
                    name: 'Win Count',
                    type: 'bar',
                    stack: 'stackedBar',
                    gridIndex: 1,
                    data: [{{$data['request']->win_count}}],
                },
                {
                    name: 'Lose Count',
                    type: 'bar',
                    stack: 'stackedBar',
                    gridIndex: 1,
                    data: [{{$data['request']->lose_count}}],
                },
            ]
        };

        // 使用刚指定的配置项和数据显示图表
        chart.setOption(option);
    });
</script>
