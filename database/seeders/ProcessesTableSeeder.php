<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProcessesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('processes')->delete();
        
        \DB::table('processes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'AAA倍投',
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="AAA倍投" isExecutable="false">
<extensionElements />
<startEvent id="StartEvent_1y45yut" name="start">
<documentation>Element documentation .......</documentation>
<extensionElements>
<zeebe:ioMapping>
<zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />
</zeebe:ioMapping>
<zeebe:properties>
<zeebe:property name="lottery_id" value="1" />
<zeebe:property name="lottery_option" value="单双" />
<zeebe:property name="base_bet_amount" value="20" />
<zeebe:property name="total_bet_amount" value="1000" />
</zeebe:properties>
</extensionElements>
<outgoing>Flow_1wrzu2u</outgoing>
</startEvent>
<sequenceFlow id="Flow_1wrzu2u" name="Flow_1wrzu2u" sourceRef="StartEvent_1y45yut" targetRef="Gateway_0ygumq5" />
<endEvent id="Event_00p8isq" name="end">
<incoming>Flow_0a721c8</incoming>
</endEvent>
<sequenceFlow id="Flow_0a721c8" name="Flow_0a721c8" sourceRef="Gateway_0ygumq5" targetRef="Event_00p8isq">
<conditionExpression xsi:type="tFormalExpression" language="">//投注金额小于等于0 || 投注金额大于等于截止金额
return \\App\\Help\\Common::lessThanOrEqualTo($request-&gt;bet_total_amount_rules) || \\App\\Help\\Common::greaterOrEqualTo($request-&gt;bet_total_amount_rules,$request-&gt;stop_betting_amount);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_19ch7nt" name="Flow_19ch7nt" sourceRef="Gateway_0ygumq5" targetRef="Activity_19dyqqr" />
<serviceTask id="Activity_19dyqqr" name="GetLotteryDataTask" camunda:delegateExpression="App\\Services\\Tasks\\GetLotteryDataTask">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_19ch7nt</incoming>
<outgoing>Flow_1ar6z4o</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0s4vlli</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_1ar6z4o" name="Flow_1ar6z4o" sourceRef="Activity_19dyqqr" targetRef="Gateway_15h65le" />
<sequenceFlow id="Flow_0s4vlli" name="Flow_0s4vlli" sourceRef="Gateway_15h65le" targetRef="Gateway_0ygumq5" />
<exclusiveGateway id="Gateway_10t4rtn" name="Gateway_10t4rtn">
<incoming>Flow_1a44leq</incoming>
<outgoing>Flow_19pl5zp</outgoing>
<outgoing>Flow_1meev5f</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
function ($request){
return preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u\', $request-&gt;lottery_rules);
}</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_19pl5zp" name="赢" sourceRef="Gateway_10t4rtn" targetRef="Activity_0f97m8m">
<extensionElements>
<zeebe:properties>
<zeebe:property name="win_lose_rules-输" value="/0$/" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">return preg_match(\'/1$/\', $request-&gt;win_lose_rules);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_1meev5f" name="输" sourceRef="Gateway_10t4rtn" targetRef="Activity_1k2wjfy">
<extensionElements>
<zeebe:properties>
<zeebe:property name="win_lose_rules-赢" value="/1$/" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">return preg_match(\'/0$/\', $request-&gt;win_lose_rules);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_1a5lhmw" name="Flow_1a5lhmw" sourceRef="Activity_0f97m8m" targetRef="Activity_1029zj8" />
<sequenceFlow id="Flow_0usdnwm" name="Flow_0usdnwm" sourceRef="Activity_1k2wjfy" targetRef="Activity_1029zj8" />
<sequenceFlow id="Flow_15forua" sourceRef="Activity_1029zj8" targetRef="Activity_0bbkk1o" />
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_15forua</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<exclusiveGateway id="Gateway_15h65le" name="Gateway_15h65le" default="Flow_0s4vlli">
<documentation>SSS</documentation>
<incoming>Flow_1ar6z4o</incoming>
<outgoing>Flow_0s4vlli</outgoing>
<outgoing>Flow_1a44leq</outgoing>
</exclusiveGateway>
<scriptTask id="Activity_0f97m8m" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_19pl5zp</incoming>
<outgoing>Flow_1a5lhmw</outgoing>
<script>//设置投注金额-赢
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_1meev5f</incoming>
<outgoing>Flow_0usdnwm</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;last_bet_amount_rules * 2;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_1029zj8" name="createBetCodeTask" scriptFormat="PHP">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_1a5lhmw</incoming>
<incoming>Flow_0usdnwm</incoming>
<outgoing>Flow_15forua</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$response = preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u\', $request-&gt;lottery_rules,$matches);

throw_if(empty($response), new Exception(\'获取投注号码失败\'));

$request-&gt;current_bet_code_rule = $matches[1];
$request-&gt;save();</script>
</scriptTask>
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
<bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
<bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
<omgdc:Bounds x="722" y="202" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="729" y="172" width="22" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Event_00p8isq_di" bpmnElement="Event_00p8isq">
<omgdc:Bounds x="922" y="322" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="931" y="365" width="19" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1t8wh6x_di" bpmnElement="Activity_19dyqqr">
<omgdc:Bounds x="690" y="440" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_0nysfq9_di" bpmnElement="Gateway_0ygumq5" isMarkerVisible="true">
<omgdc:Bounds x="715" y="315" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="748" y="306" width="83" height="27" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_10t4rtn_di" bpmnElement="Gateway_10t4rtn" isMarkerVisible="true">
<omgdc:Bounds x="715" y="715" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="698" y="772" width="84" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_1likk12_di" bpmnElement="Gateway_15h65le" isMarkerVisible="true">
<omgdc:Bounds x="715" y="595" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="775" y="613" width="89" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_0xougq0_di" bpmnElement="Activity_0f97m8m">
<omgdc:Bounds x="860" y="700" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="540" y="700" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_04pnazf_di" bpmnElement="Activity_1029zj8">
<omgdc:Bounds x="690" y="900" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNEdge id="Flow_1wrzu2u_di" bpmnElement="Flow_1wrzu2u">
<di:waypoint x="740" y="238" />
<di:waypoint x="740" y="315" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="274" width="71" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0a721c8_di" bpmnElement="Flow_0a721c8">
<di:waypoint x="765" y="340" />
<di:waypoint x="922" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="808" y="322" width="72" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19ch7nt_di" bpmnElement="Flow_19ch7nt">
<di:waypoint x="740" y="365" />
<di:waypoint x="740" y="440" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="721" y="400" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1ar6z4o_di" bpmnElement="Flow_1ar6z4o">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="595" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="555" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0s4vlli_di" bpmnElement="Flow_0s4vlli">
<di:waypoint x="715" y="620" />
<di:waypoint x="400" y="620" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="385" y="477" width="61" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1a44leq_di" bpmnElement="Flow_1a44leq">
<di:waypoint x="740" y="645" />
<di:waypoint x="740" y="715" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="744" y="677" width="23" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19pl5zp_di" bpmnElement="Flow_19pl5zp">
<di:waypoint x="765" y="740" />
<di:waypoint x="860" y="740" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="807" y="722" width="12" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1meev5f_di" bpmnElement="Flow_1meev5f">
<di:waypoint x="715" y="740" />
<di:waypoint x="640" y="740" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="672" y="722" width="12" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1a5lhmw_di" bpmnElement="Flow_1a5lhmw">
<di:waypoint x="920" y="780" />
<di:waypoint x="920" y="940" />
<di:waypoint x="790" y="940" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="898" y="857" width="75" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0usdnwm_di" bpmnElement="Flow_0usdnwm">
<di:waypoint x="590" y="780" />
<di:waypoint x="590" y="940" />
<di:waypoint x="690" y="940" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="567" y="857" width="77" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_15forua_di" bpmnElement="Flow_15forua">
<di:waypoint x="740" y="980" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0mthd3n_di" bpmnElement="Flow_0mthd3n">
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'status' => 1,
                'order' => 0,
                'describe' => NULL,
                'created_at' => '2023-04-28 07:56:54',
                'updated_at' => '2023-05-11 09:50:46',
            ),
            1 => 
            array (
                'id' => 3,
                'title' => '死循环获取开奖信息',
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="死循环获取开奖信息" isExecutable="true">
<documentation>获取数据</documentation>
<extensionElements>
<camunda:executionListener class="" event="start" />
<camunda:properties>
<camunda:property />
</camunda:properties>
</extensionElements>
<startEvent id="StartEvent_1y45yut" name="start">
<documentation>Element documentation .......</documentation>
<extensionElements>
<zeebe:ioMapping>
<zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />
</zeebe:ioMapping>
<zeebe:properties>
<zeebe:property name="lottery_id" value="1" />
<zeebe:property name="lottery_option" value="单双" />
<zeebe:property name="base_bet_amount" value="20" />
<zeebe:property name="total_bet_amount" value="1000" />
</zeebe:properties>
</extensionElements>
<outgoing>Flow_1wrzu2u</outgoing>
</startEvent>
<sequenceFlow id="Flow_1wrzu2u" name="Flow_1wrzu2u" sourceRef="StartEvent_1y45yut" targetRef="Gateway_0ygumq5" />
<sequenceFlow id="Flow_19ch7nt" name="Flow_19ch7nt" sourceRef="Gateway_0ygumq5" targetRef="Activity_19dyqqr" />
<serviceTask id="Activity_19dyqqr" name="GetLotteryDataTask" camunda:delegateExpression="App\\Services\\Tasks\\GetLotteryDataTask">
<incoming>Flow_19ch7nt</incoming>
<outgoing>Flow_1ar6z4o</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_1ar6z4o</incoming>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_1ar6z4o" name="Flow_1ar6z4o" sourceRef="Activity_19dyqqr" targetRef="Gateway_0ygumq5" />
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
<bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
<bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
<omgdc:Bounds x="722" y="202" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="729" y="172" width="22" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1t8wh6x_di" bpmnElement="Activity_19dyqqr">
<omgdc:Bounds x="690" y="440" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_0nysfq9_di" bpmnElement="Gateway_0ygumq5" isMarkerVisible="true">
<omgdc:Bounds x="715" y="315" width="50" height="50" />
</bpmndi:BPMNShape>
<bpmndi:BPMNEdge id="Flow_1wrzu2u_di" bpmnElement="Flow_1wrzu2u">
<di:waypoint x="740" y="238" />
<di:waypoint x="740" y="315" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="274" width="71" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19ch7nt_di" bpmnElement="Flow_19ch7nt">
<di:waypoint x="740" y="365" />
<di:waypoint x="740" y="440" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="721" y="400" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1ar6z4o_di" bpmnElement="Flow_1ar6z4o">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="620" />
<di:waypoint x="440" y="620" />
<di:waypoint x="440" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="555" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'status' => 1,
                'order' => 0,
                'describe' => NULL,
                'created_at' => '2023-04-28 09:52:36',
                'updated_at' => '2023-05-12 11:14:02',
            ),
            2 => 
            array (
                'id' => 13,
                'title' => 'AAA-倍投-AAAAA',
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="AAA-倍投-AAAAA" isExecutable="false">
<extensionElements />
<startEvent id="StartEvent_1y45yut" name="start">
<documentation>Element documentation .......</documentation>
<extensionElements>
<zeebe:ioMapping>
<zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />
</zeebe:ioMapping>
<zeebe:properties>
<zeebe:property name="lottery_id" value="1" />
<zeebe:property name="lottery_option" value="单双" />
<zeebe:property name="base_bet_amount" value="20" />
<zeebe:property name="total_bet_amount" value="1000" />
</zeebe:properties>
</extensionElements>
<outgoing>Flow_1wrzu2u</outgoing>
</startEvent>
<sequenceFlow id="Flow_1wrzu2u" name="Flow_1wrzu2u" sourceRef="StartEvent_1y45yut" targetRef="Gateway_0ygumq5" />
<endEvent id="Event_00p8isq" name="end">
<incoming>Flow_0a721c8</incoming>
</endEvent>
<sequenceFlow id="Flow_0a721c8" name="Flow_0a721c8" sourceRef="Gateway_0ygumq5" targetRef="Event_00p8isq">
<conditionExpression xsi:type="tFormalExpression" language="">//投注金额小于等于0 || 投注金额大于等于截止金额
return \\App\\Help\\Common::lessThanOrEqualTo($request-&gt;bet_total_amount_rules) || \\App\\Help\\Common::greaterOrEqualTo($request-&gt;bet_total_amount_rules,$request-&gt;stop_betting_amount);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_19ch7nt" name="Flow_19ch7nt" sourceRef="Gateway_0ygumq5" targetRef="Activity_19dyqqr" />
<serviceTask id="Activity_19dyqqr" name="GetLotteryDataTask" camunda:delegateExpression="App\\Services\\Tasks\\GetLotteryDataTask">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_19ch7nt</incoming>
<outgoing>Flow_1ar6z4o</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0s4vlli</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_1ar6z4o" name="Flow_1ar6z4o" sourceRef="Activity_19dyqqr" targetRef="Gateway_15h65le" />
<sequenceFlow id="Flow_0s4vlli" name="Flow_0s4vlli" sourceRef="Gateway_15h65le" targetRef="Gateway_0ygumq5" />
<sequenceFlow id="Flow_1a44leq" name="AAA-AAAAA" sourceRef="Gateway_15h65le" targetRef="Activity_1k2wjfy">
<conditionExpression xsi:type="tFormalExpression" language="PHP">//判断开奖是否在 AAA - AAAAA 区间
function ($request) {
$response = preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u\', $request-&gt;lottery_rules,$matches);
return $response &amp;&amp; \\App\\Help\\Common::lessThanOrEqualTo(mb_strlen($matches[0]),5);
}</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_15forua" sourceRef="Activity_1029zj8" targetRef="Activity_0bbkk1o" />
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_15forua</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<exclusiveGateway id="Gateway_15h65le" name="Gateway_15h65le" default="Flow_0s4vlli">
<documentation>SSS</documentation>
<incoming>Flow_1ar6z4o</incoming>
<outgoing>Flow_0s4vlli</outgoing>
<outgoing>Flow_1a44leq</outgoing>
</exclusiveGateway>
<scriptTask id="Activity_1k2wjfy" name="createBetAmount" scriptFormat="PHP">
<incoming>Flow_1a44leq</incoming>
<outgoing>Flow_1sjodh6</outgoing>
<script>$request=\\App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

//preg_match(){2,4}量词检查开奖规则是否满足 AAA-AAAAA 条件
$response = preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,4}$/u\', $request-&gt;lottery_rules, $matches);

throw_if(empty($response), new \\Exception(\'获取投注号码失败\'));

//我们计算匹配字符串的长度，然后根据这个长度来设置 $number 的值。我们减去2是因为我们的匹配规则是从3个字符开始的，所以3个字符对应的 $number 是1，4个字符对应的是2
$number = mb_strlen($matches[0]) - 2;

//设置投注金额
//在这个等比数列中，首项（a）是10，公比（r）是2。等比数列的通项公式是 an = a * r^(n-1)，其中 an 是第n项，a 是首项，r 是公比，n 是项数
$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules * pow(2, $number - 1);

$request-&gt;save();
return $request;</script>
</scriptTask>
<scriptTask id="Activity_1029zj8" name="createBetCode" scriptFormat="PHP">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_1sjodh6</incoming>
<outgoing>Flow_15forua</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$response = preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,4}$/u\', $request-&gt;lottery_rules,$matches);

throw_if(empty($response), new Exception(\'获取投注号码失败\'));

$request-&gt;current_bet_code_rule = $matches[1];
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_1sjodh6" sourceRef="Activity_1k2wjfy" targetRef="Activity_1029zj8" />
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
<bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
<bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
<omgdc:Bounds x="722" y="202" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="729" y="172" width="22" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Event_00p8isq_di" bpmnElement="Event_00p8isq">
<omgdc:Bounds x="922" y="322" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="931" y="365" width="19" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1t8wh6x_di" bpmnElement="Activity_19dyqqr">
<omgdc:Bounds x="690" y="440" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_0nysfq9_di" bpmnElement="Gateway_0ygumq5" isMarkerVisible="true">
<omgdc:Bounds x="715" y="315" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="748" y="306" width="83" height="27" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_1likk12_di" bpmnElement="Gateway_15h65le" isMarkerVisible="true">
<omgdc:Bounds x="715" y="595" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="775" y="613" width="89" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="690" y="750" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_04pnazf_di" bpmnElement="Activity_1029zj8">
<omgdc:Bounds x="690" y="900" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNEdge id="Flow_1wrzu2u_di" bpmnElement="Flow_1wrzu2u">
<di:waypoint x="740" y="238" />
<di:waypoint x="740" y="315" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="274" width="71" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0a721c8_di" bpmnElement="Flow_0a721c8">
<di:waypoint x="765" y="340" />
<di:waypoint x="922" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="808" y="322" width="72" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19ch7nt_di" bpmnElement="Flow_19ch7nt">
<di:waypoint x="740" y="365" />
<di:waypoint x="740" y="440" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="721" y="400" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1ar6z4o_di" bpmnElement="Flow_1ar6z4o">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="595" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="555" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0s4vlli_di" bpmnElement="Flow_0s4vlli">
<di:waypoint x="715" y="620" />
<di:waypoint x="400" y="620" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="385" y="477" width="61" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1a44leq_di" bpmnElement="Flow_1a44leq">
<di:waypoint x="740" y="645" />
<di:waypoint x="740" y="750" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="708" y="713" width="63" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_15forua_di" bpmnElement="Flow_15forua">
<di:waypoint x="740" y="980" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0mthd3n_di" bpmnElement="Flow_0mthd3n">
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1sjodh6_di" bpmnElement="Flow_1sjodh6">
<di:waypoint x="740" y="830" />
<di:waypoint x="740" y="900" />
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'status' => 1,
                'order' => 0,
                'describe' => NULL,
                'created_at' => '2023-05-10 09:11:08',
                'updated_at' => '2023-05-11 09:57:28',
            ),
            3 => 
            array (
                'id' => 14,
                'title' => 'AAAAA倍投',
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="AAAAA倍投" isExecutable="false">
<extensionElements />
<startEvent id="StartEvent_1y45yut" name="start">
<documentation>Element documentation .......</documentation>
<extensionElements>
<zeebe:ioMapping>
<zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />
</zeebe:ioMapping>
<zeebe:properties>
<zeebe:property name="lottery_id" value="1" />
<zeebe:property name="lottery_option" value="单双" />
<zeebe:property name="base_bet_amount" value="20" />
<zeebe:property name="total_bet_amount" value="1000" />
</zeebe:properties>
</extensionElements>
<outgoing>Flow_1wrzu2u</outgoing>
</startEvent>
<sequenceFlow id="Flow_1wrzu2u" name="Flow_1wrzu2u" sourceRef="StartEvent_1y45yut" targetRef="Gateway_0ygumq5" />
<endEvent id="Event_00p8isq" name="end">
<incoming>Flow_0a721c8</incoming>
</endEvent>
<sequenceFlow id="Flow_0a721c8" name="Flow_0a721c8" sourceRef="Gateway_0ygumq5" targetRef="Event_00p8isq">
<conditionExpression xsi:type="tFormalExpression" language="">//投注金额小于等于0 || 投注金额大于等于截止金额
return \\App\\Help\\Common::lessThanOrEqualTo($request-&gt;bet_total_amount_rules) || \\App\\Help\\Common::greaterOrEqualTo($request-&gt;bet_total_amount_rules,$request-&gt;stop_betting_amount);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_19ch7nt" name="Flow_19ch7nt" sourceRef="Gateway_0ygumq5" targetRef="Activity_19dyqqr" />
<serviceTask id="Activity_19dyqqr" name="GetLotteryDataTask" camunda:delegateExpression="App\\Services\\Tasks\\GetLotteryDataTask">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_19ch7nt</incoming>
<outgoing>Flow_1ar6z4o</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0s4vlli</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_1ar6z4o" name="Flow_1ar6z4o" sourceRef="Activity_19dyqqr" targetRef="Gateway_15h65le" />
<sequenceFlow id="Flow_0s4vlli" name="Flow_0s4vlli" sourceRef="Gateway_15h65le" targetRef="Gateway_0ygumq5" />
<exclusiveGateway id="Gateway_10t4rtn" name="Gateway_10t4rtn">
<incoming>Flow_1a44leq</incoming>
<outgoing>Flow_19pl5zp</outgoing>
<outgoing>Flow_1meev5f</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_1a44leq" name="AAAAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAAAA
function ($request){
return preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{4,}$/u\', $request-&gt;lottery_rules);
}</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_19pl5zp" name="赢" sourceRef="Gateway_10t4rtn" targetRef="Activity_0f97m8m">
<extensionElements>
<zeebe:properties>
<zeebe:property name="win_lose_rules-输" value="/0$/" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">return preg_match(\'/1$/\', $request-&gt;win_lose_rules);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_1meev5f" name="输" sourceRef="Gateway_10t4rtn" targetRef="Activity_1k2wjfy">
<extensionElements>
<zeebe:properties>
<zeebe:property name="win_lose_rules-赢" value="/1$/" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">return preg_match(\'/0$/\', $request-&gt;win_lose_rules);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_1a5lhmw" name="Flow_1a5lhmw" sourceRef="Activity_0f97m8m" targetRef="Activity_1029zj8" />
<sequenceFlow id="Flow_0usdnwm" name="Flow_0usdnwm" sourceRef="Activity_1k2wjfy" targetRef="Activity_1029zj8" />
<sequenceFlow id="Flow_15forua" sourceRef="Activity_1029zj8" targetRef="Activity_0bbkk1o" />
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_15forua</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<exclusiveGateway id="Gateway_15h65le" name="Gateway_15h65le" default="Flow_0s4vlli">
<documentation>SSS</documentation>
<incoming>Flow_1ar6z4o</incoming>
<outgoing>Flow_0s4vlli</outgoing>
<outgoing>Flow_1a44leq</outgoing>
</exclusiveGateway>
<scriptTask id="Activity_0f97m8m" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_19pl5zp</incoming>
<outgoing>Flow_1a5lhmw</outgoing>
<script>//设置投注金额-赢
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_1meev5f</incoming>
<outgoing>Flow_0usdnwm</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;last_bet_amount_rules * 2;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_1029zj8" name="createBetCodeTask" scriptFormat="PHP">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_1a5lhmw</incoming>
<incoming>Flow_0usdnwm</incoming>
<outgoing>Flow_15forua</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$response = preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{4,}$/u\', $request-&gt;lottery_rules,$matches);

throw_if(empty($response), new Exception(\'获取投注号码失败\'));

$request-&gt;current_bet_code_rule = $matches[1];
$request-&gt;save();</script>
</scriptTask>
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
<bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
<bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
<omgdc:Bounds x="722" y="202" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="729" y="172" width="22" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Event_00p8isq_di" bpmnElement="Event_00p8isq">
<omgdc:Bounds x="922" y="322" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="931" y="365" width="19" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1t8wh6x_di" bpmnElement="Activity_19dyqqr">
<omgdc:Bounds x="690" y="440" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_0nysfq9_di" bpmnElement="Gateway_0ygumq5" isMarkerVisible="true">
<omgdc:Bounds x="715" y="315" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="748" y="306" width="83" height="27" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_10t4rtn_di" bpmnElement="Gateway_10t4rtn" isMarkerVisible="true">
<omgdc:Bounds x="715" y="715" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="698" y="772" width="84" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_1likk12_di" bpmnElement="Gateway_15h65le" isMarkerVisible="true">
<omgdc:Bounds x="715" y="595" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="775" y="613" width="89" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_0xougq0_di" bpmnElement="Activity_0f97m8m">
<omgdc:Bounds x="860" y="700" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="540" y="700" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_04pnazf_di" bpmnElement="Activity_1029zj8">
<omgdc:Bounds x="690" y="900" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNEdge id="Flow_1wrzu2u_di" bpmnElement="Flow_1wrzu2u">
<di:waypoint x="740" y="238" />
<di:waypoint x="740" y="315" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="274" width="71" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0a721c8_di" bpmnElement="Flow_0a721c8">
<di:waypoint x="765" y="340" />
<di:waypoint x="922" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="808" y="322" width="72" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19ch7nt_di" bpmnElement="Flow_19ch7nt">
<di:waypoint x="740" y="365" />
<di:waypoint x="740" y="440" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="721" y="400" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1ar6z4o_di" bpmnElement="Flow_1ar6z4o">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="595" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="555" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0s4vlli_di" bpmnElement="Flow_0s4vlli">
<di:waypoint x="715" y="620" />
<di:waypoint x="400" y="620" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="385" y="477" width="61" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1a44leq_di" bpmnElement="Flow_1a44leq">
<di:waypoint x="740" y="645" />
<di:waypoint x="740" y="715" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="738" y="677" width="36" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19pl5zp_di" bpmnElement="Flow_19pl5zp">
<di:waypoint x="765" y="740" />
<di:waypoint x="860" y="740" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="807" y="722" width="12" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1meev5f_di" bpmnElement="Flow_1meev5f">
<di:waypoint x="715" y="740" />
<di:waypoint x="640" y="740" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="672" y="722" width="12" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1a5lhmw_di" bpmnElement="Flow_1a5lhmw">
<di:waypoint x="920" y="780" />
<di:waypoint x="920" y="940" />
<di:waypoint x="790" y="940" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="898" y="857" width="75" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0usdnwm_di" bpmnElement="Flow_0usdnwm">
<di:waypoint x="590" y="780" />
<di:waypoint x="590" y="940" />
<di:waypoint x="690" y="940" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="567" y="857" width="77" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_15forua_di" bpmnElement="Flow_15forua">
<di:waypoint x="740" y="980" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0mthd3n_di" bpmnElement="Flow_0mthd3n">
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'status' => 1,
                'order' => 0,
                'describe' => NULL,
                'created_at' => '2023-05-11 11:17:12',
                'updated_at' => '2023-05-13 12:27:51',
            ),
            4 => 
            array (
                'id' => 15,
                'title' => 'ABAB或者跟投',
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="ABAB或者跟投" isExecutable="false">
<documentation>如果 ABAB 就执行ABAB规则否则执行跟投</documentation>
<extensionElements />
<startEvent id="StartEvent_1y45yut" name="start">
<documentation>Element documentation .......</documentation>
<extensionElements>
<zeebe:ioMapping>
<zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />
</zeebe:ioMapping>
<zeebe:properties>
<zeebe:property name="lottery_id" value="1" />
<zeebe:property name="lottery_option" value="单双" />
<zeebe:property name="base_bet_amount" value="20" />
<zeebe:property name="total_bet_amount" value="1000" />
</zeebe:properties>
</extensionElements>
<outgoing>Flow_1wrzu2u</outgoing>
</startEvent>
<sequenceFlow id="Flow_1wrzu2u" name="Flow_1wrzu2u" sourceRef="StartEvent_1y45yut" targetRef="Gateway_0ygumq5" />
<endEvent id="Event_00p8isq" name="end">
<incoming>Flow_0a721c8</incoming>
</endEvent>
<sequenceFlow id="Flow_0a721c8" name="Flow_0a721c8" sourceRef="Gateway_0ygumq5" targetRef="Event_00p8isq">
<conditionExpression xsi:type="tFormalExpression" language="">//投注金额小于等于0 || 投注金额大于等于截止金额
return \\App\\Help\\Common::lessThanOrEqualTo($request-&gt;bet_total_amount_rules) || \\App\\Help\\Common::greaterOrEqualTo($request-&gt;bet_total_amount_rules,$request-&gt;stop_betting_amount);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_19ch7nt" name="Flow_19ch7nt" sourceRef="Gateway_0ygumq5" targetRef="Activity_19dyqqr" />
<serviceTask id="Activity_19dyqqr" name="GetLotteryDataTask" camunda:delegateExpression="App\\Services\\Tasks\\GetLotteryDataTask">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_19ch7nt</incoming>
<outgoing>Flow_0jhivou</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<exclusiveGateway id="Gateway_10t4rtn" name="Gateway_10t4rtn" default="Flow_0k10k4t">
<incoming>Flow_0jhivou</incoming>
<outgoing>Flow_0k10k4t</outgoing>
<outgoing>Flow_0fhqjnu</outgoing>
</exclusiveGateway>
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_0qy900k</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_14lqzxx</incoming>
<incoming>Flow_0vgmnk1</incoming>
<outgoing>Flow_0qy900k</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_1029zj8" name="createBetCodeTask" scriptFormat="PHP">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_0k10k4t</incoming>
<outgoing>Flow_14lqzxx</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$response = preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])$/u\', $request-&gt;lottery_rules,$matches);

throw_if(empty($response), new Exception(\'获取投注号码失败\'));

$request-&gt;current_bet_code_rule = $matches[1];
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_0jhivou" sourceRef="Activity_19dyqqr" targetRef="Gateway_10t4rtn" />
<sequenceFlow id="Flow_0k10k4t" sourceRef="Gateway_10t4rtn" targetRef="Activity_1029zj8" />
<sequenceFlow id="Flow_0fhqjnu" sourceRef="Gateway_10t4rtn" targetRef="Activity_05ghkdt">
<conditionExpression xsi:type="tFormalExpression" language="PHP">//ABAB
function ($request){
return preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])(?!\\1)([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1\\2$/u\', $request-&gt;lottery_rules);
}</conditionExpression>
</sequenceFlow>
<scriptTask id="Activity_05ghkdt" name="createBetCodeTask">
<incoming>Flow_0fhqjnu</incoming>
<outgoing>Flow_0vgmnk1</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$response = preg_match(\'/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])(?!\\1)([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1\\2$/u\', $request-&gt;lottery_rules,$matches);

throw_if(empty($response), new Exception(\'获取投注号码失败\'));

$request-&gt;current_bet_code_rule = $matches[1];
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_14lqzxx" sourceRef="Activity_1029zj8" targetRef="Activity_1k2wjfy" />
<sequenceFlow id="Flow_0vgmnk1" sourceRef="Activity_05ghkdt" targetRef="Activity_1k2wjfy" />
<sequenceFlow id="Flow_0qy900k" sourceRef="Activity_1k2wjfy" targetRef="Activity_0bbkk1o" />
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
<bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
<bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
<omgdc:Bounds x="722" y="202" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="729" y="172" width="22" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Event_00p8isq_di" bpmnElement="Event_00p8isq">
<omgdc:Bounds x="922" y="322" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="931" y="365" width="19" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1t8wh6x_di" bpmnElement="Activity_19dyqqr">
<omgdc:Bounds x="690" y="440" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_0nysfq9_di" bpmnElement="Gateway_0ygumq5" isMarkerVisible="true">
<omgdc:Bounds x="715" y="315" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="748" y="306" width="83" height="27" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_10t4rtn_di" bpmnElement="Gateway_10t4rtn" isMarkerVisible="true">
<omgdc:Bounds x="715" y="585" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="698" y="645" width="84" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_04pnazf_di" bpmnElement="Activity_1029zj8">
<omgdc:Bounds x="900" y="570" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1lnbzn9_di" bpmnElement="Activity_05ghkdt">
<omgdc:Bounds x="510" y="570" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="700" y="760" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="700" y="1060" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNEdge id="Flow_1wrzu2u_di" bpmnElement="Flow_1wrzu2u">
<di:waypoint x="740" y="238" />
<di:waypoint x="740" y="315" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="274" width="71" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0a721c8_di" bpmnElement="Flow_0a721c8">
<di:waypoint x="765" y="340" />
<di:waypoint x="922" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="808" y="322" width="72" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19ch7nt_di" bpmnElement="Flow_19ch7nt">
<di:waypoint x="740" y="365" />
<di:waypoint x="740" y="440" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="721" y="400" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0mthd3n_di" bpmnElement="Flow_0mthd3n">
<di:waypoint x="700" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0jhivou_di" bpmnElement="Flow_0jhivou">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="585" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0k10k4t_di" bpmnElement="Flow_0k10k4t">
<di:waypoint x="765" y="610" />
<di:waypoint x="900" y="610" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0fhqjnu_di" bpmnElement="Flow_0fhqjnu">
<di:waypoint x="715" y="610" />
<di:waypoint x="610" y="610" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_14lqzxx_di" bpmnElement="Flow_14lqzxx">
<di:waypoint x="950" y="650" />
<di:waypoint x="950" y="800" />
<di:waypoint x="800" y="800" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0vgmnk1_di" bpmnElement="Flow_0vgmnk1">
<di:waypoint x="560" y="650" />
<di:waypoint x="560" y="800" />
<di:waypoint x="700" y="800" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0qy900k_di" bpmnElement="Flow_0qy900k">
<di:waypoint x="750" y="840" />
<di:waypoint x="750" y="1060" />
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'status' => 1,
                'order' => 0,
                'describe' => NULL,
                'created_at' => '2023-05-12 17:16:31',
                'updated_at' => '2023-05-12 17:29:03',
            ),
            5 => 
            array (
                'id' => 17,
                'title' => '随机投注倍投',
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="随机投注倍投" isExecutable="false">
<extensionElements />
<startEvent id="StartEvent_1y45yut" name="start">
<documentation>Element documentation .......</documentation>
<extensionElements>
<zeebe:ioMapping>
<zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />
</zeebe:ioMapping>
<zeebe:properties>
<zeebe:property name="lottery_id" value="1" />
<zeebe:property name="lottery_option" value="单双" />
<zeebe:property name="base_bet_amount" value="20" />
<zeebe:property name="total_bet_amount" value="1000" />
</zeebe:properties>
</extensionElements>
<outgoing>Flow_1wrzu2u</outgoing>
</startEvent>
<sequenceFlow id="Flow_1wrzu2u" name="Flow_1wrzu2u" sourceRef="StartEvent_1y45yut" targetRef="Gateway_0ygumq5" />
<endEvent id="Event_00p8isq" name="end">
<incoming>Flow_0a721c8</incoming>
</endEvent>
<sequenceFlow id="Flow_0a721c8" name="Flow_0a721c8" sourceRef="Gateway_0ygumq5" targetRef="Event_00p8isq">
<conditionExpression xsi:type="tFormalExpression" language="">//投注金额小于等于0 || 投注金额大于等于截止金额
return \\App\\Help\\Common::lessThanOrEqualTo($request-&gt;bet_total_amount_rules) || \\App\\Help\\Common::greaterOrEqualTo($request-&gt;bet_total_amount_rules,$request-&gt;stop_betting_amount);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_19ch7nt" name="Flow_19ch7nt" sourceRef="Gateway_0ygumq5" targetRef="Activity_19dyqqr" />
<serviceTask id="Activity_19dyqqr" name="GetLotteryDataTask" camunda:delegateExpression="App\\Services\\Tasks\\GetLotteryDataTask">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_19ch7nt</incoming>
<outgoing>Flow_1ar6z4o</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_1ar6z4o" name="Flow_1ar6z4o" sourceRef="Activity_19dyqqr" targetRef="Gateway_10t4rtn" />
<exclusiveGateway id="Gateway_10t4rtn" name="Gateway_10t4rtn">
<incoming>Flow_1ar6z4o</incoming>
<outgoing>Flow_19pl5zp</outgoing>
<outgoing>Flow_1meev5f</outgoing>
</exclusiveGateway>
<sequenceFlow id="Flow_19pl5zp" name="赢" sourceRef="Gateway_10t4rtn" targetRef="Activity_0f97m8m">
<extensionElements>
<zeebe:properties>
<zeebe:property name="win_lose_rules-输" value="/0$/" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">return preg_match(\'/1$/\', $request-&gt;win_lose_rules);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_1meev5f" name="输" sourceRef="Gateway_10t4rtn" targetRef="Activity_1k2wjfy">
<extensionElements>
<zeebe:properties>
<zeebe:property name="win_lose_rules-赢" value="/1$/" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">return preg_match(\'/0$/\', $request-&gt;win_lose_rules);</conditionExpression>
</sequenceFlow>
<sequenceFlow id="Flow_1a5lhmw" name="Flow_1a5lhmw" sourceRef="Activity_0f97m8m" targetRef="Activity_1029zj8" />
<sequenceFlow id="Flow_0usdnwm" name="Flow_0usdnwm" sourceRef="Activity_1k2wjfy" targetRef="Activity_1029zj8" />
<sequenceFlow id="Flow_15forua" sourceRef="Activity_1029zj8" targetRef="Activity_0bbkk1o" />
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_15forua</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<scriptTask id="Activity_0f97m8m" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_19pl5zp</incoming>
<outgoing>Flow_1a5lhmw</outgoing>
<script>//设置投注金额-赢
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_1meev5f</incoming>
<outgoing>Flow_0usdnwm</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;last_bet_amount_rules * 2;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_1029zj8" name="createBetCodeTask" scriptFormat="PHP">
<extensionElements>
<camunda:inputOutput />
</extensionElements>
<incoming>Flow_1a5lhmw</incoming>
<incoming>Flow_0usdnwm</incoming>
<outgoing>Flow_15forua</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_code_rule = $request-&gt;requestLotteryOption-&gt;pluck(\'value\')-&gt;random();
$request-&gt;save();</script>
</scriptTask>
</process>
<bpmndi:BPMNDiagram id="BpmnDiagram_1">
<bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">
<bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">
<omgdc:Bounds x="722" y="202" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="729" y="172" width="22" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Event_00p8isq_di" bpmnElement="Event_00p8isq">
<omgdc:Bounds x="922" y="322" width="36" height="36" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="931" y="365" width="19" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1t8wh6x_di" bpmnElement="Activity_19dyqqr">
<omgdc:Bounds x="690" y="440" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_0nysfq9_di" bpmnElement="Gateway_0ygumq5" isMarkerVisible="true">
<omgdc:Bounds x="715" y="315" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="748" y="306" width="83" height="27" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Gateway_10t4rtn_di" bpmnElement="Gateway_10t4rtn" isMarkerVisible="true">
<omgdc:Bounds x="715" y="715" width="50" height="50" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="698" y="772" width="84" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_0xougq0_di" bpmnElement="Activity_0f97m8m">
<omgdc:Bounds x="860" y="700" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="540" y="700" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_04pnazf_di" bpmnElement="Activity_1029zj8">
<omgdc:Bounds x="690" y="900" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNEdge id="Flow_1wrzu2u_di" bpmnElement="Flow_1wrzu2u">
<di:waypoint x="740" y="238" />
<di:waypoint x="740" y="315" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="274" width="71" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0a721c8_di" bpmnElement="Flow_0a721c8">
<di:waypoint x="765" y="340" />
<di:waypoint x="922" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="808" y="322" width="72" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19ch7nt_di" bpmnElement="Flow_19ch7nt">
<di:waypoint x="740" y="365" />
<di:waypoint x="740" y="440" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="721" y="400" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1ar6z4o_di" bpmnElement="Flow_1ar6z4o">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="715" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="720" y="575" width="70" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_19pl5zp_di" bpmnElement="Flow_19pl5zp">
<di:waypoint x="765" y="740" />
<di:waypoint x="860" y="740" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="807" y="722" width="12" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1meev5f_di" bpmnElement="Flow_1meev5f">
<di:waypoint x="715" y="740" />
<di:waypoint x="640" y="740" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="672" y="722" width="12" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1a5lhmw_di" bpmnElement="Flow_1a5lhmw">
<di:waypoint x="920" y="780" />
<di:waypoint x="920" y="940" />
<di:waypoint x="790" y="940" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="898" y="857" width="75" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0usdnwm_di" bpmnElement="Flow_0usdnwm">
<di:waypoint x="590" y="780" />
<di:waypoint x="590" y="940" />
<di:waypoint x="690" y="940" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="567" y="857" width="77" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_15forua_di" bpmnElement="Flow_15forua">
<di:waypoint x="740" y="980" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0mthd3n_di" bpmnElement="Flow_0mthd3n">
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'status' => 1,
                'order' => 0,
                'describe' => NULL,
                'created_at' => '2023-05-17 09:48:10',
                'updated_at' => '2023-05-17 09:50:12',
            ),
        ));
        
        
    }
}