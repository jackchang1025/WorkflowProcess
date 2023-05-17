<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RequestTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('request')->delete();
        
        \DB::table('request')->insert(array (
            0 => 
            array (
                'id' => 11,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小小小大大小大大小小大大小小大小大小小大小小大小大大大小大大小小大大大小小小小小小大大大大小大大大小小大小大大大大小小小大小大大大小大小小小大小大小大小大大大小大大大小小小小小大小小小小大小大大大大小小大大大大小大大小大小大大大小大小小大大大大小小小大大大小小小小大小大大大小大小小大大大小小大大小小小小小大小小大小小小小大小小大小大小大大小小大小大小小小小大小小大小大大大小小小小小大大大小小大大大大大小小大小大小大大小小大大大大大小小大小小小大小大小大大大小大大大小小大小小小大大小小小小小"',
                'lottery_count_rules' => 249,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 379,
                'bet_amount_rules' => ',10,20,10,20,40,80,160,320',
                'stop_betting_amount' => 1500,
                'bet_code_rules' => '小小小小小小大大',
                'bet_count_rules' => 8,
                'win_lose_rules' => '101000000',
                'continuous_lose_count_rules' => 6,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-11 14:58:09',
                'updated_at' => '2023-05-11 14:58:19',
                'total_amount_rules' => 1000.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 640.0,
                'current_issue' => NULL,
                'last_issue' => '32733652',
                'continuous_bet_count' => 8,
            ),
            1 => 
            array (
                'id' => 14,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小大小小大大小大大大小小大大大大小大大大小大大大小小小小小小小大小大小大大小小大大小小小大大大大大小小小大小小大小小小小大小大大小大大小大大大小小小小大大小大小小大小大小小大小大大小小小小小大小大小大大小大小大小小小大大大大大大小小小大大小大小小大大大小大小大小小小小小小大小小小小小大小大小小大小大小大大大小小小大大大小小大小小大大大大小小小小大小小大小大小小小小大小大大大大大大小小大大小大小大大小小小大大大大小大小小小大小大小小大小大小大大大小小大小大大大大大小小小小大小大大小小小大大大小大大大大小大小小大小大大小小大大大大大大小大小大小大小大大小小大小小大小大大大大小小大小小小大小小小大小小大小大小小小大小大小小小小大小小小小大小小小小大大大大小大小大大大大大小大小大大小小大大大大大大大小小大大小小大小小大大大小小大小小大大大小小小大大小小大小小大小小小小大大小大小大小小小小大大小大大大小大大小小大大小小小小大大小小大大小小大大小小小小大小大小大小小小大小小小小大大大大大大小小小小小大小小小小小大小小小大小大小小小大大大小小小小大大小大大小小大小小小小大大大小大大大大小小小小小小大小大小小大大大大大小小大小小大大大大小小小大大大大大小小大大小大大大小小大小大大小大大大大大大小大小大小小小大小小小小小小大大小小大小大小小大小大小小小大大小大小大大小小大小大大小小小小小小大小大大大小大小小大小大大大小小小大小大小大大小大小小小大大大大大小小小大大大小小小小大小小小小小小大小小大大大小小小小大小小大大大小大小小小小大大大小小小大小小小小小小大小小小大大大小小小大大大小小小小大小小大小小小小小小大大小小大大小大小小大大小小小大大大大小小小大大大小大大大大大小小小小大大小小大小大大大大大小大大大小小大大小小大大小小大小小大小大大小小小大大小小大大小大大大大小大小大小大小小大大小大大小大小大大大小小大大大大大大大大大大大大大小大小大大大大大大小小大大小小小大小小小大小小小大小小小小小大小大小大小大小大大小小大大小小小大小小大小小小大大大小大小小大小大大小小大小小小小大大大大小大小小小大大小大小小大小大大小大大小大大大小小小大小小大小小小大小小小小大小大大小小小小小小大小大小小大大小大大小小大大大小小大小大小大大大大大大小小小大小大大大小大小小小小大大小大大大小大大大小小小大大小大大大大大小小大大大大小小大小小大小大小小小小大小大小小大小大小大大小小大大小大小大大大小小小大小大大大大大小小小小大小大小小小大小小小小大小大大小大大小小大小小小小小大大小小小小小大大小大大小大小大大大大大大大大小大大小小大大小小大大大小小大小小小大大大小小大大大大小小大大小小大小小小大小大大大小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小"',
                'lottery_count_rules' => 1658,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1537,
                'bet_amount_rules' => ',10,10,10,20,40,80,10,20,10,20,40,10,20,40,10,20,40,10,10,20,10,20,40,80,10,20,40,80,10,20,10,20,10,20,40,10,20,10,20,10,20,40,80,10,10,10,10,10,10,10,10,20,10,20,40,10,20,10,20,40,80,160,320,10,10,10,20,40,80,160,320,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,20,40,10,10,20,40,80,10,10,10,20,40,80,160,10,10,20,10,20',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大小大大小小小大大大大大大大大大大大小小小小大大大大小小小小大小小小小小小大大大大大大大大大大大大大小小小大大大大小小大大大大小小小大大大大大大小大大大大小大小小小小大大大大小小小小小小小小小小小小小小大',
                'bet_count_rules' => 105,
                'win_lose_rules' => '1110001010010010011010001000101010010101000111111110100101000001110000011110001100001100110001110000110100',
                'continuous_lose_count_rules' => 2,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-12 10:32:50',
                'updated_at' => '2023-05-12 10:33:50',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 20.0,
                'current_issue' => NULL,
                'last_issue' => '32736213',
                'continuous_bet_count' => 105,
            ),
            2 => 
            array (
                'id' => 17,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 1,
                'status' => 'failed',
                'lottery_rules' => '"小大大大小小大大小小大小大小小大大大小小大小小大小大小大小小小小大大小小小小小大大小小大大小大大大大大小大小小大大大大小小小小大小大大大小小大小大大小小小大大小大大小大小小小大大大大小大大大小小小小大小大大小大大大大小大小小大大大大大大大小大大小小小大大小大大大大大小小小小大小大小大小小小大大大大小大小大大小小小大大小小大大小小小大小小小小大小大小大大小小大大大大大小大小大小大大小小大大大大大小小小小大大大大大大大大大大小大大大小小大小小大小小小小大小小大大大小小小大大大小小大大大大大小小大大小小大小大小大大小大小小大大大大小小大小小小大小大小小小小小大小大小大大大小小大大小大小小小小小大大大小小大小小大大小小小大大大小小小大大大小大大小小小小大大大小大大大大小大大小大小大大小小小小大大小大小小小大大小小大大大小小大小大小小小大小小小大小大大大小小小大大大小大小大大大小大大小大大小大大小大小大小小小小小小大小大大小大小小大大大小大小大小小小大小小大小大大大大大小大大大小大大大小大大小小小小大小大小小小小小小小小小大大大大小大小大大大大大小小大小小小小小大小大小大大小大小小大大小小大大小小小小大小小大大大小大大小大小小小小小小小大大小小小大小小大小大大小小大小小小大小小大大大小大小小小小大大大小大大小小小小小大大大小大大大小大大小大大小大小小小大小小大小小大小大大大小大小小大小小大大大小小大小大大小小大小小小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大小小大大小小大大小小大小大大小大小小小小大大小大小大小小小大小小小大小小小大小大小小大大小大大小小大大小大大大大小大小小小大大大小大小小小小小大大大小大小小小小大小大小小大小大大小小小大小大大大小大小小大大小大小小大小小小小小大小小小大大大小大小大大小大小小大大大大大小小小小小小大小小大小小小小大大大小大小大小大大大大大小大大大大大小大小大小大大小小大大小小小小大大大小大小小大大大小大大大大小小小小小大小小小小大小小小大大大小大大大小大小大大大大大大小大大小大小小大大大大小大大大大大大小小大大大小大小小大大大小大大小大小大大小大大大小小大大大小小小小小大大小小小大大大大小大小小小小大小大大小大大大小小小小大大小大小小小大小小小大小大大大小大大小大小小小小大大小大小大小大大小小大小大大大小小小大小小小小小小大大大小小小大大小大小大小大小大大小小小小大小大小大大大大大小大大大小大大大大大小大小小小大大大大大大大大大小小大大小小大小小小小小小大小大小大大小小小小大大大小大小小大小小小大小小大大大小大大小大大大小小小小大小大大小大小小小小小小小大小大小大小大小小小小大小小大小小大小大大小小大大大大大大小大大大小大大小大小大大大小小大大小大小小小小大小小小大大大大大小小大小小小大小小小大小大小小小大小小大大大大大大大小小大大大小小大大大大大小大小小小小大大大小小小小大小大大大小小小大小小大大小小小大小小小小小大小小小小大小小大大大大小小大小小小大大小大大大大大小小小大大小大大小大大小大大小大小小大大大小小大小小大大小小小大小小小小小大大小小小大小小大大小大大大小小大小大大大小小小大大小大小小小大小大小小大小大大大大大大大小大小大大小大大小大小小大小大小小小小小小大小大大大大小小小大大小大大大小大小小小大大大大小小大大大小小小大小大大小大大大大大大小大大大大小小大大小小小大小小大小小小小小小小大小大大小小大小小小大大小大小小大小大小大大小小大大大小大小大小大大大大小小小小大小小大大小小小小大大大大小大小小大大大大小小小大大小小小大小小大大小小大小大大大小大大小小大大小小小小小大小大小小小大小大大小小小大小大大大小大大小大大小小大小大大大小大小小小小大小大大大大大小大小大大小小小小大大大小小小小大小小大小大小大大大大大大大小小小大大大小大大大大小大大大小大小小大大小大大小小大大小小大小小大小大小小大小小大小小大小小大大大小大小小小大大小大小大小大大小小大小小大大大大小大小小大大小小小大小大大大小大大小大大小大小大小小大小小大大大小小小大小小大小小大大大小小大小大大小小大大大小大小小小小小大大大小小大小小小小小大小大小小大大大大大小小小小大小小大大小小小小小小小小小小小大小小大小大大小小大小大小小大小大大小大大小小小大小小小大大小小大大小大小大大小小大大大小小小小大大小小小大小大大小小大小小小小大小小大小大小小小大小大小大小大大大大小小小大大小小大小大大小小大小大小小大大大小大大大大大小小大小大大小大大小大小大大小大大小大小小小小小小大小大小小小小大大小大小大大大小小小小小大大大大小小大小大小大大大大小大小大小大大大小小大大大大大大小大小大大大小小大小小小大小大大小大大小小大大大大小小小大大大大小大大大小大大大小大小小小小小小小小大大小小小小小大大大大小大大小大小小小大大小大大大小大小大大大小小大大大小大小小大小小大小大小大大大小小小小大小小小小大小小大小大大大大大大小大大大小小小大大大大小小小大小小大小大大大大小大小小大大小大小大小大小小小大大大大大大大小小小大大大小小小小小大大小小大小小小大小小小小大大大小大大小大小小大小小大小小小小大大小大大小小大大大小小大小小小小大大小小大小小小小小小大小小小小小小小小大大小大小大大大小小小大大大小大小小大小小小小大小小大小小小小小小大小小大大小大大大大小小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大小大大小大小小小小小小大大小小小小小小小大大小小小大小小小大大大大小小小大小小小大小大小小小大大大小大小大小小大大小大大小大小小大小大小大大小大大小大小小小大大小小大大大小小大小小大小大小大大小大小小大大小小小大大大小小小小小小小大小大小大大大小小小大大大大小小大小大大大大小小大大大大大大大小小大小大小大小大大大小大大大大小大大小大大大小小小小小大小小大大大小小大小小小小大大小小大大大小大小大小大大小小小小大小小大大小小大大大小小大小小大大小大大小小大大大小大大大大小小大大大大大大大大小大大大大小大小大大大小大大大小小大大小小小小小大小大小小小小小大小大小大大小大小小小大大小小大大小小小小小大小大大小小小小大大小大小大小大大大大大大小小大小大小大小小小大小小小大大大小大小小大大小大大小大小大"',
                'lottery_count_rules' => 3440,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1000,
                'bet_amount_rules' => NULL,
                'stop_betting_amount' => 1700,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-12 11:11:15',
                'updated_at' => '2023-05-15 10:55:59',
                'total_amount_rules' => 1000.0,
                'title' => '死循环获取开奖信息',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => NULL,
                'current_issue' => NULL,
                'last_issue' => '32739687',
                'continuous_bet_count' => 0,
            ),
            3 => 
            array (
                'id' => 18,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小大小小大大小大大大小小大大大大小大大大小大大大小小小小小小小大小大小大大小小大大小小小大大大大大小小小大小小大小小小小大小大大小大大小大大大小小小小大大小大小小大小大小小大小大大小小小小小大小大小大大小大小大小小小大大大大大大小小小大大小大小小大大大小大小大小小小小小小大小小小小小大小大小小大小大小大大大小小小大大大小小大小小大大大大小小小小大小小大小大小小小小大小大大大大大大小小大大小大小大大小小小大大大大小大小小小大小大小小大小大小大大大小小大小大大大大大小小小小大小大大小小小大大大小大大大大小大小小大小大大小小大大大大大大小大小大小大小大大小小大小小大小大大大大小小大小小小大小小小大小小大小大小小小大小大小小小小大小小小小大小小小小大大大大小大小大大大大大小大小大大小小大大大大大大大小小大大小小大小小大大大小小大小小大大大小小小大大小小大小小大小小小小大大小大小大小小小小大大小大大大小大大小小大大小小小小大大小小大大小小大大小小小小大小大小大小小小大小小小小大大大大大大小小小小小大小小小小小大小小小大小大小小小大大大小小小小大大小大大小小大小小小小大大大小大大大大小小小小小小大小大小小大大大大大小小大小小大大大大小小小大大大大大小小大大小大大大小小大小大大小大大大大大大小大小大小小小大小小小小小小大大小小大小大小小大小大小小小大大小大小大大小小大小大大小小小小小小大小大大大小大小小大小大大大小小小大小大小大大小大小小小大大大大大小小小大大大小小小小大小小小小小小大小小大大大小小小小大小小大大大小大小小小小大大大小小小大小小小小小小大小小小大大大小小小大大大小小小小大小小大小小小小小小大大小小大大小大小小大大小小小大大大大小小小大大大小大大大大大小小小小大大小小大小大大大大大小大大大小小大大小小大大小小大小小大小大大小小小大大小小大大小大大大大小大小大小大小小大大小大大小大小大大大小小大大大大大大大大大大大大大小大小大大大大大大小小大大小小小大小小小大小小小大小小小小小大小大小大小大"',
                'lottery_count_rules' => 860,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1300,
                'bet_amount_rules' => ',10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10',
                'stop_betting_amount' => 1300,
                'bet_code_rules' => '小小大小小大大小大大大小小大大大大小大大大小大大大小小小小小小小大小小大小大小小大大小小小大大大大大小小小大小小大小小小小大小小大小大大小大大大小小小小大大小大大小大小小大小大小小大小小小小小大小小大小大小大大小大小小大大大大大大小小小大大小大大小大大大小大大小大小小小小小大小小小小小大小小大小大小小大小大大小小小大大大小小大小小大大大大小小小小大小小大小小大小小小大小小大大大大大小小大大小大大小大小小小大大大大小大大小小大小小大小大小小大小大大小小大小小大大大大小小小小大小小大小小小大大大小大大大大小大大小大小小大小小大大大大大大小大大小大小大小大小小大小小大小小大大大小小大小小小大小小小大小小大小小大小小大小小大小小小大小小小小大小小小小大大大大小大大小大大大大小大大小大小小大大大大大大大小小大大小小大小小大大大小小大小小大大大小小小大大小小大小小大小小小小大大小大大小大小小小大大小大大大小大大小小大大小小小小大大小小大大小小大大小小小小大小小大小大小小大小小小小大大大大大大小小小小小大小小小小小大小小小大小小大小小大大大小小小小大大小大大小小大小小小小大大大小大大大大小小小小小小大小小大小大大大大大小小大小小大大大大小小小大大大大大小小大大小大大大小小大小小大小大大大大大大小大大小大小小大小小小小小小大大小小大小小大小大小小大小小大大小大大小大小小大小小大小小小小小小大小小大大小大大小大小小大大小小小大小小大小大小大大小小大大大大大小小小大大大小小小小大小小小小小小大小小大大大小小小小大小小大大大小大大小小小大大大小小小大小小小小小小大小小小大大大小小小大大大小小小小大小小大小小小小小小大大小小大大小大大小大大小小小大大大大小小小大大大小大大大大大小小小小大大小小大小小大大大大小大大大小小大大小小大大小小大小小大小小大小小小大大小小大大小大大大大小大大小大小大小大大小大大小大大小大大小小大大大大大大大大大大大大大小大大小大大大大大小小大大小小小大小小小大小小小大小小小小小大小小大小大小',
                'bet_count_rules' => 860,
                'win_lose_rules' => '11001010011010111001100110111111000110010101101111011001001110000001001101110100000001000000111100011000011010111110110100000110001101111001111000100001101011011010010111011100100010110000111101010001001101110000100010000110101000011101110000011011001110000000001011111000111110010010000110100110011001000101000101100111001110111000101110001001011111101010100101101001011011010100100111010001101101001100101010111010101010101110001110100111011111011110011110011000101011011101001010011101100111011111000100111101001011101101111010100110100000011111000110100111110101000100001010100010010000011111000010000000010110001100000101111011011011100111110010110111001011000011011011001111100110110110110111001001111101010100000101101110110110011110111010100001110011010101010100100000110101010011100011110010010001010101111111111110001011110101011001100110011110001111',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 4,
                'created_at' => '2023-05-12 17:31:03',
                'updated_at' => '2023-05-12 17:32:09',
                'total_amount_rules' => 1000.0,
                'title' => 'ABAB或者跟投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32735415',
                'continuous_bet_count' => 860,
            ),
            4 => 
            array (
                'id' => 19,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小大小小大大小大大大小小大大大大小大大大小大大大小小小小小小小大小大小大大小小大大小小小大大大大大小小小大小小大小小小小大小大大小大大小大大大小小小小大大小大小小大小大小小大小大大小小小小小大小大小大大小大小大小小小大大大大大大小小小大大小大小小大大大小大小大小小小小小小大小小小小小大小大小小大小大小大大大小小小大大大小小大小小大大大大小小小小大小小大小大小小小小大小大大大大大大小小大大小大小大大小小小大大大大小大小小小大小大小小大小大小大大大小小大小大大大大大小小小小大小大大小小小大大大小大大大大小大小小大小大大小小大大大大大大小大小大小大小大大小小大小小大小大大大大小小大小小小大小小小大小小大小大小小小大小大小小小小大小小小小大小小小小大大大大小大小大大大大大小大小大大小小大大大大大大大小小大大小小大小小大大大小小大小小大大大小小小大大小小大小小大小小小小大大小大小大小小小小大大小大大大小大大小小大大小小小小大大小小大大小小大大小小小小大小大小大小小小大小小小小大大大大大大小小小小小大小小小小小大小小小大小大小小小大大大小小小小大大小大大小小大小小小小大大大小大大大大小小小小小小大小大小小大大大大大小小大小小大大大大小小小大大大大大小小大大小大大大小小大小大大小大大大大大大小大小大小小小大小小小小小小大大小小大小大小小大小大小小小大大小大小大大小小大小大大小小小小小小大小大大大小大小小大小大大大小小小大小大小大大小大小小小大大大大大小小小大大大小小小小大小小小小小小大小小大大大小小小小大小小大大大小大小小小小大大大小小小大小小小小小小大小小小大大大小小小大大大小小小小大小小大小小小小小小大大小小大大小大小小大大小小小大大大大小小小大大大小大大大大大小小小小大大小小大小大大大大大小大大大小小大大小小大大小小大小小大小大大小小小大大小小大大小大大大大小大小大小大小小大大小大大小大小大大大小小大大大大大大大大大大大大大小大小大大大大大大小小大大小小小大小小小大小小小大小小小小小大小大小大小大小大大小小大大小小小大小小大小小小大大大小大小小大小大大小小大小小小小大大大大小大小小小大大小大小小大小大大小大大小大大大小小小大小小大小小小大小小小小大小大大小小小小小小大小大小小大大小大大小小大大大小小大小大小大大大大大大小小小大小大大大小大小小小小大大小大大大小大大大小小小大大小大大大大大小小大大大大小小大小小大小大小小小小大小大小小大小大小大大小小大大小大小大大大小小小大小大大大大大小小小小大小大小小小大小小小小大小大大小大大小小大小小小小小大大小小小小小大大小大大小大小大大大大大大大大小大大小小大大小小大大大小小大小小小大大大小小大大大大小小大大小小大小小小大小大大大小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小大小小大小小大小大小大小大大大大大大大大大小大小小大大小大大大小小小大大大小小大大小小大小大小小大大大小小大小小大小大小大小小小小大大小小小小小大大小小大大小大大大大大小大小小大大大大小小小小大小大大大小小大小大大小小小大大小大大小大小小小大大大大小大大大小小小小大小大大小大大大大小大小小大大大大大大大小大大小小小大大小大大大大大小小小小大小大小大小小小大大大大小大小大大小小小大大小小大大小小小大小小小小大小大小大大小小大大大大大小大小大小大大小小大大大大大小小小小大大大大大大大大大大小大大大小小大小小大小小小小大小小大大大小小小大大大小小大大大大大小小大大小小大小大小大大小大小小大大大大小小大小小小大小大小小小小小大小大小大大大小小大大小大小小小小小大大大小小大小小大大小小小大"',
                'lottery_count_rules' => 2003,
                'bet_base_amount_rules' => 20,
                'bet_total_amount_rules' => 974,
                'bet_amount_rules' => ',20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20',
                'stop_betting_amount' => 1500,
                'bet_code_rules' => '小小大小小大大小大大大小小大大大大小大大大小大大大小小小小小小小大小小大小大小小大大小小小大大大大大小小小大小小大小小小小大小小大小大大小大大大小小小小大大小大大小大小小大小大小小大小小小小小大小小大小大小大大小大小小大大大大大大小小小大大小大大小大大大小大大小大小小小小小大小小小小小大小小大小大小小大小大大小小小大大大小小大小小大大大大小小小小大小小大小小大小小小大小小大大大大大小小大大小大大小大小小小大大大大小大大小小大小小大小大小小大小大大小小大小小大大大大小小小小大小小大小小小大大大小大大大大小大大小大小小大小小大大大大大大小大大小大小大小大小小大小小大小小大大大小小大小小小大小小小大小小大小小大小小大小小大小小小大小小小小大小小小小大大大大小大大小大大大大小大大小大小小大大大大大大大小小大大小小大小小大大大小小大小小大大大小小小大大小小大小小大小小小小大大小大大小大小小小大大小大大大小大大小小大大小小小小大大小小大大小小大大小小小小大小小大小大小小大小小小小大大大大大大小小小小小大小小小小小大小小小大小小大小小大大大小小小小大大小大大小小大小小小小大大大小大大大大小小小小小小大小小大小大大大大大小小大小小大大大大小小小大大大大大小小大大小大大大小小大小小大小大大大大大大小大大小大小小大小小小小小小大大小小大小小大小大小小大小小大大小大大小大小小大小小大小小小小小小大小小大大小大大小大小小大大小小小大小小大小大小大大小小大大大大大小小小大大大小小小小大小小小小小小大小小大大大小小小小大小小大大大小大大小小小大大大小小小大小小小小小小大小小小大大大小小小大大大小小小小大小小大小小小小小小大大小小大大小大大小大大小小小大大大大小小小大大大小大大大大大小小小小大大小小大小小大大大大小大大大小小大大小小大大小小大小小大小小大小小小大大小小大大小大大大大小大大小大小大小大大小大大小大大小大大小小大大大大大大大大大大大大大小大大小大大大大大小小大大小小小大小小小大小小小大小小小小小大小小大小大小大小大小小大大小小小大小小大小小小大大大小大大小大小小大小小大小小小小大大大大小大大小小大大小大大小大小小大小大大小大大大小小小大小小大小小小大小小小小大小小大小小小小小小大小小大小大大小大大小小大大大小小大小小大小大大大大大小小小大小小大大小大大小小小大大小大大大小大大大小小小大大小大大大大大小小大大大大小小大小小大小小大小小小大小小大小大小小大小大小小大大小大大小大大小小小大小小大大大大小小小小大小小大小小大小小小小大小小大小大大小小大小小小小小大大小小小小小大大小大大小大大小大大大大大大大小大大小小大大小小大大大小小大小小小大大大小小大大大大小小大大小小大小小小大小小大大小小小大大大小大大小大大小大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小小大小小小小大小小大小小大小小小小小大大大小小小大大大大大小大大小大小大大小小大小小大大小大大小大大小大大小大大小大小大小大大大大大大大大小大大小大小大小大大小大大大小小大小小大小小小小小大小小大小小大小大大小大大大大大小大大小大小大小小大大小小大小小大小大小大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小小大大小大大大大大大大小大大小小小大小小大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小小大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小小大小大大小大大小小小大小小大大小大大小大小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小小大小小大大大小大大小小大大大小大大小小小小小大小小大小大大小大大小大大小小小大大大小小小大小小小小小大小小大小大小大小小小小大大大大小大大小大大小大大大小小小小小小小小大小小小小小大小小大小小小小大大小小小小小大小小小小小大大大小大大小大大小大大小小小小小小大小小大小大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小大小小大小小大小小大小大小大大大大大大大大小大大小大大小大大大小小小大大大小小大大小小大小小大小大大大小小大小小大小小大小大小小小大大小小小小小大大小小大大小大大大大大小大大小大大大大小小小小大小小大大小小大小小大小小小大大小大大小大大小小大大大大小大大大小小小小大小小大小大大大大小大大小大大大大大大大小大大小小小大大小大大大大大小小小小大小小大小大小小大大大大小大大小大小小小大大小小大大小小小大小小小小大小小大小大小小大大大大大小大大小大小大小小大大大大大小小小小大大大大大大大大大大小大大大小小大小小大小小小小大小小大大大小小小大大大小小大大大大大小小大大小小大小小大小大小大大小大大大大小小大小小小大小小大小小小小大小小大小大大小小大大小大大小小小小大大大小小大小小大大小小小',
                'bet_count_rules' => 2002,
                'win_lose_rules' => '11001010011010111001100110111111000110010101101111011001001110000001001101110100000001000000111100011000011010111110110100000110001101111001111000100001101011011010010111011100100010110000111101010001001101110000100010000110101000011101110000011011001110000000001011111000111110010010000110100110011001000101000101100111001110111000101110001001011111101010100101101001011011010100100111010001101101001100101010111010101010101110001110100111011111011110011110011000101011011101001010011101100111011111000100111101001011101101111010100110100000011111000110100111110101000100001010100010010000011111000010000000010110001100000101111011011011100111110010110111001011000011011011001111100110110110110111001001111101010100000101101110110110011110111010100001110011010101010100100000110101010011100011110010010001010101111111111110001011110101011001100110011110001111110010101100100110110000000001001110111000010100000000001001101100100110011100000111110001001001010110100011011110110000100001101001100110110100111101011101001000101100010000110010100010101100001110111000101001110000001010011110101111010010001011111100101010101101001101101011101010100110000101101100100010101001010010101011101110111100010111001001001111011011011110001000001001010010000010001111101111111000111000010110100100111100100000000011110001111010101000111101101100110101011011101101110000100111111001011000000110111100101100100101001110000111001011110110111111010010111000110100001100001000110011110010100101111110011010010001010110000101100101111000000010100101101101100111100011100011101110010000011011111110011110000011101011110011110110010010000111110001100110011010100111110111101001100100100011110111111100000100110110110101010001001101001000111011010111101010100111100000111011100001010000011010010000101110011011100000011100000111111001011010011110111000111010111000100110101010110011100011001011110001110010111101110111111111001101001001110010110110110101111010101000110000001110100110001011100011010101000011101101001010110',
                'continuous_lose_count_rules' => 1,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-12 17:43:44',
                'updated_at' => '2023-05-12 17:46:15',
                'total_amount_rules' => 1000.0,
                'title' => 'ABAB或者跟投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 20.0,
                'current_issue' => NULL,
                'last_issue' => '32736558',
                'continuous_bet_count' => 2002,
            ),
            5 => 
            array (
                'id' => 20,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小大小小大大小大大大小小大大大大小大大大小大大大小小小小小小小大小大小大大小小大大小小小大大大大大小小小大小小大小小小小大小大大小大大小大大大小小小小大大小大小小大小大小小大小大大小小小小小大小大小大大小大小大小小小大大大大大大小小小大大小大小小大大大小大小大小小小小小小大小小小小小大小大小小大小大小大大大小小小大大大小小大小小大大大大小小小小大小小大小大小小小小大小大大大大大大小小大大小大小大大小小小大大大大小大小小小大小大小小大小大小大大大小小大小大大大大大小小小小大小大大小小小大大大小大大大大小大小小大小大大小小大大大大大大小大小大小大小大大小小大小小大小大大大大小小大小小小大小小小大小小大小大小小小大小大小小小小大小小小小大小小小小大大大大小大小大大大大大小大小大大小小大大大大大大大小小大大小小大小小大大大小小大小小大大大小小小大大小小大小小大小小小小大大小大小大小小小小大大小大大大小大大小小大大小小小小大大小小大大小小大大小小小小大小大小大小小小大小小小小大大大大大大小小小小小大小小小小小大小小小大小大小小小大大大小小小小大大小大大小小大小小小小大大大小大大大大小小小小小小大小大小小大大大大大小小大小小大大大大小小小大大大大大小小大大小大大大小小大小大大小大大大大大大小大小大小小小大小小小小小小大大小小大小大小小大小大小小小大大小大小大大小小大小大大小小小小小小大小大大大小大小小大小大大大小小小大小大小大大小大小小小大大大大大小小小大大大小小小小大小小小小小小大小小大大大小小小小大小小大大大小大小小小小大大大小小小大小小小小小小大小小小大大大小小小大大大小小小小大小小大小小小小小小大大小小大大小大小小大大小小小大大大大小小小大大大小大大大大大小小小小大大小小大小大大大大大小大大大小小大大小小大大小小大小小大小大大小小小大大小小大大小大大大大小大小大小大小小大大小大大小大小大大大小小大大大大大大大大大大大大大小大小大大大大大大小小大大小小小大小小小大小小小大小小小小小大小大小大小大小大大小小大大小小小大小小大小小小大大大小大小小大小大大小小大小小小小大大大大小大小小小大大小大小小大小大大小大大小大大大小小小大小小大小小小大小小小小大小大大小小小小小小大小大小小大大小大大小小大大大小小大小大小大大大大大大小小小大小大大大小大小小小小大大小大大大小大大大小小小大大小大大大大大小小大大大大小小大小小大小大小小小小大小大小小大小大小大大小小大大小大小大大大小小小大小大大大大大小小小小大小大小小小大小小小小大小大大小大大小小大小小小小小大大小小小小小大大小大大小大小大大大大大大大大小大大小小大大小小大大大小小大小小小大大大小小大大大大小小大大小小大小小小大小大大大小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小小大小小大大小大大大小小大大大大小大大大小大大大小小小小小小小大小大小大大小小大大小小小大大大大大小小小大小小大小小小小大小大大小大大小大大大小小小小大大小大小小大小大小小大小大大小小小小小大小大小大大小大小大小小小大大大大大大小小小大大小大小小大大大小大小大小小小小小小大小小小小小大小大小小大小大小大大大小小小大大大小小大小小大大大大小小小小大小小大小大小小小小大小大大大大大大小小大大小大小大大小小小大大大大小大小小小大小大小小大小大小大大大小小大小大大大大大小小小小大小大大小小小大大大小大大大大小大小小大小大大小小大大大大大大小大小大小大小大大小小大小小大小大大大大小小大小小小大小小小大小小大小大小小小大小大小小小小大小小小小大小小小小大大大大小大小大大大大大小大小大大小小大大大大大大大小小大大小小大小小大大大小小大小小大大大小小小大大小小大小小大小小小小大大小大小大小小小小大大小大大大小大大小小大大小小小小大大小小大大小小大大小小小小大小大小大小小小大小小小小大大大大大大小小小小小大小小小小小大小小小大小大小小小大大大小小小小大大小大大小小大小小小小大大大小大大大大小小小小小小大小大小小大大大大大小小大小小大大大大小小小大大大大大小小大大小大大大小小大小大大小大大大大大大小大小大小小小大小小小小小小大大小小大小大小小大小大小小小大大小大小大大小小大小大大小小小小小小大小大大大小大小小大小大大大小小小大小大小大大小大小小小大大大大大小小小大大大小小小小大小小小小小小大小小大大大小小小小大小小大大大小大小小小小大大大小小小大小小小小小小大小小小大大大小小小大大大小小小小大小小大小小小小小小大大小小大大小大小小大大小小小大大大大小小小大大大小大大大大大小小小小大大小小大小大大大大大小大大大小小大大小小大大小小大小小大小大大小小小大大小小大大小大大大大小大小大小大小小大大小大大小大小大大大小小大大大大大大大"',
                'lottery_count_rules' => 2475,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1705,
                'bet_amount_rules' => ',10,10,10,20,40,80,10,20,10,20,40,10,20,40,10,20,40,10,10,20,10,20,40,80,10,20,40,80,10,20,10,20,10,20,40,10,20,10,20,10,20,40,80,10,10,10,10,10,10,10,10,20,10,20,40,10,20,10,20,40,80,160,320,10,10,10,20,40,80,160,320,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,20,40,10,10,20,40,80,10,10,10,20,40,80,160,10,10,20,10,20,40,10,10,20,40,80,10,20,10,20,40,10,20,40,10,20,40,10,10,20,10,20,40,80,10,20,40,80,10,20,10,20,10,20,40,10,20,10,20,10,20,40,80,10,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大小大大小小小大大大大大大大大大大大小小小小大大大大小小小小大小小小小小小大大大大大大大大大大大大大小小小大大大大小小大大大大小小小大大大大大大小大大大大小大小小小小大大大大小小小小小小小小小小小小小小大小小小大小大大小小小大大大大大大大大大大大小小小小大大大大小小小小大小小小小小小大大大大大',
                'bet_count_rules' => 150,
                'win_lose_rules' => '111000101001001001101000100010101001010100011111111010010100000111000001111000110000110011000111000011010011000101001001001101000100010101001010100011',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 2,
                'created_at' => '2023-05-12 23:00:03',
                'updated_at' => '2023-05-12 23:00:36',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32735372',
                'continuous_bet_count' => 150,
            ),
            6 => 
            array (
                'id' => 21,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小大小小大小小大小大小大小大大大大大大大大大小大小小大大小大大大小小小大大大小小大大小小大小大小小大大大小小大小小大小大小大小小小小大大小小小小小大大小小大大小大大大大大小大小小大大大大小小小小大小大大大小小大小大大小小小大大小大大小大小小小大大大大小大大大小小小小大小大大小大大大大小大小小大大大大大大大"',
                'lottery_count_rules' => 659,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1706,
                'bet_amount_rules' => '0,10,20,40,80,160,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,20,40,10,10,20,40,80,10,10,10,20,40,80,160,10,10,20,10,20,40,10,10,10,10,20,40,80,10,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大大大大大大小大大大大小大小小小小大大大大小小小小小小小小小小小小小小大大大大大大小大大大大',
                'bet_count_rules' => 49,
                'win_lose_rules' => '1000011110001100001100110001110000110100111100011',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 2,
                'created_at' => '2023-05-13 12:04:30',
                'updated_at' => '2023-05-13 12:05:00',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => '',
                'last_issue' => '32736366',
                'continuous_bet_count' => 49,
            ),
            7 => 
            array (
                'id' => 22,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小大小小大小小大小大小大小大大大大大大大大大小大小小大大小大大大小小小大大大小小大大小小大小大小小大大大小小大小小大小大小大小小小小大大小小小小小大大小小大大小大大大大大小大小小大大大大小小小小大小大大大小小大小大大小小小大大小大大小大小小小大大大大小大大大小小小小大小大大小大大大大小大小小大大大大大大大小大大小小小大大小大大大大大小小小小大小大小大小小小大大大大小大小大大小小小大大小小大大小小小大小小小小大小大小大大小小大大大大大小大小大小大大小小大大大大大小小小小大大大大大大大大大大小大大大小小大小小大小小小小大小小大大大小小小大大大小小大大大大大小小大大小小大小大小大大小大小小大大大大小小大小小小大小大小小小小小大小大小大大大小小大大小大小小小小小大大大小小大小小大大小小小大大大小小小大大大小大大小小小小大大大小大大大大小大大小大小大大小小小小大大小大小小小大大小小大大大小小大小大小小小大小小小大小大大大小小小大大大小大小大大大小大大小大大小大大小大小大小小小小小小大小大大小大小小大大大小大小大小小小大小小大小大大大大大小大大大小大大大小大大小小小小大小大小小小小小小小小小大大大大小大小大大大大大小小大小小小小小大小大小大大小大小小大大小小大大小小小小大小小大大大小大大小大小小小小小小小大大小小小大小小大小大大小小大小小小大小小大大大小大小小小小大大大小大大小小小小小大大大小大大大小大大小大大小大小小小大小小大小小大小大大大小大小小大小小大大大小小大小大大小小大小小小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大"',
                'lottery_count_rules' => 1733,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1692,
                'bet_amount_rules' => '0,10,20,40,80,160,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,20,40,10,10,20,40,80,10,10,10,20,40,80,160,10,10,20,10,20,40,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,20,40,80,160,10,20,40,10,10,10,10,20,40,80,10,10,20,40,10,20,40,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大大大大大大小大大大大小大小小小小大大大大小小小小小小小小小小小小小小大大大大大大小大大大大大大大大大大大大大大小小小小大小小小小小大小小小小小小小大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大',
                'bet_count_rules' => 122,
                'win_lose_rules' => '100001111000110000110011000111000011010011110001100001111100001001111000110010010100010101100100110001111011100101101011110',
                'continuous_lose_count_rules' => 1,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-13 12:06:45',
                'updated_at' => '2023-05-13 12:07:58',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => '',
                'last_issue' => '32737440',
                'continuous_bet_count' => 122,
            ),
            8 => 
            array (
                'id' => 23,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小大小小大小小大小大小大小大大大大大大大大大小大小小大大小大大大小小小大大大小小大大小小大小大小小大大大小小大小小大小大小大小小小小大大小小小小小大大小小大大小大大大大大小大小小大大大大小小小小大小大大大小小大小大大小小小大大小大大小大小小小大大大大小大大大小小小小大小大大小大大大大小大小小大大大大大大大小大大小小小大大小大大大大大小小小小大小大小大小小小大大大大小大小大大小小小大大小小大大小小小大小小小小大小大小大大小小大大大大大小大小大小大大小小大大大大大小小小小大大大大大大大大大大小大大大小小大小小大小小小小大小小大大大小小小大大大小小大大大大大小小大大小小大小大小大大小大小小大大大大小小大小小小大小大小小小小小大小大小大大大小小大大小大小小小小小大大大小小大小小大大小小小大大大小小小大大大小大大小小小小大大大小大大大大小大大小大小大大小小小小大大小大小小小大大小小大大大小小大小大小小小大小小小大小大大大小小小大大大小大小大大大小大大小大大小大大小大小大小小小小小小大小大大小大小小大大大小大小大小小小大小小大小大大大大大小大大大小大大大小大大小小小小大小大小小小小小小小小小大大大大小大小大大大大大小小大小小小小小大小大小大大小大小小大大小小大大小小小小大小小大大大小大大小大小小小小小小小大大小小小大小小大小大大小小大小小小大小小大大大小大小小小小大大大小大大小小小小小大大大小大大大小大大小大大小大小小小大小小大小小大小大大大小大小小大小小大大大小小大小大大小小大小小小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大"',
                'lottery_count_rules' => 1836,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1703,
                'bet_amount_rules' => '0,10,20,40,80,160,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,20,40,10,10,20,40,80,10,10,10,20,40,80,160,10,10,20,10,20,40,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,20,40,80,160,10,20,40,10,10,10,10,20,40,80,10,10,20,40,10,20,40,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10,20,40,80,160,10,20,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大大大大大大小大大大大小大小小小小大大大大小小小小小小小小小小小小小小大大大大大大小大大大大大大大大大大大大大大小小小小大小小小小小大小小小小小小小大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大小大大小小大大',
                'bet_count_rules' => 129,
                'win_lose_rules' => '100001111000110000110011000111000011010011110001100001111100001001111000110010010100010101100100110001111011100101101011110000101',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 1,
                'created_at' => '2023-05-13 20:28:44',
                'updated_at' => '2023-05-13 20:30:00',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => '',
                'last_issue' => '32737543',
                'continuous_bet_count' => 129,
            ),
            9 => 
            array (
                'id' => 24,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 1,
                'status' => 'running',
                'lottery_rules' => '"大小大小小小大小小小大小大大大小大大小大小小小小大大小大小大小大大小小大小大大大小小小大小小小小小小"',
                'lottery_count_rules' => 50,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1200,
                'bet_amount_rules' => NULL,
                'stop_betting_amount' => 1700,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-13 20:38:23',
                'updated_at' => '2023-05-13 23:47:51',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32737995',
                'continuous_bet_count' => 0,
            ),
            10 => 
            array (
                'id' => 25,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小大小小大小小大小大小大小大大大大大大大大大小大小小大大小大大大小小小大大大小小大大小小大小大小小大大大小小大小小大小大小大小小小小大大小小小小小大大小小大大小大大大大大小大小小大大大大小小小小大小大大大小小大小大大小小小大大小大大小大小小小大大大大小大大大小小小小大小大大小大大大大小大小小大大大大大大大小大大小小小大大小大大大大大小小小小大小大小大小小小大大大大小大小大大小小小大大小小大大小小小大小小小小大小大小大大小小大大大大大小大小大小大大小小大大大大大小小小小大大大大大大大大大大小大大大小小大小小大小小小小大小小大大大小小小大大大小小大大大大大小小大大小小大小大小大大小大小小大大大大小小大小小小大小大小小小小小大小大小大大大小小大大小大小小小小小大大大小小大小小大大小小小大大大小小小大大大小大大小小小小大大大小大大大大小大大小大小大大小小小小大大小大小小小大大小小大大大小小大小大小小小大小小小大小大大大小小小大大大小大小大大大小大大小大大小大大小大小大小小小小小小大小大大小大小小大大大小大小大小小小大小小大小大大大大大小大大大小大大大小大大小小小小大小大小小小小小小小小小大大大大小大小大大大大大小小大小小小小小大小大小大大小大小小大大小小大大小小小小大小小大大大小大大小大小小小小小小小大大小小小大小小大小大大小小大小小小大小小大大大小大小小小小大大大小大大小小小小小大大大小大大大小大大小大大小大小小小大小小大小小大小大大大小大小小大小小大大大小小大小大大小小大小小小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大"',
                'lottery_count_rules' => 1836,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1703,
                'bet_amount_rules' => '0,10,20,40,80,160,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,20,40,10,10,20,40,80,10,10,10,20,40,80,160,10,10,20,10,20,40,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,20,40,80,160,10,20,40,10,10,10,10,20,40,80,10,10,20,40,10,20,40,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10,20,40,80,160,10,20,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大大大大大大小大大大大小大小小小小大大大大小小小小小小小小小小小小小小大大大大大大小大大大大大大大大大大大大大大小小小小大小小小小小大小小小小小小小大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大小大大小小大大',
                'bet_count_rules' => 129,
                'win_lose_rules' => '100001111000110000110011000111000011010011110001100001111100001001111000110010010100010101100100110001111011100101101011110000101',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 1,
                'created_at' => '2023-05-13 23:00:03',
                'updated_at' => '2023-05-13 23:01:21',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => '',
                'last_issue' => '32737543',
                'continuous_bet_count' => 129,
            ),
            11 => 
            array (
                'id' => 26,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小小大大大小大大小大小大大大小小大小小大大小大大小小大大小小小小大大大大小小小小小大小大小小小小小大小小大小小大小小小小小大大大小小小大大大大大小大小大大小大小小小大小小大大小大大小大小小大大小大小大小大小大大大大大大大大大小大小大小大大小大小大大大大小小大小小大小小小小小大小小大小大大小大小小大大大大大小大小大小大小小小大大小小大小大小大小大大大大小小小大小小小大大小小大大大小小小小大大大小小小小大小大大大小大大大大大大大小大大小小小大小大大小大大大小小小小小大小小大大大小大大小大大小小大小小小小大小大大大大大小大大小小小小小大大大小小小小小小小大大小大大小小小小大小大小大大大小大小小小小大小大大大小大小大小小大大大大大小大大小小大小小大大大大大大大小大大大小小大小小大小大小小小大大大小大小小小大大大小大大小小小小小大小大大小大小大大大小大大小小小大大大小小小大小小小小小大小大小大小小大小小小小大大大大小大大小大小小大大大小小小小小小小小大小小小小小大小大大小小小小大大小小小小小大小小小小小大大大小大大小大大小大小小小小小小小大小大小大大小小小大小小小大大小小大小小小小小小大大大大大小小大小小小大小小大小小大小大小大小大大大大大大大大大小大小小大大小大大大小小小大大大小小大大小小大小大小小大大大小小大小小大小大小大小小小小大大小小小小小大大小小大大小大大大大大小大小小大大大大小小小小大小大大大小小大小大大小小小大大小大大小大小小小大大大大小大大大小小小小大小大大小大大大大小大小小大大大大大大大小大大小小小大大小大大大大大小小小小大小大小大小小小大大大大小大小大大小小小大大小小大大小小小大小小小小大小大小大大小小大大大大大小大小大小大大小小大大大大大小小小小大大大大大大大大大大小大大大小小大小小大小小小小大小小大大大小小小大大大小小大大大大大小小大大小小大小大小大大小大小小大大大大小小大小小小大小大小小小小小大小大小大大大小小大大小大小小小小小大大大小小大小小大大小小小大大大小小小大大大小大大小小小小大大大小大大大大小大大小大小大大小小小小大大小大小小小大大小小大大大小小大小大小小小大小小小大小大大大小小小大大大小大小大大大小大大小大大小大大小大小大小小小小小小大小大大小大小小大大大小大小大小小小大小小大小大大大大大小大大大小大大大小大大小小小小大小大小小小小小小小小小大大大大小大小大大大大大小小大小小小小小大小大小大大小大小小大大小小大大小小小小大小小大大大小大大小大小小小小小小小大大小小小大小小大小大大小小大小小小大小小大大大小大小小小小大大大小大大小小小小小大大大小大大大小大大小大大小大小小小大小小大小小大小大大大小大小小大小小大大大小小大小大大小小大小小小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大"',
                'lottery_count_rules' => 1836,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1703,
                'bet_amount_rules' => ',10,20,40,80,160,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,20,40,10,10,20,40,80,10,10,10,20,40,80,160,10,10,20,10,20,40,10,10,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,20,40,80,160,10,20,40,10,10,10,10,20,40,80,10,10,20,40,10,20,40,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10,20,40,80,160,10,20,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大大大大大大小大大大大小大小小小小大大大大小小小小小小小小小小小小小小大大大大大大小大大大大大大大大大大大大大大小小小小大小小小小小大小小小小小小小大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大小大大小小大大',
                'bet_count_rules' => 129,
                'win_lose_rules' => '100001111000110000110011000111000011010011110001100001111100001001111000110010010100010101100100110001111011100101101011110000101',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 1,
                'created_at' => '2023-05-13 23:53:56',
                'updated_at' => '2023-05-13 23:55:16',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32737543',
                'continuous_bet_count' => 129,
            ),
            12 => 
            array (
                'id' => 27,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大小小大大小小大大小小大小大大小大小小小小大大小大小大小小小大小小小大小小小大小大小小大大小大大小小大大小大大大大小大小小小大大大小大小小小小小大大大小大小小小小大小大小小大小大大小小小大小大大大小大小小大大小大小小大小小小小小大小小小大大大小大小大大小大小小大大大大大小小小小小小大小小大小小小小大大大小大小大小大大大大大小大大大大大小大小大小大大小小大大小小小小大大大小大小小大大大小大大大大小小小小小大小小小小大小小小大大大小大大大小大小大大大大大大小大大小大小小大大大大小大大大大大大小小大大大小大小小大大大小大大小大小大大小大大大小小大大大小小小小小大大小小小大大大大小大小小小小大小大大小大大大小小小小大大小大小小小大小小小大小大大大小大大小大小小小小大大小大小大小大大小小大小大大大小小小大小小小小小小大大大小小小大大小大小大小大小大大小小小小大小大小大大大大大小大大大小大大大大大小大小小小大大大大大大大大大小小大大小小大小小小小小小大小大小大大小小小小大大大小大小小大小小小大小小大大大小大大小大大大小小小小大小大大小大小小小小小小小大小大小大小大小小小小大小小大小小大小大大小小大大大大大大小大大大小大大小大小大大大小小大大小大小小小小大小小小大大大大大小小大小小小大小小小大小大小小小大小小大大大大大大大小小大大大小小大大大大大小大小小小小大大大小小小小大小大大大小小小大小小大大小小小大小小小小小大小小小小大小小大大大大小小大小小小大大小大大大大大小小小大大小大大小大大小大大小大小小大大大小小大小小大大小小小大小小小小小大大小小小大小小大大小大大大小小大小大大大小小小大大小大小小小大小大小小大小大大大大大大大小大小大大小大大小大小小大小大小小小小小小大小大大大大小小小大大小大大大小大小小小大大大大小小大大大小小小大小大大小大大大大大大小大大大大小小大大小小小大小小大小小小小小小小大小大大小小大小小小大大小大小小大小大小大大小小大大大小大小大小大大大大小小小小大小小大大小小小小大大大大小大小小大大大大小小小大大小小小大小小大大小小大小大大大小大大小小大大小小小小小大小大小小小大小大大小小小大小大大大小大大小大大小小大小大大大小大小小小小大小大大大大大小大小大大小小小小大大大小小小小大小小大小大小大大大大大大大小小小大大大小大大大大小大大大小"',
                'lottery_count_rules' => 1671,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1588,
                'bet_amount_rules' => ',10,20,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10,20,40,80,160,10,20,10,20,40,80,160,10,20,40,80,160,10,20,10,20,40,10,20,40,80,10,10,10,10,20,10,20,10,10,20,10,20,40,10,10,20,40,80,160,320,10,10,20,10,20,10,20,10,10,20,40,80,10,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大小大大小小大大小小大小小大大小大大大大小小小大大大大大大大小小小小小大大大大大大大小大小大大大小小大大小小小小大大大大',
                'bet_count_rules' => 104,
                'win_lose_rules' => '101010001010110010011000111101110010110101111000010100001000010100100011110101101001100000110101011000110',
                'continuous_lose_count_rules' => 1,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-14 10:49:15',
                'updated_at' => '2023-05-14 10:50:29',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32738530',
                'continuous_bet_count' => 104,
            ),
            13 => 
            array (
                'id' => 28,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大小小大大小小大大小小大小大大小大小小小小大大小大小大小小小大小小小大小小小大小大小小大大小大大小小大大小大大大大小大小小小大大大小大小小小小小大大大小大小小小小大小大小小大小大大小小小大小大大大小大小小大大小大小小大小小小小小大小小小大大大小大小大大小大小小大大大大大小小小小小小大小小大小小小小大大大小大小大小大大大大大小大大大大大小大小大小大大小小大大小小小小大大大小大小小大大大小大大大大小小小小小大小小小小大小小小大大大小大大大小大小大大大大大大小大大小大小小大大大大小大大大大大大小小大大大小大小小大大大小大大小大小大大小大大大小小大大大小小小小小大大小小小大大大大小大小小小小大小大大小大大大小小小小大大小大小小小大小小小大小大大大小大大小大小小小小大大小大小大小大大小小大小大大大小小小大小小小小小小大大大小小小大大小大小大小大小大大小小小小大小大小大大大大大小大大大小大大大大大小大小小小大大大大大大大大大小小大大小小大小小小小小小大小大小大大小小小小大大大小大小小大小小小大小小大大大小大大小大大大小小小小大小大大小大小小小小小小小大小大小大小大小小小小大小小大小小大小大大小小大大大大大大小大大大小大大小大小大大大小小大大小大小小小小大小小小大大大大大小小大小小小大小小小大小大小小小大小小大大大大大大大小小大大大小小大大大大大小大小小小小大大大小小小小大小大大大小小小大小小大大小小小大小小小小小大小小小小大小小大大大大小小大小小小大大小大大大大大小小小大大小大大小大大小大大小大小小大大大小小大小小大大小小小大小小小小小大大小小小大小小大大小大大大小小大小大大大小小小大大小大小小小大小大小小大小大大大大大大大小大小大大小大大小大小小大小大小小小小小小大小大大大大小小小大大小大大大小大小小小大大大大小小大大大小小小大小大大小大大大大大大小大大大大小小大大小小小大小小大小小小小小小小大小大大小小大小小小大大小大小小大小大小大大小小大大大小大小大小大大大大小小小小大小小大大小小小小大大大大小大小小大大大大小小小大大小小小大小小大大小小大小大大大小大大小小大大小小小小小大小大小小小大小大大小小小大小大大大小大大小大大小小大小大大大小大小小小小大小大大大大大小大小大大小小小小大大大小小小小大小小大小大小大大大大大大大小小小大大大小大大大大小大大大小大小小大大小大大小小大大小小大小小大小大小小大小小大小小大小小大大大小大小小小大大小大小大小大大小小大小小大大大大"',
                'lottery_count_rules' => 1728,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1588,
                'bet_amount_rules' => '0,10,20,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10,20,40,80,160,10,20,10,20,40,80,160,10,20,40,80,160,10,20,10,20,40,10,20,40,80,10,10,10,10,20,10,20,10,10,20,10,20,40,10,10,20,40,80,160,320,10,10,20,10,20,10,20,10,10,20,40,80,10,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大小大大小小大大小小大小小大大小大大大大小小小大大大大大大大小小小小小大大大大大大大小大小大大大小小大大小小小小大大大大',
                'bet_count_rules' => 104,
                'win_lose_rules' => '101010001010110010011000111101110010110101111000010100001000010100100011110101101001100000110101011000110',
                'continuous_lose_count_rules' => 1,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-14 12:00:02',
                'updated_at' => '2023-05-14 12:01:20',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => '',
                'last_issue' => '32738587',
                'continuous_bet_count' => 104,
            ),
            14 => 
            array (
                'id' => 58,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大小小大大小小大大小小大小大大小大小小小小大大小大小大小小小大小小小大小小小大小大小小大大小大大小小大大小大大大大小大小小小大大大小大小小小小小大大大小大小小小小大小大小小大小大大小小小大小大大大小大小小大大小大小小大小小小小小大小小小大大大小大小大大小大小小大大大大大小小小小小小大小小大小小小小大大大小大小大小大大大大大小大大大大大小大小大小大大小小大大小小小小大大大小大小小大大大小大大大大小小小小小大小小小小大小小小大大大小大大大小大小大大大大大大小大大小大小小大大大大小大大大大大大小小大大大小大小小大大大小大大小大小大大小大大大小小大大大小小小小小大大小小小大大大大小大小小小小大小大大小大大大小小小小大大小大小小小大小小小大小大大大小大大小大小小小小大大小大小大小大大小小大小大大大小小小大小小小小小小大大大小小小大大小大小大小大小大大小小小小大小大小大大大大大小大大大小大大大大大小大小小小大大大大大大大大大小小大大小小大小小小小小小大小大小大大小小小小大大大小大小小大小小小大小小大大大小大大小大大大小小小小大小大大小大小小小小小小小大小大小大小大小小小小大小小大小小大小大大小小大大大大大大小大大大小大大小大小大大大小小大大小大小小小小大小小小大大大大大小小大小小小大小小小大小大小小小大小小大大大大大大大小小大大大小小大大大大大小大小小小小大大大小小小小大小大大大小小小大小小大大小小小大小小小小小大小小小小大小小大大大大小小大小小小大大小大大大大大小小小大大小大大小大大小大大小大小小大大大小小大小小大大小小小大小小小小小大大小小小大小小大大小大大大小小大小大大大小小小大大小大小小小大小大小小大小大大大大大大大小大小大大小大大小大小小大小大小小小小小小大小大大大大小小小大大小大大大小大小小小大大大大小小大大大小小小大小大大小大大大大大大小大大大大小小大大小小小大小小大小小小小小小小大小大大小小大小小小大大小大小小大小大小大大小小大大大小大小大小大大大大小小小小大小小大大小小小小大大大大小大小小大大大大小小小大大小小小大小小大大小小大小大大大小大大小小大大小小小小小大小大小小小大小大大小小小大小大大大小大大小大大小小大小大大大小大小小小小大小大大大大大小大小大大小小小小大大大小小小小大小小大小大小大大大大大大大小小小大大大小大大大大小大大大小大小小大大小大大小小大大小小大小小大小大小小大小小大小小大小小大大大小大小小小大大小大小大小大大小小大小小大大大大小大小小大大小小小大小大大大小大大小大大小大小大小小大小小大大大小小小大小小大小小大大大小小大小大大小小大大大小大小小小小小大大大小小大小小小小小大小大小小大大大大大小小小小大小小大大小小小小小小小小小小小大小小大小大大小小大小大小小大小大大小大大小小小大小小小大大小小大大小大小大大小小大大大小小小小大大小小小大小大大小小大小小小小大小小大小大小小小大小大小大小大大大大小小小大大小小大小大大小小大小大小小大大大小大大大大大小小大小大大小大大小大小大大小大大小大小小小小小小大小大小小小小大大小大小大大大小小小小小大大大大小小大小大小大大大大小大小大小大大大小小大大大大大大小大小大大大小小大小小小大小大大小大大小小大大大大小小小大大大大小大大大小大大大小大小小小小小小小小大大小小小小小大大大大小大大小大小小"',
                'lottery_count_rules' => 2084,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1665,
                'bet_amount_rules' => ',10,20,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10,20,40,80,160,10,20,10,20,40,80,160,10,20,40,80,160,10,20,10,20,40,10,20,40,80,10,10,10,10,20,10,20,10,10,20,10,20,40,10,10,20,40,80,160,320,10,10,20,10,20,10,20,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,10,20,40,10,20,40,10,20,10,10,10,20',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大小大大小小大大小小大小小大大小大大大大小小小大大大大大大大小小小小小大大大大大大大小大小大大大小小大大小小小小大大大大小小大小小小小小小小大小小小大大小小小小小',
                'bet_count_rules' => 125,
                'win_lose_rules' => '101010001010110010011000111101110010110101111000010100001000010100100011110101101001100000110101011000110000111111001001011100',
                'continuous_lose_count_rules' => 2,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-14 19:24:40',
                'updated_at' => '2023-05-14 19:26:16',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 20.0,
                'current_issue' => NULL,
                'last_issue' => '32738943',
                'continuous_bet_count' => 125,
            ),
            15 => 
            array (
                'id' => 60,
                'bpmn_xml' => '',
                'lottery_id' => 2,
                'token_id' => NULL,
                'code_type' => 0,
                'status' => 'pending',
                'lottery_rules' => '"闲闲庄闲庄闲闲和庄闲庄闲庄闲闲闲闲闲和闲闲和庄闲闲和闲庄和庄闲庄庄闲和闲闲庄庄庄闲闲庄庄和闲闲闲和庄和和闲庄闲闲闲闲闲闲闲闲庄庄和闲庄和闲闲闲闲闲和闲和庄和闲和闲庄闲庄闲闲闲闲闲闲闲闲闲庄庄闲闲闲闲和闲和庄闲和闲闲庄庄闲闲闲闲闲和闲和闲和闲庄闲闲闲庄闲闲闲闲闲庄闲闲和和庄闲庄庄和和闲闲庄闲闲和闲闲庄和闲和闲庄和闲庄庄闲庄和和和闲闲闲闲庄闲和庄闲庄庄和闲庄闲闲闲和和闲闲闲和闲和和庄闲闲和闲庄庄庄庄闲庄和和庄闲闲闲和闲闲闲闲庄庄闲闲闲庄闲和闲庄闲庄庄庄闲闲闲闲庄闲和闲庄闲闲和闲庄庄闲闲闲闲闲闲和庄闲闲闲庄闲庄庄闲和闲闲庄闲庄闲闲和闲和和闲和和闲和庄闲庄庄闲闲庄庄庄闲庄庄闲庄闲闲和闲闲和闲闲庄庄闲闲闲闲庄和和闲庄闲闲闲闲闲闲庄和闲闲闲闲闲庄闲庄和闲和庄闲庄闲庄和闲闲庄闲闲闲庄闲闲闲庄闲闲闲闲闲庄庄闲闲和闲闲闲和闲闲庄闲闲庄和闲闲庄庄庄闲闲闲庄闲闲闲闲和闲和庄庄闲闲闲和庄庄闲闲庄庄庄闲闲闲闲闲闲庄闲和闲闲闲闲闲和闲庄庄闲庄闲庄闲庄闲闲闲庄闲闲闲闲闲闲闲闲闲庄庄庄闲和闲庄闲闲闲闲庄闲闲闲闲闲庄闲闲和闲闲闲庄闲闲庄和闲闲闲庄庄闲闲闲闲闲闲闲闲庄闲庄庄闲闲闲闲庄闲和闲闲闲庄和闲闲闲庄庄闲闲和和闲闲闲闲庄闲闲庄庄闲闲闲闲闲庄闲和闲和和庄闲和闲闲庄庄庄庄闲闲庄和闲闲闲和闲闲闲庄闲闲庄闲庄庄闲庄闲闲闲闲庄闲闲和闲闲闲闲闲庄闲庄庄和庄闲闲庄闲闲闲闲闲庄闲闲闲庄闲和闲庄闲庄和和和和闲闲闲闲和庄闲闲闲和闲和和闲庄闲闲和闲庄闲闲闲庄和闲和庄闲和和闲庄闲庄闲闲庄闲闲闲闲闲庄庄闲闲和闲和闲闲闲闲闲闲和闲闲闲闲闲和闲闲闲庄和庄和和闲闲闲闲闲和闲闲闲闲闲庄闲闲闲庄庄庄庄庄庄庄庄和和闲庄闲闲闲闲闲闲庄闲闲庄闲庄闲闲闲闲和庄和闲庄闲闲闲庄和闲闲闲闲闲闲和庄庄庄闲闲闲闲庄闲和庄庄闲庄和闲闲闲闲闲闲闲和闲闲和庄庄"',
                'lottery_count_rules' => 747,
                'bet_base_amount_rules' => 0,
                'bet_total_amount_rules' => 0,
                'bet_amount_rules' => NULL,
                'stop_betting_amount' => 0,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-14 22:27:09',
                'updated_at' => '2023-05-15 10:54:30',
                'total_amount_rules' => 0.0,
                'title' => '射龙门',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => NULL,
                'current_issue' => NULL,
                'last_issue' => NULL,
                'continuous_bet_count' => 0,
            ),
            16 => 
            array (
                'id' => 61,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"双小单小单小双小单大双大单大单大单大单小双大单大单大双大单大双大双小双小单大双大单大单大单小单大单小单小双小单大双大单大单小双大单小双大单大单小单大双小单小单大单大单小双大单小双大双大双小单大双小双大双大双小双大双小双小单大单大单小双小双大单小双小单小双小单小单小单大单小双大单小单小双小双大单大双大单小双大单大单大双小双大双大单小单小双大双小双小单大双大双小单大双小单大单小双小双小单大双小单大单小双大单小单大双大双小双大双小单大双大单小单小双大单小双小双小双大双大双小双小单大双小单大双小双小双小双大双小单大双小双大单大单小单大双大双小双大双小单大单小单小单大单小双小单大双小单大双小双小双小双小双小单大单小单大单大双大单大单小双小双小单大双大双小双小单小双大双小单小双大双大单大单小单小单大双大双小双小双大单大双大单小双小双小双小单小单大双小单大单小单小双大单大单小单大单小单大单大单小单大单大单小单大双大单大双大双小单大单大双小双小双小单大双小双大单小双小单小双小双小单小双大单大单小双小双大单小单小双大单小单大单小双大单大单大双小单小双小双小单小单小双大单小双大双小双小单小单大双大单大单大双大单大单大单小双小单小单大单大双小双大双小双小双小双大单小单大单大单大单大单大双小双小单小单大单大双大单小单大双大双大单小单大双大单小双小双小双小单大双小双大单大双小双小单大双大双小双小单大单小单小单小单大单大单小单大双大单小单小双小单小双小双小双大双小双大双小双小单大单小双小双大双小单大单大双小单小单小双小双小单大单小单小单小单大单小双大双小单小单大单小双大双大单大双大双大单大双大单小双大单大双小双大双小双大双小单小单小双小双大单大双小双大单大双大双小双大单大单大单大双大双小单大单大单小双大单小双小双小单大双大单小单大单小单小双大双小双大单小单小单大单大双小单小双小双大双大双小单小双小双大单小双小单小单大单大双大单小单小单大单大双小单大双大单大双小双大单大双大单大单小单大单小单大单大双大双大单大双小单小单大双小单大双大双小双大单小双小双小单小双小单小双小单小双小单大单大单大双小单小双小单大双小单大单大单大单大单大双大双大双大双小双小单大双小单小单小单小双大双小单大双小单小单大单大单小单大单大单大双大双小单大单小双小单大单大双大单小双大双小双大单大单大双小双小双小双小双大单小单大双小单小单大单大单小单大双大单大双大双大双小双大单大双小单大单大单大双大单大双大双小双小单小单小单小双小单小单大双大单大单小双大单小双大双大双小单大双小单大单小单大双小双小单大单小单大双大双大双小双大单小单小双小双小双小单小单大单大单大双小双大双小单大双大单大单小双大双大双大单大双大单大双大双大单大单小双大双小单大单大双小双大双大双小单小单小单小双小双大双小单大单小双小单大双小单小双大双大双大单大单小单大双小单小单大双小双小双小双小单大单小单大双小双大双小双大双大双小单小单小双小双大双大双小双大双小单大双小双大单大单小双小双大单小单大单大双大单大单大单小单大单大单大双小单大双小单小双大双小单大双大单大单大单大单小单大单小单大双小双小单小单小单小双小单大单小单大单大双大双小双小单小双大双小单大双大单小双小单小双大双大双大双大单大单大单小单小双大双大双小双小双大单大单小单小单大双小双大单大单小单大单小单小单小双小双大单大单小双大双小双大单小双小双小单大单小单小双小单大双小单小双小双大双小双大双小单小双大单大双小双大单大单小双小单大单大单小双大双大单大单大双小双大单小单小双小双大双大双大单小单大双小双小双小单小单小单大双大单大双小单大双小双小双小双小单大双小单大双小单小双大双小单大单大单小双小单小单大单小双大单大双大单小双大单小双小单大双大双小单大双小双小单大单小双小双小单小双小单大单小双小双小单大单大单大双小单大单小单大单大双小单大双小双小单大双大双大单大单大双小双小双小单小双小双小双大双小单小单大双小单小单小双小双大双大单大双小单大双小双大双小单大单大双大单大双大单小单大双大单大单大双大双小单大双小双大双小单大双大双小双小单大单大单小双小单小双小单大单大双大单小双大双小双小单大单大双大双小单大单大双大双大双小单小双小单小双小双大单小单小双小双小双大单小双小双小单大单大双大单小单大单大单大单小双大双小单大双大单大双大双大单大单小双大双大双小单大双小单小双大双大单大双大双小双大双大单大双大双大双大双小双小双大单大双大双小单大双小双小单大双大单大单小双大单大单小单大单小双大单大单小双大单大双大单小双小双大单大单大单小双小单小双小双小单大双大双小双小单小双大单大单大双大单小单大单小双小双小单小单大单小双大单大双小单大双大双大双小单小单小双小单大双大单小双大单小双小单小双大双小单小双小单大单小双大双大单大单小单大双大双小单大单小双小双小双小双大单大单小双大单小单大双小双大双大单小双小单大双小单大双大双大单小双小双小双大双小双小单小单小单小单小单大单大单大单小双小单小单大单大单小单大双小双大双小单大双小双大单大单小双小单小双小双大双小单大双小双大单大单大单大双大双小单大双大单大单小双大双大单大单大单大双小双大双小单小双小双大双大双大单大单大单大单大单大双大单小双小双大单大双小单小双大双小双小单小双小单小双小双大单小双大双小单大双大双小双小单小单小双大双大双大单小双大双小双小双大单小单小单小单大双小双小双大单大双大双小单大双大单小双大单大单大双小双小单小单小单大双小双大单大双小单大双小单小双小单小单小单小双小单大单小双大单小单大单小单大双小双小单小单小单大双小单小双大双小双小单大单小双大双大双小单小单大单大双大单大双大单大单小双大单大单大单小单大双大单小单大双小单大单大双大单小双小单大单大单小双大双小双小双小双小单大单小单小双小双大单大双大单大双大双小单小单大双小单小双小单大双小单小双小单大单小双大单小双小单小双大单小双小单大单大单大单大单大单大单大双小单小双大双大双大单小双小单大双大单大双大双大双小单大双小双小双小单小双大单大双大双小单小双小双小双大双小单大双大单大单小双小双小双大双小双小单大双大双小单小单小双大单小单小单小单小双小双大单小单小单小双小单大单小单小单大双大单大双大双小单小双大双小双小双小单大单大单小双大双大双大单大双大双小双小单小双大单大单小单大单大双小单大双大单小双大单大双小单大双小单小单大双大单大双小双小单大双小单小单大双大单小单小双小双大双小单小双小双小单小双大单大单小单小双小双大双小单小单大双大单小单大双大单大单小单小双大双小单大单大单大双小双小双小双大单大双小单大单小双小双小单大双小双大双小双小双大双小单大双大单大单大双大单大双大单小单大单小双大单大单小单大单大双小双大单小单小单大单小单大双小双小单小双小单小双小单大双小双大单大双大单大双小单小双小双大单大单小双大单大单大单小双大单小双小单小单大单大单大单大单小双小双大单大双大双小单小双小单大双小单大双大双小单大单大单大单大双大双大双小双大单大双大单大单小单小双大双大双小单小单小单大单小双小单大双小双小双小单小双小单小双小单大双小单大单大双小双小单大双小单小双小双大双大单小单大双小双小单大单小双大双小双大单大双小双小双大单大双大双小单大单小单大双小单大双大单大双大双小单小双小双小双大双小单小单大单大单小单小单小双小单大单大单大双大双小单大双小双小单大双大单大双大单小单小双小双大单大双小单小双小单大双小单小单大双大单小单小双大双小单大单大单大双小双大单大双小单小双大双大单小单小单小单小单小双大单小双大单小双小双小双大单小双大双大单小单小双小双大双小单大单大单大双小双大双大单小单大双大双小双小双大双小单大双大单大双小单大单小双小双小单小单大双小双大单大单大单大单大双小双大双小单大单大双小双小单小双小双大单大双大单小双小双小单小单大双小双小单大双小单大双小单大单大单大单大双大双大单大双小单小双小单大双大单大双小单大单大单大单大双小单大单大双大双小双大双小双小双大单大双小双大双大单小单小单大单大单小单小双大双小双小单大单小双大单小双小单大单小单小双大双小单小双大单小双小单大双大单大单小双大双小双小双小单大双大单小双大双小双大单小双大单大双小单小双大单小双小单大单大双大双大单小双大单小双小双大双大双小双小单小单大双小双大双大双大双小单大单大单小双大单大双小单大双小单大双小双小双大双小双小双大单大双大双小单小单小单大单小单小单大双小单小单大双大单大单小双小单大双小双大双大单小单小单大双大双大单小单大双小单小双小双小双小单大双大双大双小单小双大双小双小单小单小双小双大单小单大双小单小双大单大单大单大单大单小单小双小单小双大单小双小双大双大双小双小单小单小单小双小双小双小单小单小单小双大单小双小双大双小单大双大单小双小单大单小双大双小双小单大单小双大双大双小单大单大双小双小双小单大单小双小双小单大双大双小单小单大单大双小双大单小单大双大双小单小双大单大单大单小双小双小单小单大单大双小双小单小双大单小单大双大双小双小双大单小单小单小单小双大双小单小单大双小单大双小双小双小双大单小单大双小双大双小单大双大双大双大单小单小单小双大单大双小双小双大双小单大单大单小双小单大单小单大双小双小单大单大双大单小单大单大单大单大双大双小双小单大双小双大单大双小单大单大双小双大单小单大单大双小单大单大单小单大单小单小双小单小双小单小双大单小双大单小单小双小单小单大双大双小单大双小双大单大单大双小单小单小单小单小单大双大单大双大双小双小单大单小单大双小单大单大单大双大双小单大双小双大单小单大单大单大单小双小单大双大双大双大单大单大单小双大双小双大双大单大双小双小双大双小单小单小双大单小单大单大双小双大双大双小双小双大双大双大双大双小双小双小双大单大双大单大双小双大双大双大单小双大单大双大单小双大双小单小双小单小单小双小双小单小双大双大双小双小双小单小双小双大双大双大双大单小单大双大双小双大双小双小双小双大双大双小双大双大单大双小单大单小双大单大双大双小双小单大双大单大双小单大单小单小单大双小双小双大双小双大双小单大双大单大单小双小双小单小双大双小双小单小单小双大单小双小单大双小单大单大单大双大单大单大双小单大单大双大双小双小双小单大单大单大单大单小双小双小双大单小双小单大双小单大单大单大单大双小双大双小双小双大单大双小单大单小单大双小单大单小单小双小双大单大双大单大单大单大双大双小单小单小双大单大双大双小双小双小单小双小单大单大双小单小单大双小双小双小单大单小双小双小双小单大单大单大单小单大单大双小单大双小双小单大双小双小单大双小单小单小双小单大双大单小单大双大单小单小双大单大单大双小双小单大双小单小单小单小单大单大双小单小单大单小单小单小单小单小双小单大双小双小单小双小"',
                'lottery_count_rules' => 2256,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1200,
                'bet_amount_rules' => '0',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-14 23:00:03',
                'updated_at' => '2023-05-14 23:01:48',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => 0.0,
                'current_issue' => '',
                'last_issue' => '32739115',
                'continuous_bet_count' => 0,
            ),
            17 => 
            array (
                'id' => 62,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小小小大大大大大小大大大大大大小小大大大大小大小小小大大大小大小大大小大小小大大小大小大大小大小大大小大小小大大小小大小小小小小小大小大小小小大大大小大大大小大大小小大小小大大小大小大小小小大小大小大小大大小大小大大小小大小小小大大小小大小大小小小大小大小大大小大大小大小大小小大小小大小大小小小小小大小大大大大小小小大大小小小大小小大大大小小大大小小大大大小小小小小大小大小小大大小大小大大小大大小大大大大小大大小小小大小大小小小小小小大大小小大小小大小大小大大大小小小小小小大小大小小小大大大大大大大小小小大大小大小小小大小大大大大大小小小大大大小大大大小大大小小小小大小大大小小大大小小大小小小大大小大大小小小小小小大小大小小大小小大小大大小小小小小大小小小大小大小小大小大大大大大大大小大大小大小大小小小小大大小大大大小大大大大大小大大小大小小小大大小大小小大小大小小大大小小小大大小小小大小小小大大大小小大大小大大大小大大大大小大小大大大大大小小大小大大小大小小小小小小小小小大大大小小小大小大大大大大大大大小小大小小小小大小大小小大大小大大大大小大小小大大大小大小大大大小小小小大小大小小大大小大大大大大小大大小大大大大大大小小小小小小小大大大小大小大大小大小大小大小小大小大大大小大小小小小小小大大大小大小大大大小大大大大大大大大大小大小大大小大大小小小小小大小大小小大小小大大大大小大小小大小小小小大小大小大小大大小小小小大大小大小大小大大小小大小大大大大大小大大大小大小小大小大大大大大小大小大小小小小小小大小大大大小小小大小大大小小小大大大大大大小小大大小小大大小小大小大大小大小小小小大大小大小大小小小大小小小大小小小大小大小小大大小大大小小大大小大大大大小大小小小大大大小大小小小小小大大大小大小小小小大小大小小大小大大小小小大小大大大小大小小大大小大小小大小小小小小大小小小大大大小大小大大小大小小大大大大大小小小小小小大小小大小小小小大大大小大小大小大大大大大小大大大大大小大小大小大大小小大大小小小小大大大小大小小大大大小大大大大小小小小小大小小小小大小小小大大大小大大大小大小大大大大大大小大大小大小小大大大大小大大大大大大小小大大大小大小小大大大小大大小大小大大小大大大小小大大大小小小小小大大小小小大大大大小大小小小小大小大大小大大大小小小小大大小大小小小大小小小大小大大大小大大小大小小小小大大小大小大小大大小小大小大大大小小小大小小小小小小大大大小小小大大小大小大小大小大大小小小小大小大小大大大大大小大大大小大大大大大小大小小小大大大大大大大大大小小大大小小大小小小小小小大小大小大大小小小小大大大小大小小大小小小大小小大大大小大大小大大大小小小小大小大大小大小小小小小小小大小大小大小大小小小小大小小大小小大小大大小小大大大大大大小大大大小大大小大小大大大小小大大小大小小小小大小小小大大大大大小小大小小小大小小小大小大小小小大小小大大大大大大大小小大大大小小大大大大大小大小小小小大大大小小小小大小大大大小小小大小小大大小小小大小小小小小大小小小小大小小大大大大小小大小小小大大小大大大大大小小小大大小大大小大大小大大小大小小大大大小小大小小大大小小小大小小小小小大大小小小大小小大大小大大大小小大小大大大小小小大大小大小小小大小大小小大小大大大大大大大小大小大大小大大小大小小大小大小小小小小小大小大大大大小小小大大小大大大小大小小小大大大大小小大大大小小小大小大大小大大大大大大小大大大大小小大大小小小大小小大小小小小小小小大小大大小小大小小小大大小大小小大小大小大大小小大大大小大小大小大大大大小小小小大小小大大小小小小大大大大小大小小大大大大小小小大大小小小大小小大大小小大小大大大小大大小小大大小小小小小大小大小小小大小大大小小小大小大大大小大大小大大小小大小大大大小大小小小小大小大大大大大小大小大大小小小小大大大小小小小大小小大小大小大大大大大大大小小小大大大小大大大大小大大大小大小小大大小大大小小大大小小大小小大小大小小大小小大小小大小小大大大小大小小小大大小大小大小大大小小大小小大大大大小大小小大大小小小大小大大大小大大小大大小大小大小小大小小大大大小小小大小小大小小大大大小小大小大大小小大大大小大小小小小小大大大小小大小小小小小大小大小小大大大大大小小小小大小小大大小小小小小小小小小小小大小小大小大大小小大小大小小大小大大小大大小小小大小小小大大小小大大小大小大大小小大大大小小小小大大小小小大小大大小小大小小小小大小小大小大小小小大小大小大小大大大大小小小大大小小大小大大小小大小大小小大大大小大大大大大小小大小大大小大大小大小大大小大大小大小小小小小小大小大小小小小大大小大小大大大小小小小小大大大大小小大小大小大大大大小大小大小大大大小小大大大大大大小大小大大大小小大小小小大小大大小大大小小大大大大小小小大大大大小大大大小大大大小大小小小小小小小小大大小小小小小大大大大小大大小大小小小大大小大大大小大小大大大小小大大大小大小小大小小大小大小大大大小小小小大小小小小大小小大小大大大大大大小大大大小小小大大大大小小小大小小大小大大大大小大小小大大小大小大小大小小小大大大大大大"',
                'lottery_count_rules' => 2180,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1702,
                'bet_amount_rules' => ',10,20,10,20,10,20,40,80,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,80,10,10,10,10,20,10,10,10,20,40,10,20,10,10,20,10,20,10,10,10,10,20,40,80,160,10,20,10,20,40,80,160,10,20,40,80,160,10,20,10,20,40,10,20,40,80,10,10,10,10,20,10,20,10,10,20,10,20,40,10,10,20,40,80,160,320,10,10,20,10,20,10,20,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,10,20,40,10,20,40,10,20,10,10,10,20,40,10,20,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '大大大小小小小小小小小大大大大小小小大大大大大小小小小小大大大大大大大小小小小小大大大大大小大大小小大大小小大小小大大小大大大大小小小大大大大大大大小小小小小大大大大大大大小大小大大大小小大大小小小小大大大大小小大小小小小小小小大小小小大大小小小小小大大大大',
                'bet_count_rules' => 129,
                'win_lose_rules' => '101010001010110010011000111101110010110101111000010100001000010100100011110101101001100000110101011000110000111111001001011100101',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 1,
                'created_at' => '2023-05-14 23:10:24',
                'updated_at' => '2023-05-14 23:12:11',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32739039',
                'continuous_bet_count' => 129,
            ),
            18 => 
            array (
                'id' => 63,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => NULL,
                'lottery_count_rules' => 0,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1200,
                'bet_amount_rules' => '0',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-15 12:00:02',
                'updated_at' => '2023-05-15 12:00:03',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => 0.0,
                'current_issue' => '',
                'last_issue' => '32736213',
                'continuous_bet_count' => 0,
            ),
            19 => 
            array (
                'id' => 65,
                'bpmn_xml' => '',
                'lottery_id' => 2,
                'token_id' => NULL,
                'code_type' => 0,
                'status' => 'pending',
                'lottery_rules' => '"庄闲闲闲和闲闲闲闲和闲闲庄庄和闲闲庄闲闲和闲庄闲闲庄闲庄庄闲和和闲庄庄闲闲闲庄庄闲闲庄庄闲庄和闲庄闲闲闲闲和庄和庄闲闲庄庄闲闲闲庄庄闲闲闲庄闲闲闲和闲闲庄庄闲闲闲闲闲和庄闲闲闲闲庄庄和闲闲闲闲闲闲庄闲闲闲庄闲闲闲庄闲闲庄庄庄闲庄闲闲闲庄闲庄庄闲闲闲闲庄庄闲庄闲庄闲闲闲闲闲闲闲闲闲庄闲闲闲庄闲闲庄闲闲闲和庄庄闲闲闲闲闲闲庄闲庄闲闲闲和闲闲闲闲闲和闲闲庄庄和庄闲闲庄和闲闲闲闲和庄闲闲闲闲闲闲闲闲庄闲和闲庄闲庄闲庄闲闲庄闲庄和闲闲闲闲闲闲庄庄闲闲闲闲庄闲闲和闲闲庄闲和庄庄闲闲和和庄和闲庄庄闲庄闲闲闲闲闲庄和闲和闲闲闲庄和闲庄闲庄和闲和闲和闲庄闲和和庄庄闲闲闲闲闲闲闲闲庄和闲闲庄闲闲闲闲闲闲闲和闲庄庄庄庄闲庄和闲闲庄闲庄庄闲闲庄闲闲庄闲闲庄庄庄和闲和庄庄庄闲庄庄庄闲闲闲和闲闲闲闲闲闲庄闲闲闲和庄庄庄庄和闲闲闲和闲庄闲和闲闲庄和闲庄闲闲闲闲庄庄闲庄闲闲庄庄和庄闲和闲庄闲庄和庄闲闲庄庄和庄闲和闲闲闲闲闲闲闲闲闲闲庄闲闲和闲庄闲闲闲庄闲闲庄闲闲闲庄和闲庄闲闲闲和庄闲闲闲闲庄庄闲和庄庄闲闲闲闲闲闲庄和闲庄庄和庄闲庄闲闲和闲闲和和庄闲闲闲庄闲庄庄闲和庄闲闲庄闲和闲闲和闲庄庄闲闲闲闲庄闲闲闲闲庄闲庄庄闲闲闲闲闲庄闲闲闲庄闲庄和闲闲闲闲闲闲和庄闲闲闲闲闲闲闲闲庄闲闲庄闲和闲和庄庄闲闲庄庄闲闲庄闲闲庄闲闲庄庄闲闲闲闲庄闲闲闲闲闲庄闲闲和闲闲闲闲庄闲闲闲闲闲闲庄闲庄庄闲闲庄闲庄闲闲闲闲闲闲和闲闲和闲闲庄闲庄闲庄庄庄闲和闲庄闲闲闲闲闲和闲闲庄和闲庄庄闲庄闲庄闲闲闲闲闲庄闲闲闲闲闲闲闲闲庄闲闲闲庄闲闲闲闲闲庄闲闲"',
                'lottery_count_rules' => 652,
                'bet_base_amount_rules' => 0,
                'bet_total_amount_rules' => 0,
                'bet_amount_rules' => NULL,
                'stop_betting_amount' => 0,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-15 16:03:12',
                'updated_at' => '2023-05-16 02:54:30',
                'total_amount_rules' => 0.0,
                'title' => '射龙门',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => NULL,
                'current_issue' => NULL,
                'last_issue' => NULL,
                'continuous_bet_count' => 0,
            ),
            20 => 
            array (
                'id' => 66,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 1,
                'status' => 'running',
                'lottery_rules' => '"大小大小大小大大小大小小小小小小小大大小大大小小大大小小小大大小大大小小小大大小大大大大小大大大小小小小大小小小大大大大小大小大小小小大小大大小大大大大大小大大小小大大大小小小小大大大小小小小小大小大大小大小大大大小大大小大小小大小大大小小大小大小大小大小小大小小大大小大大大小大大大小大大小小小小小小大大大小大大小小小大小小小小大大小大大小小大大大大小小大小大小小大小小大小大小小小大小小大大大大大小大大小大大小小大大大大小大小小小小大大大大大小小大大小大小小大大小小大大大大大小小大小小小大大小大小小小小大大小大大小小小大小小大大小小大大小小大小小大大大小小大小大大小大小小大小小小小大大大大小小大小大小小小小小小大小小小大大大大小小小小大小小小大大小大大大小大大小大小小大大小大大小大大大小小大小大大大小大小小大小小小小小大大小大小大大大小小大小小小大大大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大小大大小小大小小大大大小小大大大小大小大小小大大大小小大大大大小小大大大小大大小小大小小小小小小小小大大大小小小小小小大小大小小大大小小大小小大小大小大小大小小小小大小小大小小小小大大大大小小大小小小小小大大小大小小大小小小小小小大大大大大小大大大小小小小大大小小大小小大小小小大大大小小小小大大小大大大小大大小小小小大大大小大大大小小小小小大小小大小大小小小小大大小小大大小大大小大小大大小大小大大大小大小大小大大大大小大大小大小大大大大小小小小小大大小大大大小大小大大大小小大大大小小大小小小大大小大小大大大小大大小大大大大大小小小大大小小大大小大大大小大小大小小大大大小大小大小小大大小大大大小大小大大小大小小小大大大大大大小小小大大小大小大小小小小大小大小大大小小小小大小小小大大小大小大小大大小大小大小"',
                'lottery_count_rules' => 871,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1000,
                'bet_amount_rules' => NULL,
                'stop_betting_amount' => 1000,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-15 16:05:03',
                'updated_at' => '2023-05-16 10:13:11',
                'total_amount_rules' => 1000.0,
                'title' => '死循环获取开奖信息',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => NULL,
                'current_issue' => NULL,
                'last_issue' => '32740806',
                'continuous_bet_count' => 0,
            ),
            21 => 
            array (
                'id' => 67,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小小小小小大小大小大小大小小小小大小小大小小大小大大小小大大大大大大小大大大小大大小大小大大大小小大大小大小小小小大小小小大大大大大小小大小小小大小小小大小大小小小大小小大大大大大大大小小大大大小小大大大大大小大小小小小大大大小小小小大小大大大小小小大小小大大小小小大小小小小小大小小小小大小小大大大大小小大小小小大大小大大大大大小小小大大小大大小大大小大大小大小小大大大小小大小小大大小小小大小小小小小大大小小小大小小大大小大大大小小大小大大大小小小大大小大小小小大小大小小大小大大大大大大大小大小大大小大大小大小小大小大小小小小小小大小大大大大小小小大大小大大大小大小小小大大大大小小大大大小小小大小大大小大大大大大大小大大大大小小大大小小小大小小大小小小小小小小大小大大小小大小小小大大小大小小大小大小大大小小大大大小大小大小大大大大小小小小大小小大大小小小小大大大大小大小小大大大大小小小大大小小小大小小大大小小大小大大大小大大小小大大小小小小小大小大小小小大小大大小小小大小大大大小大大小大大小小大小大大大小大小小小小大小大大大大大小大小大大小小小小大大大小小小小大小小大小大小大大大大大大大小小小大大大小大大大大小大大大小大小小大大小大大小小大大小小大小小大小大小小大小小大小小大小小大大大小大小小小大大小大小大小大大小小大小小大大大大小大小小大大小小小大小大大大小大大小大大小大小大小小大小小大大大小小小大小小大小小大大大小小大小大大小小大大大小大小小小小小大大大小小大小小小小小大小大小小大大大大大小小小小大小小大大小小小小小小小小小小小大小小大小大大小小大小大小小大小大大小大大小小小大小小小大大小小大大小大小大大小小大大大小小小小大大小小小大小大大小小大小小小小大小小大小大小小小大小大小大小大大大大小小小大大小小大小大大小小大小大小小大大大小大大大大大小小大小大大小大大小大小大大小大大小大小小小小小小大小大小小小小大大小大小大大大小小小小小大大大大小小大小大小大大大大小大小大小大大大小小大大大大大大小大小大大大小小大小小小大小大大小大大小小大大大大小小小大大大大小大大大小大大大小大小小小小小小小小大大小小小小小大大大大小大大小大小小小大大小大大大小大小大大大小小大大大小大小小大小小大小大小大大大小小小小大小小小小大小小大小大大大大大大小大大大小小小大大大大小小小大小小大小大大大大小大小小大大小大小大小大小小小大大大大大大大小小小大大大小小小小小大大小小大小小小大小小小小大大大小大大小大小小大小小大小小小小大大小大大小小大大大小小大小小小小大大小小大小小小小小小大小小小小小小小小大大小大小大大大小小小大大大小大小小大小小小小大小小大小小小小小小大小小大大小大大大大小小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大小大大小大小小小小小小大大小小小小小小小大大小小小大小小小大大大大小小小大小小小大小大小小小大大大小大小大小小大大小大大小大小小大小大小大大小大大小大小小小大大小小大大大小小大小小大小大小大大小大小小大大小小小大大大小小小小小小小大小大小大大大小小小大大大大小小大小大大大大小小大大大大大大大小小大小大小大小大大大小大大大大小大大小大大大小小小小小大小小大大大小小大小小小小大大小小大大大小大小大小大大小小小小大小小大大小小大大大小小大小小大大小大大小小大大大小大大大大小小大大大大大大大大小大大大大小大小大大大小大大大小小大大小小小小小大小大小小小小小大小大小大大小大小小小大大小小大大小小小小小大小大大小小小小大大小大小大小大大大大大大小小大小大小大小小小大小小小大大大小大小小大大小大大小大小大小大小小大大小小大大大小大大大小小大大大大大小小小大大大小大小大大小小大大小小小大大大小小小小小大大小大小小大大小小大小小小大小大大大小大小大大大小大小小小小大大大大小小大大小小大小大大小小大大小小小大大大大大小小小小大大大大大小大大大大小小小大大小小小大大小大小小大小小小小小小大小大小小大大小大大小小大小小大大小大小小小小大小小小小大大大大小小大大小大大大小大小大小小小大大小大大大小小小小大大大小大小小大小大小大大小大小大小小大小大大小小小大小大大大小小小小小小大大大大小大大小大小大大小小大小大小大小"',
                'lottery_count_rules' => 1930,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1608,
                'bet_amount_rules' => ',10,10,10,20,10,20,40,10,10,20,40,80,160,320,10,10,20,10,20,10,20,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,10,20,40,10,20,40,10,20,10,10,10,20,40,10,20,10,10,20,40,10,20,10,10,10,20,10,20,40,10,10,10,10,10,20,40,80,10,20,10,10,20,10,10,20,10,10,20,40,10,10,10,20,40,80,160,10,20,40,80,160,320,10,20,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大大大大大大大小大小大大大小小大大小小小小大大大大小小大小小小小小小小大小小小大大小小小小小大大大大大小小小小小小小小小小大大大大大大小小小小小小小小小小大大大小大大大大小小小大大大小大大小小小小',
                'bet_count_rules' => 101,
                'win_lose_rules' => '111010011000001101010110001100001111110010010111001011001011101001111100010110110110011100001000001010',
                'continuous_lose_count_rules' => 1,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-15 16:13:01',
                'updated_at' => '2023-05-15 16:14:41',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32739941',
                'continuous_bet_count' => 101,
            ),
            22 => 
            array (
                'id' => 68,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小小小小小大小大小大小大小小小小大小小大小小大小大大小小大大大大大大小大大大小大大小大小大大大小小大大小大小小小小大小小小大大大大大小小大小小小大小小小大小大小小小大小小大大大大大大大小小大大大小小大大大大大小大小小小小大大大小小小小大小大大大小小小大小小大大小小小大小小小小小大小小小小大小小大大大大小小大小小小大大小大大大大大小小小大大小大大小大大小大大小大小小大大大小小大小小大大小小小大小小小小小大大小小小大小小大大小大大大小小大小大大大小小小大大小大小小小大小大小小大小大大大大大大大小大小大大小大大小大小小大小大小小小小小小大小大大大大小小小大大小大大大小大小小小大大大大小小大大大小小小大小大大小大大大大大大小大大大大小小大大小小小大小小大小小小小小小小大小大大小小大小小小大大小大小小大小大小大大小小大大大小大小大小大大大大小小小小大小小大大小小小小大大大大小大小小大大大大小小小大大小小小大小小大大小小大小大大大小大大小小大大小小小小小大小大小小小大小大大小小小大小大大大小大大小大大小小大小大大大小大小小小小大小大大大大大小大小大大小小小小大大大小小小小大小小大小大小大大大大大大大小小小大大大小大大大大小大大大小大小小大大小大大小小大大小小大小小大小大小小大小小大小小大小小大大大小大小小小大大小大小大小大大小小大小小大大大大小大小小大大小小小大小大大大小大大小大大小大小大小小大小小大大大小小小大小小大小小大大大小小大小大大小小大大大小大小小小小小大大大小小大小小小小小大小大小小大大大大大小小小小大小小大大小小小小小小小小小小小大小小大小大大小小大小大小小大小大大小大大小小小大小小小大大小小大大小大小大大小小大大大小小小小大大小小小大小大大小小大小小小小大小小大小大小小小大小大小大小大大大大小小小大大小小大小大大小小大小大小小大大大小大大大大大小小大小大大小大大小大小大大小大大小大小小小小小小大小大小小小小大大小大小大大大小小小小小大大大大小小大小大小大大大大小大小大小大大大小小大大大大大大小大小大大大小小大小小小大小大大小大大小小大大大大小小小大大大大小大大大小大大大小大小小小小小小小小大大小小小小小大大大大小大大小大小小小大大小大大大小大小大大大小小大大大小大小小大小小大小大小大大大小小小小大小小小小大小小大小大大大大大大小大大大小小小大大大大小小小大小小大小大大大大小大小小大大小大小大小大小小小大大大大大大大小小小大大大小小小小小大大小小大小小小大小小小小大大大小大大小大小小大小小大小小小小大大小大大小小大大大小小大小小小小大大小小大小小小小小小大小小小小小小小小大大小大小大大大小小小大大大小大小小大小小小小大小小大小小小小小小大小小大大小大大大大小小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大小大大小大小小小小小小大大小小小小小小小大大小小小大小小小大大大大小小小大小小小大小大小小小大大大小大小大小小大大小大大小大小小大小大小大大小大大小大小小小大大小小大大大小小大小小大小大小大大小大小小大大小小小大大大小小小小小小小大小大小大大大小小小大大大大小小大小大大大大小小大大大大大大大小小大小大小大小大大大小大大大大小大大小大大大小小小小小大小小大大大小小大小小小小大大小小大大大小大小大小大大小小小小大小小大大小小大大大小小大小小大大小大大小小大大大小大大大大小小大大大大大大大大小大大大大小大小大大大小大大大小小大大小小小小小大小大小小小小小大小大小大大小大小小小大大小小大大小小小小小大小大大小小小小大大小大小大小大大大大大大小小大小大小大小小小大小小小大大大小大小小大大小大大小大小大小大小小大大小小大大大小大大大小小大大大大大小小小大大大小大小大大小小大大小小小大大大小小小小小大大小大小小大大小小大小小小大小大大大小大小大大大小大小小小小大大大大小小大大小小大小大大小小大大小小小大大大大大小小小小大大大大大小大大大大小小小大大小小小大大小大小小大小小小小小小大小大小小大大小大大小小大小小大大小大小小小小大小小小小大大大大小小大大小大大大小大小大小小小大大小大大大小小小小大大大小大小小大小大小大大小大小大小小大小大大小小小大小大大大小小小小小小大大大大小大大小大小大大小小大小大小大小大大小大小小小小小小小大大小大大小小大大小小小大大小大大小小小大大小大大大大小大大大小小小小大小小小大大大大小大小大小小小大小大大小大大大大大小大大小小大大大小小小小大大大小小小小小大小大大小大小大大大小大大小大小小大小大大小小大小大小大小大小小大小小大大小大大大小大大大小大大小小小小小小大大大小大大小小小大小小小小大大小大大小小大大大大小小大小大小小大小小大小大小小小大小小大大大大大小大大小大大小小大大大大小大小小小小大大大大大小小大大小大小小大大小小大大大大大小小大小小小大大小大小小小小大大小大大小小小大小小大大小小大大小小大小小大大大小小大小大大小大小小大小小小小大大大大小小大小大小小小小小小大小小小大大大大小小小小大小小小大大小大大大小"',
                'lottery_count_rules' => 2256,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1635,
                'bet_amount_rules' => '0,10,10,10,20,10,20,40,10,10,20,40,80,160,320,10,10,20,10,20,10,20,10,10,20,40,80,10,10,20,40,80,160,10,10,10,10,10,10,20,40,10,20,40,10,20,10,10,10,20,40,10,20,10,10,20,40,10,20,10,10,10,20,10,20,40,10,10,10,10,10,20,40,80,10,20,10,10,20,10,10,20,10,10,20,40,10,10,10,20,40,80,160,10,20,40,80,160,320,10,20,10,20,10,10,20,40,80,10,20,40,80,160,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小小小大大大大大大大小大小大大大小小大大小小小小大大大大小小大小小小小小小小大小小小大大小小小小小大大大大大小小小小小小小小小小大大大大大大小小小小小小小小小小大大大小大大大大小小小大大大小大大小小小小小小小大小小小大大大小小',
                'bet_count_rules' => 113,
                'win_lose_rules' => '111010011000001101010110001100001111110010010111001011001011101001111100010110110110011100001000001010110001000010',
                'continuous_lose_count_rules' => 1,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-15 23:00:03',
                'updated_at' => '2023-05-15 23:02:01',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => '',
                'last_issue' => '32740267',
                'continuous_bet_count' => 113,
            ),
            23 => 
            array (
                'id' => 71,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大小大大小大小小小小小小大大小小小小小小小大大小小小大小小小大大大大小小小大小小小大小大小小小大大大小大小大小小大大小大大小大小小大小大小大大小大大小大小小小大大小小大大大小小大小小大小大小大大小大小小大大小小小大大大小小小小小小小大小大小大大大小小小大大大大小小大小大大大大小小大大大大大大大小小大小大小大小大大大小大大大大小大大小大大大小小小小小大小小大大大小小大小小小小大大小小大大大小大小大小大大小小小小大小小大大小小大大大小小大小小大大小大大小小大大大小大大大大小小大大大大大大大大小大大大大小大小大大大小大大大小小大大小小小小小大小大小小小小小大小大小大大小大小小小大大小小大大小小小小小大小大大小小小小大大小大小大小大大大大大大小小大小大小大小小小大小小小大大大小大小小大大小大大小大小大小大小小大大小小大大大小大大大小小大大大大大小小小大大大小大小大大小小大大小小小大大大小小小小小大大小大小小大大小小大小小小大小大大大小大小大大大小大小小小小大大大大小小大大小小大小大大小小大大小小小大大大大大小小小小大大大大大小大大大大小小小大大小小小大大小大小小大小小小小小小大小大小小大大小大大小小大小小大大小大小小小小大小小小小大大大大小小大大小大大大小大小大小小小大大小大大大小小小小大大大小大小小大小大小大大小大小大小小大小大大小小小大小大大大小小小小小小大大大大小大大小大小大大小小大小大小大小大大小大小小小小小小小大大小大大小小大大小小小大大小大大小小小大大小大大大大小大大大小小小小大小小小大大大大小大小大小小小大小大大小大大大大大小大大小小大大大小小小小大大大小小小小小大小大大小大小大大大小大大小大小小大小大大小小大小大小大小大小小大小小大大小大大大小大大大小大大小小小小小小大大大小大大小小小大小小小小大大小大大小小大大大大小小大小大小小大小小大小大小小小大小小大大大大大小大大小大大小小大大大大小大小小小小大大大大大小小大大小大小小大大小小大大大大大小小大小小小大大小大小小小小大大小大大小小小大小小大大小小大大小小大小小大大大小小大小大大小大小小大小小小小大大大大小小大小大小小小小小小大小小小大大大大小小小小大小小小大大小大大大小大大小大小小大大小大大小大大大小小大小大大大小大小小大小小小小小大大小大小大大大小小大小小小大大大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大小大大小小大小小大大大小小大大大小大小大小小大大大小小大大大大小小大大大小大大小小大小小小小小小小小大大大小小小小小小大小大小小大大小小大小小大小大小大小大小小小小大小小大小小小小大大大大小小大小小小小小大大小大小小大小小小小小小大大大大大小大大大小小小小大大小小大小小大小小小大大大小小小小大大小大大大小大大小小小小大大大小大大大小小小小小大小小大小大小小小小大大小小大大小大大小大小大大小大小大大大小大小大小大大大大小大大小大小大大大大小小小小小大大小大大大小大小大大大小小大大大小小大小小小大大小大小大大大小大大小大大大大大小小小大大小小大大小大大大小大小大小小大大大小大小大小小大大小大大大小大小大大小大小小小大大大大大大小小小大大小大小大小小小小大小大小大大小小小小大小小小大大小大小大小大大小大小大小大大小大大大小小大大大大小小小大大大大大大小大小大小小小大小大小小大大小大大小小大大大大小小小大大小小大大小大小小小小大小小大大小小小大大小大小大小大大小大小大大小小小大大大小大小大小大小小大大小大大大大大小大小大大小小小小小大小大小小小小大大大小小大小小小小大小大小小大小大大大大大小大小大大大小大大大小小小小小大大小小小小大小大大大小小大大大大小大大小大小小大大小小大大小大大小小大小大大小大大大小大大大小小大大大小大小大大小小大大大小小小大小小小大小小小大大小大小大大大大大大小大小"',
                'lottery_count_rules' => 1887,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1390,
                'bet_amount_rules' => ',10,20,10,10,10,10,10,20,40,80,10,20,10,10,20,10,10,20,10,10,20,40,10,10,10,20,40,80,160,10,20,40,80,160,320,10,20,10,20,10,10,20,40,80,10,20,40,80,160,10,20,40,80,160,320,10,10,10,20,10,20,40,10,20,40,80,160,320,10,20,10,20,40,80,160,320,10',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小大大大大大大小小小小小小小小小小大大大小大大大大小小小大大大小大大小小小小小小小大小小小大大大小小小小小大小小小小小小小小小大小小大大大大大大小大小大大',
                'bet_count_rules' => 77,
                'win_lose_rules' => '101111100010110110110011100001000001010110001000010000011101001000001010000010',
                'continuous_lose_count_rules' => 1,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-16 15:18:11',
                'updated_at' => '2023-05-16 15:19:33',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32741050',
                'continuous_bet_count' => 77,
            ),
            24 => 
            array (
                'id' => 72,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 1,
                'status' => 'failed',
                'lottery_rules' => '"小大大大大小小小小小大小大大小大小大大小小大大小大小大大小大大小小小大大大小小大小大大大大小大小小大大大大大小小大小小小小大大大小大大大小小大大小大大小小小小小小小大小大小大大大小小小小大小小大大大小小大小大小大大小小小大小小小小小小小小小大小小小大大小小小大小大小小大大小小大小大小小大大大大大大小小大大小大大大大小大大大大小大大小大大大大大小大大小小大小大大大小小大大大大大大大小小小小大大小小大大小小小大小大小大大大小小小大大小大大小大小大小小大大小小大大小小大小大小大小小大小"',
                'lottery_count_rules' => 242,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1000,
                'bet_amount_rules' => NULL,
                'stop_betting_amount' => 1500,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-16 15:27:49',
                'updated_at' => '2023-05-16 20:32:12',
                'total_amount_rules' => 1000.0,
                'title' => '死循环获取开奖信息',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => NULL,
                'current_issue' => NULL,
                'last_issue' => '32741300',
                'continuous_bet_count' => 0,
            ),
            25 => 
            array (
                'id' => 73,
                'bpmn_xml' => '',
                'lottery_id' => 2,
                'token_id' => NULL,
                'code_type' => 0,
                'status' => 'pending',
                'lottery_rules' => '"闲闲闲庄庄闲庄庄闲闲和庄闲庄闲庄闲闲闲和闲闲庄和闲和闲闲和和庄闲闲和和和闲和闲闲闲庄闲庄庄和闲庄闲闲庄闲和庄和闲闲庄庄闲闲闲闲闲闲闲庄闲庄闲闲闲和闲闲庄闲闲和和和闲闲闲闲和庄庄和闲庄闲和和闲和闲闲闲闲闲和闲闲闲庄闲和庄闲闲闲闲闲闲闲闲庄庄闲庄庄庄庄闲闲和庄闲闲和闲庄和庄庄庄庄庄闲庄闲闲和庄和闲闲和庄闲庄和和闲闲庄闲庄闲闲庄和闲庄闲庄庄闲庄庄闲闲庄庄庄闲庄闲闲闲庄和闲和闲闲闲闲闲闲庄闲闲闲和和庄庄庄庄庄闲闲闲闲闲闲闲和庄闲庄庄闲闲闲闲庄庄闲闲闲闲闲闲闲庄庄闲闲庄闲闲庄和闲闲闲庄闲和和庄闲闲庄闲庄闲闲闲闲闲庄庄闲闲庄庄闲闲庄闲闲闲庄闲庄庄庄闲庄庄闲闲闲庄闲闲闲和和闲庄闲闲闲闲闲闲闲闲闲庄闲闲闲闲闲庄闲闲闲闲闲闲闲和闲闲闲和庄庄和闲闲闲闲闲和闲闲闲和闲闲闲闲闲闲闲庄闲闲庄闲闲庄庄庄庄闲闲闲闲闲闲庄闲闲闲闲闲闲庄和庄庄庄和庄庄和闲闲闲闲和闲闲庄闲和闲庄庄闲闲闲闲闲闲庄闲庄闲闲和和闲庄闲闲闲庄庄庄庄闲闲庄闲闲闲闲闲闲闲闲庄庄闲闲庄闲闲闲闲闲庄庄庄庄闲闲闲闲闲闲闲闲和和庄庄庄闲和庄庄和闲庄闲庄闲庄闲庄闲闲庄和闲闲闲庄闲闲闲庄闲闲闲闲闲庄庄闲闲闲和闲庄庄闲闲庄闲闲闲闲庄闲庄庄闲庄庄闲闲闲和闲庄闲庄闲闲闲闲闲闲闲和和闲庄闲闲闲闲庄闲闲和庄和闲闲闲庄庄闲闲和闲和闲闲闲闲闲闲庄庄闲庄庄闲闲闲闲闲闲闲庄闲闲闲闲闲闲闲庄庄闲闲庄庄闲庄和闲闲闲庄闲庄闲闲闲闲和闲庄和闲闲庄庄闲庄闲闲庄庄闲庄庄和和闲和庄庄闲闲庄和闲庄闲闲闲闲和庄庄闲闲闲和庄闲庄闲闲闲闲闲闲庄闲闲闲闲闲和庄庄闲闲闲庄和闲闲闲闲闲"',
                'lottery_count_rules' => 643,
                'bet_base_amount_rules' => 0,
                'bet_total_amount_rules' => 0,
                'bet_amount_rules' => NULL,
                'stop_betting_amount' => 0,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-16 15:32:10',
                'updated_at' => '2023-05-17 02:14:30',
                'total_amount_rules' => 0.0,
                'title' => '射龙门',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => NULL,
                'current_issue' => NULL,
                'last_issue' => NULL,
                'continuous_bet_count' => 0,
            ),
            26 => 
            array (
                'id' => 74,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 2,
                'status' => 'failed',
                'lottery_rules' => '"小大大大大大小大小大大小大大小大小大小大小大大小大小小小大大小大小大大大大大大大大大小小大大大小小大小大大大小小小小大大小大小大大大小大大小小小小小小小小小大小大大小小大大大小大小小大大小小大小小大大大大大小大小小小大小大小小小大小小小大大大小大小小小小小大小小大大小小小小大大小大小大大小小小小大小小小大大小小小大小大大大小小小大大大大大大小小大小大大小大小小大大小大小小小小小小大大大大小大大大小小大大大大大小大小大大小大小大大大小小大小大大小小小小大大小小小小小小大小大大小大小大小大小小小小大大小大大小小小小大小大大大大大大大大大大小小小小小小小小大大小小小小小大小小大大小小小小小大小小小小小小小小大小小大小小大大大大小小大大小小小小小小小小小小小小大大大小大小大小小小小大大大大小大小小大大小小大大小大大小大小大小小大小大小小小小小小大小小大大大小大小大大大小小小大小小大小小小大小大小小小大小小小小小小小大大大大大大大小大大小大小小小小小大小小大小小大大小大小大大小小小小小大小大大大大大大小大大大小小大大小小大小大小大小大大小小小小大小小小小大大大小大大大小小小大小大小大大小大大小小大小大小小小大大大小小大大小大小大小小大小小小大小大大小大大小小小小大小大小小大大小小大小小小大小大小小小小小大小小大大小小大小大小小小大大小小小小大小大小小大小小小小大小大大大小小小小大大大大大小大小小大大小小小小大小大小小小小小大大大小小小大小大小小小大大大大大小大小小小小小大小"',
                'lottery_count_rules' => 642,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 947,
                'bet_amount_rules' => ',10,20,10,10,10,10,20,10,10,10,10,20,40,80,10,20,10,20,40,10,20,10,10,10,10,10,20,10,10,10,20,40,80,10,10,10,20,10,10,10,10,10,10,10,20,10,20,10,10,20,10,10,20,40,80,10,20,40,80,160,320',
                'stop_betting_amount' => 1600,
                'bet_code_rules' => '大大大大大大小小小小小大小大大小小大小小大大大大大大小小小小小小小小小小小小小小小小小小小小小小小大大大小小大大小大小大小',
                'bet_count_rules' => 61,
                'win_lose_rules' => '10111101111000101001011111011100011101111111010110110001000000',
                'continuous_lose_count_rules' => 6,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-16 20:31:48',
                'updated_at' => '2023-05-17 09:54:20',
                'total_amount_rules' => 1250.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 320.0,
                'current_issue' => NULL,
                'last_issue' => '32741943',
                'continuous_bet_count' => 61,
            ),
            27 => 
            array (
                'id' => 75,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大小大大小大小小小小小小大大小小小小小小小大大小小小大小小小大大大大小小小大小小小大小大小小小大大大小大小大小小大大小大大小大小小大小大小大大小大大小大小小小大大小小大大大小小大小小大小大小大大小大小小大大小小小大大大小小小小小小小大小大小大大大小小小大大大大小小大小大大大大小小大大大大大大大小小大小大小大小大大大小大大大大小大大小大大大小小小小小大小小大大大小小大小小小小大大小小大大大小大小大小大大小小小小大小小大大小小大大大小小大小小大大小大大小小大大大小大大大大小小大大大大大大大大小大大大大小大小大大大小大大大小小大大小小小小小大小大小小小小小大小大小大大小大小小小大大小小大大小小小小小大小大大小小小小大大小大小大小大大大大大大小小大小大小大小小小大小小小大大大小大小小大大小大大小大小大小大小小大大小小大大大小大大大小小大大大大大小小小大大大小大小大大小小大大小小小大大大小小小小小大大小大小小大大小小大小小小大小大大大小大小大大大小大小小小小大大大大小小大大小小大小大大小小大大小小小大大大大大小小小小大大大大大小大大大大小小小大大小小小大大小大小小大小小小小小小大小大小小大大小大大小小大小小大大小大小小小小大小小小小大大大大小小大大小大大大小大小大小小小大大小大大大小小小小大大大小大小小大小大小大大小大小大小小大小大大小小小大小大大大小小小小小小大大大大小大大小大小大大小小大小大小大小大大小大小小小小小小小大大小大大小小大大小小小大大小大大小小小大大小大大大大小大大大小小小小大小小小大大大大小大小大小小小大小大大小大大大大大小大大小小大大大小小小小大大大小小小小小大小大大小大小大大大小大大小大小小大小大大小小大小大小大小大小小大小小大大小大大大小大大大小大大小小小小小小大大大小大大小小小大小小小小大大小大大小小大大大大小小大小大小小大小小大小大小小小大小小大大大大大小大大小大大小小大大大大小大小小小小大大大大大小小大大小大小小大大小小大大大大大小小大小小小大大小大小小小小大大小大大小小小大小小大大小小大大小小大小小大大大小小大小大大小大小小大小小小小大大大大小小大小大小小小小小小大小小小大大大大小小小小大小小小大大小大大大小大大小大小小大大小大大小大大大小小大小大大大小大小小大小小小小小大大小大小大大大小小大小小小大大大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大小大大小小大小小大大大小小大大大小大小大小小大大大小小大大大大小小大大大小大大小小大小小小小小小小小大大大小小小小小小大小大小小大大小小大小小大小大小大小大小小小小大小小大小小小小大大大大小小大小小小小小大大小大小小大小小小小小小大大大大大小大大大小小小小大大小小大小小大小小小大大大小小小小大大小大大大小大大小小小小大大大小大大大小小小小小大小小大小大小小小小大大小小大大小大大小大小大大小大小大大大小大小大小大大大大小大大小大小大大大大小小小小小大大小大大大小大小大大大小小大大大小小大小小小大大小大小大大大小大大小大大大大大小小小大大小小大大小大大大小大小大小小大大大小大小大小小大大小大大大小大小大大小大小小小大大大大大大小小小大大小大小大小小小小大小大小大大小小小小大小小小大大小大小大小大大小大小大小大大小大大大小小大大大大小小小大大大大大大小大小大小小小大小大小小大大小大大小小大大大大小小小大大小小大大小大小小小小大小小大大小小小大大小大小大小大大小大小大大小小小大大大小大小大小大小小大大小大大大大大小大小大大小小小小小大小大小小小小大大大小小大小小小小大小大小小大小大大大大大小大小大大大小大大大小小小小小大大小小小小大小大大大小小大大大大小大大小大小小大大小小大大小大大小小大小大大小大大大小大大大小小大大大小大小大大小小大大大小小小大小小小大小小小大大小大小大大大大大大小大小大大大小大大小小小大大大大小小小小小大小大大小大小大大小小大大小大小大大小大大小小小大大大小小大小大大大大小大小小大大大大大小小大小小小小大大大小大大大小小大大小大大小小小小小小小大小大小大大大小小小小大小小大大大小小大小大小大大小小小大小小小小小小小小小大小小小大大小小小大小大小小大大小小大小大小小大大大大大大小小大大小大大大大小大大大大小大大小大大大大大小大大小小大小大大大小小大大大大大大大小小小小大大小小大大小小小大小大小大大大小小小大大小大大小大小大小小大大小小大大小小大小大小大小小大小大小大大大大大小大小大大小大大小大小大小大小大大小大小小小大大小大小大大大大大大大大大小小大大大小小大小大大大小小小小大大小大小大大大小大大小小小小小小小小小大小大大小小大大大小大小小大大小小大小小大大大大大小大小小小大小大小小小大小小小"',
                'lottery_count_rules' => 2256,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1529,
                'bet_amount_rules' => '0,10,20,10,10,10,10,10,20,40,80,10,20,10,10,20,10,10,20,10,10,20,40,10,10,10,20,40,80,160,10,20,40,80,160,320,10,20,10,20,10,10,20,40,80,10,20,40,80,160,10,20,40,80,160,320,10,10,10,20,10,20,40,10,20,40,80,160,320,10,20,10,20,40,80,160,320,10,20,40,80,10,10,20,10,10,10,10,20,10,20,40,10,10,20,40,10,10,10,10,20,10,10,10,10,20',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => '小大大大大大大小小小小小小小小小小大大大小大大大大小小小大大大小大大小小小小小小小大小小小大大大小小小小小大小小小小小小小小小大小小大大大大大大小大小大大小大小小小小小小小小大大大大大大大大大大大大小小小小小大',
                'bet_count_rules' => 105,
                'win_lose_rules' => '1011111000101101101100111000010000010101100010000100000111010010000010100000100011011110100110011110111100',
                'continuous_lose_count_rules' => 2,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-16 23:00:03',
                'updated_at' => '2023-05-16 23:01:46',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 20.0,
                'current_issue' => '',
                'last_issue' => '32741419',
                'continuous_bet_count' => 105,
            ),
            28 => 
            array (
                'id' => 76,
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="随机投注" isExecutable="false">
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
<outgoing>Flow_1sl5j1j</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_0qy900k</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_0vgmnk1</incoming>
<outgoing>Flow_0qy900k</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_05ghkdt" name="createBetCodeTask">
<incoming>Flow_1sl5j1j</incoming>
<outgoing>Flow_0vgmnk1</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_code_rule = $request-&gt;requestLotteryOption-&gt;pluck(\'value\')-&gt;random();
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_0vgmnk1" sourceRef="Activity_05ghkdt" targetRef="Activity_1k2wjfy" />
<sequenceFlow id="Flow_0qy900k" sourceRef="Activity_1k2wjfy" targetRef="Activity_0bbkk1o" />
<sequenceFlow id="Flow_1sl5j1j" sourceRef="Activity_19dyqqr" targetRef="Activity_05ghkdt" />
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
<bpmndi:BPMNShape id="Activity_1lnbzn9_di" bpmnElement="Activity_05ghkdt">
<omgdc:Bounds x="690" y="580" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="690" y="760" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
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
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0vgmnk1_di" bpmnElement="Flow_0vgmnk1">
<di:waypoint x="740" y="660" />
<di:waypoint x="740" y="760" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0qy900k_di" bpmnElement="Flow_0qy900k">
<di:waypoint x="740" y="840" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1sl5j1j_di" bpmnElement="Flow_1sl5j1j">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="580" />
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大"',
                'lottery_count_rules' => 174,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1300,
                'bet_amount_rules' => ',10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10',
                'stop_betting_amount' => 1300,
                'bet_code_rules' => '小大小大大大大小小大大小大小大大小小大小小大小小大小小大小大小大小小大大大大小大大大小小小小小小大小小大小小大大小小小小小小大小小小小大大小大小大大小小小小大大大小小小小大大大大小小大小小小大大大小小小大大小小大小小小大小大小小小小小大大大大大小大大大小大大小大大小小大大大小小小大小大大小大小小大大大小小小大大小大大大小小小大小小小大小大大大大大',
                'bet_count_rules' => 174,
                'win_lose_rules' => '110011011100010011101111111111001101010100101101011000011000000011111101111101011001111000011000011010100111111111110110011100011000001010010111101111111100001111101100011111',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 5,
                'created_at' => '2023-05-16 23:56:12',
                'updated_at' => '2023-05-16 23:56:28',
                'total_amount_rules' => 1000.0,
                'title' => '随机投注',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32739337',
                'continuous_bet_count' => 174,
            ),
            29 => 
            array (
                'id' => 77,
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="随机投注" isExecutable="false">
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
<outgoing>Flow_1sl5j1j</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_0qy900k</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_0vgmnk1</incoming>
<outgoing>Flow_0qy900k</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_05ghkdt" name="createBetCodeTask">
<incoming>Flow_1sl5j1j</incoming>
<outgoing>Flow_0vgmnk1</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_code_rule = $request-&gt;requestLotteryOption-&gt;pluck(\'value\')-&gt;random();
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_0vgmnk1" sourceRef="Activity_05ghkdt" targetRef="Activity_1k2wjfy" />
<sequenceFlow id="Flow_0qy900k" sourceRef="Activity_1k2wjfy" targetRef="Activity_0bbkk1o" />
<sequenceFlow id="Flow_1sl5j1j" sourceRef="Activity_19dyqqr" targetRef="Activity_05ghkdt" />
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
<bpmndi:BPMNShape id="Activity_1lnbzn9_di" bpmnElement="Activity_05ghkdt">
<omgdc:Bounds x="690" y="580" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="690" y="760" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
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
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0vgmnk1_di" bpmnElement="Flow_0vgmnk1">
<di:waypoint x="740" y="660" />
<di:waypoint x="740" y="760" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0qy900k_di" bpmnElement="Flow_0qy900k">
<di:waypoint x="740" y="840" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1sl5j1j_di" bpmnElement="Flow_1sl5j1j">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="580" />
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大小大大小大小小小小小小大大小小小小小小小大大小小小大小小小大大大大小小小大小小小大小大小小小大大大小大小大小小大大小大大小大小小大小大小大大小大大小大小小小大大小小大大大小小大小小大小大小大大小大小小大大小小小大大大小小小小小小小大小大小大大大小小小大大大大小小大小大大大大小小大大大大大大大小小大小大小大小大大大小大大大大小大大小大大大小小小小小大小小大大大小小大小小小小大大小小大大大小大小大小大大小小小小大小小大大小小大大大小小大小小大大小大大小小大大大小大大大大小小大大大大大大大大小大大大大小大小大大大小大大大小小大大小小小小小大小大小小小小小大小大小大大小大小小小大大小小大大小小小小小大小大大小小小小大大小大小大小大大大大大大小小大小大小大小小小大小小小大大大小大小小大大小大大小大小大小大小小大大小小大大大小大大大小小大大大大大小小小大大大小大小大大小小大大小小小大大大小小小小小大大小大小小大大小小大小小小大小大大大小大小大大大小大小小小小大大大大小小大大小小大小大大小小大大小小小大大大大大小小小小大大大大大小大大大大小小小大大小小小大大小大小小大小小小小小小大小大小小大大小大大小小大小小大大小大小小小小大小小小小大大大大小小大大小大大大小大小大小小小大大小大大大小小小小大大大小大小小大小大小大大小大小大小小大小大大小小小大小大大大小小小小小小大大大大小大大小大小大大小小大小大小大小大大小大小小小小小小小大大小大大小小大大小小小大大小大大小小小大大小大大大大小大大大小小小小大小小小大大大大小大小大小小小大小大大小大大大大大小大大小小大大大小小小小大大大小小小小小大小大大小大小大大大小大大小大小小大小大大小小大小大小大小大小小大小小大大小大大大小大大大小大大小小小小小小大大大小大大小小小大小小小小大大小大大小小大大大大小小大小大小小大小小大小大小小小大小小大大大大大小大大小大大小小大大大大小大小小小小大大大大大小小大大小大小小大大小小大大大大大小小大小小小大大小大小小小小大大小大大小小小大小小大大小小大大小小大小小大大大小小大小大大小大小小大小小小小大大大大小小大小大小小小小小小大小小小大大大大小小小小大小小小大大小大大大小大大小大小小大大小大大小大大大小小大小大大大小大小小大小小小小小大大小大小大大大小小大小小小大大大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大小大大小小大小小大大大小小大大大小大小大小小大大大小小大大大大小小大大大小大大小小大小小小小小小小小大大大小小小小小小大小大小小大大小小大小小大小大小大小大小小小小大小小大小小小小大大大大小小大小小小小小大大小大小小大小小小小小小大大大大大小大大大小小小小大大小小大小小大小小小大大大小小小小大大小大大大小大大小小小小大大大小大大大小小小小小大小小大小大小小小小大大小小大大小大大小大小大大小大小大大大小大小大小大大大大小大大小大小大大大大小小小小小大大小大大大小大小大大大小小大大大小小大小小小大大小大小大大大小大大小大大大大大小小小大大小小大大小大大大小大小大小小大大大小大小大小小大大小大大大小大小大大小大小小小大大大大大大小小小大大小大小大小小小小大小大小大大小小小小大小小小大大小大小大小大大小大小大小大大小大大大小小大大大大小小小大大大大大大小大小大小小小大小大小小大大小大大小小大大大大小小小大大小小大大小大小小小小大小小大大小小小大大小大小大小大大小大小大大小小小大大大小大小大小大小小大大小大大大大大小大小大大小小小小小大小大小小小小大大大小小大小小小小大小大小小大小大大大大大小大小大大大小大大大小小小小小大大小小小小大小大大大小小大大大大小大大小大小小大大小小大大小大大小小大小大大小大大大小大大大小小大大大小大小大大小小大大大小小小大小小小大小小小大大小大小大大大大大大小大小大大大小大大小小小大大大大小小小小小大小大大小大小大大小小大大小大小大大小大大小小小大大大小小大小大大大大小大小小大大大大大小小大小小小小大大大小大大大小小大大小大大小小小小小小小大小大小大大大小小小小大小小大大大小小大小大小大大小小小大小小小小小小小小小大小小小大大小小小大小大小小大大小小大小大小小大大大大大大小小大大小大大大大小大大大大小大大小大大大大大小大大小小大小大大大小小大大大大大大大小小小小大大小小大大小小小大小大小大大大小小小大大小大大小大小大小小大大小小大大小小大小大小大小小大小大小大大大大大小大小大大小大大小大小大小大小大大小大小小小大大小大小大大大大大大大大大小小大大大小小大小大大大小小小小大大小大小大大大小大大小小小小小小小小小大小大大小小大大大小大小小大大小小大小小大大大大大小大小小小大小大小小小大小小小大大大小大小小小小小大小小大大小小小小大大小大小大大小小小小大小小小大大小小小大小大大大小小"',
                'lottery_count_rules' => 2302,
                'bet_base_amount_rules' => 20,
                'bet_total_amount_rules' => 454,
                'bet_amount_rules' => ',20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20',
                'stop_betting_amount' => 1500,
                'bet_code_rules' => '大大大小大大大大小大小小大小大小大小小小小大小大小小小小小大小小大小大小小小大小小大小大小小小小大大大大小大小小小小大小小大大大大小大大大小小小小小大大小小大大大大小大小大小大小大大大大大小大小大小大大大小大小小大大大小大小小大小大小小大小大小小小小大大小小大小小小大小小大小小大小大大小大小小小小小小小大小小小小大小大大小小小大小大小小小小小大大大小小小小大大小大大小小小小大小大小小小大大大小大大小小大大大小大小小大大小大大小大大小小大大小大小小大大小大大小大大小大大小小大小大小小大大小大小大小小小小大大大小大小小小大小小小小小小小大大大大大小大大大大大小小小小大小大大大小大小小大小小大小大小小小大小大大大小大小小小大大大小小大大小小大大小大大小小小大小大小大大小小大小大大小大大大大小小小大大小大小大小小大小小大小小大小大大小小大大大大大大大大小大大大大大小小大小小小小小大小大大大小大大大小小小大小大小大小小小小小大大小小大大小小小大小大小小大大小大小大小小小小小大小小小大大小小小小大大小小小大小大大小小大小大大大小小小小大大小小大大大小小小小小小小小小大小小小小小小大小小小小小小大大大小小大小小小大大大大小大小小大小小小大大小小小大大小大小大小小大大小大大大小小大小大小大小小小小大小大小小小大大小小小小小小大小大小大大大大小小大大小大小大小大大大小大大大小小大大大小小大小小大大小大小小小小小小大大小大小小小小小大大小小大大大大小大大大大大小大小大小小小大小大大大大大大小大大大小大大大小大大小大大大大小小小大大大小大小小小小小小小小大大小小小小小大大大大大大小小大大大小大大小大小小大大大小小小小大大小大小小大大小大大小大大大大大小大大小大大大大小大小大小大大大大大大大大小大小大大大小小大小小大大大小小大大大大小小小小大大小小小小小大大大小大小大大大小大大小大大小大大小小小小小小大大大小小小大大小小大大大小小大大大大小大大大大大大小小大大大小大小小大小小小大大小小大大大小小小小小大大小小小大大小小大大小小小大小小小大小大大小小大小小小大小大大大小大大小大大大小大小小小小大小小小小大小大小大小大小小小小大大小小小小小小大小大大大小大小小大大大小大大小大小小大大大大小小小大小大小小大小大大大小小小大大大小大小大小小小小小大小大大小小小大小小大大大小小大小小大大小大大小大大大大小大小大小大小小小小小小小大小小大小大小小小大大小大大大小大大小小大大大大小小小大大小小小小小小小大大大小大小大小大小小小大大大小大小小小小大大小大小小小小大大小大小大小大小小大大小小小小大大大大小大小小大大大大大大小小小小大大大大大大大小小小小大小小大小大小小小小大大小大小小小小大小小小大小大大大小大大小大大小小小小小大大小小大小小大小小小大大大小大小小大小大大小大大大大小大大大大小小大大大大小大小小大小小小小小大大大小小小大大大大大小小小小小大大小大大大小小大小小小小大大小小小大大小大小大小小小小大小大大大小大小小小大小小小小小大小大小大小大小大大小小小大小大大大小大大小小小小小大大小大小小大小小小小小大大小小小大大小小小大大大小小小大大大小小大大小大大大大小小小大小大小小大小小大大小小大小大大大大大大大小大小小大小大大大小小小小小大小小小小小大大小大大小小大小小小大小大小大小小大大大大大小小大大大小大小大大大小小大小大小大小小大大大小大小大小小大大小小小大大大大大小小大大大小大小大大小大小小小小小大小大大小大大大小大大小大小小小大小小大大小大大小大大大小大小小大小大小小大大小大大小小大小大大大小大小大大大小大小小小大小小大大小小大大小小小小大小小大小大大小小小小大大小小大大大小小大大小小小小大大大小大小小大大小小大小大大小大小大小小大小大小小大小大大小大小大小小小大小小大小大大大小大小大大大小小大小小小小大小小小大小小小大小大大大大大大大大小小大大小小大小大小大小小小大小小大大大大小大小小小小小大大小大小小大大小小大大大大大大大小大小大大大小小大大小小大大小大小大小大小小大小小大小大大小大小小大大小大大小大大大小小大大大小大小小小大大小大大大大小小小大大小小小大大大小大小小小大大小小大小大大大大小小小大大大小小大大小小小小大小大小大大小小小小小小大小大大大小大小小小大小小小大小小大小小大小小小大大小小小大小小大小小小小小大小小小小大小小小大大小小小大小小大小小大大小小小小小小大小小大小小小大小小大大大大小大小小大小大大大小小小小大小小大小大大小大大大大小小大小大大小小大小大小小大小小大大小大大大大大大小小大小大小大小小小小小小小大大小小小大大小大大小小大大大小小大小大大大大小大小小大大大小小小小大大小小小大大小小小大大大大大大小大大小大大大大小小大小小大小大小大小小大大大小小小小小大小小大小大小大大小小大小小大小小小大大大大小小小大小小小小小大小小大大小小大小大大小大小大大大小小大大大小小小小大大大小大大小大小小小小大小小小小大大大小小小小小小小大大大小大大大大大小大小小大大小小大小大大小大小大大大小大小大大大大小小小大大大小大大小大小大小大大大小大小小小大小小大小大大大小小小大小大大大小大小小大小小大大小小大大小小小小小小小大大小大小大大大小大小大大大大小大大大大大小大小小大小小大小大小小大大大小小大小大大大大小小小大小小小小小大小小大小大小大大小小小大大大小大大大小小大大大大小小大大小小大大小大大大小小小小大小大大大大小大小大大小大大小小大小',
                'bet_count_rules' => 2301,
                'win_lose_rules' => '1001010101010100001111110011010000011010111001010101001000010010001011001000110110110111011011100010011111000000010111001101110001111001000110010101100010011010101000011100010101010010000110101101001101111100111010111011110001101111111101000000010000110000101110010101000100100001101110100111101010110000110101011111001111100011001110111011110000010101011001011101001110010110001100111110011001110010000000101110001100100001111011110111001011110011100010001001011101001001110101111001000100001011010010111111111000101100011011011001011111111101011110100010101001111011000000011001101010100010110101101010000101001010000000001011100100100000111000010011100000000011001011010011010101011001000101111010000101101101000010100011010110001100000110110001110100110101111010100011100101010110100011111110101110001111111101111011001010001001011111001010001111001111011000010111001011100011000000111110100001010011011101110010101111101001110100001111101011101111111110100110101101001000010100101100111001110100100011001000110101011111101001110001011010000011000101001111001100101011001101111101001011100011111010110101001010001110011000001000111111111000010101111110010110111011000001111100011101000101101101110000111101101011010010100010010000111111101000100000001101110001010011101100011110001000111011100000010111011011110110111111000011100100010010101111000000110010100001010101011100000101100111010011101100111000110010010100011110110010101000001100111111101010110111110100100001100001111100110000110101111100010000100101011011000000101011000000100101000111110101101010110011110100000101110000010000110100100000111011101010000101100101101010000110001110010001100110000001111101100011011100111110101010000101001011000110011111101010010110110000111001101001110111100101011111000010011101101010010001101001010001111101010000100011111011000001111000100110001011101001000111111101001101111110001110100100001001100111110111010111010101100100001101110011011100100010101111100001010000111000100111001011011111110001101000011111001011000100010001010111010000100001001111011110001111001010011100000100110010110011010001110100001011110110001001101001110111101000011110100011111001100101110010011010100110101110101111111100100001011001100101100100100111010001001111110001101100101100101010110100100011011000011000010001',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 1,
                'created_at' => '2023-05-16 23:57:05',
                'updated_at' => '2023-05-17 00:00:09',
                'total_amount_rules' => 1000.0,
                'title' => '随机投注',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 20.0,
                'current_issue' => NULL,
                'last_issue' => '32741465',
                'continuous_bet_count' => 2301,
            ),
            30 => 
            array (
                'id' => 78,
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="随机投注" isExecutable="false">
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
<outgoing>Flow_1sl5j1j</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_0qy900k</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_0vgmnk1</incoming>
<outgoing>Flow_0qy900k</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_05ghkdt" name="createBetCodeTask">
<incoming>Flow_1sl5j1j</incoming>
<outgoing>Flow_0vgmnk1</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_code_rule = $request-&gt;requestLotteryOption-&gt;pluck(\'value\')-&gt;random();
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_0vgmnk1" sourceRef="Activity_05ghkdt" targetRef="Activity_1k2wjfy" />
<sequenceFlow id="Flow_0qy900k" sourceRef="Activity_1k2wjfy" targetRef="Activity_0bbkk1o" />
<sequenceFlow id="Flow_1sl5j1j" sourceRef="Activity_19dyqqr" targetRef="Activity_05ghkdt" />
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
<bpmndi:BPMNShape id="Activity_1lnbzn9_di" bpmnElement="Activity_05ghkdt">
<omgdc:Bounds x="690" y="580" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="690" y="760" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
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
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0vgmnk1_di" bpmnElement="Flow_0vgmnk1">
<di:waypoint x="740" y="660" />
<di:waypoint x="740" y="760" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0qy900k_di" bpmnElement="Flow_0qy900k">
<di:waypoint x="740" y="840" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1sl5j1j_di" bpmnElement="Flow_1sl5j1j">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="580" />
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"小小小大大大小大小小小小大大大小大小小小小小大小小大小小大小小大大小大大小大小小小小大大小小大小大大小大小大大大大大大大大大大小小小小小大大大大小大大小大小大大大小大小小小大小小小大小大大大大小大大大小大大小大小大小小小大小大小小小大小大小小大大小小小小小大小大小小大小小大小大小大大小大大大大小小大大大小小大小小大大大大小小大大小大大小小大大大大小大大小大小小小小小小大大小小小小小小小大大小小小大小小小大大大大小小小大小小小大小大小小小大大大小大小大小小大大小大大小大小小大小大小大大小大大小大小小小大大小小大大大小小大小小大小大小大大小大小小大大小小小大大大小小小小小小小大小大小大大大小小小大大大大小小大小大大大大小小大大大大大大大小小大小大小大小大大大小大大大大小大大小大大大小小小小小大小小大大大小小大小小小小大大小小大大大小大小大小大大小小小小大小小大大小小大大大小小大小小大大小大大小小大大大小大大大大小小大大大大大大大大小大大大大小大小大大大小大大大小小大大小小小小小大小大小小小小小大小大小大大小大小小小大大小小大大小小小小小大小大大小小小小大大小大小大小大大大大大大小小大小大小大小小小大小小小大大大小大小小大大小大大小大小大小大小小大大小小大大大小大大大小小大大大大大小小小大大大小大小大大小小大大小小小大大大小小小小小大大小大小小大大小小大小小小大小大大大小大小大大大小大小小小小大大大大小小大大小小大小大大小小大大小小小大大大大大小小小小大大大大大小大大大大小小小大大小小小大大小大小小大小小小小小小大小大小小大大小大大小小大小小大大小大小小小小大小小小小大大大大小小大大小大大大小大小大小小小大大小大大大小小小小大大大小大小小大小大小大大小大小大小小大小大大小小小大小大大大小小小小小小大大大大小大大小大小大大小小大小大小大小大大小大小小小小小小小大大小大大小小大大小小小大大小大大小小小大大小大大大大小大大大小小小小大小小小大大大大小大小大小小小大小大大小大大大大大小大大小小大大大小小小小大大大小小小小小大小大大小大小大大大小大大小大小小大小大大小小大小大小大小大小小大小小大大小大大大小大大大小大大小小小小小小大大大小大大小小小大小小小小大大小大大小小大大大大小小大小大小小大小小大小大小小小大小小大大大大大小大大小大大小小大大大大小大小小小小大大大大大小小大大小大小小大大小小大大大大大小小大小小小大大小大小小小小大大小大大小小小大小小大大小小大大小小大小小大大大小小大小大大小大小小大小小小小大大大大小小大小大小小小小小小大小小小大大大大小小小小大小小小大大小大大大小大大小大小小大大小大大小大大大小小大小大大大小大小小大小小小小小大大小大小大大大小小大小小小大大大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大小大大小小大小小大大大小小大大大小大小大小小大大大小小大大大大小小大大大小大大小小大小小小小小小小小大大大小小小小小小大小大小小大大小小大小小大小大小大小大小小小小大小小大小小小小大大大大小小大小小小小小大大小大小小大小小小小小小大大大大大小大大大小小小小大大小小大小小大小小小大大大小小小小大大小大大大小大大小小小小大大大小大大大小小小小小大小小大小大小小小小大大小小大大小大大小大小大大小大小大大大小大小大小大大大大小大大小大小大大大大小小小小小大大小大大大小大小大大大小小大大大小小大小小小大大小大小大大大小大大小大大大大大小小小大大小小大大小大大大小大小大小小大大大小大小大小小大大小大大大小大小大大小大小小小大大大大大大小小小大大小大小大小小小小大小大小大大小小小小大小小小大大小大小大小大大小大小大小大大小大大大小小大大大大小小小大大大大大大小大小大小小小大小大小小大大小大大小小大大大大小小小大大小小大大小大小小小小大小小大大小小小大大小大小大小大大小大小大大小小小大大大小大小大小大小小大大小大大大大大小大小大大小小小小小大小大小小小小大大大小小大小小小小大小大小小大小大大大大大小大小大大大小大大大小小小小小大大小小小小大小大大大小小大大大大小大大小大小小大大小小大大小大大小小大小大大小大大大小大大大小小大大大小大小大大小小大大大小小小大小小小大小小小大大小大小大大大大大大小大小大大大小大大小小小大大大大小小小小小大小大大小大小大大小小大大小大小大大小大大小小小大大大小小大小大大大大小大小小大大大大大小小大小小小小大大大小大大大小小大大小大大小小小小小小小大小大小大大大小小小小大小小大大大小小大小大小大大小小小大小小小小小小小小小大小小小大大小小小大小大小小大大小小大小大小小大大大大大大小小大大小大大大大小大大大大小大大小大大大大大小大大小小大小大大大小小大大大大大大大小小小小大大小小大大小小小大小大小大大大小小小大大小大大小大小大小小大大小小大大小小大小大小大小小大小大小大大大大大小大小大大小大大小大小大小大小大大小大小小小大大小大小大大大大大大大大大小小大大大小小大小大大大小小小小大大小大小大大大小大大小小小小小小小小小大小大大小小大大大小大小小大大小小大小小大大大大大小大小小小大小大小小小大小小小大大大小大小小小小小大小小大大小小小小大大小大小大大小小小小大小小小大大小小小大小大大大小小小大"',
                'lottery_count_rules' => 2304,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1230,
                'bet_amount_rules' => ',10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10',
                'stop_betting_amount' => 1500,
                'bet_code_rules' => '小小小小小小大大小大大大大小大小大小大小小大小大大小大小小大小大小大大大小大小大小小大大小大大大大小小大大大小小小大小大小大小小大小大小小小小大大小小大大小小大大小大大大小小大大大小小大大大小大小小小小小小大小大小大小小小大大小小小小小大大小小小大大大小小大小小小小大小大大大小小小小小小小小大大大大小大大大小大小大大大小大小大大大大小小大大小大小大小小小大小小大小小小小大小大小小大小小小小大小大大大大大大大小大小小小小大大大大大大大小小大小小大大小小小小小大大大小大小小小大大小小大小小小大小大小小大小小大小小小小大小小大大大大小小大小大小小大大小大小大大大小大小大大大大大小小小大大大大大大大大小大大大大小大大大大大小小大小小小小小大小大小大小小大小大小大小小大小大小小大小大大小小小大大大小大大大大小大小小小小小小大小小小大大小大小小小大大大小小大大小小大大大小小小大大大小大大大小小大大大大大大大大大大小小大大大小小小大大小小小大小大小大小大大小大大大小小小小小大大大大大小大小大大大小小小小小小大小大大小小大小大大小大小大大大小大大小小小大小小小大小大大大大小小小小大小小大大小大大大小大小大小大小大小小大小小小小小小小小小小大大大大大大大小小大小大大大大大小小大大大大小小大小小大小大小小大小小小大大大大大大大小小大小小小大大大大小大大小小小小大小小大小小小大大大小小小小大大大大小小小大小小小小小大小小大大小小大小小小小大小小大大小大大大大大大大小小小大小大小大大大大大小小大小大小大大大大大大大小小小小小大小大小大大小大小大大小小小大大小大大大小大大大小大小大大大大大小大小大大小小大大大大大大大大小小大大小大小小小小小小小小大小大小大小大大小小大大小大小大大小大大小小小大小大大小小大大小大大小小小大大大小大小小小大小小小大小小大小小大小大小大小小大小小大大大大大小大小小大大小大小小大大小大小大大大小大小大小小小小大大小大大小小小小小大大大小大大大大大小小小小大大大小小小小小小大大大小大小小小小小小大小大大小小小小小大小大大大大大小大大大小小小大大大大大小小大小大大大大大大小大大小大大大小大小大大小小小小小大小小小小大小小大大大小大小大小小大小小大小大大大大大小小小小大小大小小小大大大大小大小大小大大小大大小小小大大小小小大大小大大小小大小大小大小小大大大小大小大大大大大大小小大大小小小小大大小小大大小大大小大大大大小大大大大大小大大小小大小小大小大大大大大大大大小大大小小小大大大小小小大小大大大小小大大小大小大大大小小大小大大小小大大小大大小小大小小小小小大小小小小小大大大小大小大小小大小大小小小大大小小小小大大大小小大大大小大大小大大小小大小大小大小小大小大小小大大大大大小大大大小小小大大小小小大大大大小大大大小大大小大大大小大小小大小大小小小小大小小大小大大大大大小小大小小小小大大大小大小小小小小大大大小小大小小小大小大大大大小大小小小小大大小小大大大大小小小小小小小大小小小大大小小大大小大大大小大小大大大大小大大大大大大大大小大大大小大小大小小小大大小小小小大大小大小小大大小小小小大小小小小小小大小大小大大大小小小大大大大小大大大小大大大大大大小小小小小小大小小大小小小大小大小小小大小小大大大大小大小大小小大大大小大小小大大小大大大小大大大小大大小小大小大大大大小大大小大大大小大小大小大大小大小大小大小大小小大大大小小小小小小大小大小大大小小大大大小小小大小大小小小小小大大小大小大大大小小大小大小大大小小大小大大大小小小小小大小小小小大小大大小小小小大小大大大大小大小小大大大大大大小小大小大小大大大小小小大大小大大小小小大小小小大大大小小大大小小小小小大大小小大大小小小小小小小大大大大小小小大大大小小小大大小大小小大小小小小大小大大小小大大小小大大小大大小大大小小大大大小大小大大小小小小大小大大大大小小小小大大大大大大大大大大大小小小小小大大大小小大大大大小小大大大大大大大大大大大大小大大大小小大小大大大大小大大小大大大大小小大大大小大大小小小大小小大小小小小大小小小大大小小小大大大大大小大小小大大小大大小大大大小大大大小小大大大小大小小大大大大大大小大大小大小大小小大大大小小大大小大大小小大小大大大小大小大小小小小大大小小小大小大大小小小小小大小大大大小小小小小小大大小小大小小小小大小小小小小大小小小小小小小大小小小大小大小大小大大小小大大大小小大大小大大小大小小大小小大大大小大大大大小小小小大大小小大大大大大小小大小小小大小大小小大大小大小大大大大小大大大大小小大小小小大小大大小小小小大大小大大大大大小大小大小小大小大大大小小小大小小小小小小大大大小小大小小小大大大大小大大大小小小大大大小小大小大大大大小小大小小小大小小小大小大小大小小小大大小大大大小小小大大小小小小小大小大小小大大大小大小大大小大大大小小大大大大大小大小小大大小小小小小小小小小大大大小大小小大大小大小小大小大小大大大小大大小大小小小小小大小大小小小大小小小小小小大大小大小大小小大小小大小大大大大大小小大大小大小大大大大大大大小大小小大小大大大大大小大小小大大大小小小大大小小大大小小小小小大小大小小小大小大小大大小小大小大大小大小大大大小大小小小小小大小大大小小小小大大大大小大大大大小小小大小大大小小小小小大小小大小小小小小小小小小大小大小小小小小小大小小小大大小大小大小小小大小大大小大小大大小大大大小小大小小大小大小大小大大大大小小大大小小大小大',
                'bet_count_rules' => 2303,
                'win_lose_rules' => '111000110100110000101111011001001111000101010110111001100010101110100000010110001000000100110111110010011111010110110100000100010001100110110010000001100011001111001011111101110100110110001011010010110001110011010010100101011001100011111100110110000011101000010010101101111111101111101000011011110001101001111110101000000111110001000010000001111100110111100111101110111110111011011111010010000010111001110110000100011001101000010101001101000011110011101000100101111001001000101111001010010010010110111101110101010110010001010101011011100010010010101100001010011001010110001001110001001100110101111001101000001010100001110100011110001001011111101110010110100011110111101100101110111000001110001101101011110101011111100111100111100011010000000010110001000010010011001101101111000110000110110110100101010000100101111010100101000111011111010010101010000101000101111010001110110010110011101010111111101010110111001001001000111100010100100101110011000000011101010000001011010001000111101001111011111011011010101010001111101010010010110100010010110110010001111001110100000101100110111010001000110101101100010010100001011101011110111110001100101011110111110101101001001010111101100001011110110000111101100001001011110111100001110011000010110000001111110010100100111000110100000000110100001011001111011100000000011000101111001011000001101011100000110100001001100100100100000110100010101100100001100010110101001110111001110000110000001001001101110001011010100011011010011011010111010111001101110100101110001111101010100010000111011010011111100011110110011100011011101010100001010001101001010001011000010010100110100010001110011111111111100111010011010101100001111101001100110101000101101110110111000111000001010001110101001110111101110000101100011011111100010011100010110011011110011100000110111111100101111101111111000110100001111001001000100010100101010100110100111010111000011111011110110000011011011110000110110111001010001110000110001000000011111110001010001101000101101011000000100110111111011001000101110001000111001001111111110111000001111010111010110101011100100100011001111001010010111000100011011010111000110100011000100100111110000001010101000001101000110110001110101010101000100111010001011000011010011111111000011011110100111001001000000101100001110101001000101100111101010010000110001001000011101011',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 2,
                'created_at' => '2023-05-16 23:59:21',
                'updated_at' => '2023-05-17 00:02:41',
                'total_amount_rules' => 1000.0,
                'title' => '随机投注',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 10.0,
                'current_issue' => NULL,
                'last_issue' => '32741467',
                'continuous_bet_count' => 2303,
            ),
            31 => 
            array (
                'id' => 79,
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="随机投注倍投" isExecutable="false">
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
<outgoing>Flow_1sl5j1j</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_0qy900k</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_0vgmnk1</incoming>
<outgoing>Flow_0qy900k</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules * 2;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_05ghkdt" name="createBetCodeTask">
<incoming>Flow_1sl5j1j</incoming>
<outgoing>Flow_0vgmnk1</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_code_rule = $request-&gt;requestLotteryOption-&gt;pluck(\'value\')-&gt;random();
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_0vgmnk1" sourceRef="Activity_05ghkdt" targetRef="Activity_1k2wjfy" />
<sequenceFlow id="Flow_0qy900k" sourceRef="Activity_1k2wjfy" targetRef="Activity_0bbkk1o" />
<sequenceFlow id="Flow_1sl5j1j" sourceRef="Activity_19dyqqr" targetRef="Activity_05ghkdt" />
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
<bpmndi:BPMNShape id="Activity_1lnbzn9_di" bpmnElement="Activity_05ghkdt">
<omgdc:Bounds x="690" y="580" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="690" y="760" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
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
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0vgmnk1_di" bpmnElement="Flow_0vgmnk1">
<di:waypoint x="740" y="660" />
<di:waypoint x="740" y="760" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0qy900k_di" bpmnElement="Flow_0qy900k">
<di:waypoint x="740" y="840" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1sl5j1j_di" bpmnElement="Flow_1sl5j1j">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="580" />
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'completed',
                'lottery_rules' => '"大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大小大大小小大小小大大大小小大大大小大小大小小大大大小小大大大大小小大大大小大大小小大小小小小小小小小大大大小小小小小小大小大小小大大小小大小小大小大小大小大小小小小大小小大小小小小大大大大小小大小小小小小大大小大小小大小小小小小小大大大大大小大大大小小小小大大小小大小小大小小小大大大小小小小大大小大大大小大大小小小小大大大小大大大小小小小小大小小大小大小小小小大大小小大大小大大小大小大大小大小大大大小大小大小大大大大小大大小大小大大大大小小小小小大大小大大大小大小大大大小小大大大小小大小小小大大小大小大大大小大大小大大大大大小小小大大小小大大小大大大小大小大小小大大大小大小大小小大大小大大大小大小大大小大小小小大大大大大大小小小大大小大小大小小小小大小大小大大小小小小大小小小大大小大小大小大大小大小大小大大小大大大小小大大大大小小小大大大大大大小大小大小小小大小大小小大大小大大小小大大大大小小小大大小小大大小大小小小小大小小大大小小小大大小大小大小大大小大小大大小小小大大大小大小大小大小小大大小大大大大大小大小大大小小小小小大小大小小小小大大大小小大小小小小大小大小小大小大大大大大小大小大大大小大大大小小小小小大大小小小小大小大大大小小大大大大小大大小大小小大大小小大大小大大小小大小大大小大大大小大大大小小大大大小大小大大小小大大大小小小大小小小大小小小大大小大小大大大大大大小大小大大大小大大小小小大大大大小小小小小大小大大小大小大大小小大大小大小大大小大大小小小大大大小小大小大大大大小大小小大大大大大小小大小小小小大大大小大大大小小大大小大大小小小小小小小大小大小大大大小"',
                'lottery_count_rules' => 833,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1500,
                'bet_amount_rules' => ',20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20',
                'stop_betting_amount' => 1500,
                'bet_code_rules' => '大小大大小小大小大小大大大大小大大小小大大小小小大小小大小小大小小大大小大小小大大大小小小小大大小小小小小小小小小小大小大小小小大小小大大大大大小大小大大大小小小小大小小小大大大大大小小大大小小小大小大小小小小小大大大小大大大大小小小小大大小小大小小小大小大大大大大小小小小小小小小小大大小大大小小大大大大大大大小大小大大大大大小小大小小小小大大大大大大大大小小小大大大小小小大小小小大大大大小大大大小大大大小小大小大大大小小大大小大小小小小大大小大大小小大小小大小小大小大大大大小大小小小小小小小大小大小小小大小大大大小小小小小小大小小小大大小大小小大大小大大大小小大大大大小大小大大小小小大小小大小大小小小小小小大小小大小小大大大大大大小大小大小小小大小小小小大小小小小大大小大大大小小小小大大大小大小小小大大大大大大大小小大小小大大小小大小大大大小大大小小小大小小大小小大小大大大大小大大大小小大大小小大大小大大大小大大小大小小大小大大大大大大大小大大大大小小大大大小小小小小大大大大大大大大大小大小大大小小大大小小小大小小小小大大小大小大大小小大大小大大小小小小小大大小小小小小大小大大小小小小大小大大大小大小大大小大小小大小大小大大大大大大小小小小小小大小小大小小小大小小大大小小大小小大大小小小小大小大大大小大大小大小大大小小大大小小小小大小小小大小大大小大小大小小大大大大小大小小大大大小大小小小大大小大小小大大小大大大小小大小小大大大大大小大大小大大小小小小小大大大大小小小大大小小大小小大大小大小大小小小大大小大大小大小小小小大大小小大大大大小小小小大大大大小大大小大小大小大小小大小小大大大大小大大小小小小大小小大小大小小大大小小大大小小大大大小大大小小小大大小大大大大小小小大大小小小大大大小大大小大小小小大大小小小小大大小大小大大小大大小小大大小小小大大小大小小大大大小小大小大小大小大大大大小小小大大大小大小小大大大小大小大小大大大大大小大',
                'bet_count_rules' => 833,
                'win_lose_rules' => '10001010111010010101101001011100101011111010010101011101011100010011101110000111111001100011001001000111110101101000111111111100001100010011011110000010101000100011101000011100100011100100101110101101110101000010010011110100111000100110111011001111111010011010011001111100011000010111011010010000000011011101111001101100100011011010110010011111010001001001000011000110010001111101111101110100110011101000000010101000010011010101110100010001010011111101001001101111101010101101111110010011001001101010001100101011111001000100111001101000110111111001101110001011110000100111111010100001100110111111101001010110101011101011001100100110100100001111110000011011101110110010001101010101111011101010010011000011100011111001111010100111001100010011110011001001100111100111010010001001010101001000011000111111101001101001011110100010111101111',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 4,
                'created_at' => '2023-05-17 00:01:17',
                'updated_at' => '2023-05-17 00:02:39',
                'total_amount_rules' => 1000.0,
                'title' => '随机投注倍投',
                'current_bet_code_rule' => '大',
                'current_bet_amount_rule' => 20.0,
                'current_issue' => NULL,
                'last_issue' => '32741148',
                'continuous_bet_count' => 833,
            ),
            32 => 
            array (
                'id' => 80,
                'bpmn_xml' => '<?xml version="1.0" encoding="UTF-8"?>
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">
<process id="Process_1" name="随机投注倍投" isExecutable="false">
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
<outgoing>Flow_1sl5j1j</outgoing>
</serviceTask>
<exclusiveGateway id="Gateway_0ygumq5" name="Gateway_0ygumq5" default="Flow_19ch7nt">
<incoming>Flow_1wrzu2u</incoming>
<incoming>Flow_0mthd3n</incoming>
<outgoing>Flow_0a721c8</outgoing>
<outgoing>Flow_19ch7nt</outgoing>
</exclusiveGateway>
<serviceTask id="Activity_0bbkk1o" name="BetTask" camunda:delegateExpression="App\\Services\\Tasks\\BetTask">
<incoming>Flow_0qy900k</incoming>
<outgoing>Flow_0mthd3n</outgoing>
</serviceTask>
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />
<scriptTask id="Activity_1k2wjfy" name="createBetAmountTask" scriptFormat="PHP">
<incoming>Flow_0vgmnk1</incoming>
<outgoing>Flow_0qy900k</outgoing>
<script>//设置投注金额-输
$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_amount_rule = $request-&gt;bet_base_amount_rules * 2;
$request-&gt;save();</script>
</scriptTask>
<scriptTask id="Activity_05ghkdt" name="createBetCodeTask">
<incoming>Flow_1sl5j1j</incoming>
<outgoing>Flow_0vgmnk1</outgoing>
<script>$request = App\\Models\\Request::findOrStatusFail($data[\'request_id\']);

$request-&gt;current_bet_code_rule = $request-&gt;requestLotteryOption-&gt;pluck(\'value\')-&gt;random();
$request-&gt;save();</script>
</scriptTask>
<sequenceFlow id="Flow_0vgmnk1" sourceRef="Activity_05ghkdt" targetRef="Activity_1k2wjfy" />
<sequenceFlow id="Flow_0qy900k" sourceRef="Activity_1k2wjfy" targetRef="Activity_0bbkk1o" />
<sequenceFlow id="Flow_1sl5j1j" sourceRef="Activity_19dyqqr" targetRef="Activity_05ghkdt" />
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
<bpmndi:BPMNShape id="Activity_1lnbzn9_di" bpmnElement="Activity_05ghkdt">
<omgdc:Bounds x="690" y="580" width="100" height="80" />
<bpmndi:BPMNLabel />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_05ftgvw_di" bpmnElement="Activity_1k2wjfy">
<omgdc:Bounds x="690" y="760" width="100" height="80" />
</bpmndi:BPMNShape>
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">
<omgdc:Bounds x="690" y="1060" width="100" height="80" />
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
<di:waypoint x="690" y="1100" />
<di:waypoint x="400" y="1100" />
<di:waypoint x="400" y="340" />
<di:waypoint x="715" y="340" />
<bpmndi:BPMNLabel>
<omgdc:Bounds x="353" y="1033" width="73" height="14" />
</bpmndi:BPMNLabel>
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0vgmnk1_di" bpmnElement="Flow_0vgmnk1">
<di:waypoint x="740" y="660" />
<di:waypoint x="740" y="760" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_0qy900k_di" bpmnElement="Flow_0qy900k">
<di:waypoint x="740" y="840" />
<di:waypoint x="740" y="1060" />
</bpmndi:BPMNEdge>
<bpmndi:BPMNEdge id="Flow_1sl5j1j_di" bpmnElement="Flow_1sl5j1j">
<di:waypoint x="740" y="520" />
<di:waypoint x="740" y="580" />
</bpmndi:BPMNEdge>
</bpmndi:BPMNPlane>
</bpmndi:BPMNDiagram>
</definitions>',
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大小大大小小大小小大大大小小大大大小大小大小小大大大小小大大大大小小大大大小大大小小大小小小小小小小小大大大小小小小小小大小大小小大大小小大小小大小大小大小大小小小小大小小大小小小小大大大大小小大小小小小小大大小大小小大小小小小小小大大大大大小大大大小小小小大大小小大小小大小小小大大大小小小小大大小大大大小大大小小小小大大大小大大大小小小小小大小小大小大小小小小大大小小大大小大大小大小大大小大小大大大小大小大小大大大大小大大小大小大大大大小小小小小大大小大大大小大小大大大小小大大大小小大小小小大大小大小大大大小大大小大大大大大小小小大大小小大大小大大大小大小大小小大大大小大小大小小大大小大大大小大小大大小大小小小大大大大大大小小小大大小大小大小小小小大小大小大大小小小小大小小小大大小大小大小大大小大小大小大大小大大大小小大大大大小小小大大大大大大小大小大小小小大小大小小大大小大大小小大大大大小小小大大小小大大小大小小小小大小小大大小小小大大小大小大小大大小大小大大小小小大大大小大小大小大小小大大小大大大大大小大小大大小小小小小大小大小小小小大大大小小大小小小小大小大小小大小大大大大大小大小大大大小大大大小小小小小大大小小小小大小大大大小小大大大大小大大小大小小大大小小大大小大大小小大小大大小大大大小大大大小小大大大小大小大大小小大大大小小小大小小小大小小小大大小大小大大大大大大小大小大大大小大大小小小大大大大小小小小小大小大大小大小大大小小大大小大小大大小大大小小小大大大小小大小大大大大小大小小大大大大大小小大小小小小大大大小大大大小小大大小大大小小小小小小小大小大小大大大小小小小大小小大大大小小大小大小大大小小小大小小小小小小小小小大小小小大大小小小大小大小小大大小小大小大小小大大大大大大小小大大小大大大大小大大大大小大大小大大大大大小大大小小大小大大大小小大大大大大大大小小小小大大小小大大小小小大小大小大大大小小小大大小大大小大小大小小大大小小大大小小大小大小大小小大小大小大大大大大小大小大大小大大小大小大小大小大大小大小小小大大小大小大大大大大大大大大小"',
                'lottery_count_rules' => 1029,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 18,
                'bet_amount_rules' => ',20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20,20',
                'stop_betting_amount' => 1500,
                'bet_code_rules' => '小大小小小小大小小小小大小大大小大小小大大小小小大小大小大大大大小小大大小大小小小大小大大小小小大大大大大大大小大小小小小小小大小小大大小大大小小小大大大大大小大大小小大小小大大大小小大小小大大小大小大大小小小小小大大大小大小小大大小小大小大大大大小大小大大小小大小大小大大小大小大大小小大大大大小大小大大大小小小小小大大小小大小大大大小小小大小大大小小大大大大小小大大小小小大大小小小小大大小大小小小大小大小大大大大小小小小小大大大大小大大小小小大大大大大大小大大大大大大小小大小小大小小大小大小大小大小大小大大小大小小大小大小大大小小小小大大大大小小大大大大大大小大小大大大小小小小大大大小小小小小大大大小小小小小小大大大小小大大小小大大小大大大大大大小小大大小小大大大大大大大大大小小小大小小大小大大小小大大大大大大大大小小大小小大小大大小大小大大小大小大大大小小小小小小大小大大大小小大大小大小小小大大大小小小小大小大大小大小小小小小大小大小小小大小小大小小大大小小小小大大小大大大大小小大大大小大大小小小小小大大小大小大大小小小大小大小小小大小小小大小大小大小小大小大大小小小小小小大大小小小大大小大大大大小小小大小小小小小小大大小大大小大小小小小小小大大小大大大小大大小大大小小大小大小大小小大小大小小大小大小小大小大大小小大小小大大大大大大小小大小小大大小大大大大小大大大小小小大小大大小大小大小小小大小大小小小小小大大大小大小小小小大大小小大大小小小大小大大大小大大大大大小大小大小小大小大大小小小小小大大大大大小大小小小小大小大小大大大大大大大小小小小大小小小大大小大小大大小大大小大大小小小小小大大小小大小大小大大大大大大小大大小小小小大大大大小小小大大小小小小大大小小小小小大大小小小小大小小大大大小大大小大大大小大大小小小小大大小大小大大小大大小小大小大大小大小大大小大小小小小大小小小小小大小小小小大大大大大小大大大大小大大小小小大小小大小大小小大大小小小小大大小小大小小小大大大小大大小大大大小小大大小大小大大小大小大小大小小大大大小大小大小小小小大小小大大小小大大小大大大小小大大小小大大大大大小小大小大小大小大小大小小大小小大小大小大大大大大小大小小小小大小小大大小小小大大小大小大大小大大小大大小大大小大大小大大小小小大大小小大大大大小小小大大大大小小大小小大小小大小小小大大大大大大小小大小小小大小小小大大大小大小小小大',
                'bet_count_rules' => 1028,
                'win_lose_rules' => '111100101011110011011010010000100000000101101000101000100010010111101111001101101001001100100101100001011100010111110111000101111000011111100000010010111011100000001000100110000100001101001001110011000100011010010110010110111111100000000101111111010110101111001100110111010011010001100100111111111100010001011011001111111111101010110001010101110101100011010000110100001101011010111001010100111100011001101000010100111110000000111011000110011010111001001111010100111100010100110001111110111100010000000010101110000010111100000110011011000001011110010111110011100011111100000001111000110111010111101100010111010100001110010010101101100111111111100101101010110001011111101010011011011010101100100100001111000110111100010100010011000111001011100100000010011011011010000101111100100010000010011101101100101101000110011110111000010110110001010000001011000010011001000111010010100000101000000100010000000101100011101011100001100001010001010100000111000111001011101111111100000101111100110001001011111000000000100101100101000010111010000',
                'continuous_lose_count_rules' => 4,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-17 09:22:59',
                'updated_at' => '2023-05-17 09:24:20',
                'total_amount_rules' => 1000.0,
                'title' => '随机投注倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 20.0,
                'current_issue' => NULL,
                'last_issue' => '32741344',
                'continuous_bet_count' => 1028,
            ),
            33 => 
            array (
                'id' => 81,
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => '"大小大小大大小小小大小小大小小小小大大小大小小大大大大小大小大小小大大小小大小小大小大大大小大大小小大小小小大小大小小大大小大小大小小小大小大大大大小大小大大小小小小小大小小小小小大大大大大小大小大小大大小小小小大大小大小小大小小大小小小大大小小大小小大小大小大大小小大"',
                'lottery_count_rules' => 135,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 238,
                'bet_amount_rules' => ',10,10,20,10,20,40,10,20,40,10,20,40,10,20,10,10,10,10,20,10,20,10,10,20,40,10,20,40,10,10,20,40,10,20,10,20,10,10,10,20,40,80,10,10,10,10,10,20,40,80,10,20,10,10,10,20,40,80,160,320,10,10,20,10,20,40,80,10,10,10,20,40,80,10,10,20,10,20,40,10,10,20,40,80,160,10,10,20,10,10,10,20,40,10,20,40,80,160,320,640,10,10,10,20,10,10,10,10,20,40,80,10,10,10,20,40,80,10,20,40,10,20,40,10,10,20,10,10,20,40,80,160,320,640',
                'stop_betting_amount' => 1500,
                'bet_code_rules' => '小小小小小小大大大大大大大小小小大小小小小小小小大小大大小小大小小大大小大小大小大大大大小大小大大大大小小大大小大大小大小小小小大大小大小小小小大小小小小小小小大大大小小小大小小大小小大小大小大小大大大小大小小大大大小大小大小大小大小大小大大大大小大大小小大小小大大小',
                'bet_count_rules' => 134,
                'win_lose_rules' => '110100100100101111010110010011001010111000111110001011100000110100011100011010011000011011100100000011101111000111000100100110110000000',
                'continuous_lose_count_rules' => 7,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-17 09:50:46',
                'updated_at' => '2023-05-17 09:51:02',
                'total_amount_rules' => 1000.0,
                'title' => '随机投注倍投',
                'current_bet_code_rule' => '小',
                'current_bet_amount_rule' => 1280.0,
                'current_issue' => NULL,
                'last_issue' => '32740450',
                'continuous_bet_count' => 134,
            ),
            34 => 
            array (
                'id' => 82,
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
<sequenceFlow id="Flow_1a44leq" name="AAA" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">
<extensionElements>
<zeebe:properties>
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{2,}$/u" />
</zeebe:properties>
</extensionElements>
<conditionExpression xsi:type="tFormalExpression" language="PHP">//AAA
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
                'lottery_id' => 1,
                'token_id' => 1,
                'code_type' => 3,
                'status' => 'failed',
                'lottery_rules' => NULL,
                'lottery_count_rules' => 0,
                'bet_base_amount_rules' => 10,
                'bet_total_amount_rules' => 1200,
                'bet_amount_rules' => '0',
                'stop_betting_amount' => 1700,
                'bet_code_rules' => NULL,
                'bet_count_rules' => 0,
                'win_lose_rules' => '1',
                'continuous_lose_count_rules' => 0,
                'continuous_win_count_rules' => 0,
                'created_at' => '2023-05-17 12:00:03',
                'updated_at' => '2023-05-17 12:00:06',
                'total_amount_rules' => 1200.0,
                'title' => 'AAAAA倍投',
                'current_bet_code_rule' => NULL,
                'current_bet_amount_rule' => 0.0,
                'current_issue' => '',
                'last_issue' => '32736213',
                'continuous_bet_count' => 0,
            ),
        ));
        
        
    }
}