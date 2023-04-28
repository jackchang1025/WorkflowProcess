<div class="content with-diagram" id="js-drop-zone" style="height: 1200px;">

    <div ref="canvas" class="canvas" id="js-canvas"></div>
    <div ref="propertiesPanel" class="properties-panel-parent" id="js-properties-panel"></div>

</div>

<ul class="buttons">
    <li>
        download
    </li>
    <li>
        <a id="js-download-diagram" href title="download BPMN diagram">
            BPMN diagram
        </a>
    </li>
    <li>
        <a id="js-download-svg" href title="download as SVG image">
            SVG image
        </a>
    </li>

    <li>
        <a @click="submit" href="javascript:" title="save">
        </a>
    </li>
</ul>

<!-- required viewer styles -->
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@13.0.3/dist/assets/bpmn-js.css" />

<script src="https://unpkg.com/bpmn-js@13.0.3/dist/bpmn-viewer.development.js"></script>

<!-- required modeler styles -->
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@13.0.3/dist/assets/diagram-js.css" />
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@13.0.3/dist/assets/bpmn-js.css" />
<link rel="stylesheet" href="https://unpkg.com/bpmn-js@13.0.3/dist/assets/bpmn-font/css/bpmn.css" />

<script src="https://unpkg.com/bpmn-js@13.0.3/dist/bpmn-modeler.development.js"></script>

<script>

    Dcat.ready(function () {
        // 写入你的 js 代码
        console.log('所有 js 脚本加载完毕啦~~');

        const bpmnJS = new BpmnJS({
            container: '#js-canvas'
        });

        try {
            const encodedXmlString = `{!! urlencode($bpmn_xml) !!}`;
            const decodedXmlString = decodeURIComponent(encodedXmlString);

            bpmnJS.importXML(decodedXmlString);

            console.log('success!');
            // viewer.get('js-properties-panel').zoom('fit-viewport');

        } catch (err) {

            console.error('something went wrong:', err);
        }
    });

</script>

