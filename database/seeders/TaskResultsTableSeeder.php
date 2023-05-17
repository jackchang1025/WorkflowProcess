<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskResultsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('task_results')->delete();
        
        \DB::table('task_results')->insert(array (
            0 => 
            array (
                'id' => 1,
                'task_id' => 1,
                'ran_at' => '2023-05-06 01:59:19',
                'result' => '',
                'created_at' => '2023-05-06 09:59:19',
                'updated_at' => '2023-05-06 09:59:19',
                'duration' => '101.13883018494000',
            ),
            1 => 
            array (
                'id' => 2,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:00:02',
                'result' => '',
                'created_at' => '2023-05-06 10:00:02',
                'updated_at' => '2023-05-06 10:00:02',
                'duration' => '933.50505828857000',
            ),
            2 => 
            array (
                'id' => 3,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:01:04',
                'result' => '',
                'created_at' => '2023-05-06 10:01:04',
                'updated_at' => '2023-05-06 10:01:04',
                'duration' => '1085.27183532710000',
            ),
            3 => 
            array (
                'id' => 4,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:02:03',
                'result' => '',
                'created_at' => '2023-05-06 10:02:03',
                'updated_at' => '2023-05-06 10:02:03',
                'duration' => '999.70507621765000',
            ),
            4 => 
            array (
                'id' => 5,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:03:03',
                'result' => '',
                'created_at' => '2023-05-06 10:03:03',
                'updated_at' => '2023-05-06 10:03:03',
                'duration' => '1038.93399238590000',
            ),
            5 => 
            array (
                'id' => 6,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:04:03',
                'result' => '',
                'created_at' => '2023-05-06 10:04:03',
                'updated_at' => '2023-05-06 10:04:03',
                'duration' => '1128.28803062440000',
            ),
            6 => 
            array (
                'id' => 7,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:05:03',
                'result' => '',
                'created_at' => '2023-05-06 10:05:03',
                'updated_at' => '2023-05-06 10:05:03',
                'duration' => '1006.29591941830000',
            ),
            7 => 
            array (
                'id' => 8,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:06:03',
                'result' => '',
                'created_at' => '2023-05-06 10:06:03',
                'updated_at' => '2023-05-06 10:06:03',
                'duration' => '1072.38888740540000',
            ),
            8 => 
            array (
                'id' => 9,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:07:03',
                'result' => '',
                'created_at' => '2023-05-06 10:07:03',
                'updated_at' => '2023-05-06 10:07:03',
                'duration' => '1015.33985137940000',
            ),
            9 => 
            array (
                'id' => 10,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:08:03',
                'result' => '',
                'created_at' => '2023-05-06 10:08:03',
                'updated_at' => '2023-05-06 10:08:03',
                'duration' => '1156.56399726870000',
            ),
            10 => 
            array (
                'id' => 11,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:09:04',
                'result' => '',
                'created_at' => '2023-05-06 10:09:04',
                'updated_at' => '2023-05-06 10:09:04',
                'duration' => '1320.67203521730000',
            ),
            11 => 
            array (
                'id' => 12,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:10:03',
                'result' => '',
                'created_at' => '2023-05-06 10:10:03',
                'updated_at' => '2023-05-06 10:10:03',
                'duration' => '1252.60114669800000',
            ),
            12 => 
            array (
                'id' => 13,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:11:03',
                'result' => '',
                'created_at' => '2023-05-06 10:11:03',
                'updated_at' => '2023-05-06 10:11:03',
                'duration' => '1132.01308250430000',
            ),
            13 => 
            array (
                'id' => 14,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:12:03',
                'result' => '',
                'created_at' => '2023-05-06 10:12:03',
                'updated_at' => '2023-05-06 10:12:03',
                'duration' => '1212.48793601990000',
            ),
            14 => 
            array (
                'id' => 15,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:13:03',
                'result' => '',
                'created_at' => '2023-05-06 10:13:03',
                'updated_at' => '2023-05-06 10:13:03',
                'duration' => '1013.45515251160000',
            ),
            15 => 
            array (
                'id' => 16,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:14:03',
                'result' => '',
                'created_at' => '2023-05-06 10:14:03',
                'updated_at' => '2023-05-06 10:14:03',
                'duration' => '1086.61699295040000',
            ),
            16 => 
            array (
                'id' => 17,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:15:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:15:03',
                'updated_at' => '2023-05-06 10:15:03',
                'duration' => '1445.46294212340000',
            ),
            17 => 
            array (
                'id' => 18,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:16:04',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:16:04',
                'updated_at' => '2023-05-06 10:16:04',
                'duration' => '1609.16709899900000',
            ),
            18 => 
            array (
                'id' => 19,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:17:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:17:03',
                'updated_at' => '2023-05-06 10:17:03',
                'duration' => '1067.59786605830000',
            ),
            19 => 
            array (
                'id' => 20,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:18:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:18:03',
                'updated_at' => '2023-05-06 10:18:03',
                'duration' => '1104.60209846500000',
            ),
            20 => 
            array (
                'id' => 21,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:19:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:19:03',
                'updated_at' => '2023-05-06 10:19:03',
                'duration' => '1139.55092430110000',
            ),
            21 => 
            array (
                'id' => 22,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:20:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:20:03',
                'updated_at' => '2023-05-06 10:20:03',
                'duration' => '1624.58395957950000',
            ),
            22 => 
            array (
                'id' => 23,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:21:04',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:21:04',
                'updated_at' => '2023-05-06 10:21:04',
                'duration' => '1302.60896682740000',
            ),
            23 => 
            array (
                'id' => 24,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:22:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:22:03',
                'updated_at' => '2023-05-06 10:22:03',
                'duration' => '1066.78819656370000',
            ),
            24 => 
            array (
                'id' => 25,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:23:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:23:03',
                'updated_at' => '2023-05-06 10:23:03',
                'duration' => '1445.10388374330000',
            ),
            25 => 
            array (
                'id' => 26,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:24:04',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:24:04',
                'updated_at' => '2023-05-06 10:24:04',
                'duration' => '1425.57907104490000',
            ),
            26 => 
            array (
                'id' => 27,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:25:03',
                'result' => '

Not enough arguments (missing: "id").  


',
                'created_at' => '2023-05-06 10:25:03',
                'updated_at' => '2023-05-06 10:25:03',
                'duration' => '1324.11003112790000',
            ),
            27 => 
            array (
                'id' => 28,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:26:04',
                'result' => 'Request Crontab 76 2023-05-06 10:26:04
',
                'created_at' => '2023-05-06 10:26:04',
                'updated_at' => '2023-05-06 10:26:04',
                'duration' => '1241.08290672300000',
            ),
            28 => 
            array (
                'id' => 29,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:27:03',
                'result' => 'Request Crontab 76 2023-05-06 10:27:03
',
                'created_at' => '2023-05-06 10:27:03',
                'updated_at' => '2023-05-06 10:27:03',
                'duration' => '1691.78009033200000',
            ),
            29 => 
            array (
                'id' => 30,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:28:03',
                'result' => 'Request Crontab 76 2023-05-06 10:28:03
',
                'created_at' => '2023-05-06 10:28:03',
                'updated_at' => '2023-05-06 10:28:03',
                'duration' => '1192.34800338750000',
            ),
            30 => 
            array (
                'id' => 31,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:29:03',
                'result' => 'Request Crontab 76 2023-05-06 10:29:03
',
                'created_at' => '2023-05-06 10:29:03',
                'updated_at' => '2023-05-06 10:29:03',
                'duration' => '1161.87095642090000',
            ),
            31 => 
            array (
                'id' => 32,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:30:03',
                'result' => 'Request Crontab 76 2023-05-06 10:30:03
',
                'created_at' => '2023-05-06 10:30:03',
                'updated_at' => '2023-05-06 10:30:03',
                'duration' => '1126.86085700990000',
            ),
            32 => 
            array (
                'id' => 33,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:31:04',
                'result' => 'Request Crontab 76 2023-05-06 10:31:03
',
                'created_at' => '2023-05-06 10:31:03',
                'updated_at' => '2023-05-06 10:31:03',
                'duration' => '1255.99694252010000',
            ),
            33 => 
            array (
                'id' => 34,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:32:03',
                'result' => 'Request Crontab 76 2023-05-06 10:32:03
',
                'created_at' => '2023-05-06 10:32:03',
                'updated_at' => '2023-05-06 10:32:03',
                'duration' => '1281.37087821960000',
            ),
            34 => 
            array (
                'id' => 35,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:33:03',
                'result' => 'Request Crontab 76 2023-05-06 10:33:03
',
                'created_at' => '2023-05-06 10:33:03',
                'updated_at' => '2023-05-06 10:33:03',
                'duration' => '1279.61301803590000',
            ),
            35 => 
            array (
                'id' => 36,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:34:04',
                'result' => '"76" // app/Console/Commands/RequestCrontab.php:49
array:24 [ // app/Console/Commands/RequestCrontab.php:49
"bpmn_xml" => """
<?xml version="1.0" encoding="UTF-8"?>\\n
<definitions xmlns="http://www.omg.org/spec/BPMN/20100524/MODEL" xmlns:bpmndi="http://www.omg.org/spec/BPMN/20100524/DI" xmlns:omgdc="http://www.omg.org/spec/DD/20100524/DC" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:zeebe="http://camunda.org/schema/zeebe/1.0" xmlns:di="http://www.omg.org/spec/DD/20100524/DI" xmlns:camunda="http://camunda.org/schema/1.0/bpmn" id="sid-38422fae-e03e-43a3-bef4-bd33b32041b2" targetNamespace="http://bpmn.io/bpmn" exporter="bpmn-js (https://demo.bpmn.io)" exporterVersion="5.1.2">\\n
<process id="Process_1" name="AAAAAA-倍投" isExecutable="true">\\n
<documentation>获取数据</documentation>\\n
<extensionElements>\\n
<camunda:executionListener class="" event="start" />\\n
<camunda:properties>\\n
<camunda:property />\\n
</camunda:properties>\\n
</extensionElements>\\n
<startEvent id="StartEvent_1y45yut" name="start">\\n
<documentation>Element documentation .......</documentation>\\n
<extensionElements>\\n
<zeebe:ioMapping>\\n
<zeebe:output source="=Variable assignment value" target="OutputVariable_32ckfr2" />\\n
</zeebe:ioMapping>\\n
<zeebe:properties>\\n
<zeebe:property name="lottery_id" value="1" />\\n
<zeebe:property name="lottery_option" value="单双" />\\n
<zeebe:property name="base_bet_amount" value="20" />\\n
<zeebe:property name="total_bet_amount" value="1000" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<outgoing>Flow_1wrzu2u</outgoing>\\n
</startEvent>\\n
<sequenceFlow id="Flow_1wrzu2u" name="Flow_1wrzu2u" sourceRef="StartEvent_1y45yut" targetRef="Gateway_0ygumq5" />\\n
<endEvent id="Event_00p8isq" name="end">\\n
<incoming>Flow_0a721c8</incoming>\\n
</endEvent>\\n
<sequenceFlow id="Flow_0a721c8" name="Flow_0a721c8" sourceRef="Gateway_0ygumq5" targetRef="Event_00p8isq">\\n
<extensionElements>\\n
<zeebe:properties>\\n
<zeebe:property name="total_amount_rule-总金额规则小于等于0" value="$data &#60;= 0 || $data &#62;= 2000" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<conditionExpression xsi:type="tFormalExpression">=true</conditionExpression>\\n
</sequenceFlow>\\n
<sequenceFlow id="Flow_19ch7nt" name="Flow_19ch7nt" sourceRef="Gateway_0ygumq5" targetRef="Activity_19dyqqr" />\\n
<serviceTask id="Activity_19dyqqr" name="getLotteryDataTask">\\n
<incoming>Flow_19ch7nt</incoming>\\n
<outgoing>Flow_1ar6z4o</outgoing>\\n
</serviceTask>\\n
<exclusiveGateway id="Gateway_0ygumq5" default="Flow_19ch7nt">\\n
<incoming>Flow_1wrzu2u</incoming>\\n
<incoming>Flow_0s4vlli</incoming>\\n
<incoming>Flow_0mthd3n</incoming>\\n
<outgoing>Flow_0a721c8</outgoing>\\n
<outgoing>Flow_19ch7nt</outgoing>\\n
</exclusiveGateway>\\n
<exclusiveGateway id="Gateway_15h65le" default="Flow_0s4vlli">\\n
<incoming>Flow_1ar6z4o</incoming>\\n
<outgoing>Flow_0s4vlli</outgoing>\\n
<outgoing>Flow_1a44leq</outgoing>\\n
</exclusiveGateway>\\n
<sequenceFlow id="Flow_1ar6z4o" name="Flow_1ar6z4o" sourceRef="Activity_19dyqqr" targetRef="Gateway_15h65le" />\\n
<sequenceFlow id="Flow_0s4vlli" name="Flow_0s4vlli" sourceRef="Gateway_15h65le" targetRef="Gateway_0ygumq5" />\\n
<exclusiveGateway id="Gateway_10t4rtn">\\n
<incoming>Flow_1a44leq</incoming>\\n
<outgoing>Flow_19pl5zp</outgoing>\\n
<outgoing>Flow_1meev5f</outgoing>\\n
</exclusiveGateway>\\n
<sequenceFlow id="Flow_1a44leq" name="Flow_1a44leq" sourceRef="Gateway_15h65le" targetRef="Gateway_10t4rtn">\\n
<extensionElements>\\n
<zeebe:properties>\\n
<zeebe:property name="lottery_rules-AAAAAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{5,}$/u" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<conditionExpression xsi:type="tFormalExpression">=true</conditionExpression>\\n
</sequenceFlow>\\n
<sequenceFlow id="Flow_19pl5zp" name="Flow_19pl5zp" sourceRef="Gateway_10t4rtn" targetRef="Activity_0f97m8m">\\n
<extensionElements>\\n
<zeebe:properties>\\n
<zeebe:property name="win_lose_rules-输" value="/0$/" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<conditionExpression xsi:type="tFormalExpression">=true</conditionExpression>\\n
</sequenceFlow>\\n
<sequenceFlow id="Flow_1meev5f" name="Flow_1meev5f" sourceRef="Gateway_10t4rtn" targetRef="Activity_1k2wjfy">\\n
<extensionElements>\\n
<zeebe:properties>\\n
<zeebe:property name="win_lose_rules-赢" value="/1$/" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<conditionExpression xsi:type="tFormalExpression">=true</conditionExpression>\\n
</sequenceFlow>\\n
<serviceTask id="Activity_1k2wjfy" name="createBetAmountTask">\\n
<extensionElements>\\n
<zeebe:properties>\\n
<zeebe:property name="bet_base_amount_rules-基础" value="$data * 1" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<incoming>Flow_1meev5f</incoming>\\n
<outgoing>Flow_0usdnwm</outgoing>\\n
</serviceTask>\\n
<serviceTask id="Activity_0f97m8m" name="createBetAmountTask">\\n
<extensionElements>\\n
<zeebe:properties>\\n
<zeebe:property name="last_bet_amount_rules-倍投" value="$data * 2" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<incoming>Flow_19pl5zp</incoming>\\n
<outgoing>Flow_1a5lhmw</outgoing>\\n
</serviceTask>\\n
<sequenceFlow id="Flow_1a5lhmw" name="Flow_1a5lhmw" sourceRef="Activity_0f97m8m" targetRef="Activity_1029zj8" />\\n
<sequenceFlow id="Flow_0usdnwm" name="Flow_0usdnwm" sourceRef="Activity_1k2wjfy" targetRef="Activity_1029zj8" />\\n
<serviceTask id="Activity_1029zj8" name="createBetCodeTask">\\n
<extensionElements>\\n
<zeebe:properties>\\n
<zeebe:property name="lottery_rules-AAA" value="/([\\x{4e00}-\\x{9fa5}_a-zA-Z0-9])\\1{4,}$/u" />\\n
</zeebe:properties>\\n
</extensionElements>\\n
<incoming>Flow_1a5lhmw</incoming>\\n
<incoming>Flow_0usdnwm</incoming>\\n
<outgoing>Flow_15forua</outgoing>\\n
</serviceTask>\\n
<sequenceFlow id="Flow_15forua" sourceRef="Activity_1029zj8" targetRef="Activity_0bbkk1o" />\\n
<serviceTask id="Activity_0bbkk1o" name="betTask">\\n
<incoming>Flow_15forua</incoming>\\n
<outgoing>Flow_0mthd3n</outgoing>\\n
</serviceTask>\\n
<sequenceFlow id="Flow_0mthd3n" name="Flow_0mthd3n" sourceRef="Activity_0bbkk1o" targetRef="Gateway_0ygumq5" />\\n
</process>\\n
<bpmndi:BPMNDiagram id="BpmnDiagram_1">\\n
<bpmndi:BPMNPlane id="BpmnPlane_1" bpmnElement="Process_1">\\n
<bpmndi:BPMNShape id="StartEvent_1y45yut_di" bpmnElement="StartEvent_1y45yut">\\n
<omgdc:Bounds x="722" y="202" width="36" height="36" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="729" y="172" width="22" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Event_00p8isq_di" bpmnElement="Event_00p8isq">\\n
<omgdc:Bounds x="972" y="322" width="36" height="36" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="981" y="365" width="19" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Activity_1t8wh6x_di" bpmnElement="Activity_19dyqqr">\\n
<omgdc:Bounds x="690" y="440" width="100" height="80" />\\n
<bpmndi:BPMNLabel />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Gateway_0nysfq9_di" bpmnElement="Gateway_0ygumq5" isMarkerVisible="true">\\n
<omgdc:Bounds x="715" y="315" width="50" height="50" />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Gateway_15h65le_di" bpmnElement="Gateway_15h65le" isMarkerVisible="true">\\n
<omgdc:Bounds x="715" y="595" width="50" height="50" />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Gateway_10t4rtn_di" bpmnElement="Gateway_10t4rtn" isMarkerVisible="true">\\n
<omgdc:Bounds x="715" y="715" width="50" height="50" />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Activity_0fzzgek_di" bpmnElement="Activity_1k2wjfy">\\n
<omgdc:Bounds x="540" y="700" width="100" height="80" />\\n
<bpmndi:BPMNLabel />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Activity_0mgtdwf_di" bpmnElement="Activity_0f97m8m">\\n
<omgdc:Bounds x="860" y="700" width="100" height="80" />\\n
<bpmndi:BPMNLabel />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Activity_0sybv91_di" bpmnElement="Activity_1029zj8">\\n
<omgdc:Bounds x="690" y="900" width="100" height="80" />\\n
<bpmndi:BPMNLabel />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNShape id="Activity_1n8x1r0_di" bpmnElement="Activity_0bbkk1o">\\n
<omgdc:Bounds x="690" y="1060" width="100" height="80" />\\n
</bpmndi:BPMNShape>\\n
<bpmndi:BPMNEdge id="Flow_1wrzu2u_di" bpmnElement="Flow_1wrzu2u">\\n
<di:waypoint x="740" y="238" />\\n
<di:waypoint x="740" y="315" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="720" y="274" width="71" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_0a721c8_di" bpmnElement="Flow_0a721c8">\\n
<di:waypoint x="765" y="340" />\\n
<di:waypoint x="972" y="340" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="833" y="322" width="72" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_19ch7nt_di" bpmnElement="Flow_19ch7nt">\\n
<di:waypoint x="740" y="365" />\\n
<di:waypoint x="740" y="440" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="721" y="400" width="70" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_1ar6z4o_di" bpmnElement="Flow_1ar6z4o">\\n
<di:waypoint x="740" y="520" />\\n
<di:waypoint x="740" y="595" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="720" y="555" width="70" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_0s4vlli_di" bpmnElement="Flow_0s4vlli">\\n
<di:waypoint x="715" y="620" />\\n
<di:waypoint x="440" y="620" />\\n
<di:waypoint x="440" y="340" />\\n
<di:waypoint x="715" y="340" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="425" y="477" width="60" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_1a44leq_di" bpmnElement="Flow_1a44leq">\\n
<di:waypoint x="740" y="645" />\\n
<di:waypoint x="740" y="715" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="721" y="677" width="69" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_19pl5zp_di" bpmnElement="Flow_19pl5zp">\\n
<di:waypoint x="765" y="740" />\\n
<di:waypoint x="860" y="740" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="779" y="722" width="68" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_1meev5f_di" bpmnElement="Flow_1meev5f">\\n
<di:waypoint x="715" y="740" />\\n
<di:waypoint x="640" y="740" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="641" y="722" width="73" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_1a5lhmw_di" bpmnElement="Flow_1a5lhmw">\\n
<di:waypoint x="920" y="780" />\\n
<di:waypoint x="920" y="940" />\\n
<di:waypoint x="790" y="940" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="898" y="857" width="75" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_0usdnwm_di" bpmnElement="Flow_0usdnwm">\\n
<di:waypoint x="590" y="780" />\\n
<di:waypoint x="590" y="940" />\\n
<di:waypoint x="690" y="940" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="567" y="857" width="77" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_15forua_di" bpmnElement="Flow_15forua">\\n
<di:waypoint x="740" y="980" />\\n
<di:waypoint x="740" y="1060" />\\n
</bpmndi:BPMNEdge>\\n
<bpmndi:BPMNEdge id="Flow_0mthd3n_di" bpmnElement="Flow_0mthd3n">\\n
<di:waypoint x="690" y="1100" />\\n
<di:waypoint x="440" y="1100" />\\n
<di:waypoint x="440" y="340" />\\n
<di:waypoint x="715" y="340" />\\n
<bpmndi:BPMNLabel>\\n
<omgdc:Bounds x="393" y="1033" width="73" height="14" />\\n
</bpmndi:BPMNLabel>\\n
</bpmndi:BPMNEdge>\\n
</bpmndi:BPMNPlane>\\n
</bpmndi:BPMNDiagram>\\n
</definitions>
"""
"lottery_id" => 1
"token_id" => 1
"code_type" => 3
"status" => "pending"
"lottery_rules" => "小大大大小大小小大小大小大小大大小"
"lottery_count_rules" => 17
"bet_base_amount_rules" => 10
"bet_total_amount_rules" => 1000
"bet_amount_rules" => null
"bet_code_rules" => null
"bet_count_rules" => 0
"win_lose_rules" => "1"
"continuous_lose_count_rules" => 0
"continuous_win_count_rules" => 0
"total_amount_rules" => 1000.0
"title" => "AAAAAA-倍投2023-05-06 10:34:04 copy"
"current_bet_code_rule" => null
"current_bet_amount_rule" => null
"current_issue" => null
"last_issue" => "32726492"
"updated_at" => "2023-05-06 10:34:04"
"created_at" => "2023-05-06 10:34:04"
"id" => 79
]
',
                'created_at' => '2023-05-06 10:34:04',
                'updated_at' => '2023-05-06 10:34:04',
                'duration' => '1142.17591285710000',
            ),
            36 => 
            array (
                'id' => 37,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:35:03',
                'result' => '"76" // app/Console/Commands/RequestCrontab.php:49
81 // app/Console/Commands/RequestCrontab.php:49
',
                'created_at' => '2023-05-06 10:35:03',
                'updated_at' => '2023-05-06 10:35:03',
                'duration' => '1036.49401664730000',
            ),
            37 => 
            array (
                'id' => 38,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:36:03',
                'result' => '"76" // app/Console/Commands/RequestCrontab.php:49
82 // app/Console/Commands/RequestCrontab.php:49
',
                'created_at' => '2023-05-06 10:36:03',
                'updated_at' => '2023-05-06 10:36:03',
                'duration' => '1109.22503471370000',
            ),
            38 => 
            array (
                'id' => 39,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:37:03',
                'result' => '"76" // app/Console/Commands/RequestCrontab.php:49
83 // app/Console/Commands/RequestCrontab.php:49
',
                'created_at' => '2023-05-06 10:37:03',
                'updated_at' => '2023-05-06 10:37:03',
                'duration' => '1210.05892753600000',
            ),
            39 => 
            array (
                'id' => 40,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:38:04',
                'result' => '"76" // app/Console/Commands/RequestCrontab.php:49
84 // app/Console/Commands/RequestCrontab.php:49
',
                'created_at' => '2023-05-06 10:38:04',
                'updated_at' => '2023-05-06 10:38:04',
                'duration' => '1229.60591316220000',
            ),
            40 => 
            array (
                'id' => 41,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:39:04',
                'result' => 'Request Crontab 86 2023-05-06 10:39:04
',
                'created_at' => '2023-05-06 10:39:04',
                'updated_at' => '2023-05-06 10:39:04',
                'duration' => '1893.61405372620000',
            ),
            41 => 
            array (
                'id' => 42,
                'task_id' => 1,
                'ran_at' => '2023-05-06 02:40:04',
                'result' => 'Request Crontab 87 2023-05-06 10:40:04
',
                'created_at' => '2023-05-06 10:40:04',
                'updated_at' => '2023-05-06 10:40:04',
                'duration' => '1515.92516899110000',
            ),
            42 => 
            array (
                'id' => 43,
                'task_id' => 1,
                'ran_at' => '2023-05-06 03:00:04',
                'result' => 'Request Crontab 88 2023-05-06 11:00:04
',
                'created_at' => '2023-05-06 11:00:04',
                'updated_at' => '2023-05-06 11:00:04',
                'duration' => '1180.45496940610000',
            ),
            43 => 
            array (
                'id' => 44,
                'task_id' => 1,
                'ran_at' => '2023-05-06 15:00:03',
                'result' => 'Request Crontab 89 2023-05-06 23:00:03
',
                'created_at' => '2023-05-06 23:00:03',
                'updated_at' => '2023-05-06 23:00:03',
                'duration' => '1167.37890243530000',
            ),
            44 => 
            array (
                'id' => 45,
                'task_id' => 1,
                'ran_at' => '2023-05-07 15:00:03',
                'result' => 'Request Crontab 76 not found

Illuminate\\Database\\Eloquent\\ModelNotFoundException 

No query results for model [App\\Models\\Request] 76

at vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:489
485▕             return $result;
486▕         }
487▕ 
488▕         if (is_null($result)) {
➜ 489▕             throw (new ModelNotFoundException)->setModel(
490▕                 get_class($this->model), $id
491▕             );
492▕         }
493▕

[2m+3 vendor frames [22m
4   app/Console/Commands/RequestCrontab.php:42
Illuminate\\Database\\Eloquent\\Model::__callStatic()

[2m+13 vendor frames [22m
18  artisan:37
Illuminate\\Foundation\\Console\\Kernel::handle()
',
            'created_at' => '2023-05-07 23:00:03',
            'updated_at' => '2023-05-07 23:00:03',
            'duration' => '1286.90981864930000',
        ),
        45 => 
        array (
            'id' => 46,
            'task_id' => 1,
            'ran_at' => '2023-05-08 15:00:03',
            'result' => 'Request Crontab 76 not found

Illuminate\\Database\\Eloquent\\ModelNotFoundException 

No query results for model [App\\Models\\Request] 76

at vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:489
485▕             return $result;
486▕         }
487▕ 
488▕         if (is_null($result)) {
➜ 489▕             throw (new ModelNotFoundException)->setModel(
490▕                 get_class($this->model), $id
491▕             );
492▕         }
493▕

[2m+3 vendor frames [22m
4   app/Console/Commands/RequestCrontab.php:42
Illuminate\\Database\\Eloquent\\Model::__callStatic()

[2m+13 vendor frames [22m
18  artisan:37
Illuminate\\Foundation\\Console\\Kernel::handle()
',
        'created_at' => '2023-05-08 23:00:03',
        'updated_at' => '2023-05-08 23:00:03',
        'duration' => '1288.42115402220000',
    ),
    46 => 
    array (
        'id' => 47,
        'task_id' => 1,
        'ran_at' => '2023-05-09 15:00:04',
        'result' => 'Request Crontab 85 2023-05-09 23:00:04
',
        'created_at' => '2023-05-09 23:00:04',
        'updated_at' => '2023-05-09 23:00:04',
        'duration' => '1242.66290664670000',
    ),
    47 => 
    array (
        'id' => 48,
        'task_id' => 1,
        'ran_at' => '2023-05-10 15:00:04',
        'result' => 'Request Crontab 136 2023-05-10 23:00:04
',
        'created_at' => '2023-05-10 23:00:04',
        'updated_at' => '2023-05-10 23:00:04',
        'duration' => '1416.76187515260000',
    ),
    48 => 
    array (
        'id' => 49,
        'task_id' => 1,
        'ran_at' => '2023-05-11 15:00:03',
        'result' => 'Request Crontab 76 not found

Illuminate\\Database\\Eloquent\\ModelNotFoundException 

No query results for model [App\\Models\\Request] 76

at vendor/laravel/framework/src/Illuminate/Database/Eloquent/Builder.php:489
485▕             return $result;
486▕         }
487▕ 
488▕         if (is_null($result)) {
➜ 489▕             throw (new ModelNotFoundException)->setModel(
490▕                 get_class($this->model), $id
491▕             );
492▕         }
493▕

[2m+3 vendor frames [22m
4   app/Console/Commands/RequestCrontab.php:42
Illuminate\\Database\\Eloquent\\Model::__callStatic()

[2m+13 vendor frames [22m
18  artisan:37
Illuminate\\Foundation\\Console\\Kernel::handle()
',
    'created_at' => '2023-05-11 23:00:03',
    'updated_at' => '2023-05-11 23:00:03',
    'duration' => '973.31809997559000',
),
49 => 
array (
    'id' => 50,
    'task_id' => 1,
    'ran_at' => '2023-05-12 02:49:31',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 10:49:31',
    'updated_at' => '2023-05-12 10:49:31',
    'duration' => '142.63010025024000',
),
50 => 
array (
    'id' => 51,
    'task_id' => 1,
    'ran_at' => '2023-05-12 02:53:18',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 10:53:18',
    'updated_at' => '2023-05-12 10:53:18',
    'duration' => '105.88788986206000',
),
51 => 
array (
    'id' => 52,
    'task_id' => 1,
    'ran_at' => '2023-05-12 02:56:22',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 10:56:22',
    'updated_at' => '2023-05-12 10:56:22',
    'duration' => '119.89808082581000',
),
52 => 
array (
    'id' => 53,
    'task_id' => 1,
    'ran_at' => '2023-05-12 02:57:45',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 10:57:45',
    'updated_at' => '2023-05-12 10:57:45',
    'duration' => '133.83889198303000',
),
53 => 
array (
    'id' => 54,
    'task_id' => 1,
    'ran_at' => '2023-05-12 03:02:12',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 11:02:12',
    'updated_at' => '2023-05-12 11:02:12',
    'duration' => '119.33898925781000',
),
54 => 
array (
    'id' => 55,
    'task_id' => 1,
    'ran_at' => '2023-05-12 03:03:03',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 11:03:03',
    'updated_at' => '2023-05-12 11:03:03',
    'duration' => '119.23098564148000',
),
55 => 
array (
    'id' => 56,
    'task_id' => 1,
    'ran_at' => '2023-05-12 03:03:31',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 11:03:31',
    'updated_at' => '2023-05-12 11:03:31',
    'duration' => '121.27590179443000',
),
56 => 
array (
    'id' => 57,
    'task_id' => 1,
    'ran_at' => '2023-05-12 03:06:28',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 11:06:28',
    'updated_at' => '2023-05-12 11:06:28',
    'duration' => '128.22389602661000',
),
57 => 
array (
    'id' => 58,
    'task_id' => 1,
    'ran_at' => '2023-05-12 03:06:59',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 11:06:59',
    'updated_at' => '2023-05-12 11:06:59',
    'duration' => '134.96613502502000',
),
58 => 
array (
    'id' => 59,
    'task_id' => 1,
    'ran_at' => '2023-05-12 03:08:13',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-12 11:08:13',
    'updated_at' => '2023-05-12 11:08:13',
    'duration' => '110.00204086304000',
),
59 => 
array (
    'id' => 60,
    'task_id' => 1,
    'ran_at' => '2023-05-12 15:00:03',
    'result' => 'Request Crontab 20 2023-05-12 23:00:03
',
    'created_at' => '2023-05-12 23:00:03',
    'updated_at' => '2023-05-12 23:00:03',
    'duration' => '998.38304519653000',
),
60 => 
array (
    'id' => 61,
    'task_id' => 2,
    'ran_at' => '2023-05-13 04:02:01',
'result' => 'Not enough arguments (missing: "id").',
    'created_at' => '2023-05-13 12:02:01',
    'updated_at' => '2023-05-13 12:02:01',
    'duration' => '66.40291213989300',
),
61 => 
array (
    'id' => 62,
    'task_id' => 1,
    'ran_at' => '2023-05-13 15:00:03',
    'result' => 'Request Crontab 25 2023-05-13 23:00:03
',
    'created_at' => '2023-05-13 23:00:03',
    'updated_at' => '2023-05-13 23:00:03',
    'duration' => '1039.87407684330000',
),
62 => 
array (
    'id' => 63,
    'task_id' => 2,
    'ran_at' => '2023-05-14 04:00:03',
    'result' => 'Request Crontab 28 2023-05-14 12:00:02
',
    'created_at' => '2023-05-14 12:00:03',
    'updated_at' => '2023-05-14 12:00:03',
    'duration' => '1074.63002204900000',
),
63 => 
array (
    'id' => 64,
    'task_id' => 1,
    'ran_at' => '2023-05-14 15:00:03',
    'result' => 'Request Crontab 61 2023-05-14 23:00:03
',
    'created_at' => '2023-05-14 23:00:03',
    'updated_at' => '2023-05-14 23:00:03',
    'duration' => '1107.26404190060000',
),
64 => 
array (
    'id' => 65,
    'task_id' => 2,
    'ran_at' => '2023-05-15 04:00:03',
    'result' => 'Request Crontab 63 2023-05-15 12:00:03
',
    'created_at' => '2023-05-15 12:00:03',
    'updated_at' => '2023-05-15 12:00:03',
    'duration' => '1152.22311019900000',
),
65 => 
array (
    'id' => 66,
    'task_id' => 1,
    'ran_at' => '2023-05-15 15:00:03',
    'result' => 'Request Crontab 68 2023-05-15 23:00:03
',
    'created_at' => '2023-05-15 23:00:03',
    'updated_at' => '2023-05-15 23:00:03',
    'duration' => '1056.89811706540000',
),
66 => 
array (
    'id' => 67,
    'task_id' => 2,
    'ran_at' => '2023-05-16 04:00:03',
    'result' => 'Request Crontab 70 2023-05-16 12:00:03
',
    'created_at' => '2023-05-16 12:00:03',
    'updated_at' => '2023-05-16 12:00:03',
    'duration' => '983.26802253723000',
),
67 => 
array (
    'id' => 68,
    'task_id' => 1,
    'ran_at' => '2023-05-16 15:00:03',
    'result' => 'Request Crontab 75 2023-05-16 23:00:03
',
    'created_at' => '2023-05-16 23:00:03',
    'updated_at' => '2023-05-16 23:00:03',
    'duration' => '968.99795532227000',
),
68 => 
array (
    'id' => 69,
    'task_id' => 2,
    'ran_at' => '2023-05-17 04:00:03',
    'result' => 'Request Crontab 82 2023-05-17 12:00:03
',
    'created_at' => '2023-05-17 12:00:03',
    'updated_at' => '2023-05-17 12:00:03',
    'duration' => '1045.44401168820000',
),
));
        
        
    }
}