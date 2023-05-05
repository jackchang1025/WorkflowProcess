<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RequestStatusRowAction;
use App\Admin\Repositories\Process;
use App\Models\Process as ProcessModel;
use App\Services\Engine\BpmnDocumentService;
use App\Services\ProcessService;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\Displayers\Actions;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;


class ProcessController extends AdminController
{

    public function __construct(protected readonly BpmnDocumentService $bpmnDocumentService,protected readonly ProcessService $processService)
    {

    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Process(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('status')->switch();
            $grid->column('describe');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });

            // 禁用内置的创建按钮
            $grid->disableCreateButton();
            $grid->disableEditButton();

            // 添加自定义的创建按钮
            $grid->tools(function (Grid\Tools $tools) {
                $createUrl = admin_url('process/create'); // 替换为实际的创建页面 URL
                $tools->append("<a href='{$createUrl}' target='_blank' class='btn btn-success'><i class='feather icon-plus'></i> " . trans('admin.new') . "</a>");
            });

            $grid->actions(function (Actions $actions) {

                $editUrl = admin_url("process/{$actions->getKey()}/edit/"); // 替换为实际的编辑页面 URL
                $actions->append("<a href='{$editUrl}' target='_blank' class='grid-row-action'><i class='feather icon-edit'>edit</i></a>");

                $actions->append(RequestStatusRowAction::make());
            });
        });
    }

    /**
     * @param $id
     * @param Content $content
     * @return Content|\Inertia\Response
     */
    public function edit($id, Content $content)
    {
        $process = ProcessModel::find($id);

        return Inertia::render('Bpmn/BpmnViewer', [
            'id'         => $process->id,
            'csrf_token' => csrf_token(),
            'xml'        => $process->bpmn_xml
        ]);
    }

    /**
     * @return JsonResponse|mixed
     * @throws ValidationException
     * @throws \Throwable
     */
    public function store()
    {
        throw_if(empty($bpmnXml = request()->post('xml')), ValidationException::withMessages(['xml' => 'xml 不能为空']));

        $this->bpmnDocumentService->loadXML($bpmnXml);

        $attributes = $this->bpmnDocumentService->validate();

        if (ProcessModel::where('title', $attributes['name'])->first()){
            return Response::error('流程名称已存在');
        }

        $process = ProcessModel::create([
            'title'    => $attributes['name'],
            'bpmn_xml' => $bpmnXml
        ]);

        return Response::success('创建成功',$process);
    }

    /**
     * @param Content $content
     * @return Content|\Inertia\Response
     */
    public function create(Content $content): Content|\Inertia\Response
    {
        return Inertia::render('Bpmn/BpmnViewer', [
            'csrf_token' => csrf_token(),
            'xml'        => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
  <process id="Process_1" isExecutable="false">
    <documentation>获取数据</documentation>
    <extensionElements>
      <camunda:executionListener class="" event="start" />
      <camunda:properties>
        <camunda:property />
      </camunda:properties>
    </extensionElements>
    <startEvent id="StartEvent_1y45yut">
      <documentation>Element documentation .......</documentation>
      <extensionElements>
        <zeebe:ioMapping>
          <zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />
        </zeebe:ioMapping>
        <zeebe:properties>
          <zeebe:property name="lottery_id" value="888" />
          <zeebe:property name="lottery_option" value="单双" />
          <zeebe:property name="base_bet_amount" value="20" />
          <zeebe:property name="total_bet_amount" value="1000" />
        </zeebe:properties>
      </extensionElements>
    </startEvent>
  </process>
  <bpmndi:BPMNDiagram id="BpmnDiagram_1">
    <bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
      <bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
        <omgdc:Bounds x="152" y="92" width="36" height="36" />
        <bpmndi:BPMNLabel>
          <omgdc:Bounds x="126" y="68" width="88" height="40" />
        </bpmndi:BPMNLabel>
      </bpmndi:BPMNShape>
    </bpmndi:BPMNPlane>
  </bpmndi:BPMNDiagram>
</definitions>',
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse|\Illuminate\Http\Response
     * @throws ValidationException|\Throwable
     */
    public function update($id): \Illuminate\Http\Response|JsonResponse
    {
        throw_if(empty($bpmnXml = request()->post('xml')), ValidationException::withMessages(['xml' => 'xml 不能为空']));

        $process = ProcessModel::findOrFail($id);

        $this->bpmnDocumentService->loadXML($bpmnXml);

        $attributes = $this->bpmnDocumentService->validate();

        $process->bpmn_xml = $bpmnXml;
        $process->title    = $attributes['name'];
        $process->save();

        return Response::success();
    }

    public function run(Request $request)
    {
        throw_if(empty($bpmnXml = request()->post('xml')), ValidationException::withMessages(['xml' => 'xml 不能为空']));

        $this->bpmnDocumentService->loadXML($bpmnXml);

        $attributes = $this->bpmnDocumentService->validate();

        return Response::success('待开发中');

    }

    public function dispatch (){
        dd('dispatch');
    }
}
